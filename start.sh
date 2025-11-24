#!/bin/sh

# === Função para esperar o banco de dados ===
wait_for_db() {
  echo "Aguardando o serviço MySQL..."
  
  # MUDEI AQUI: Nomes diferentes para não sobrescrever as variáveis globais
  CHECK_HOST="${DB_HOST:-127.0.0.1}"
  CHECK_PORT="${DB_PORT:-3306}"
  
  MAX_ATTEMPTS=20
  
  for i in $(seq 1 $MAX_ATTEMPTS); do
    # MUDEI AQUI TAMBÉM: Usando as novas variáveis
    nc -z $CHECK_HOST $CHECK_PORT 
    EXIT_CODE=$?
    
    if [ $EXIT_CODE -eq 0 ]; then
        echo "MySQL ($CHECK_HOST:$CHECK_PORT) pronto na tentativa $i!"
        return 0
    fi
    
    echo "Tentativa $i/$MAX_ATTEMPTS: Conexão recusada em $CHECK_HOST:$CHECK_PORT. Aguardando 3s..."
    sleep 3
  done
  
  echo "ERRO CRÍTICO: O serviço MySQL não respondeu."
  exit 1
}

# === Execução dos Comandos ===

# 1. Limpa TODOS os caches antigos
echo "Limpando caches e configuração..."
php artisan optimize:clear

# 2. Chama a função de espera
wait_for_db

# 3. Roda Migrações
echo "Rodando Migrações..."
php artisan migrate --force

# 4. Cacheia a configuração para produção
echo "Gerando cache de produção..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "Criando link do Storage..."
# Remove qualquer link velho/quebrado e cria um novo
rm -rf public/storage
php artisan storage:link

# 5. Inicia o Servidor
# O Railway define a variável $PORT automaticamente. 
# Se ela não existir, usamos 8080 como fallback, MAS NÃO 3306.
echo "Iniciando Servidor Laravel na porta ${PORT:-8080}..."
exec php artisan serve --host 0.0.0.0 --port ${PORT:-8080}