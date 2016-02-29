<?php get_template_part('includes/header'); ?>

<div class="container">
  <div class="row">


      <div id="content" role="main">
        <?php 
                        if ( is_singular( 'product' ) ) {
                            woocommerce_content();
                            } else {
                            //For ANY product archive.
                            //Product taxonomy, product search or /shop landing
                            woocommerce_get_template( 'archive-product.php' );
                        }
                        ?>
      </div><!-- /#content -->

    

    
  </div><!-- /.row -->
</div><!-- /.container -->

<?php get_template_part('includes/footer'); ?>
