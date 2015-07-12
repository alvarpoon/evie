<!--<footer class="content-info" role="contentinfo">
  <div class="container">
    <?php dynamic_sidebar('sidebar-footer'); ?>
  </div>
</footer>-->


<footer class="content-info" role="contentinfo">
  <div class="container">
  	<div class="row">
    	<div class="col-xs-12 col-sm-4 col-sm-push-8 col-md-2 col-md-push-10 col-lg-4 col-lg-push-8 social-link-container">
			<a href="https://www.facebook.com/eviebeaute" class="icon_facebook" target="_blank"></a>
			<a href="https://instagram.com/eviebeaute/" class="icon_instagram" target="_blank"></a>
			<a href="http://www.weibo.com/u/1710187200?topnav=1&wvr=6&topsug=1" class="icon_weibo" target="_blank"></a>
			<a href="#" class="icon_wechat" target="_blank"></a>
			<a href="https://www.pinterest.com/natalieevie/" class="icon_pinterest" target="_blank"></a>
			<a href="https://twitter.com/eviebeaute" class="icon_twitter" target="_blank"></a>
			<a href="https://www.youtube.com/channel/UCHWvlq1A-m7OdPhTto4qoCA" class="icon_youtube" target="_blank"></a>
			<a href="https://plus.google.com/u/0/103873711430165814116/posts" class="icon_googleplus" target="_blank"></a>
			<a href="https://www.linkedin.com/company/1116315?trk=tyah&trkInfo=clickedVertical%3Acompany%2Cidx%3A1-1-1%2CtarId%3A1435031312432%2Ctas%3Aevie%20bea" class="icon_linkin" target="_blank"></a>
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
  <small><?=_e('Please enter your email to subscribe. Mobile is optional.');?></small>
  <?=do_shortcode('[contact-form-7 id="105" title="Contact form 1"]'); ?>
  <div class="social-link-container marginTop10">
			<a href="https://www.facebook.com/eviebeaute" class="icon_facebook"></a>
			<a href="https://instagram.com/eviebeaute/" class="icon_instagram"></a>
			<a href="http://www.weibo.com/u/1710187200?topnav=1&wvr=6&topsug=1" class="icon_weibo"></a>
			<a href="#" class="icon_wechat"></a>
			<a href="https://www.pinterest.com/natalieevie/" class="icon_pinterest"></a>
			<a href="https://twitter.com/eviebeaute" class="icon_twitter"></a>
			<a href="https://www.youtube.com/channel/UCHWvlq1A-m7OdPhTto4qoCA" class="icon_youtube"></a>
			<a href="https://plus.google.com/u/0/103873711430165814116/posts" class="icon_googleplus"></a>
			<a href="https://www.linkedin.com/company/1116315?trk=tyah&trkInfo=clickedVertical%3Acompany%2Cidx%3A1-1-1%2CtarId%3A1435031312432%2Ctas%3Aevie%20bea" class="icon_linkin"></a>
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