# Usa uma imagem PHP base que o Laravel e Railway suportam (ex: 8.3-fpm-alpine)
FROM php:8.3-fpm-alpine 

# Instala dependências do sistema e as extensões PHP necessárias
RUN apk update && apk add --no-cache \
    git \
    zip \
    libzip-dev \
    icu-dev \
    curl \
    # Instala as extensões PHP
    && docker-php-ext-install \
        pdo_mysql \
        bcmath \
        zip \
        intl \
    # Limpa o cache após a instalação
    && rm -rf /var/cache/apk/*

# Instala o Composer Globalmente
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

# CORREÇÃO CRÍTICA DO CACHE QUEBRADO:
# Remove o arquivo de cache de serviços/provedores manualmente antes de rodar o app.
RUN rm -f bootstrap/cache/*.php

# COPIA OS ASSETS COMPILADOS DA ETAPA 1
COPY --from=frontend_builder /app/public/build/ /app/public/build/

# Adiciona o script de inicialização e o torna executável
COPY start.sh /usr/local/bin/start.sh
RUN chmod +x /usr/local/bin/start.sh

EXPOSE 8080

# Comando para iniciar o servidor (Executa o script de inicialização)
CMD ["/usr/local/bin/start.sh"]