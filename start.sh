#!/bin/sh

# === Função para esperar o banco de dados ===
wait_for_db() {
  echo "Aguardando o serviço MySQL..."
  # Tenta usar as variáveis do ambiente, se não existirem, usa padrão
  HOST="${DB_HOST:-127.0.0.1}"
  PORT="${DB_PORT:-3306}"
  MAX_ATTEMPTS=20
  
  for i in $(seq 1 $MAX_ATTEMPTS); do
    nc -z $HOST $PORT 
    EXIT_CODE=$?
    
    if [ $EXIT_CODE -eq 0 ]; then
        echo "MySQL ($HOST:$PORT) pronto na tentativa $i!"
        return 0
    fi
    
    echo "Tentativa $i/$MAX_ATTEMPTS: Conexão recusada em $HOST:$PORT. Aguardando 3s..."
    sleep 3
  done
  
  echo "ERRO CRÍTICO: O serviço MySQL não respondeu."
  exit 1
}

# === Execução dos Comandos ===

# 1. Limpa TODOS os caches antigos (ESSENCIAL PARA CORRIGIR SEU ERRO)
echo "Limpando caches e configuração..."
php artisan optimize:clear

# 2. Chama a função de espera
wait_for_db

# 3. Roda Migrações
echo "Rodando Migrações..."
php artisan migrate --force

# 4. (Opcional) Seeders - Cuidado para não duplicar dados
# Se seus seeders não verificam se o dado já existe, comente a linha abaixo
# php artisan db:seed --force

# 5. Cacheia a configuração para produção (Performance)
echo "Gerando cache de produção..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 6. Inicia o Servidor usando a porta do Railway ($PORT)
echo "Iniciando Servidor Laravel na porta ${PORT:-8080}..."
exec php artisan serve --host 0.0.0.0 --port ${PORT:-8080}