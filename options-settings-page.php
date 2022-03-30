<?php
   //register settings
   function theme_options_add(){
       register_setting( 'theme_settings', 'theme_settings' );
   }
    
   //add settings page to menu
   function add_options() {
      add_menu_page( __( 'Theme Options' ), __( 'Theme Options' ), 'manage_options', 'settings', 'theme_options_page');
   }
   //add actions
   add_action( 'admin_init', 'theme_options_add' );
   add_action( 'admin_menu', 'add_options' );
    
   //start settings page
   function theme_options_page() {
    
   if ( ! isset( $_REQUEST['updated'] ) )
   $_REQUEST['updated'] = false;
    
   //get variables outside scope
   global $color_scheme;
   ?>
<div>
   <form method="post" action="options.php">
      <h2>Theme Options</h2>
      <?php settings_fields( 'theme_settings' ); ?>
      <?php $options = get_option( 'theme_settings' ); ?>
      <table>
         <tr valign="top">
            <th scope="row"><?php _e( 'Leaderboard Ad' ); ?></th>
            <td><label for="theme_settings[leadad728]"><?php _e( 'Enter your advertisement code' ); ?></label>
               <br />
               <textarea id="theme_settings[leadad728]" name="theme_settings[leadad728]" rows="5" cols="36"><?php esc_attr_e( $options['leadad728'] ); ?></textarea>
            </td>
         </tr>
         <tr valign="top">
            <th scope="row"><?php _e( 'Tracking Code' ); ?></th>
            <td><label for="theme_settings[tracking]"><?php _e( 'Enter your analytics tracking code' ); ?></label>
               <br />
               <textarea id="theme_settings[tracking]" name="theme_settings[tracking]" rows="5" cols="36"><?php esc_attr_e( $options['tracking'] ); ?></textarea>
            </td>
         </tr>
         <tr valign="top">
            <th scope="row"><?php _e( 'Custom Logo' ); ?></th>
            <td><input id="theme_settings[custom_logo]" type="text" size="36" name="theme_settings[custom_logo]" value="<?php esc_attr_e( $options['custom_logo'] ); ?>" />
               <label for="theme_settings[custom_logo]"><?php _e( 'Enter the URL to your custom logo' ); ?></label>
            </td>
         </tr>
         <tr valign="top">
            <th scope="row"><?php _e( 'Twitter URL' ); ?></th>
            <td><input id="theme_settings[twitterurl]" type="text" size="36" name="theme_settings[twitterurl]" value="<?php esc_attr_e ($options['twitterurl'] ); ?>" />
               <label for="theme_settings[twitterurl]"><?php _e( 'Enter Twitter URL' ); ?></label> 
            </td>
         </tr>
      </table>
      <p><input name="submit" id="submit" value="Save Changes" type="submit"></p>
   </form>
</div>
<!-- END wrap -->
<?php } ?>
