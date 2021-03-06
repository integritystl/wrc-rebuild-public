<?php
/**
 * Post ID Widget
 *
 * Post ID widget class file.
 *
 * @since 	1.1.7
 * @package search-wsal
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


if ( ! class_exists( 'WSAL_AS_Filters_PostIDWidget' ) ) :

	/**
	 * WSAL_AS_Filters_PostIDWidget.
	 *
	 * Class: Post ID Widget.
	 *
	 * @since 1.1.7
	 */
	class WSAL_AS_Filters_PostIDWidget extends WSAL_AS_Filters_AbstractWidget {

		/**
		 * Method: Function to render field.
		 *
		 * @since 1.1.7
		 */
		protected function RenderField() {
			?>
			<input type="text"
				class="<?php echo esc_attr( $this->GetSafeName() ); ?>"
				id="<?php echo esc_attr( $this->id ); ?>"
				data-prefix="<?php echo esc_attr( $this->prefix ); ?>"
			/>
			<span id="<?php echo esc_attr( "wsal-add-$this->prefix-filter" ); ?>" class="wsal-add-button dashicons-before dashicons-plus"></span>
			<?php
		}

		/**
		 * Method: Render JS in footer regarding this widget.
		 *
		 * @since 1.1.7
		 */
		public function StaFooter() {
			?>
			<script type="text/javascript">
				jQuery( '<?php echo esc_attr( "#wsal-add-$this->prefix-filter" ); ?>' ).click( function( event ) {
			    	event.preventDefault();
			    	var post_id_input = jQuery( 'input.<?php echo esc_attr( $this->GetSafeName() ); ?>' );
			    	var post_id = post_id_input.val();
			    	if ( post_id.length == 0 ) return;
			    	var post_id_filter_value = post_id_input.attr( 'data-prefix' ) + ':' + post_id;
			    	window.WsalAs.AddFilter( post_id_filter_value );
			    } );
			</script>
			<?php
		}

	}

endif;
