<?php get_header(); 
pageBanner(array(
    'title' => 'Our Campuses',
    'subtitle' => 'Check Our All The Available Campuses.',
));
?>


<div class="container container--narrow page-section">
    <?php
    while (have_posts()) {
        the_post(); ?>
        <div class="event-summary">
            <a class="campus-summary__date t-center" href="<?php the_permalink(); ?>">
                <span class="campus-summary__month">
                    <?php
                    $campusDateCapture = new DateTime(get_field('establishment_year'));
                    $month = $campusDateCapture->format('M');
                    $date = $campusDateCapture->format('d');
                    $year = $campusDateCapture->format('Y');
                    echo $month . " " . $date;
                    ?>
                </span>

                <span class="event-summary__month">
                    <?php
                    echo $year;
                    ?>
                </span>
            </a>
            <div class="event-summary__content">
                <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></h5>
                <php><?php echo wp_trim_words(get_the_content(), 18) ?> <a href="<?php the_permalink(); ?>" class="nu gray">Learn more</a></p>
            </div>
        </div>
    <?php }
    echo paginate_links();
    ?>

    <hr class="section-break">
</div>

<?php get_footer(); ?>