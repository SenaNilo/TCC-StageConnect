# Usa uma imagem PHP base que o Laravel e Railway suportam (ex: 8.2 ou 8.3)
# Verifique a versão do PHP que você está usando localmente.
FROM php:8.3-fpm-alpine 

# Instala dependências do sistema e as extensões PHP necessárias
RUN apk update && apk add --no-cache \
    git \
    zip \
    libzip-dev \
    icu-dev \
    # Instala as extensões
    && docker-php-ext-install \
        pdo_mysql \
        bcmath \
        zip \
        intl \
    # Limpa o cache após a instalação
    && rm -rf /var/cache/apk/*

# Define o diretório de trabalho
WORKDIR /app

# Copia os arquivos do projeto para o container
COPY . /app

# Instala as dependências do Composer (o comando que falhou antes)
RUN composer install --optimize-autoloader --no-scripts --no-dev

# Cria o .env de produção (irá puxar as variáveis do Railway)
RUN cp .env.example .env
# ... (Seu código Dockerfile para instalar dependências) ...

# 1. Gera a APP_KEY
RUN php artisan key:generate

# 2. Roda as Migrações (Cria as tabelas)
RUN php artisan migrate --force

# 3. Roda os Seeders (Popula os conteúdos)
RUN php artisan db:seed --force

# Cria as pastas de cache e storage e define permissões (Permissões de armazenamento)
RUN chown -R www-data:www-data /app/storage /app/bootstrap/cache \
    && chmod -R 775 /app/storage /app/bootstrap/cache

# Comando para iniciar o servidor web (você pode usar Nginx ou o servidor Laravel padrão)
# Se você tiver um Nginx/Caddy configurado, use-o. Senão, use o servidor do Laravel:
CMD ["php", "artisan", "serve", "--host", "0.0.0.0", "--port", "8080"]
