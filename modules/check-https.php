<?php
/**
* Plugin name: Seravo Check HTTPS
* Description: Checks that the WordPress siteurl begins with https:// so WordPress can
* be served over HTTPS. Displays an error message on the dashboard page if https is
* not enabled.
*/

namespace Seravo;

if (! class_exists('CheckHttps')) {
    class CheckHttps {

        public static function load() {
            add_action('admin_notices', array(__CLASS__, '_seravo_check_https'));
        }

        public static function _seravo_check_https() {
            // Get the siteurl and home url and check if https is enabled, if not, show warning
            $siteurl = get_option('siteurl');
            $home = get_option('home');
            if (strpos($siteurl, 'https') !== 0 || strpos($home, 'https') !== 0) {
                self::_seravo_show_https_warning();
            }
        }

        public static  function _seravo_show_https_warning() {
            ?><div class="notice notice-error"><p>
            <?php _e('Error with HTTPS protocol. Check <a href="https://make.wordpress.org/support/user-manual/web-publishing/https-for-wordpress/">here</a> for more information.', 'seravo'); ?>
            </p>
        </div>
        <?php }
    }
    CheckHttps::load();
}
