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

# Instala o Composer Globalmente (resolveu o erro 'composer: not found')
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Define o diretório de trabalho
WORKDIR /app

# Copia os arquivos do projeto para o container
COPY . /app

# Instala as dependências do Composer
RUN composer install --optimize-autoloader --no-scripts --no-dev

# Cria as pastas de cache e storage e define permissões
RUN chown -R www-data:www-data /app/storage /app/bootstrap/cache \
    && chmod -R 775 /app/storage /app/bootstrap/cache

# Cria o .env de produção (irá puxar as variáveis do Railway)
RUN cp .env.example .env

# Limpa o cache para corrigir a referência quebrada de Service Provider
RUN rm -f bootstrap/cache/*.php

# ----------------------------------------------------------------------
# NOVIDADE: Adiciona o script de inicialização e o torna executável
# ----------------------------------------------------------------------

# Copia o script para um local executável
COPY start.sh /usr/local/bin/start.sh
# Define permissão de execução
RUN chmod +x /usr/local/bin/start.sh

# REMOVE: Os comandos de banco de dados e key:generate são movidos para o start.sh
# REMOVE: RUN php artisan key:generate
# REMOVE: RUN php artisan migrate --force
# REMOVE: RUN php artisan db:seed --force

# Expõe a porta que o servidor Artisan vai usar
EXPOSE 8080

# Comando para iniciar o servidor web (Executa o script de inicialização)
CMD ["/usr/local/bin/start.sh"]