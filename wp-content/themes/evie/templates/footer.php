<!--<footer class="content-info" role="contentinfo">
  <div class="container">
    <?php dynamic_sidebar('sidebar-footer'); ?>
  </div>
</footer>-->


<footer class="content-info" role="contentinfo">
  <div class="container">
  	<div class="row">
    	<div class="col-xs-12 col-sm-4 col-sm-push-8 col-md-2 col-md-push-10 col-lg-4 col-lg-push-8 social-link-container">
			<a href="#" class="icon_facebook" target="_blank"></a>
			<a href="#" class="icon_instagram" target="_blank"></a>
			<a href="#" class="icon_weibo" target="_blank"></a>
			<a href="#" class="icon_wechat" target="_blank"></a>
			<a href="#" class="icon_pinterest" target="_blank"></a>
			<a href="#" class="icon_twitter" target="_blank"></a>
			<a href="#" class="icon_youtube" target="_blank"></a>
			<a href="#" class="icon_googleplus" target="_blank"></a>
			<a href="#" class="icon_linkin" target="_blank"></a>
			<a href="#" class="icon_email" target="_blank"></a>
			<a href="#" class="icon_line" target="_blank"></a>
			<a href="#" class="icon_whatsapp" target="_blank"></a>
			<!--<a href="#"><i class="fa fa-facebook-square"></i></a>
			<a href="#"><i class="fa fa-instagram"></i></a>
			<a href="#"><i class="fa fa-weibo"></i></a>
			<a href="#"><i class="fa fa-weixin"></i></a>
			<a href="#"><i class="fa fa-pinterest"></i></a>
			<a href="#"><i class="fa fa-twitter"></i></a>
			<a href="#"><i class="fa fa-youtube"></i></a>
			<a href="#"><i class="fa fa-linkedin"></i></a>
			<a href="#"><i class="fa fa-google-plus"></i></a>
			<a href="#"><i class="fa fa-envelope-o"></i></a>
			<a href="#"><i class="fa fa-whatsapp"></i></a>-->
		</div>
	  	<div class="col-xs-12 col-sm-8 col-sm-pull-4 col-md-10 col-md-pull-2 col-lg-8 col-lg-pull-4 footer-link-container">
	    <?
		    //$id = array('en'=>4,'zh-hant'=>16,'zh-hans'=>14);
	    if (has_nav_menu('footer_navigation')){
	    	wp_nav_menu(array('theme_location' => 'footer_navigation', 'menu_class' => 'footer_link clearfix', 'depth' => 2));
	    }
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
  <a href="javascript:;" id="connect_close"><i class="fa fa-times"></i></a>
  <h2><?=_e('Stay Connected');?></h2>
  <p><?=_e('Get the latest in skincare wardrobe right to your inbox,<br />plus special offers!');?></p>
  <small><?=_e('Please enter your email and / or mobile');?></small>
  <?=do_shortcode('[contact-form-7 id="105" title="Contact form 1"]'); ?>
  <div class="social-link-container marginTop10">
			<a href="#" class="icon_facebook" target="_blank"></a>
			<a href="#" class="icon_instagram" target="_blank"></a>
			<a href="#" class="icon_weibo" target="_blank"></a>
			<a href="#" class="icon_wechat" target="_blank"></a>
			<a href="#" class="icon_pinterest" target="_blank"></a>
			<a href="#" class="icon_twitter" target="_blank"></a>
			<a href="#" class="icon_youtube" target="_blank"></a>
			<a href="#" class="icon_googleplus" target="_blank"></a>
			<a href="#" class="icon_linkin" target="_blank"></a>
			<a href="#" class="icon_email" target="_blank"></a>
			<a href="#" class="icon_whatsapp" target="_blank"></a>
  </div>  
</div>
<?php wp_footer(); ?> 

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-64529777-1', 'auto');
  ga('send', 'pageview');

</script>