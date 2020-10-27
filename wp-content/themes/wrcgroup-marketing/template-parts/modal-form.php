
        <?php
        // The Bridge form shared between modals
        if ( get_field('modal_help_text', 'option') ) { ?>
          <div class="modal__helper_text"><?php the_field('modal_help_text', 'option'); ?></div>
        <?php } else { ?>
          <p>Enter the complete policy number below.</p>
        <?php } ?>

          <div class="modal__error"></div>

          <form id="policy-number-check" class="modal__form" action="">
              <label>Policy Number</label>
              <input id="policy-num" type="text" autocomplete="off"
                data-parsley-required
                data-parsley-trigger="change"
                data-parsley-validation-threshold="7"
                data-parsley-required-message="Please enter a policy number."
                data-parsley-policy-type-check="(^[a-zA-Z]{4}[-]\d{1,5}$|^[a-zA-Z]{4}\d{6}[-]\d{2}$)"
                data-parsley-policy-type-check-message="Please enter a policy number that matches the format on your bill." />
                <input id="policy-type-redirect" type="submit" value="Go" class="btn btn-primary"/>
          </form>

          <div class="modal__img-group">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/WRC_modal_v3_06.gif" alt="" class="modal__img">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/WRC_modal_v3_03.gif" alt="" class="modal__img">
          </div>
