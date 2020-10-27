<?php
  $site = get_current_site();

  //Check for Career entries and change the number of News Posts if we find one
  $careerTax = get_field('career_site_taxonomy', $site->ID);
  $careerPost_args = array (
    'post_type' => 'career',
    'posts_per_page' => 1,
    'tax_query' => array(
      array(
        'taxonomy' => 'career-site',
        'field' => 'term_id',
        'terms' => $careerTax
      )
    )
  );
  $careerPost_query = new WP_Query($careerPost_args);

  $checkCareerPosts = $careerPost_query->have_posts();

  //Change our Posts Per Page for News if there's a Career for this site
  if ( $checkCareerPosts ) {
    $newsPPP = 2;
  } else {
    $newsPPP = 3;
  }
?>

<?php
  //container if there's careers posts
  if ( $checkCareerPosts ) { ?>
  <div class="homepage_has_careers">
<?php } ?>
  <div class="homepage_posts_section">
    <h2><?php echo get_the_title($site->ID); ?> News</h2>
    <div class="homepage_posts_section_posts_container">
  <?php
    $tax = get_field('post_site_taxonomy', $site->ID);
    $post_args = array (
      'post_type' => 'post',
      'posts_per_page' => $newsPPP,
      'tax_query' => array(
        array(
          'taxonomy' => 'post-site',
          'field' => 'term_id',
          'terms' => $tax
        )
      )
    );
    $post_query = new WP_Query($post_args);
    if( $post_query->have_posts() ): while( $post_query->have_posts() ): $post_query->the_post();
  ?>
    <div class="homepage_post_item">
      <h4 class="post_item_title"><a href="<?php echo get_the_permalink();?>?current_site=<?php echo $site->ID; ?>"><?php echo get_the_title();?></a></h4>
      <p class="post_item_date">POSTED ON <?php echo get_the_date('n/j/Y', get_the_ID());?></p>
      <p class="post_item_excerpt">
        <?php echo excerpt(100); ?>
      </p>
      <a class="post_item_read_more" href="<?php echo get_the_permalink();?>?current_site=<?php echo $site->ID; ?>">Read More <i class="fa fa-caret-right" aria-hidden="true"></i></a>
    </div>
  <?php
    endwhile; endif;
    wp_reset_query();
  ?>
    </div>
    <div class="homepage_posts_section_cta_container">
      <a class="homepage_posts_section_cta" href="<?php the_field('site_news_link', $site->ID); ?>">
        View All News
      </a>
    </div>
  </div><!-- / Posts -->


  <?php
  if( $careerPost_query->have_posts() ): ?>
  <div class="homepage_careers_section">
    <h2>Careers</h2>
   <?php
   while( $careerPost_query->have_posts() ): $careerPost_query->the_post();

    $careerSiteTaxes = wp_get_object_terms( get_the_ID(), 'career-site' );
  ?>
  <div class="homepage_career_item">
    <h4><?php echo get_the_title();?></h4>
    <!-- <p class="post_item_date">POSTED ON <?php echo get_the_date('n/j/Y', get_the_ID());?></p> -->
    <p class="post_item_excerpt">
      <?php echo the_content(); ?>
    </p>
    <a class="homepage_careers_section_cta" href="<?php the_field('site_careers_link', $site->ID); ?>">
      View Careers
    </a>
  </div>
  <?php
  endwhile; ?>
  </div>
  <?php
  endif;
    wp_reset_query();
  ?>
<?php
  //close container if careers exist
  if ( $checkCareerPosts ) { ?>
  </div>
<?php } ?>
