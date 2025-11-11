<?php get_header(); 
pageBanner(array(
    'title' => 'All Events',
    'subtitle' => 'Check Your Upcoming Events.',
));
?>


<div class="container container--narrow page-section">
    <?php
    while (have_posts()) {
        the_post(); ?>
        <div class="event-summary">
            <a class="event-summary__date t-center" href="#">
                <span class="event-summary__month">
                    <?php
                    $eventDateCapture = new DateTime(get_field('event_date'));
                    echo $eventDateCapture->format('M');
                    ?>
                </span>
                <span class="event-summary__day">
                    <?php
                    echo $eventDateCapture->format('d');
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
    <p>Looking for a recap of past events? <a href="<?php echo site_url('/past-events'); ?>">Check Out Past Events</a></p>
</div>

<?php get_footer(); ?>