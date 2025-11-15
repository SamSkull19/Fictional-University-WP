<?php 

    add_action('rest_api_init', 'universityRegisterSearch');

    function universityRegisterSearch(){
        register_rest_route('university/v1', 'search', array(
            'methods' => WP_REST_SERVER::READABLE, // GET
            'callback' => 'universitySearchResults'
        )); /*(namespace / version, route, array contain description) */
    }

    function universitySearchResults($data){
        $mainQuery = new WP_Query(array(
            'post_type' => array('post', 'page', 'professor', 'program', 'event', 'campus'),
            's' => sanitize_text_field($data['term'])
        ));

        $results = array(
            'generalInfo' => array(),
            'professor' => array(),
            'program' => array(),
            'event' => array(),
            'campus' => array(),
        );

        while($mainQuery->have_posts()){
            $mainQuery->the_post();

            if(get_post_type() == 'post' OR get_post_type() == 'page'){
                array_push($results['generalInfo'], array(
                    'title' => get_the_title(),
                    'permalink' => get_the_permalink(),
                ));
            }
            
            if(get_post_type() == 'professor'){
                array_push($results['professor'], array(
                    'title' => get_the_title(),
                    'permalink' => get_the_permalink(),
                ));
            }
            
            if(get_post_type() == 'program'){
                array_push($results['program'], array(
                    'title' => get_the_title(),
                    'permalink' => get_the_permalink(),
                ));
            }
            
            if(get_post_type() == 'event'){
                array_push($results['event'], array(
                    'title' => get_the_title(),
                    'permalink' => get_the_permalink(),
                ));
            }
            
            if(get_post_type() == 'campus'){
                array_push($results['campus'], array(
                    'title' => get_the_title(),
                    'permalink' => get_the_permalink(),
                ));
            }
        }

        wp_reset_postdata();

        return $results;
    }