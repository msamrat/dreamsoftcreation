<?php

function section_port_shortcode( $atts ) {
    extract( shortcode_atts( array( 'limit' => -1 ), $atts ) );

    $paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

    $posts = get_posts( array(
        'post_type' => 'unslider',
        'order'     => 'ASC',
        'orderby'   => 'id',
        'paged'     => $paged,
    ) );

    $slides = array();
    $output = '';

    foreach ( $posts as $post ) {
        $slides[] = array(
            'image'   => wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) ),
            'content' => $post->post_content,
        );
    }

    $slides = apply_filters( 'responsive_image_slider_slides', $slides );

    foreach ( $slides as $slide ) {
        $style = '';

        if ( ! is_array( $slide ) ) {
            $slide = array( 'content' => $slide );
        }

        if ( ! empty( $slide['image'] ) ) {
            $style .= 'background: url(' . $slide['image'] . ');';
        }

        if ( ! empty( $slide['css'] ) ) {
            $style .= $slide['css'];
        }

        $output .= '<li style="' . $style . ' background-size: 100%">' . $slide['content'] . '</li>';
    }

    return '<div class="unslider"><ul>' . $output . '</ul></div>';
}

add_shortcode( 'tp-unslider', 'section_port_shortcode' ); 