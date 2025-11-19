# ===============================================
# STAGE 1: COMPILAÇÃO DOS ASSETS FRONTEND (Vite/Node.js) - DEVE VIR PRIMEIRO
# ===============================================
FROM node:20-alpine AS frontend_builder

WORKDIR /app

# 1. Copia arquivos de configuração do Node
COPY package*.json ./
# 2. Instala as dependências Node (Vite, etc.)
RUN npm install
# 3. Copia o restante dos arquivos (incluindo /resources)
COPY . .

# 4. **Comando de Build:** (Se este passo falhar, a Etapa 2 falha)
RUN npm run build


# ===============================================
# STAGE 2: AMBIENTE DE EXECUÇÃO PHP (LARAVEL) - REFERENCIA O STAGE 1
# ===============================================
FROM php:8.3-fpm-alpine AS laravel_runtime

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
RUN rm -f bootstrap/cache/*.php

# >>> CORREÇÃO ESTRUTURAL AQUI: A CÓPIA AGORA OCORRE APÓS A DEFINIÇÃO DO STAGE 1
COPY --from=frontend_builder /app/public/build/ /app/public/build/

# Adiciona o script de inicialização e o torna executável
COPY start.sh /usr/local/bin/start.sh
RUN chmod +x /usr/local/bin/start.sh

EXPOSE 8080

# Comando para iniciar o servidor (Executa o script de inicialização)
CMD ["/usr/local/bin/start.sh"]