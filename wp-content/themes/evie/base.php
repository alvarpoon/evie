<?php get_template_part('templates/head'); ?>
<body <?php body_class(); ?>>

  <!--[if lt IE 8]>
    <div class="alert alert-warning">
      <?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'roots'); ?>
    </div>
  <![endif]-->

  <?php
    do_action('get_header');
    get_template_part('templates/header-top-navbar');
	$template_name = get_post_meta( $post->ID, '_wp_page_template', true );
  ?>
  <script>
  function close_contact_popup(){
    $('#connect-popup').fadeOut();
    //alert('close_contact_popup');
  }
  </script>
  <main class="main" role="main">
  	<div id="main-content">
	    <?php include roots_template_path(); ?>
    </div>
  </main>

  <?php get_template_part('templates/footer'); ?>

</body>
</html>