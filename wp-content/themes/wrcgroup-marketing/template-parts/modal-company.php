<?php
//Company logos have data attributes to match them up with Current Site to apply additional styling based on active site
  $site = get_current_site();
  if ($site) {
      $siteSlug = $site->post_name;
  }
  //Slugs to match up with Current Site Slugs
  $firstAutoSlug = '1st-auto';
  $WRCAgencySlug = 'wrc-agency';
  // $1stAutoSlug = 1st-auto
  // $WRCAgencySlug = wrc-agency
  //if siteslug === data-att { active }
?>

<div class="modal modal__hide modal__bill_policy" id="modalFormBillPolicy" role="dialog" aria-hidden="true">
  <div class="modal-fade-screen">
    <div class="modal__inner modal__inner-select">
      <div class="modal__close">	&times; </div>
      <h3 class="modal__title">Pay Bill</h3>
      <div class="modal__body">
        <div class="modal__company">
          <p>Choose a company</p>
          <div class="logo-wrapper">
            <a class="company__modal-trigger" href="https://epayment.epymtservice.com/epay.jhtml?billerGroupId=AUT&billerId=AUT&productCode=BillerGroup-AUT&disallowLogin=N" target="_blank" rel="noreferrer"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/1st-auto-logo.png" alt="1st Auto" data-site="<?php echo $firstAutoSlug; ?>" class="modal__logo<?php if ($siteSlug != $firstAutoSlug) { echo ' logo-inactive';} ?>" /><br>Claim Payment</a>
            <a class="company__modal-trigger" href="https://mypolicy.1stauto.com/#/access/signin" target="_blank" rel="noreferrer"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/1st-auto-logo.png" alt="1st Auto" data-site="<?php echo $firstAutoSlug; ?>" class="modal__logo<?php if ($siteSlug != $firstAutoSlug) { echo ' logo-inactive';} ?>" /><br>Premium Payment</a>
            <a class="company__modal-wrcagency" href="https://epayment.epymtservice.com/epay.jhtml?billerGroupId=AGY&billerId=AGY&productCode=BillerGroup-AGY&disallowLogin=N" target="_blank"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/WRC-Agency-logo.png" alt="WRC Agency" data-site="<?php echo $WRCAgencySlug; ?>" class="modal__logo<?php if ($siteSlug != $WRCAgencySlug) { echo ' logo-inactive';} ?>" /><br>Payment</a>
          </div>
        </div>
      
        <div class="modal__form-wrap modal__hide">

          <?php get_template_part( 'template-parts/modal', 'form' ); ?>

        </div>

      </div>
    </div>

  </div>
</div>
