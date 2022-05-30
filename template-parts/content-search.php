<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package urban_flavours
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="row align-items-center mt-3 mb-3">
        <?php if(has_post_thumbnail() && 'page' !== get_post_type()):?>
        <div class="col-lg-3 col-md-4 col-sm-12"><?php urban_flavours_post_thumbnail(); ?></div>
        <?php endif;?>
        <div class="<?php if(has_post_thumbnail() && 'page' !== get_post_type()):?>col-lg-9<?php else:?>col-lg-12<?php endif;?> <?php if(has_post_thumbnail() && 'page' !== get_post_type()):?>col-md-8<?php else:?>col-md-12<?php endif;?> col-sm-12">
            <?php the_title( sprintf( '<h2 class="entry-title d-inline-block"><a class="green-text font-weight-bold" href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
            <?php
            if ( 'product' === get_post_type() ) :
                global $woocommerce;
                $currency = get_woocommerce_currency_symbol();
                $price = get_post_meta( get_the_ID(), '_price', true);
                $sale = get_post_meta( get_the_ID(), '_sale_price', true);
                ?>

                <?php if($sale) : ?>
                <p class="search-price"><del><?php echo $currency; echo $price; ?></del> <?php echo $currency; echo $sale; ?></p>
            <?php elseif($price) : ?>
                <p class="search-price"><?php echo $currency; echo $price; ?></p>
            <?php endif;

            endif; ?>

            <div class="entry-summary">
                <?php the_excerpt(); ?>
            </div><!-- .entry-summary -->

            <a href="<?php echo $permalink; ?>" class="read-more text-capitalize green-text"><?php echo "Read More"; ?></a>

            <?php if ( 'post' === get_post_type() ) : ?>
            <div class="entry-meta">
                <?php
                urban_flavours_posted_on();
                urban_flavours_posted_by();
                ?>
            </div><!-- .entry-meta -->
            <?php endif; ?>
        </div>
	</div><!-- .entry-header -->

</article><!-- #post-<?php the_ID(); ?> -->
