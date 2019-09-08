<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title><?php bloginfo('name'); ?></title>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/styles.css" type="text/css"/>
    <?php
    wp_enqueue_script('jQuery');
    wp_enqueue_script('js-name',get_teplate_directory_uri() . '/js/hogehoge.js');
    wp_head();
    ?>
    <?php if (is_home()) : ?>
    <div class="only-home">トップページのときだけここを表示</div>
    <?php endif; ?>
</head>
<body>