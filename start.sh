#!/bin/sh

# === Inicialização do Banco de Dados e Aplicação ===

# 1. Espera um pouco para dar tempo do serviço MySQL iniciar (Opcional, mas mais seguro)
echo "Aguardando 5 segundos para garantir a conexão com o banco de dados..."
sleep 5

# 2. Roda Migrações (Cria/atualiza tabelas)
echo "Rodando Migrações..."
php artisan migrate --force

# 3. Roda Seeders (Popula o banco com Admin, Tags e Conteúdos)
echo "Rodando Seeders..."
php artisan db:seed --force

# 4. Gera a APP_KEY (garante que a chave existe e está no ambiente)
echo "Gerando APP Key..."
php artisan key:generate

# 5. Inicia o Servidor Laravel (Comando final de execução)
echo "Iniciando Servidor Laravel..."
exec php artisan serve --host 0.0.0.0 --port 8080