#!/bin/sh

# === Função para esperar o banco de dados (Mais Robusta) ===
wait_for_db() {
  echo "Aguardando o serviço MySQL (mysql.railway.internal)..."
  HOST="$DB_HOST"
  PORT="$DB_PORT"
  MAX_ATTEMPTS=20 # 20 tentativas * 3 segundos = 60 segundos de espera total
  
  for i in $(seq 1 $MAX_ATTEMPTS); do
    # Tenta conectar na porta. O nc retorna 0 se a conexão for bem-sucedida.
    nc -z $HOST $PORT 
    EXIT_CODE=$?
    
    if [ $EXIT_CODE -eq 0 ]; then
        echo "MySQL pronto na tentativa $i!"
        return 0
    fi
    
    echo "Tentativa $i/$MAX_ATTEMPTS: Conexão recusada. Aguardando 3 segundos..."
    sleep 3
  done
  
  echo "ERRO CRÍTICO: O serviço MySQL não respondeu após $MAX_ATTEMPTS tentativas."
  exit 1
}

# === Execução dos Comandos ===

# 1. Gera a APP_KEY (Roda primeiro, pois não depende do DB, mas precisa ser estável)
echo "Gerando APP Key..."
php artisan key:generate

# 2. CHAMA A FUNÇÃO DE ESPERA
wait_for_db

# 3. Roda Migrações (Agora que o banco está pronto)
echo "Rodando Migrações..."
php artisan migrate --force

# 4. Roda Seeders (Popula o banco)
echo "Rodando Seeders..."
php artisan db:seed --force

# 5. Inicia o Servidor Laravel
echo "Iniciando Servidor Laravel..."
exec php artisan serve --host 0.0.0.0 --port 8080