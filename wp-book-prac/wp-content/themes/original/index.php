<?php get_header(); ?>
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

<aside class="sidebar">
    <?php get_sidebar(); ?>
</aside>

<?php get_footer(); ?>
