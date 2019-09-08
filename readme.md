- 運用環境構築はこちらを参考に！！！
https://qiita.com/ryuta69/items/dbb0db5cf7099b7a7cc4#%E3%81%BE%E3%81%A8%E3%82%81

- ローカル開発環境
https://docs.docker.com/compose/wordpress/

```
// docker-compose.yml
version: '3.3'

services:
   db:
     image: mysql:5.7
     volumes:
       - db_data:/var/lib/mysql
     restart: always
     environment:
       MYSQL_ROOT_PASSWORD: somewordpress
       MYSQL_DATABASE: wordpress
       MYSQL_USER: wordpress
       MYSQL_PASSWORD: wordpress

   wordpress:
     depends_on:
       - db
     image: wordpress:latest
     ports:
       - "8000:80"
     restart: always
     environment:
       WORDPRESS_DB_HOST: db:3306
       WORDPRESS_DB_USER: wordpress
       WORDPRESS_DB_PASSWORD: wordpress
       WORDPRESS_DB_NAME: wordpress
volumes:
    db_data: {}
```

`$ docker-compose up -d`

# ローカル環境パスワード
ID: djiro
PASS: Y39LM3DNx74ee7dqMm69CZ3v

