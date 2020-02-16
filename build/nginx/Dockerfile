FROM nginx

COPY build/nginx/default.conf.template /etc/nginx/conf.d/default.conf

WORKDIR /var/www/html

ENTRYPOINT ["./build/nginx/start.sh"]
