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
                    'postType' => get_post_type(),
                    'authorName' => get_the_author(),
                ));
            }
            
            if(get_post_type() == 'professor'){
                array_push($results['professor'], array(
                    'title' => get_the_title(),
                    'permalink' => get_the_permalink(),
                    'image' => get_the_post_thumbnail_url(0, 'professorLandscape')
                ));
            }
            
            if(get_post_type() == 'program'){
                array_push($results['program'], array(
                    'title' => get_the_title(),
                    'permalink' => get_the_permalink(),
                    'id' => get_the_id()
                ));
            }
            
            if(get_post_type() == 'event'){
                $eventDate = new DateTime(get_field('event_date'));
                $description = null;

                if (has_excerpt()) {
                    $description = get_the_excerpt();
                } 
                else {
                    $description = wp_trim_words(get_the_content(), 18);
                }

                array_push($results['event'], array(
                    'title' => get_the_title(),
                    'permalink' => get_the_permalink(),
                    'month' => $eventDate->format('M'),
                    'day' => $eventDate->format('d'),
                    'description' => $description
                ));
            }
            
            if(get_post_type() == 'campus'){
                array_push($results['campus'], array(
                    'title' => get_the_title(),
                    'permalink' => get_the_permalink(),
                ));
            }
        }

        if($results['program']){
            $programsMetaQuery = array('relation' => 'OR');

            foreach($results['program'] as $item) {
                array_push($programsMetaQuery, array(
                    'key' => 'related_program',
                    'compare' => 'LIKE',
                    'value' => '"' . $item['id'] . '"'
                ));
            }

            $programRelationshipQuery = new WP_Query(array(
                'post_type' => 'professor',
                'meta_query' => $programsMetaQuery
            ));

            while($programRelationshipQuery->have_posts()){
                $programRelationshipQuery->the_post();

                if(get_post_type() == 'professor'){
                    array_push($results['professor'], array(
                        'title' => get_the_title(),
                        'permalink' => get_the_permalink(),
                        'image' => get_the_post_thumbnail_url(0,    'professorLandscape')
                    ));
                }
            }

            $results['professor'] = array_values(array_unique($results['professor'], SORT_REGULAR));
        }
        
        return $results;
    }