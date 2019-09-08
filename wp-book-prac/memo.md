## wordpressファイル一式

|ファイル|概要|
|:---|:---|
|wp-content|テーマやプラグインなどに関するファイルを格納するディレクトリ。<br>基本的にがこのディレウトリの中のファイルを使用する|
|wp-adimin|管理画面に関するファイルを格納するディレクトリ|
|wp-includes|WordPressのシステム全般に関するファイルを格納するディレクトリ|
|index.php|Webサイトにアクセスがあったとき、最初に読み込まれるディレクトリ|
|wp-active.php|ユーザーのアカウントに関するファイル|
|wp-blog-header.php|WordPressの環境に関するファイルをロードするファイル|
|wp-comments-post.php|コメント投稿に関するファイル|
|wp-config-sample.php|インストール時に、このファイルを元に設定ファイルを作成する|
|wp-cron.php|PHPによる擬似cronジョブを実現するファイル|
|wp-links-opml.php|リンクのXML出力に関するファイル|
|wp-load.php|WordPressの動作に必要なプログラムをロードするファイル|
|wp-login.php|管理画面のログインに関するファイル|
|wp-mail.php|メールによるブログ投稿用のファイル|
|wp-settings.php|WordPressを動かすための変数、関数、クラスの基本設定|
|wp-signup.php|ブログ名・ユーザー名などの設定を行うファイル|
|wp-trackback.php|トラックバックとping送信用のファイル|
|xmlrpc.php|WordPressのXML-RPC通信に関するファイル|

## wordpress/index.phpに書いておく初期設定

以下の設定を終えてサーバーにアップロードをするとテーマの表示が可能

```index.php
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title><?php bloginfo('name'); ?></title>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/styles.css" type="text/css" />
</head>
<body>
<img src="<?php echo get_template_directory_uri(); ?>/images/~" />

</body>
</html>

```

## テンプレートファイルの設定
ページごとのレイアウトを製作するためのページ

|テンプレートファイル名|概要|
|:---|:---|
|front-page.php|トップページ|
|single.php|投稿の記事ページを表示|
|page.php|固定ページの表示|
|category.php|カテゴリーページを表示|
|search.php|検索結果ページを表示|
|archive.php|記事一覧を表示|
|404.php|エラーページの表示|

## テンプレートの優先順位
wordpressには優先順位がある。

`front-page.php > index.php`

## テンプレート階層を考えるP.48
すべてのページのデザインが同じであれば`index.php`で良いけど、そういうわけにもいかない。
優先順位の表があるけど、めんどくさいからp.48みて。それか巻末に書いている

## テンプレートタグを使用するためのパラメータ

<?php bloginfo('hogehoge'); ?>
このhogehogeに入るもの

|パラメータ|機能|
|---|---|
|name|サイトのタイトル|
|description|キャッチフレーズ|

※管理画面で設定した値が入る

## リンクの設定
トップページに行く
`<a href="<?php echo home_url(); ?>">`

## 管理者だけに見える設定を表示
`<body <?php body_class(); ?>>`

これを設定することによって管理者だけに見える設定画面をつけることができる。
が、HTMLとCSS側で設定をしておかなければならない。

```HTML
<div class="adminOnly">
    ログインユーザーのみ表示
</div>

```

```CSS
body .adminOnly {
    display: none;
}

body.logged-in .adminOnly {
    display: block;
}
```

## テンプレートを分割する
テンプレートを分割することで、管理しやすくなる

- header.php
- sidebar.php
- header.php

など

## ヘッダーを読み込む
index.phpに`<?php get_header(); ?>`を書いて`header.php`を読み込む

同様に`footer`や`sidebar`も読み込める

## プラグインを読み込む準備
`header.php`、`footer.php`に`<?php wp_head(); ?>`、`<?php wp_footer(); ?>`を書くことでプラグインを使用できるようになる

## jQueryを読み込む
`<?php wp_enqueue_script('jQuery') ?>`をheaderに加える

## jQuery以外のjsファイルを読み込む
`<?php wp_enqueue_script('js-name',get_teplate_directory_uri() . '/js/hogehoge.js') ?>`をheaderに加える

## 条件分岐タグ
```
<?php if (is_home()) : ?>
    <div class="only-home">トップページのときだけここを表示</div>
    <?php endif; ?>
```

