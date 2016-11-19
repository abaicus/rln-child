<?php

add_action( 'wp_enqueue_scripts', 'catch_responsive_parent_theme_enqueue_styles' );

function catch_responsive_parent_theme_enqueue_styles() {
    wp_enqueue_style( 'catch-responsive-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'rln-child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( 'catch-responsive-style' )
    );

}

function rln_child_customize_register( $wp_customize ) {

	require_once( get_stylesheet_directory() . '/dropdown-posts.php' );

	//loop for featured page content
	$wp_customize->add_section( 'rln_featured_content', array(
		'title'       => 'RLN Featured Content',
		'description' => 'Select featured content displayed in the frontpage section',
		'priority'    => 0,
	) );

	$options = catchresponsive_get_theme_options();

	$number_of_featured_items = $options['featured_content_number'];


	for($i = 1; $i<=$number_of_featured_items; $i++) {

		$wp_customize->add_setting( 'rln_content_setting_' . $i, array(
			'default' => '-',
		) );

		$wp_customize->add_control( new RLN_Posts_Pages_Dropdown( $wp_customize, 'rln_content_setting_'. $i, array(
			'label'    => __( 'Featured Content No. ' . $i , 'rln-child' ),
			'priority' => '$i',
			'section'  => 'rln_featured_content',
//			'type'     => 'select',
//			'choices'  => $the_posts,
		) ) );
	}


//	var_dump(get_theme_mod('featured_content_' . $i));
//	}
}
add_action( 'customize_register', 'rln_child_customize_register' );

//function catchresponsive_featured_content_display() {
//	//catchresponsive_flush_transients();
//
//	global $post, $wp_query;
//
//	// get data value from options
//	$options 		= catchresponsive_get_theme_options();
//	$enablecontent 	= $options['featured_content_option'];
//	$contentselect 	= $options['featured_content_type'];
//
//	// Front page displays in Reading Settings
//	$page_on_front 	= get_option('page_on_front') ;
//	$page_for_posts = get_option('page_for_posts');
//
//
//	// Get Page ID outside Loop
//	$page_id = $wp_query->get_queried_object_id();
//	if ( $enablecontent == 'entire-site' || ( ( is_front_page() || ( is_home() && $page_for_posts != $page_id ) ) && $enablecontent == 'homepage' ) ) {
//		if( ( !$catchresponsive_featured_content = get_transient( 'catchresponsive_featured_content_display' ) ) ) {
//			$layouts 	 = $options ['featured_content_layout'];
//			$headline 	 = $options ['featured_content_headline'];
//			$subheadline = $options ['featured_content_subheadline'];
//
//			echo '<!-- refreshing cache -->';
//
//			if ( !empty( $layouts ) ) {
//				$classes = $layouts ;
//			}
//
//			if( $contentselect == 'demo-featured-content' ) {
//				$classes 		.= ' demo-featured-content' ;
//				$headline 		= __( 'Featured Content', 'catch-responsive' );
//				$subheadline 	= __( 'Here you can showcase the x number of Featured Content. You can edit this Headline, Subheadline and Feaured Content from "Appearance -> Customize -> Featured Content Options".', 'catch-responsive' );
//			}
//			elseif ( $contentselect == 'featured-page-content' ) {
//				$classes .= ' featured-page-content' ;
//			}
//
//			//Check Featured Content Position
//			$featured_content_position = $options [ 'featured_content_position' ];
//
//			if ( '1' == $featured_content_position ) {
//				$classes .= ' border-top' ;
//			}
//
//			$catchresponsive_featured_content ='
//				<section id="featured-content" class="' . $classes . '">
//					<div class="wrapper">';
//			if ( !empty( $headline ) || !empty( $subheadline ) ) {
//				$catchresponsive_featured_content .='<div class="featured-heading-wrap">';
//				if ( !empty( $headline ) ) {
//					$catchresponsive_featured_content .='<h1 id="featured-heading" class="entry-title">'. $headline .'</h1>';
//				}
//				if ( !empty( $subheadline ) ) {
//					$catchresponsive_featured_content .='<p>'. $subheadline .'</p>';
//				}
//				$catchresponsive_featured_content .='</div><!-- .featured-heading-wrap -->';
//			}
//			$catchresponsive_featured_content .='
//						<div class="featured-content-wrap">';
//
//			// Select content
//			if ( $contentselect == 'demo-featured-content'  && function_exists( 'catchresponsive_demo_content' ) ) {
//				$catchresponsive_featured_content .= catchresponsive_demo_content( $options );
//			}
//			elseif ( $contentselect == 'featured-page-content' && function_exists( 'catchresponsive_page_content' ) ) {
//				$catchresponsive_featured_content .= catchresponsive_page_content( $options );
//			}
//
//			$catchresponsive_featured_content .='
//						</div><!-- .featured-content-wrap -->
//					</div><!-- .wrapper -->
//				</section><!-- #featured-content -->';
//			set_transient( 'catchresponsive_featured_content', $catchresponsive_featured_content, 86940 );
//		}
//		echo $catchresponsive_featured_content;
//	}
//}