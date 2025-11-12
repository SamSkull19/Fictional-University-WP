<?php
get_header();

while (have_posts()) {
    the_post();
    pageBanner(array(
        'title' => get_the_title(),
        'subtitle' => get_field('page_banner_subtitle')
    ));

    $campusDateCapture = new DateTime(get_field('establishment_year'));
    $month = $campusDateCapture->format('M');
    $date = $campusDateCapture->format('d');
    $year = $campusDateCapture->format('Y');
    $establishmentDate = $date . " / " . $month . " / " . $year;

    $campusImage = get_field('page_banner_background')['sizes']['campusBanner']; 
?>


    <div class="container container--narrow page-section">
        <div class="metabox metabox--position-up metabox--with-home-link">
            <p>
                <a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('campus'); ?>"><i class="fa fa-home" aria-hidden="true"></i> Back to Our Campuses</a> <span class="metabox__main">Established on <?php echo $establishmentDate ?></span>
            </p>
        </div>

        <div class="two-thirds">
            <img src="<?php echo $campusImage; ?>" alt="Campus Image">
        </div>

        <div class="one-third">
            <?php the_content(); ?>
        </div>
    </div>
<?php
}
get_footer();
?>