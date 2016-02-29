<?php get_template_part('includes/header'); ?>

<?php if ( is_home() || is_front_page() ): //  -- HOMEPAGE CHECK ?>

<div class="container">
  <div class="row">
    <div id="content" role="main">
        <?php //get_template_part('includes/loops/content', 'page'); ?>
        <div style="width:100%;">
          <img style="width:100%; margin-bottom: 2%;" src="wp-content/imgs/homepage/Nursing-Healthcare-Education.png" />
        </div>
          <div class="col-xs-12 col-md-8" style="padding:0 3% 0 0;margin-bottom: 4%;">
            <img style="width:100%;" src="wp-content/imgs/homepage/Healthcare-Education.png" />
          </div>
          <div class="col-xs-6 col-md-4" style="padding: 0 0 0 0.75%;margin-bottom: 4%;">
            <img style="width:100%;" src="wp-content/imgs/homepage/biomedical-repair.png" />
          </div>
          <?php echo do_shortcode('[wpb-feature-product title="Feature Products"]'); ?>
      </div><!-- /#content -->
    </div><!-- /.row -->
  </div><!-- /.container -->
        <div style="width:100%; background: #ffd67f; height:260px; margin-bottom: 2%; text-align:center;padding-top:3em;">
          <h3>Medical equipment from your most trusted brands.</h3>
We offer a large variety of infusion pumps, hospital beds, headwalls, simulated IV fluids, furniture, manikins and<br />
replacement parts for your Hill-Rom, Stryker, Hausted, MidMark, Span America beds, stretchers, wheelchairs &amp; more!<br />
<div style="margin-top: 10px;" id="mattresshomeimgwrap">
<img style="margin:0 0.8em;" src="wp-content/imgs/hill-rom-logo.png" alt=" " />
<img style="margin:0 0.8em;" src="wp-content/imgs/strykerlogo.png" alt=" " />
<img style="margin:0 0.8em;" src="wp-content/imgs/haustedlogo.png" alt=" " />
<img style="margin:0 0.8em;" src="wp-content/imgs/midmarklogo.png" alt=" " />
</div>
        </div>
        <div class="container" style="margin-bottom:2%;">
          <div class="row">
            <div id="content" role="main">
                <div class="col-md-4" style="">
                  <img style="width:100%;" src="wp-content/imgs/homepage/Simulated-iv-fluids.png" />
                </div>
                <div class="col-md-4" style="">
                  <img style="width:100%;" src="wp-content/imgs/homepage/download-catalog.png" />
                </div>
                <div class="col-md-4" style="">
                  <img style="width:100%;" src="wp-content/imgs/homepage/loaded-crash-carts.png" />
                </div>
            </div><!-- /#content -->
          </div><!-- /.row -->

    <?php else: //  -- EVERY PAGE EXCEPT HOMEPAGE ?>
      <div class="container">
        <div class="row">
        <div class="col-xs-12 col-sm-8">
          <div id="content" role="main">
            <?php get_template_part('includes/loops/content', 'page'); ?>
          </div><!-- /#content -->
        </div>

        <div class="col-xs-6 col-sm-4" id="sidebar" role="navigation">
          <?php get_template_part('includes/sidebar'); ?>
        </div>
<?php endif; ?>



  </div><!-- /.row -->
</div><!-- /.container -->

<?php get_template_part('includes/footer'); ?>
