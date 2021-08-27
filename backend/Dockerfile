FROM ubuntu:20.04
ARG DEBIAN_FRONTEND=noninteractive

ARG PHP_VERSION

# Update repositories index
RUN apt-get update --fix-missing && apt-get upgrade -y

# Install util tools
RUN ln -snf /usr/share/zoneinfo/UTC /etc/localtime && echo "UTC" > /etc/timezone
RUN apt-get install -y apt-utils git rsync nano vim unzip curl wget software-properties-common 

# Install Apache
RUN apt-get install -y apache2
RUN apt-get install openssl

RUN apt-get install -y php$PHP_VERSION libapache2-mod-php$PHP_VERSION

# Install PHP extensions
RUN apt-get install -y -m   php$PHP_VERSION-cli \
    php$PHP_VERSION-dev \
    php$PHP_VERSION-common \
    php$PHP_VERSION-json \
    php$PHP_VERSION-intl \
    php$PHP_VERSION-curl \
    php$PHP_VERSION-mysql \
    php$PHP_VERSION-gd \
    php$PHP_VERSION-imagick \
    php$PHP_VERSION-ldap \
    php$PHP_VERSION-soap\
    php$PHP_VERSION-zip \
    php$PHP_VERSION-mbstring \
    php$PHP_VERSION-bcmath \
    php$PHP_VERSION-xml \
    php$PHP_VERSION-imap \
    php$PHP_VERSION-bz2

# Install XDebug
RUN apt-get install php$PHP_VERSION-xdebug
# Config XDebug
COPY .docker/config/20-xdebug.ini /etc/php/$PHP_VERSION/cli/conf.d/20-xdebug.ini

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Config Apache
ENV APACHE_RUN_USER www-data
ENV APACHE_RUN_GROUP www-data
ENV APACHE_LOG_DIR /var/log/apache2

RUN chown www-data:www-data -R /var/www
RUN chmod -R 755 /var/www

RUN mkdir /var/www/html/public

COPY .docker/config/000-default.conf /etc/apache2/sites-available/000-default.conf
COPY .docker/config/default-ssl.conf /etc/apache2/sites-available/default-ssl.conf

RUN a2enmod ssl
RUN a2enmod headers

RUN a2enmod rewrite headers
RUN cd /etc/apache2/sites-available
RUN a2ensite default-ssl.conf
RUN service apache2 start

# Installation of pdftotext
RUN apt-get -y install poppler-utils
#Directory to store files
RUN mkdir /var/db_docs
RUN mkdir /var/db_docs/cv
RUN mkdir /var/db_docs/txt
RUN mkdir /var/db_docs/offer
RUN chown www-data:www-data -R /var/db_docs
RUN chmod -R 755 /var/db_docs



WORKDIR /var/www/html


EXPOSE 80
EXPOSE 8000
EXPOSE 443
EXPOSE 9000