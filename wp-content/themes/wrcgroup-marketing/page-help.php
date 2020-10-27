<?php
/**
 * Template Name: Help
 *
 *
 * @package wrcgroup_marketing
 */

get_header();
?>
<div class="child-page">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">
					<h1><?php the_title();?></h1>
				</header>
				<?php if (get_the_content()) { ?>
					<div class="help_content">
						<?php the_content(); ?>
					</div>
				<?php } ?>

					<?php if( have_rows('help_questions')): ?>
						<div class="help_questions">
							<?php while(have_rows('help_questions')): the_row();
								$helpPostObj = get_sub_field('help');
								//make sure help question exists before output
								if ($helpPostObj) {
									$helpPostObjID = $helpPostObj->ID; ?>

									<div class="help_single">
										<div class="help_single_title">
											<h4><?php echo get_field('label_question', $helpPostObjID);?></h4>
											<i class="fa fa-plus" aria-hidden="true"></i>
											<i class="fa fa-minus" aria-hidden="true"></i>
										</div>
										<div class="help_single_answer">
											<?php echo get_field('answer', $helpPostObjID);?>
										</div>
									</div>
							<?php } ?>
					<?php endwhile; ?>
					</div>
				<?php endif;?>
			</article>
		</main><!-- #main -->
	</div><!-- #primary -->
  <?php get_sidebar('internal'); ?>
</div>
<?php
get_footer();
