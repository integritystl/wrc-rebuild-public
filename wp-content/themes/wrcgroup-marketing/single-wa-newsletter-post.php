<?php
/**
 * The template for displaying all single Newsletter Name
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package wrcgroup_marketing
 */

//set query param of wrc site
newsletter_wrc_site();

//Get ID of current site using query param if we have it
if (isset($_GET['current_site'])) {
    $siteID = $_GET['current_site'];
}



get_header(); ?>
    <div class="child-page">
        <div id="primary" class="content-area">
            <main id="main" class="site-main" role="main">

             <?php //get issue
             $issueTerms = get_the_terms( get_the_ID(), 'wrcagency-newsletter-issue-group' );

             if ( $issueTerms && ! is_wp_error( $issueTerms ) ) :
                 foreach ($issueTerms as $i) {
                     $theIssue = $i->name;
                 }
             endif;

             //get post meta parent issue
             $issueParent = $post->post_parent;
             $parentIssueLink = get_permalink($issueParent);
             ?>

                <div class="issue_template_right_section">

                    <div id="primary" class="issue_template_content_section">

                        <a class="back-to-issue" href="<?php echo $parentIssueLink . '?current_site=75'; ?>">Back to <?php echo $theIssue; ?> Issue</a>

                        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                            <?php
                            if ( has_post_thumbnail() ) { ?>
                                <div class="wire-post-thumbnail"><?php the_post_thumbnail(); ?></div>
                            <?php } ?>
                            <h1><?php the_title(); ?></h1>

                            <p class="issue-meta">
                                <?php echo $theIssue . ' Issue'; ?>
                            </p>

                            <?php the_content(); ?>

                        </article>

                        <div class="news-links">
                            <?php previous_post_link( '%link', 'Previous post in Issue', TRUE, ' ', 'wrcagency-newsletter-issue-group' ); ?><?php next_post_link( '%link', 'Next post in Issue', TRUE, ' ', 'wrcagency-newsletter-issue-group' ); ?>
                        </div>

            </main><!-- #main -->
        </div><!-- #primary -->
        <?php get_sidebar('wrcageny-newsletter'); ?>
<?php
get_footer();
