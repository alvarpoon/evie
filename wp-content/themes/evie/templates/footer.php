<!--<footer class="content-info" role="contentinfo">
  <div class="container">
    <?php dynamic_sidebar('sidebar-footer'); ?>
  </div>
</footer>-->


<footer class="content-info" role="contentinfo">
  <div class="container">
  	<div class="row">
    	<div class="col-xs-12 col-sm-4 col-sm-push-8 col-md-4 col-md-push-8 col-lg-4 col-lg-push-8 social-link-container">
            area for social media
		</div>
	  	<div class="col-xs-12 col-sm-8 col-sm-pull-4 col-md-8 col-md-pull-4  col-lg-8 col-lg-pull-4 footer-link-container">
	    <?
		    //$id = array('en'=>4,'zh-hant'=>16,'zh-hans'=>14);
		    wp_nav_menu(array('menu' => 'footer_navigation','menu_class' => 'footer_link clearfix', 'depth' => 2));
	    ?>
		</div>
	</div>
    <!--<p class="copyright"><?=get_field("footer_copyright_text",$id[ICL_LANGUAGE_CODE])?></p>-->
    <div class="copyright">
    	@2015 EVIE INTERNATIONAL LIMITED. ALL RIGHTS RESERVED 
    	<span>|</span> <a href="#">Terms of Use</a>
        <span>|</span> <a href="#">Privacy Policy</a>
    </div>
  </div>
</footer>
<div id="connect-popup" style="display:none;">
  <h2><?=_e('Stay Connected');?></h2>
  <p><?=_e('Lorem ipsum dolor sit amet, consectetur adipiscing elit,
sed do eiusmod tempor suscipit');?></p>
  <?=do_shortcode('[contact-form-7 id="105" title="Contact form 1"]'); ?>
</div>
<?php wp_footer(); ?> 