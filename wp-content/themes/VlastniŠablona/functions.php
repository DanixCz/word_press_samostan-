<?php
/**
 * Theme functions for OnePage theme
 */

if ( ! function_exists( 'vlastni_sablona_setup' ) ) {
    function vlastni_sablona_setup() {
        // Support for featured images
        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'title-tag' );

        // Register menu location (optional)
        register_nav_menus( array(
            'primary' => __( 'Primary Menu', 'vlastni-sablona' ),
        ) );
    }
    add_action( 'after_setup_theme', 'vlastni_sablona_setup' );
}

/**
 * Enqueue styles and scripts
 */
function vlastni_sablona_enqueue_assets() {
    $theme_dir = get_template_directory_uri();
    $theme_dir_path = get_template_directory();

    // Main styles
    wp_enqueue_style( 'vlastni-style', $theme_dir . '/style.css', array(), filemtime( $theme_dir_path . '/style.css' ) );
    wp_enqueue_style( 'vlastni-footer', $theme_dir . '/style/footer.css', array('vlastni-style'), filemtime( $theme_dir_path . '/style/footer.css' ) );

    // Scripts (defer handled in script tag)
    wp_enqueue_script( 'vlastni-script', $theme_dir . '/script/script.js', array(), filemtime( $theme_dir_path . '/script/script.js' ), true );
    // Add localized data for JS (if needed)
    wp_localize_script( 'vlastni-script', 'VlastniData', array(
        'ajax_url' => admin_url( 'admin-ajax.php' ),
    ) );
}
add_action( 'wp_enqueue_scripts', 'vlastni_sablona_enqueue_assets' );

/**
 * Register custom post type for OnePage sections
 */
function vlastni_register_onepage_sections() {
    $labels = array(
        'name'               => __( 'Sections', 'vlastni-sablona' ),
        'singular_name'      => __( 'Section', 'vlastni-sablona' ),
        'add_new_item'       => __( 'Add New Section', 'vlastni-sablona' ),
        'edit_item'          => __( 'Edit Section', 'vlastni-sablona' ),
        'new_item'           => __( 'New Section', 'vlastni-sablona' ),
        'view_item'          => __( 'View Section', 'vlastni-sablona' ),
        'search_items'       => __( 'Search Sections', 'vlastni-sablona' ),
        'not_found'          => __( 'No sections found', 'vlastni-sablona' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'capability_type'    => 'post',
        'hierarchical'       => false,
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes' ),
        'has_archive'        => false,
        'rewrite'            => array( 'slug' => 'section' ),
        'menu_position'      => 20,
    );

    register_post_type( 'onepage_section', $args );
}
add_action( 'init', 'vlastni_register_onepage_sections' );

/**
 * Meta box for iframe URL and custom ID
 */
function vlastni_add_section_metaboxes() {
    add_meta_box( 'vlastni_section_meta', __( 'Section settings', 'vlastni-sablona' ), 'vlastni_section_meta_callback', 'onepage_section', 'side', 'default' );
}
add_action( 'add_meta_boxes', 'vlastni_add_section_metaboxes' );

function vlastni_section_meta_callback( $post ) {
    wp_nonce_field( basename( __FILE__ ), 'vlastni_section_nonce' );
    $iframe = get_post_meta( $post->ID, '_vlastni_iframe', true );
    $section_id = get_post_meta( $post->ID, '_vlastni_section_id', true );
    ?>
    <p>
        <label for="vlastni_section_id"><?php _e( 'Section ID (for anchors)', 'vlastni-sablona' ); ?></label>
        <input type="text" name="vlastni_section_id" id="vlastni_section_id" value="<?php echo esc_attr( $section_id ); ?>" style="width:100%;" />
        <small><?php _e( 'Optional. If empty, a slugified title will be used.', 'vlastni-sablona' ); ?></small>
    </p>
    <p>
        <label for="vlastni_iframe"><?php _e( 'Iframe URL (e.g. map URL)', 'vlastni-sablona' ); ?></label>
        <input type="text" name="vlastni_iframe" id="vlastni_iframe" value="<?php echo esc_attr( $iframe ); ?>" style="width:100%;" />
        <small><?php _e( 'Enter a full URL for the iframe src. Leave empty to skip iframe for this section.', 'vlastni-sablona' ); ?></small>
    </p>
    <?php
}

function vlastni_save_section_meta( $post_id ) {
    if ( ! isset( $_POST['vlastni_section_nonce'] ) || ! wp_verify_nonce( $_POST['vlastni_section_nonce'], basename( __FILE__ ) ) ) {
        return $post_id;
    }

    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return $post_id;
    }

    if ( 'onepage_section' !== get_post_type( $post_id ) ) {
        return $post_id;
    }

    if ( isset( $_POST['vlastni_iframe'] ) ) {
        update_post_meta( $post_id, '_vlastni_iframe', esc_url_raw( $_POST['vlastni_iframe'] ) );
    }

    if ( isset( $_POST['vlastni_section_id'] ) ) {
        update_post_meta( $post_id, '_vlastni_section_id', sanitize_title_with_dashes( $_POST['vlastni_section_id'] ) );
    }
}
add_action( 'save_post', 'vlastni_save_section_meta' );

/**
 * Customizer settings for footer text and social links
 */
function vlastni_customize_register( $wp_customize ) {
    $wp_customize->add_section( 'vlastni_footer', array(
        'title' => __( 'Footer', 'vlastni-sablona' ),
        'priority' => 160,
    ) );

    $wp_customize->add_setting( 'vlastni_footer_text', array(
        'default' => '© ' . date( 'Y' ) . ' Všechna práva vyhrazena',
        'sanitize_callback' => 'wp_kses_post',
    ) );
    $wp_customize->add_control( 'vlastni_footer_text', array(
        'label' => __( 'Footer text', 'vlastni-sablona' ),
        'section' => 'vlastni_footer',
        'type' => 'textarea',
    ) );

    // Social links (comma separated simple approach or add more controls if needed)
    $wp_customize->add_setting( 'vlastni_footer_social', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'vlastni_footer_social', array(
        'label' => __( 'Footer social links (one per line as "label|url")', 'vlastni-sablona' ),
        'section' => 'vlastni_footer',
        'type' => 'textarea',
    ) );
}
add_action( 'customize_register', 'vlastni_customize_register' );
