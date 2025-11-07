<?php
    get_header();

    while(have_posts()){
        the_post(); ?>

        <h2><?php the_title(); ?></h2>
        <h3><?php the_content(); ?></h3>
        
<?php        
    }
    get_footer();
?>