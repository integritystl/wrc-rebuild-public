<div id="secondary" class="secondary__child-page">
  <nav class="nav-child-page">
    <span class="nav-child-page__title">Menu</span>
    <ul class="menu-child-page news-category-list">
      <li class="cat-item active-item all-cat-item">
        <a data-category="ALL" href="#" title="All News">News</a>
      </li>
      <?php /**
       *
       * Note: The client wanted to hide the categories for the WRC news pages. So goodbye.

       3/31 - uncommented to see if client wants back in. Jsut need to comment all the way down to the echo if clients wants re-hidden. 
       */
      // global $wpdb;
      // $site = get_current_site();
      // $tax_id = get_field('post_site_taxonomy', $site->ID);

      // //grab ids of all posts in site
      // $post_ids = $wpdb->get_results(
      //   "SELECT ID 
      //   FROM $wpdb->posts AS p
      //   INNER JOIN $wpdb->term_relationships AS tr ON (p.ID = tr.object_id)
      //   INNER JOIN $wpdb->term_taxonomy AS tt ON (tr.term_taxonomy_id = tt.term_taxonomy_id)
      //   INNER JOIN $wpdb->terms AS t ON (t.term_id = tt.term_id)
      //   WHERE   p.post_status = 'publish' 
      //       AND tt.taxonomy = 'post-site' 
      //       AND tt.term_id = $tax_id",
      // ARRAY_N
      // );

      // $id_array = array();
      // foreach($post_ids as $post_id){
      //   array_push($id_array, $post_id[0]);
      // }
      // $id_string = implode(",", $id_array);

      // //get categories of only existing posts
      // $categories = $wpdb->get_results(
      //   "SELECT tt.term_id as term_id, tt.description as description, t.name as name
      //   FROM $wpdb->posts AS p
      //   INNER JOIN $wpdb->term_relationships AS tr ON (p.ID = tr.object_id)
      //   INNER JOIN $wpdb->term_taxonomy AS tt ON (tr.term_taxonomy_id = tt.term_taxonomy_id)
      //   INNER JOIN $wpdb->terms AS t ON (t.term_id = tt.term_id)
      //   WHERE   p.post_status = 'publish' 
      //       and tt.taxonomy = 'category' 
      //       and p.id in ($id_string)
      //   GROUP BY t.name"
      // );

      // foreach($categories as $category){
      //   if ($category->term_id != 24) {
      //     echo('<li class="cat-item">');
      //     echo('<a data-category="' . $category->term_id . '" href="#" title="' . $category->description . '">' . $category->name . '</a>');
      //     echo('</li>');
      //   }
      // }
      ?>
      <!-- Adding The Wire menu item -->
      <li><a href="/the-wire">The Wire</a></li>
    </ul>
  </nav>
</div>
