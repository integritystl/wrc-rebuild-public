<?php

namespace WRCInfrastructure\Services;

class CommonServices
{
  public static function getCurrentSite()
  {
    static $site = NULL;
    if( empty($site) ) {
      global $wp_query;

      if(isset($_GET['current_site'])){
        $siteID = $_GET['current_site'];
        $site = get_post($siteID);
        return $site;
      }
      if(! is_object($wp_query)) {
        $site = get_field('site_default', 'options');
        return $site;
      }

      if(empty($wp_query->post) && !(is_404())) {
        $site = get_field('site_default', 'options');
        return $site;
      }
      //only check for ancestors if we have a wp query to check against to avoid 404 page errors
      if ( !empty($wp_query->post) ) {
        $ancestors = get_ancestors($wp_query->post->ID, 'page', 'post_type');
      } else {
        $ancestors = null;
      }


      if(!empty($ancestors) && count($ancestors) > 0) { //check for null first since it isn't countable
        $topAncestor = $ancestors[count($ancestors) - 1];
        $site = get_field('site', $topAncestor);
      } else if ( is_page_template('page-wrc-home.php') || is_page_template('page-wrc-agency-home.php') || is_page_template('page-1stauto-home.php') ) {
         $site = get_field('site', $wp_query->post->ID);
      } else if ( is_single() ) {
        //Make sure a post-site tax has been assigned
        if ( has_term('', 'post-site', $wp_query->post->ID) === true ) {
          $postSiteTax = get_the_terms($wp_query->post->ID, 'post-site' );

          //Check to see if it's more than 1
          if ( count($postSiteTax) > 1 ) {
            // Use the Default Site when more than 1 Post Site Tax assigned
            $site = get_field('site_default', 'options');
          } else {
            //Field is set to required and maps to Site Post Object
            $attachedSite = get_field('attached_site', $wp_query->post->ID);
            if ($attachedSite) {
              $site = $attachedSite;
            } else {
              //just in case
              $site = get_field('site_default', 'options');
            }
          }

        } else {
          //if no post-site tax is set at all on the current post, bail to Default as well
          $site = get_field('site_default', 'options');
        }
      //Final Fallback if site isn't set or we're unable to set it, such as Global Pages or Posts that are on Multiple Sites
      } else {
        $site = get_field('site_default', 'options');
      }
    }

    if(empty($site)){
      $site = get_field('site_default', 'options');
    }

    return $site;
  }
}
