# Usa uma imagem PHP base que o Laravel e Railway suportam (ex: 8.3-fpm-alpine)
FROM php:8.3-fpm-alpine 

# Instala dependências do sistema e as extensões PHP necessárias
RUN apk update && apk add --no-cache \
    git \
    zip \
    libzip-dev \
    icu-dev \
    curl \
    # Instala as extensões PHP que o Filament exige
    && docker-php-ext-install \
        pdo_mysql \
        bcmath \
        zip \
        intl \
    # Limpa o cache após a instalação
    && rm -rf /var/cache/apk/*

# Instala o Composer Globalmente (RESOLVE O ERRO 'composer: not found')
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Define o diretório de trabalho
WORKDIR /app

# Copia os arquivos do projeto para o container
COPY . /app

# Instala as dependências do Composer
RUN composer install --optimize-autoloader --no-scripts --no-dev

# Cria as pastas de cache e storage e define permissões 
# ISSO É ESSENCIAL: Permite que o PHP escreva em logs, cache e storage.
RUN chown -R www-data:www-data /app/storage /app/bootstrap/cache \
    && chmod -R 775 /app/storage /app/bootstrap/cache

# Cria o .env de produção (irá puxar as variáveis de ambiente do Railway)
RUN cp .env.example .env

# =================================================================
# CORREÇÃO CRÍTICA DO ERRO 'Class Not Found'
# 1. Limpa o cache de configuração que contém a referência quebrada
RUN php artisan config:clear
# 2. Reconstroi o manifesto de pacotes, ignorando o cache antigo.
RUN php artisan package:discover --ansi
# =================================================================

# 1. Gera a APP_KEY (necessário para a segurança e sessions)
RUN php artisan key:generate

# 2. Roda as Migrações (Cria as tabelas)
RUN php artisan migrate --force

# 3. Roda os Seeders (Popula os conteúdos, Tags e Admin)
RUN php artisan db:seed --force

# Expõe a porta que o servidor Artisan vai usar
EXPOSE 8080

# Comando para iniciar o servidor web (servidor Artisan do Laravel)
CMD ["php", "artisan", "serve", "--host", "0.0.0.0", "--port", "8080"]