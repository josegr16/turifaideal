<?php
get_header();
?>
<div class="container">
    <h1>Sorteos</h1>
    <div class="row">
        <?php
        if (have_posts()) : while (have_posts()) : the_post();
        ?>
            <div class="col-md-4">
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <?php the_post_thumbnail('medium'); ?>
                <p><?php the_excerpt(); ?></p>
            </div>
        <?php
        endwhile; endif;
        ?>
    </div>
</div>
<?php
get_footer();
