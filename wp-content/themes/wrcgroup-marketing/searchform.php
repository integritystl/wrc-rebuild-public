<?php
  $site = get_current_site();
// if there's no Site because we're on a page that has not Site parent, output Global search instead
if ($site) { ?>
  <form action="<?php echo home_url();?>">
  	<label class="screen-reader-text" for="s">Search<?php _x( 'Search:', 'label' ); ?></label>
  	<input class="full_width" type="search" placeholder="Search" value="" name="s" id="s" />
  	<input type="hidden" name="current_site" id="current_site" value="<?php echo $site->ID ?>"/>
  	<input type="submit" id="searchsubmit" value="Search" />
  </form>
<?php } else { ?>
  <form role="search" method="get" id="search-form" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
   	<label class="screen-reader-text" for="s"><?php _x( 'Search:', 'label' ); ?></label>
   	<input class="full_width" type="search" placeholder="Search" value="<?php echo trim( get_search_query() ); ?>" name="s" id="s" />
   	<input type="submit" id="searchsubmit" value="Search" />
   </form>
<?php } ?>
