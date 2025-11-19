#!/bin/sh

# === Inicialização do Banco de Dados e Aplicação ===
# Esta função usa 'nc' (netcat, instalado na imagem alpine) para checar a porta.
wait_for_db() {
  echo "Aguardando o serviço MySQL (mysql.railway.internal)..."
  HOST="mysql.railway.internal"
  PORT="3306"
  MAX_ATTEMPTS=20 # 20 tentativas * 5 segundos = 100 segundos de espera total
  
  for i in $(seq 1 $MAX_ATTEMPTS); do
    # Tenta conectar na porta. O nc retorna 0 se a conexão for bem-sucedida.
    nc -z $HOST $PORT 
    EXIT_CODE=$?
    
    if [ $EXIT_CODE -eq 0 ]; then
        echo "MySQL pronto na tentativa $i!"
        return 0
    fi
    
    echo "Tentativa $i/$MAX_ATTEMPTS: Conexão recusada. Aguardando 5 segundos..."
    sleep 5
  done
  
  echo "ERRO CRÍTICO: O serviço MySQL não respondeu após $MAX_ATTEMPTS tentativas."
  exit 1
}

# 1. Gera a APP_KEY (Deve rodar no runtime, antes de qualquer operação de DB/sessão)
echo "Gerando APP Key..."
php artisan key:generate

# 2. Espera um pouco para dar tempo do serviço MySQL iniciar
echo "Aguardando 5 segundos para garantir a conexão com o banco de dados..."
sleep 5

# 3. Roda Migrações (Cria/atualiza tabelas)
echo "Rodando Migrações..."
php artisan migrate --force

# 4. Roda Seeders (Popula o banco com Admin, Tags e Conteúdos)
echo "Rodando Seeders..."
php artisan db:seed --force

# 5. Inicia o Servidor Laravel (Comando final de execução)
echo "Iniciando Servidor Laravel..."
exec php artisan serve --host 0.0.0.0 --port 8080