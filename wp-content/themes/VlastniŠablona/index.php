<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php wp_title() ?></title>
        <link rel="stylesheet" href="<?php $theme_url ?>/style/footer.css">
        <?php wp_head(); ?>
    </head>


    <?php
        /**
         * The main template file
         */

        get_header(); // Načte header.php
        ?>

        <main id="primary" class="site-main">
            <?php
            if (have_posts()) :
                while (have_posts()) :
                    the_post();
                    ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <header class="entry-header">
                            <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
                        </header>

                        <div class="entry-content">
                            <?php the_content(); ?>
                        </div>
                    </article>
                    <?php
                endwhile;

                // Navigace mezi příspěvky
                the_posts_navigation();

            else :
                ?>
                <article class="no-results">
                    <header class="entry-header">
                        <h1 class="entry-title">Nic nenalezeno</h1>
                    </header>
                    <div class="entry-content">
                        <p>Bohužel, nic nebylo nalezeno.</p>
                    </div>
                </article>
                <?php
            endif;
            ?>
        </main>

        <?php
        get_footer(); // Načte footer.php
        ?>
    </body>
</html>