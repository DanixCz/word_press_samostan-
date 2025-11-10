<footer class="footer" >
	<div class="waves">
		<div class="wave" id="wave1"></div>
		<div class="wave" id="wave2"></div>
		<div class="wave" id="wave3"></div>
		<div class="wave" id="wave4"></div>
	</div>

    <div class="wrapper">
        
        <div class="wrapper-content">
            <?php if ( get_theme_mod( 'vlastni_footer_text' ) ) : ?>
                <div class="footer-text">
                    <?php echo wp_kses_post( wpautop( get_theme_mod( 'vlastni_footer_text' ) ) ); ?>
                </div>
            <?php else : ?>
                <h2>Zde se nachazí Footer</h2>
                <p>📧 E-mail: info@danielzeman.cz</p>
                <p>📱 Telefon: +420 777 123 456</p>
            <?php endif; ?>

            <div class="wrapper-content-social">
                <?php
                $social = get_theme_mod( 'vlastni_footer_social', '' );
                if ( ! empty( $social ) ) {
                    $lines = preg_split( '/\r?\n/', $social );
                    foreach ( $lines as $line ) {
                        $parts = explode( '|', trim( $line ) );
                        if ( count( $parts ) === 2 ) {
                            $label = esc_html( $parts[0] );
                            $url = esc_url( $parts[1] );
                            printf( '<a href="%s" target="_blank" rel="noopener">%s</a>', $url, $label );
                        }
                    }
                }
                ?>
            </div>
        </div>
        <div class="wrapper-footer">
            <div class="wrapper-footer-left">
            </div>
            <div class="wrapper-footer-right">
                <?php if ( function_exists( 'wp_nav_menu' ) && has_nav_menu( 'primary' ) ) : ?>
                    <?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => false ) ); ?>
                <?php else : ?>

                <?php endif; ?>
            </div>
        </div>
    </div>

    
    <?php wp_footer(); ?>
</footer>