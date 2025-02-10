FROM php:8.3-cli

RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    git \
    vim \
    && docker-php-ext-install zip pdo_mysql

RUN apt-get install -y zsh && \
    chsh -s $(which zsh)

RUN yes | sh -c "$(curl -fsSL https://raw.githubusercontent.com/ohmyzsh/ohmyzsh/master/tools/install.sh)"

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY aliases.sh /etc/aliases.sh
RUN echo "source /etc/aliases.sh" >> ~/.zshrc

WORKDIR /app

EXPOSE 8000

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]