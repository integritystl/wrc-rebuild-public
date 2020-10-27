<div id="secondary" class="secondary__child-page">
    <?php
    $issue_args = array(
      'post_type' => 'mutual-manager',
      'post_status' => 'publish',
      'posts_per_page' => 4,
    );

    $issue_list = new WP_Query( $issue_args );

    $issue_count = wp_count_posts('mutual-manager')->publish;

    if( $issue_list->have_posts() && ($issue_count > 1) ) :
    ?>
    <nav class="nav-child-page">
        <ul class="menu-child-page wire-category-list">
        <?php while( $issue_list->have_posts()) : $issue_list->the_post(); ?>

            <li class="cat-item"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>

        <?php endwhile;
            if ($issue_count >= 5) { ?>
            <li class="cat-item"><a href="/mutual-manager/">The Mutual Manager Archive</a></li>
            <?php } ?>
        </ul>
    </nav>
    <?php endif; ?>

</div>
