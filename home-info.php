<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="what-we-do">
				<h1><?php the_field('what_we_do_section_title'); ?></h1>
				<div class="info-section">
					<?php if( have_rows('home_info') ): ?>
						<?php while( have_rows('home_info') ): the_row(); 
							// vars
							$icon = get_sub_field('icon');
							$content = get_sub_field('info');
							$title = get_sub_field('title');
							?>
                            <div class="col-md-4">
                                <i class="icon <?php echo $icon; ?>"></i>
                                <span class="title"><?php echo $title; ?></span>
                                <div class="content"><?php echo $content; ?></div>
                            </div>
							
						<?php endwhile; ?>
					<?php endif; ?>
				</div> <!-- info -->
			</div> <!-- what we do -->
		</div>
	</div>
</div>