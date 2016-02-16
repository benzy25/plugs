<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.14
 */

// Benz Mod File
// Added  " Free Shipping icon" under image if ID matches $product_notfree_ship defined in functions.php -- global;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $woocommerce, $product;

?>
<div class="images">

	<?php
		if ( has_post_thumbnail() ) {

			$image_title 	= esc_attr( get_the_title( get_post_thumbnail_id() ) );
			$image_caption 	= get_post( get_post_thumbnail_id() )->post_excerpt;
			$image_link  	= wp_get_attachment_url( get_post_thumbnail_id() );
			$image       	= get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
				'title'	=> $image_title,
				'alt'	=> $image_title
				) );

			$attachment_count = count( $product->get_gallery_attachment_ids() );

			if ( $attachment_count > 0 ) {
				$gallery = '[product-gallery]';
			} else {
				$gallery = '';
			}

			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" itemprop="image" class="woocommerce-main-image zoom" title="%s" data-rel="prettyPhoto' . $gallery . '">%s</a>', $image_link, $image_caption, $image ), $post->ID );

		} else {

			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), __( 'Placeholder', 'woocommerce' ) ), $post->ID );

		}
	?>

	<?php do_action( 'woocommerce_product_thumbnails' ); 

// begin if statement for free shipping icons on product pages
global $product_notfree_ship;
    global $post;
    $product_id = $post->ID;
    $product_notfree_ship = array( '799', '781', '768', '748', '2175', '2177', '2179', '2181', '2183', '2185', '2186', '2188', '2190', '2192', '2194', '2196', '2198' );
    
    if ( is_single($product_notfree_ship) ) {
        echo '<div id="free_ship-productpage">';
        echo '<p class="add_shipp">*Additional Shipping Charges Apply</p>';
        echo '</div>';
    } else {
        echo '<div id="free_ship-productpage">';
        echo '<img width="110" alt="Free Shipping Mattresses" src="../../wp-content/imgs/Free_shipping.png" style="float:left;">';
        echo '<div style="padding-top:10px;"><span class="red_free">FREE SHIPPING</span><br>on This Product</div>';
        echo '</div>';
    }

    ?>
  
    
</div>
