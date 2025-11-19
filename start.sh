#!/bin/sh

# === Inicialização do Banco de Dados e Aplicação ===
# Esta função usa 'nc' (netcat, instalado na imagem alpine) para checar a porta.
wait_for_db() {
  echo "Aguardando o serviço MySQL..."
  # O host é o endereço interno do Railway (mysql.railway.internal)
  HOST="mysql.railway.internal"
  PORT="3306"
  
  # Loop que tenta a conexão 10 vezes com um pequeno intervalo
  for i in $(seq 1 10); do
    nc -z $HOST $PORT && echo "MySQL pronto!" && return
    echo "Tentativa $i: MySQL ainda indisponível. Aguardando 3 segundos..."
    sleep 3
  done
  echo "ERRO: O serviço MySQL não respondeu após várias tentativas."
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