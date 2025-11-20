<?php

    add_action('rest_api_init', 'universityLikeRoutes');

    function universityLikeRoutes(){
        register_rest_route('university/v1', 'manageLike', array(
            'methods' => 'POST',
            'callback' => 'createLike',
        ));
        
        register_rest_route('university/v1', 'manageLike', array(
            'methods' => 'DELETE',
            'callback' => 'deleteLike',
        ));
    }

    function createLike($data){
        if(is_user_logged_in()){
            $professor = sanitize_text_field($data['professorId']);

            return wp_insert_post(array(
                'post_type' => 'like',
                'post_status' => 'publish',
                'post_title' => 'Title Like',
                'meta_input' => array(
                    'liked_professor_id' => $professor
                )
            ));
        }
        
        else{
            die('Only Logged in user can create a Like');
        }
    }
    
    function deleteLike(){
        return 'Samin';
    }