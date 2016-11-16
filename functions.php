<?php

add_action( 'wp_enqueue_scripts', 'catch_responsive_parent_theme_enqueue_styles' );

function catch_responsive_parent_theme_enqueue_styles() {
    wp_enqueue_style( 'catch-responsive-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'rln-child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( 'catch-responsive-style' )
    );

}
