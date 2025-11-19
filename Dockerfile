# ===============================================
# STAGE 1: COMPILAÇÃO DOS ASSETS FRONTEND (Vite/Node.js)
# Resultado: O Node.js compila o CSS/JS e gera a pasta public/build
# ===============================================
FROM node:20-alpine AS frontend_builder

WORKDIR /app

# Copia os arquivos de configuração do Node
COPY package*.json ./
# Instala as dependências Node (Vite, etc.)
RUN npm install
# Copia o restante dos arquivos para o container Node
COPY . .

# Compila os assets do frontend (CRIA A PASTA public/build)
RUN npm run build


# ===============================================
# STAGE 2: AMBIENTE DE EXECUÇÃO PHP (LARAVEL)
# Resultado: Imagem PHP leve com todos os assets e dependências
# ===============================================
FROM php:8.3-fpm-alpine AS laravel_runtime

# Instala dependências do sistema e as extensões PHP necessárias
RUN apk update && apk add --no-cache \
    git \
    zip \
    libzip-dev \
    icu-dev \
    curl \
    # Instala as extensões PHP que o Filament exige (Resolvendo erros anteriores)
    && docker-php-ext-install \
        pdo_mysql \
        bcmath \
        zip \
        intl \
    # Limpa o cache após a instalação
    && rm -rf /var/cache/apk/*

# Instala o Composer Globalmente (Resolveu o erro 'composer: not found')
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Define o diretório de trabalho e copia os arquivos do backend
WORKDIR /app
COPY . /app

# COPIA OS ASSETS COMPILADOS DA ETAPA 1 para a pasta public/build
COPY --from=frontend_builder /app/public/build/ /app/public/build/


# Instala as dependências do Composer (Backend)
RUN composer install --optimize-autoloader --no-scripts --no-dev

# Cria o .env de produção e limpa o cache
RUN cp .env.example .env
RUN rm -f bootstrap/cache/*.php

# Permissões (Essencial para que o Artisan possa gravar)
RUN chown -R www-data:www-data /app/storage /app/bootstrap/cache \
    && chmod -R 775 /app/storage /app/bootstrap/cache

# Adiciona o script de inicialização e o torna executável (start.sh)
COPY start.sh /usr/local/bin/start.sh
RUN chmod +x /usr/local/bin/start.sh

EXPOSE 8080

# Comando para iniciar o servidor (Executa o script de migração e depois inicia o servidor)
CMD ["/usr/local/bin/start.sh"]