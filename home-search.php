<div class="home-search" style="background-image:url('<?php the_field('header_background_image'); ?>');">
<?php while ( have_posts() ) : the_post(); ?>
<!-- loop begins -->
    <article id="post-<?php the_ID(); ?>">
        <h1 class="animated fadeInUp" style="color: <?php the_field('text_color'); ?>;"><?php the_field('header_title'); ?></h1>
        <h4 class="animated fadeInUp" style="color: <?php the_field('text_color'); ?>;"><?php the_field('header_sub_title'); ?></h4>
        <?php echo the_content(); ?>
        <?php endwhile; // end of the loop.
        ?>
    </article><!-- #post-## -->
    
</div>
        