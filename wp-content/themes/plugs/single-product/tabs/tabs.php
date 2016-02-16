<?php
/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

// Benz Mod File
// big time changes for 'IF' checkbox on product page is checked display this html for proactive products 

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( 'yes' == get_post_meta( get_the_ID(), 'product_checkbox', true ) ) : ?>

<div class="proactive-foam-wrap">
  <div class="proactive-3span">
      <div class="practive-blue1">
    <img src="../../wp-content/imgs/customsize/Standard-foam.png" alt="Standard Foam Custom Size Mattress" /> 
      </div>
    <h4>Standard</h4>
      <div class="proactive-foam-copy">
    <p>This mattress conforms to the patient's body and customizes support as the patient moves. Excellent pressure redistribution is achieved by varying cell depths throughout the mattress with special attention given to the vulnerable heel section.</p>
    <ul>
      <li><strong>Unique Pressure Zones:</strong> Channel Cut High Density Polyurethane Foam</li>
      <li>670 individual cells offer superior pressure redistribution</li>
      <li>Foam core is fire-retardant and anti-microbial/anti-bacterial</li>
      <li>
        <strong>Cover:</strong>
        <ul>
          <li>Anti-microbial and anti-fungal</li>
          <li>low moisture vapor transmission(MVTR)</li>
          <li>fluid resistant</li>
          <li>conforms to NFPA702 class 1 and TB 117E</li>
        </ul>
      </li>
      <li>360 degree zipper allows for easy removal for cleaning or replacement</li>
      <li><strong>Side Rails:</strong> PTSS Rail System (Patient transfer support system)</li>
      <li>Provides firm support for safe and easy patient egress and ingress</li>
      <li>Anti-contamination flap covers the zipper reducing the possibility of contaminating the foam core</li>
      <li><strong>Fire Retardant:</strong> Conforms to 16 CFR Part 1632 &amp; 1633 and NFPA 702 Class 1</li>
    </ul>
    <p><strong>Weight Capacity: 300 lbs</strong><br /> <strong>Warranty: 4 Year, Non-Prorated</strong></p>
  </div></div>
  <div class="proactive-3span">
      <div class="practive-blue2">
    <img src="../../wp-content/imgs/customsize/Plus-Foam.png" alt="Premium Foam Custom Size Mattress" /> 
      </div>
    <h4>Plus</h4>
      <div class="proactive-foam-copy">
    <p>This mattress provides exceptional pressure redistribution. It is ideal for moderate to high risk patients with close attention paid to the sacral and heel area by utilizing ultra high density foam.</p>
    <ul>
      <li>Multi-tiered pressure redistribution mattress with top layer of die-cut high density foam in the head and torso section</li>
      <li>High-resilient foam in heel section provides an unparalleled pressure redistribution support surface</li>
      <li>Middle layer of heel section has air channel cut foam which provides additional pressure redistribution in heel area and air circulation</li>
      <li>PTSS Rail System provides additional support, allowing easy patient transfer and edge of bed sitting</li>
      <li>Top cover is a 4-way stretch nylon which reduces perspiration and provides a low shear friction surface that is anti-microbial and water resistant</li>
      <li>Anti-Contamination Flap covers the zipper reducing the possibility of fluids contaminating the foam core</li>
      <li>Designated head and foot sections</li>
      <li>Fire sleeve to meet Federal Fire Code 16 CFR part 1633</li>
    </ul>
    <p><strong>Weight Capacity: 350 lbs</strong><br /> <strong>Warranty: 5 Year, Non-Prorated</strong></p>
  </div></div>
  <div class="proactive-3span">
      <div class="practive-blue3">
    <img src="../../wp-content/imgs/customsize/Premium-Foam.png" alt="Premium Foam Custom Size Mattress" />
          </div>
    <h4>Premium</h4>
      <div class="proactive-foam-copy">
          <img style="margin-top:-1em;" src="../../wp-content/imgs/customsize/Most-Popular.png" />
    <p>The Visco Gel Polymer Technology is a revolutionary support surface that provides unprecedented pressure redistribution, rapid heat dissipation, and vast increases in breathability compared to traditional foam.</p>
    <p>VGPT™ is an open-cell memory foam that is infused with gel polymers. Designed for clinical superiority as well as patient comfort, some of the many benefits of VGPT™ include:</p>
    <ul>
      <li>Reduced occurrence of pressure sores</li>
      <li>Channels heat away from the body faster than traditional foam</li>
      <li>Provides more support and less cradling over a large surface area</li>
      <li>Eliminates static fatigue</li>
      <li>Holds it’s shape better than traditional foam</li>
      <li>Keeps patients cool, dry and comfortable</li>
      <li>Heel section uses 30 degree slope to redistribute pressure</li>
      <li>Uses a top layer of Lura-Quilt foam that keeps skin cool and dry</li>
    </ul>
    <p><strong>Weight Capacity: 1,000 lbs</strong><br /> <strong>Warranty: 15 Year, Non-Prorated</strong></p>
  </div>
</div></div>

<?php else: ?>

	<div class="woocommerce-tabs wc-tabs-wrapper">
		<ul class="tabs wc-tabs">
			<?php foreach ( $tabs as $key => $tab ) : ?>
				<li class="<?php echo esc_attr( $key ); ?>_tab">
					<a href="#tab-<?php echo esc_attr( $key ); ?>"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $tab['title'] ), $key ); ?></a>
				</li>
			<?php endforeach; ?>
		</ul>
		<?php foreach ( $tabs as $key => $tab ) : ?>
			<div class="panel entry-content wc-tab" id="tab-<?php echo esc_attr( $key ); ?>">
				<?php call_user_func( $tab['callback'], $key, $tab ); ?>
			</div>
		<?php endforeach; ?>
	</div>

<?php endif; ?>