|条件分岐|内容|
|---|---|
|is_home()|トップページかどうかを判定|
|is_single('パラメータ')|記事ページかどうかを判定。例: is_single(2), is_single('hogehoge') |
|is_page('パラメータ')|固定ページかどうかを判定|
|is_category('パラメータ')|カテゴリーページかどうかを判定|

## ページタイトルを取得する〜応用〜
`<title><?php bloginfo('name'); ?></title>`でとっていたが
`wp_title(' - ' , true, 'right');` とすることで
【Daijiro Blog - IT分野を専門に~】のように表示される

## WordPressループの基本構造p.68
```angular2html
<?php
if (have_post()) :
    while ( have_posts() ) : the_post();
?>

ここに投稿された記事情報ループされます。

<?php
    endwhile;
endif;
?>

```

以下のコードを説明すると
```angular2html
記事が１件以上存在するのか
    →する 記事が存在するだけループする
         ループの中の情報を取得
         ループが終わると戻る
    →じない 記事がなかったら終了
    

```

## 基本のワードプレスルールを作る

### 記事IDを取得する
```
<article id="post-<?php the_ID(); ?>" <?php post_class('news') ?> >
~~~~~
</article>
```

### カテゴリーを取得
```angular2html
<div class="categories">
<?php the_category(); ?>
</div>
```

### 記事の投稿時刻を表示する（巻末にまとめてある）
```angular2html
<time datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('Y年m月d日(1)'); ?></time>
```

### 記事ページへのリンク、タイトル、抜粋を表示する

`<?php the_excerpt(); ?>`は記事の抜粋を表示

```angular2html
<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
<?php the_excerpt(); ?>
<p>[<a href="<?php the_permalink(); ?>">続きを読む</a>]</p>
```

### アイキャッチ画像を使用可能にする

function.phpに設定する
```angular2html
<?php add_theme_support('post-thumnails' );
?>
```

### 記事のアイキャッチ画像を表示する
`the_post_thumnail($size, $attr)`

|サイズ|概要|
|---|---|
|thumbnail|150×150|
|medium|300×300|
|large|640×640|
|full|フルサイズ|
|array(100,100)|カスタム|


index.phpに記述していく
```index.php
<figure><a href="<?php the_permalink(); ?>"<?php the_post_thumnail('thumnail');?></a></figure>
```

もしアイキャッチ画像が投稿されなかったら、という場合を作るとき
```index.php
<figure>
<?php if (has_post_thumnail() ): ?>
    <a href="<?php the_permalink(); ?>"<?php the_post_thumnail('thumnail');
?></a>
<?php else: ?>
    <a href="<?php the_permalink(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/common/noimage.png"></a>
<?php endif; ?>
</figure>

```

## これまでの知識を使って記事を作る

```angular2html
<?php
if (have_posts() ) :
    while ( have_posts() ) : the_post();
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('news'); ?>>
    <div class="text">
        <div class="entryInfo">
            <div class="categories">
            <?php the_category(); ?>
            </div>
            <time datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('Y年m月d日(1)'); ?></time>
        </div>
        <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> </h1>
        <?php the_excerpt() ?>
        <p>[<a href="<?php the_permalink(); ?>">続きを読む</a>]</p>
    </div>
    <figure>
    <?php if ( has_post_thumbnail() ): ?>
        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail');?></a>
    <?php else: ?>
        <a href="<?php the_permalink(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/common.png"></a>
    <?php endif; ?>
    </figure>
</article>
<?php
    endwhile;
endif;
?>
```

## 個別記事ページを作成する
`single.php`は個別記事ページ

ループで本文を表示する。
```angular2html
<?php
if (habe_posts() ) :
    while (have_post()) : the_post();
?>

-------

<?php
    endwhile;
endif;
?> 

```

## メインクエリという概念
メインクエリというのは、どのようにWordpressのループを行うか、を指定する命令のようなもの。

上記で`single.php`にループを書いたのは、`single.php`内ではループをしないといった設定をWordpress側で設定されているから。

なぜループを書いているのかというと、メインクエリを利用することで、Wordpress側でメインクエリだよと知らせているから。

## テンプレートパーツのファイル名
` 任意のテンプレート名-任意の名前.php`

## get_templete_part('loop','main')
`loop-main.php`にループする内容を記述することでるーぷできるようになる

## 日付

