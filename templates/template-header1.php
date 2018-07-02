<header class="header1">

  <?php if(cryptic_plugin_active('redux-framework/redux-framework.php')){ ?>
  <div class="row top-header">
    <div class="container">

	    <div class="col-md-8 col-sm-7">
	    	<div class="header-infos">
			  <!-- <div class="header-infos-sub"> -->
			    <?php if(cryptic_redux('mt_divider_header_info_1_status') == true){ ?>
			      <!-- HEADER INFO 1 -->
			      <div class="text-center header-info-group">
			        <div class="header-info-icon pull-left text-center <?php echo esc_attr(cryptic_redux('mt_divider_header_info_1_media_type')); ?>">
			          <?php if(cryptic_redux('mt_divider_header_info_1_media_type') == 'font_awesome'){ ?>
			            <i class="<?php echo esc_attr(cryptic_redux('mt_divider_header_info_1_faicon')); ?>"></i>
			          <?php }elseif(cryptic_redux('mt_divider_header_info_1_media_type') == 'media_image'){ ?>
			            <img src="<?php echo esc_url(cryptic_redux('mt_divider_header_info_1_image_icon','url')); ?>" alt="" />
			          <?php }elseif(cryptic_redux('mt_divider_header_info_1_media_type') == 'text_title'){ ?>
			          	<p class="header_text_title"><?php echo esc_html(cryptic_redux('mt_divider_header_info_1_text_1')); ?>
			          <?php } ?>
			        </div>
			        <div class="header-info-labels pull-left">
			          <p><?php echo esc_html(cryptic_redux('mt_divider_header_info_1_heading1')); ?></p>
			        </div>
			      </div>
			      <!-- // HEADER INFO 1 -->
			    <?php } ?>

			    <?php if(cryptic_redux('mt_divider_header_info_2_status') == true){ ?>
			      <!-- HEADER INFO 2 -->
			      <div class="text-center header-info-group">
			        <div class="header-info-icon pull-left text-center <?php echo esc_attr(cryptic_redux('mt_divider_header_info_2_media_type')); ?>">
			          <?php if(cryptic_redux('mt_divider_header_info_2_media_type') == 'font_awesome'){ ?>
			            <i class="<?php echo esc_attr(cryptic_redux('mt_divider_header_info_2_faicon')); ?>"></i>
			          <?php }elseif(cryptic_redux('mt_divider_header_info_2_media_type') == 'media_image'){ ?>
			            <img src="<?php echo esc_url(cryptic_redux('mt_divider_header_info_2_image_icon','url')); ?>" alt="" />
			          <?php }elseif(cryptic_redux('mt_divider_header_info_2_media_type') == 'text_title'){ ?>
			          	<p class="header_text_title"><?php echo esc_html(cryptic_redux('mt_divider_header_info_2_text_2')); ?>
			          <?php } ?>
			        </div>
			        <div class="header-info-labels pull-left">
			          <p><?php echo esc_html(cryptic_redux('mt_divider_header_info_2_heading1')); ?></p>
			        </div>
			      </div>
			      <!-- // HEADER INFO 2 -->
			    <?php } ?>

			    <?php if(cryptic_redux('mt_divider_header_info_3_status') == true){ ?>
			      <!-- HEADER INFO 3 -->
			      <div class="text-center header-info-group">
			        <div class="header-info-icon pull-left text-center <?php echo esc_attr(cryptic_redux('mt_divider_header_info_3_media_type')); ?>">
			          <?php if(cryptic_redux('mt_divider_header_info_3_media_type') == 'font_awesome'){ ?>
			            <i class="<?php echo esc_attr(cryptic_redux('mt_divider_header_info_3_faicon')); ?>"></i>
			          <?php }elseif(cryptic_redux('mt_divider_header_info_3_media_type') == 'media_image'){ ?>
			            <img src="<?php echo esc_url(cryptic_redux('mt_divider_header_info_3_image_icon','url')); ?>" alt="" />
			          <?php }elseif(cryptic_redux('mt_divider_header_info_3_media_type') == 'text_title'){ ?>
			          	<p class="header_text_title"><?php echo esc_html(cryptic_redux('mt_divider_header_info_3_text_3')); ?>
			          <?php } ?>
			        </div>
			        <div class="header-info-labels pull-left">
			          <p class="call_us_class"><?php echo esc_html(cryptic_redux('mt_divider_header_info_3_heading1')); ?></p>
			        </div>
			      </div>
			      <!-- // HEADER INFO 3 -->
			    <?php } ?>

				  <!-- </div> -->
				</div>
	      
		</div>

	      <!-- NAV ACTIONS -->
            <div class="navbar-collapse actions collapse col-md-4  col-sm-5">
                <div class="header-nav-actions">

                  <?php if(cryptic_redux('mt_header_fixed_sidebar_menu_status') == true) { ?>
                    <!-- MT BURGER -->
                    <div id="mt-nav-burger">
                      <span></span>
                      <span></span>
                      <span></span>
                      <span></span>
                      <span></span>
                      <span></span>
                    </div>
                  <?php } ?>

                  <?php if(cryptic_redux('mt_header_is_search') == true){ ?>
                    <a href="<?php echo esc_url('#'); ?>" class="mt-search-icon">
                      <i class="fa fa-search" aria-hidden="true"></i>
                    </a>
                  <?php } ?>

                  <ul class="social-links">
                        <?php if ( cryptic_redux('mt_social_fb') && cryptic_redux('mt_social_fb') != '' ) { ?>
                            <li><a href="<?php echo esc_url( cryptic_redux('mt_social_fb') ) ?>"><i class="fa fa-facebook"></i></a></li>
                        <?php } ?>
                        <?php if ( cryptic_redux('mt_social_tw') && cryptic_redux('mt_social_tw') != '' ) { ?>
                            <li><a href="https://twitter.com/<?php echo esc_attr( cryptic_redux('mt_social_tw') ) ?>"><i class="fa fa-twitter"></i></a></li>
                        <?php } ?>
                        <?php if ( cryptic_redux('mt_social_gplus') && cryptic_redux('mt_social_gplus') != '' ) { ?>
                            <li><a href="<?php echo esc_url( cryptic_redux('mt_social_gplus') ) ?>"><i class="fa fa-google-plus"></i></a></li>
                        <?php } ?>
                        <?php if ( cryptic_redux('mt_social_youtube') && cryptic_redux('mt_social_youtube') != '' ) { ?>
                            <li><a href="<?php echo esc_url( cryptic_redux('mt_social_youtube') ) ?>"><i class="fa fa-youtube"></i></a></li>
                        <?php } ?>
                        <?php if ( cryptic_redux('mt_social_pinterest') && cryptic_redux('mt_social_pinterest') != '' ) { ?>
                            <li><a href="<?php echo esc_url( cryptic_redux('mt_social_pinterest') ) ?>"><i class="fa fa-pinterest"></i></a></li>
                        <?php } ?>
                        <?php if ( cryptic_redux('mt_social_linkedin') && cryptic_redux('mt_social_linkedin') != '' ) { ?>
                            <li><a href="<?php echo esc_url( cryptic_redux('mt_social_linkedin') ) ?>"><i class="fa fa-linkedin"></i></a></li>
                        <?php } ?>
                        <?php if ( cryptic_redux('mt_social_skype') && cryptic_redux('mt_social_skype') != '' ) { ?>
                            <li><a href="<?php echo esc_url( cryptic_redux('mt_social_skype') ) ?>"><i class="fa fa-skype"></i></a></li>
                        <?php } ?>
                        <?php if ( cryptic_redux('mt_social_instagram') && cryptic_redux('mt_social_instagram') != '' ) { ?>
                            <li><a href="<?php echo esc_url( cryptic_redux('mt_social_instagram') ) ?>"><i class="fa fa-instagram"></i></a></li>
                        <?php } ?>
                        <?php if ( cryptic_redux('mt_social_dribbble') && cryptic_redux('mt_social_dribbble') != '' ) { ?>
                            <li><a href="<?php echo esc_url( cryptic_redux('mt_social_dribbble') ) ?>"><i class="fa fa-dribbble"></i></a></li>
                        <?php } ?>
                        <?php if ( cryptic_redux('mt_social_deviantart') && cryptic_redux('mt_social_deviantart') != '' ) { ?>
                            <li><a href="<?php echo esc_url( cryptic_redux('mt_social_deviantart') ) ?>"><i class="fa fa-deviantart"></i></a></li>
                        <?php } ?>
                        <?php if ( cryptic_redux('mt_social_digg') && cryptic_redux('mt_social_digg') != '' ) { ?>
                            <li><a href="<?php echo esc_url( cryptic_redux('mt_social_digg') ) ?>"><i class="fa fa-digg"></i></a></li>
                        <?php } ?>
                        <?php if ( cryptic_redux('mt_social_flickr') && cryptic_redux('mt_social_flickr') != '' ) { ?>
                            <li><a href="<?php echo esc_url( cryptic_redux('mt_social_flickr') ) ?>"><i class="fa fa-flickr"></i></a></li>
                        <?php } ?>
                        <?php if ( cryptic_redux('mt_social_stumbleupon') && cryptic_redux('mt_social_stumbleupon') != '' ) { ?>
                            <li><a href="<?php echo esc_url( cryptic_redux('mt_social_stumbleupon') ) ?>"><i class="fa fa-stumbleupon"></i></a></li>
                        <?php } ?>
                        <?php if ( cryptic_redux('mt_social_tumblr') && cryptic_redux('mt_social_tumblr') != '' ) { ?>
                            <li><a href="<?php echo esc_url( cryptic_redux('mt_social_tumblr') ) ?>"><i class="fa fa-tumblr"></i></a></li>
                        <?php } ?>
                        <?php if ( cryptic_redux('mt_social_vimeo') && cryptic_redux('mt_social_vimeo') != '' ) { ?>
                            <li><a href="<?php echo esc_url( cryptic_redux('mt_social_vimeo') ) ?>"><i class="fa fa-vimeo-square"></i></a></li>
                        <?php } ?>
                    </ul>



                </div>
                
            </div>

    </div>
   </div>
  <?php } ?>


  <!-- BOTTOM BAR -->
  <nav class="navbar navbar-default logo-infos" id="modeltheme-main-head">
    <div class="container">
        <div class="row">

          <!-- LOGO -->
          <div class="navbar-header col-md-3">
            <!-- NAVIGATION BURGER MENU -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>



            <?php if(cryptic_plugin_active('redux-framework/redux-framework.php')){ 
              
            $custom_header_activated = get_post_meta( get_the_ID(), 'smartowl_custom_header_options_status', true );
            $header_v = get_post_meta( get_the_ID(), 'smartowl_header_custom_variant', true );
            $custom_logo_url = get_post_meta( get_the_ID(), 'smartowl_header_custom_logo', true );

            if($custom_header_activated == 'yes' && isset($custom_logo_url) && !empty($custom_logo_url)) { ?>

              <h1 class="logo">
                  <a href="<?php echo esc_url(get_site_url()); ?>">
                      <img src="<?php echo esc_url($custom_logo_url); ?>" alt="<?php echo esc_attr(get_bloginfo()); ?>" />
                  </a>
              </h1>

            <?php } else {

              if(cryptic_redux('mt_logo','url')){ ?>
                <h1 class="logo">
                    <a href="<?php echo esc_url(get_site_url()); ?>">
                        <img src="<?php echo esc_url(cryptic_redux('mt_logo','url')); ?>" alt="<?php echo esc_attr(get_bloginfo()); ?>" />
                    </a>
                </h1>
              <?php }else{ ?>
                <h1 class="logo no-logo">
                    <a href="<?php echo esc_url(get_site_url()); ?>">
                      <?php echo esc_html(get_bloginfo()); ?>
                    </a>
                </h1>
              <?php } ?>
            <?php } ?>

            <?php }else{ ?>
              <h1 class="logo no-logo">
                  <a href="<?php echo esc_url(get_site_url()); ?>">
                    <?php echo esc_html(get_bloginfo()); ?>
                  </a>
              </h1>
            <?php } ?>
          </div>

          <!-- NAV MENU -->
          <div id="navbar" class="navbar-collapse collapse col-md-9">
            <ul class="menu nav navbar-nav pull-right nav-effect nav-menu">
              <?php
                if ( has_nav_menu( 'primary' ) ) {
                  $defaults = array(
                    'menu'            => '',
                    'container'       => false,
                    'container_class' => '',
                    'container_id'    => '',
                    'menu_class'      => 'menu',
                    'menu_id'         => '',
                    'echo'            => true,
                    'fallback_cb'     => false,
                    'before'          => '',
                    'after'           => '',
                    'link_before'     => '',
                    'link_after'      => '',
                    'items_wrap'      => '%3$s',
                    'depth'           => 0,
                    'walker'          => ''
                  );

                  $defaults['theme_location'] = 'primary';

                  wp_nav_menu( $defaults );
                }else{
                  echo '<p class="no-menu text-right">';
                    echo esc_html__('Primary navigation menu is missing. Add one from ', 'cryptic');
                    echo '<a href="'.esc_url(get_admin_url() . 'nav-menus.php').'"><strong>'.esc_html__(' Appearance -> Menus','cryptic').'</strong></a>';
                  echo '</p>';
                }
              ?>
            </ul>
          </div>

        </div>
    </div>
  </nav>
</header>
