<!DOCTYPE html>
<?php $theme_url = get_template_directory_uri(); ?>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

         <script src="<?= $theme_url?>/script/script.js" defer></script>
         <link rel="stylesheet" href="<?= $theme_url ?>/style.css">
         <link rel="stylesheet" href="<?= $theme_url ?>/style/footer.css">
         <?php wp_head(); ?>
    </head>
    <body>
        <?php
            get_header();
        ?>

        <main id="primary" class="site-main">
            <?php
                // Query onepage_section posts and render them as sections
                $sections = get_posts( array(
                    'post_type' => 'onepage_section',
                    'posts_per_page' => -1,
                    'orderby' => 'menu_order',
                    'order' => 'ASC',
                    'post_status' => 'publish',
                ) );

                if ( $sections ) :
                    foreach ( $sections as $section ) :
                        $meta_id = get_post_meta( $section->ID, '_vlastni_section_id', true );
                        $anchor = $meta_id ? $meta_id : sanitize_title( $section->post_title );
                        $iframe = get_post_meta( $section->ID, '_vlastni_iframe', true );
                        $bg_style = '';
                        if ( has_post_thumbnail( $section->ID ) ) {
                            $thumb = get_the_post_thumbnail_url( $section->ID, 'full' );
                            $bg_style = sprintf( 'style="background-image: url(%s);"', esc_url( $thumb ) );
                        }
                        ?>
                        <section id="section-<?php echo esc_attr( $anchor ); ?>" class="onepage-section" <?php echo $bg_style; ?>>
                            <div class="section-inner">
                                <h2><?php echo esc_html( $section->post_title ); ?></h2>
                                <div class="section-content">
                                    <?php echo apply_filters( 'the_content', $section->post_content ); ?>
                                </div>

                                <?php if ( ! empty( $iframe ) ) : ?>
                                    <div class="section-iframe">
                                        <iframe src="<?php echo esc_url( $iframe ); ?>" frameborder="0" loading="lazy" style="width:100%;height:400px;"></iframe>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </section>
                    <?php endforeach;
                else :
                    // Fallback: show page content if no sections available
                    the_content();
                endif;
            ?>
        </main>

        <?php
            get_footer();
        ?>
    </body>
</html>