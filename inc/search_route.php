<?php 

    add_action('rest_api_init', 'universityRegisterSearch');

    function universityRegisterSearch(){
        register_rest_route('university/v1', 'search', array(
            'methods' => WP_REST_SERVER::READABLE, // GET
            'callback' => 'universitySearchResults'
        )); /*(namespace / version, route, array contain description) */
    }

    function universitySearchResults(){
        $professors = new WP_Query(array(
            'post_type' => 'professor'
        ));

        $professorsResults = array();

        while($professors->have_posts()){
            $professors->the_post();

            array_push($professorsResults, array(
                'title' => get_the_title(),
                'permalink' => get_the_permalink(),
            ));
        }

        wp_reset_postdata();

        return $professorsResults;
    }