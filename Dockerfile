FROM php:8.1.3RC1-apache
RUN apt-get update && apt-get install -y vim nano mc cron

# Fix timezone: http://serverfault.com/a/683651
ENV TZ=Asia/Omsk
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

RUN printf '[PHP]\ndate.timezone = "Asia/Omsk"\n' > /usr/local/etc/php/conf.d/tzone.ini

WORKDIR /app
CMD php artisan serve --host=0.0.0.0 --port=8000

