<section class="media-coverage-section container">
  <div class="col-xs-12">
    <div class="row">
      <div class="headline-title-container clearfix">
    	<div class="col-xs-2 headline-title-left"></div>
      	<div class="col-xs-8 headline-title-center">MEDIA COVERAGE</div>
      	<div class="col-xs-2 headline-title-right"></div>
      </div>
      <div class="media-item-container">
			<?
            	$args = array( 'numberposts' => -1, 'post_type' => 'media', 'post_status' => 'publish', 'order' => 'ASC', 'orderby' => 'menu_order', 'suppress_filters' => 0);
            	$results = get_posts( $args );
				$count = 1;
           		foreach( $results as $result ) :
           			$url = wp_get_attachment_image_src( get_post_thumbnail_id($result->ID), 'full');
            		//$page_url = get_field("page_link",$result->ID);
					//print_r($result);
					$media_image = get_field("popup_image",$result->ID);
					if($count%5 == 1){
						echo '<div class="col-sm-7 five-three"><div class="row">';
					}
					if($count%5 < 4 && $count%5 != 0){
						echo '<div class="col-sm-4"><a class="fancybox-effects-c" href="'.$media_image['url'].'"><img class="img-responsive" src="'.$url[0].'" /></a><div class="media-headline">'.$result->post_title.'</div></div>';
					}
					if($count%5 == 3){
						echo '</div></div>';
						echo '<div class="col-sm-5 five-two"><div class="row">';	
					}
					if($count%5 == 4){
						echo '<div class="col-sm-6"><a class="fancybox-effects-c" href="'.$media_image['url'].'"><img class="img-responsive" src="'.$url[0].'" /></a><div class="media-headline">'.$result->post_title.'</div></div>';
					}
					if($count%5 == 0){
						echo '<div class="col-sm-6"><a class="fancybox-effects-c" href="'.$media_image['url'].'"><img class="img-responsive" src="'.$url[0].'" /></a><div class="media-headline">'.$result->post_title.'</div></div>';
						echo '</div></div>';
					}
					$count++;
            ?>
            
          <!--<div class="col-sm-5 five-two">
            <div class="row">
              <div class="col-sm-6"> Col 4 </div>
              <div class="col-sm-6"> Col 5 </div>
            </div>
          </div>-->
          <? endforeach;?>
      </div>
    </div>
    <!-- end outer row --> 
  </div>
</section>