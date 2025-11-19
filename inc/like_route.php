<?php

    add_action('rest_api_init', 'universityLikeRoutes');

    function universityLikeRoutes(){
        register_rest_route('university/v1', 'manageLike', array(
            'methods' => 'POST',
            'callbacks' => 'createLike',
        ));
        
        register_rest_route('university/v1', 'manageLike', array(
            'methods' => 'DELETE',
            'callbacks' => 'deleteLike',
        ));
    }

    function createLike(){
        return 'Sifat';
    }
    
    function deleteLike(){
        return 'Samin';
    }