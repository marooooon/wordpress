## 運用環境構築
https://qiita.com/ryuta69/items/dbb0db5cf7099b7a7cc4#%E3%81%BE%E3%81%A8%E3%82%81

## ローカル開発環境
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
     volumes:
       - ./themes/theme-template:/var/www/html/wp-content/themes/theme-template
       - ./themes/daijiroblog:/var/www/html/wp-content/themes/daijiroblog
     restart: always
     environment:
       WORDPRESS_DB_HOST: db:3306
       WORDPRESS_DB_USER: wordpress
       WORDPRESS_DB_PASSWORD: wordpress
       WORDPRESS_DB_NAME: wordpress
volumes:
    db_data: {}
```

- このコードでtempleteを作成することができる
```
volumes:
       - ./themes/theme-template:/var/www/html/wp-content/themes/theme-template
       - ./themes/daijiroblog:/var/www/html/wp-content/themes/daijiroblog
```

### ローカル開発環境コマンド
#### dockerデプロイ
- `$ docker-compose up -d`
- `localhost:8000`で表示

## ローカル環境パスワード
個人PCの1passwordに記載

## テーマ
#### daijiroblog
自分のブログコンテンツ

#### gulp-wordpress
gulp回して作成できる

#### original
いつ作ったんだろう。知らない。

#### theme-bones
カスタマイズしまくれるテーマ
名前の由来は「骨組み」らしい

#### theme-templete
最低限書かれた自作テンプレ

#### WP_sample
参考書にあったサンプルコード