<?php
get_header();

while (have_posts()) {
    the_post();
    pageBanner(array(
        'title' => get_the_title(),
        'subtitle' => 'Learn how the school of your dreams got started.',
    ));
?>


    <div class="container container--narrow page-section">

        Content
    </div>

<?php
}
get_footer();
?>