<div class="homepage_agent_search">
  <?php
    $agentImage = get_field('agent_search_image');
    $agentImage = $agentImage['sizes']['large'];
  ?>
  <div class="homepage_agent_search_image">
    <img src="<?php echo $agentImage;?>" />
  </div>
  <div class="homepage_agent_search_content-container">
    <div class="homepage_agent_search_content">
      <h2><?php echo get_field('agent_search_headline');?></h2>
      <p><?php echo get_field('agent_search_content');?></p>
      <?php $search_page_url = get_field('agent_search_target_page'); ?>
      <a class="homepage_agent_search_link" href="<?php echo $search_page_url; ?>">
        <?php echo get_field('agent_search_link_text'); ?> <i class="fa fa-caret-right" aria-hidden="true"></i>
      </a>
      <div class="agent-search_block">
        <div class="agent_search_block-intro">
          <p>Select a State:</p>
            <ul class="state-select">
              <li><a href="<?php echo($search_page_url . '?state_filter=Arkansas'); ?>"><span>Arkansas</span></a></li>
              <li><a href="<?php echo($search_page_url . '?state_filter=Illinois'); ?>"><span>Illinois</span></a></li>
              <li><a href="<?php echo($search_page_url . '?state_filter=Iowa'); ?>"><span>Iowa</span></a></li>
              <li><a href="<?php echo($search_page_url . '?state_filter=Missouri'); ?>"><span>Missouri</span></a></li>
              <li><a href="<?php echo($search_page_url . '?state_filter=South%20Dakota'); ?>"><span>South Dakota</span></a></li>
              <li><a href="<?php echo($search_page_url . '?state_filter=Wisconsin'); ?>"><span>Wisconsin</span></a></li>
            </ul>
          <p>– or –</p>
        </div>
        <form action="<?php echo get_field('agent_search_target_page');?>" method="get">
          <span class="form-location-info"></span>
          <label for="homepage_search" class="screen-reader-text" aria-labelledby="homepage_agent_search_input">Search by City, State or Zip Code</label>
          <div class="homepage_search-input"><i class="fa fa-search"></i><input type="text" id="homepage_agent_search_input" class="homepage_agent_search_input" name="homepage_search" placeholder="Search by City, State or Zip Code" autocomplete="off"/></div>
          <input type="hidden" id="homepage_search-userLat" name="userLatitude" value=""/>
          <input type="hidden" id="homepage_search-userLong" name="userLongitude" value=""/>
          <input class="homepage_agent_search_submit" type="submit" value="See Results">
        </form>
      </div>
    </div>
  </div>
</div>
