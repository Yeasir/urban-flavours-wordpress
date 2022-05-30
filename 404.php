<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package urban_flavours
 */

get_header();
?>

    <section class="orders-section">
        <div class="container"> <!-- /.container start  -->
            <!-- /.row start  --->
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <header class="page-header">
                        <h2 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'urban_flavours' ); ?></h2>
                    </header><!-- .page-header -->
                    <div class="page-content">
                        <p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'urban_flavours' ); ?></p>
                        <?php
                        get_search_form();
                        ?>
                    </div><!-- .page-content -->
                </div>
            </div>
        </div>
    </section>

<?php
get_footer();
