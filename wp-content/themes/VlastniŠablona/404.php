<?php
get_header();
?>

<main id="primary" class="site-main">
    <section class="error-404 not-found">
        <header class="page-header">
            <h1 class="page-title">Oops! Stránka nebyla nalezena.</h1>
        </header>

        <div class="page-content">
            <p>Omlouváme se, ale požadovaná stránka nebyla nalezena. Zkuste použít vyhledávání nebo se vraťte na hlavní stránku.</p>

            <?php
            get_search_form(); // Přidá vyhledávací formulář
            ?>

            <div class="widget-area">
                <div class="recent-posts">
                    <h2>Nejnovější příspěvky</h2>
                    <ul>
                        <?php
                        wp_get_archives(array(
                            'type'  => 'postbypost',
                            'limit' => 5
                        ));
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </section>
</main>

<?php
get_footer();
?>