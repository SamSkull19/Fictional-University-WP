<?php

    while(have_posts()){
        the_post(); ?>

        <h1>This is a Page</h1>
        <h2><?php the_title(); ?></h2>
        <h3><?php the_content(); ?></h3>
<?php        
    }

?>