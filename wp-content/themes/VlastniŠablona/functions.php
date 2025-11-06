<?php
function vlastni_sablona_enqueue_styles() {
    // Registrace a načtení hlavního stylu
    wp_register_style('vlastni-style', get_template_directory_uri() . '/style.css', array(), filemtime(get_template_directory() . '/style.css'), 'all');
    wp_enqueue_style('vlastni-style');
}
add_action('wp_enqueue_scripts', 'vlastni_sablona_enqueue_styles');