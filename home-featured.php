<div class="container">
    <div class="row">
       <div class="col-md-12">
            <div class="home-featured">
                <?php
				if ( is_active_sidebar( 'widget-area-home' ) ) :
					dynamic_sidebar( 'widget-area-home' );
				else :
					$defaults = array(
						'before_widget' => '<aside class="home-widget">',
						'after_widget'  => '</aside>',
						'before_title'  => '<div class="home-widget-section-title"><h3 class="home-widget-title">',
						'after_title'   => '</h3></div>',
						'widget_id'     => ''
					);

				/*	the_Widget(
						'Listify_Widget_Recent_Listings',
						array(
							'title' => __( 'Recent  Listings', 'listify' ),
							'description' => __( 'Take a look at what\'s been recently added.', 'listify' ),
							'limit' => 6,
							'featured' => 0
						),
						$defaults
					); */
				endif;
			?>
            </div>
        </div>
    </div>
</div>