<?php
/**
 * Theme License Manager
 *
 * @package Theme License
 */
namespace Theme\License;

/**
 * Class Theme License Manager
 */
class Theme_License_Manager {
    /**
     * Initialize
     *
     * @return void
     */
    public function run( $store_url, $product_id ) {
        $this->includes();
        $this->define_constants( $store_url, $product_id );
        $this->init_hooks();

    }

    /**
     * Get instance
     *
     * @return  Object
     */
    public static function instance() {
        static $instance = false;

        if ( ! $instance ) {
            $instance = new Theme_License_Manager();
        }

        return $instance;
    }

    /**
     * Init hooks
     *
     * @return  void
     */
    public function init_hooks() {
        add_action( 'admin_init', [$this, 'updater'] );
    }

    /**
     * Includes require file
     *
     * @return  void
     */
    public function includes() {
        require_once dirname( __FILE__ ) . '/includes/admin.php';
        require_once dirname( __FILE__ ) . '/includes/license-activator.php';
        require_once dirname( __FILE__ ) . '/includes/license-functions.php';
        require_once dirname( __FILE__ ) . '/updater/edd-theme-updater.php';
    }

    /**
     * Define constants
     *
     * @param   string  $store_url   EDD store url
     * @param   integer $product_id  EDD Product ID
     *
     * @return  void
     */
    public function define_constants( $store_url, $product_id ) {
        define( 'THEME_LICENSE_STROE', $store_url );
        define( 'THEME_LICENSE_PRODUCT', $product_id );
    }

    public function updater() {

        if ( ! theme_is_valid_license() ) {
            return;
        }

        $theme = wp_get_theme();

        // Config.
        $config = array(
            'item_name'      => $theme->get('Name'),
            'author'         => $theme->get('Author'),
            'version'        => $theme->get('Version'),
            'license'        => trim( theme_get_license_key() ),
            'remote_api_url' => THEME_LICENSE_STROE,
            'item_id'        => THEME_LICENSE_PRODUCT,
        );
        
        // Strings.
        $strings = array(
            'theme-license'             => __( 'Theme License', 'instive' ),
            'enter-key'                 => __( 'Enter your theme license key.', 'instive' ),
            'license-key'               => __( 'License Key', 'instive' ),
            'license-action'            => __( 'License Action', 'instive' ),
            'deactivate-license'        => __( 'Deactivate License', 'instive' ),
            'activate-license'          => __( 'Activate License', 'instive' ),
            'status-unknown'            => __( 'License status is unknown.', 'instive' ),
            'renew'                     => __( 'Renew?', 'instive' ),
            'unlimited'                 => __( 'unlimited', 'instive' ),
            'license-key-is-active'     => __( 'License key is active.', 'instive' ),
            'expires%s'                 => __( 'Expires %s.', 'instive' ),
            '%1$s/%2$-sites'            => __( 'You have %1$s / %2$s sites activated.', 'instive' ),
            'license-key-expired-%s'    => __( 'License key expired %s.', 'instive' ),
            'license-key-expired'       => __( 'License key has expired.', 'instive' ),
            'license-keys-do-not-match' => __( 'License keys do not match.', 'instive' ),
            'license-is-inactive'       => __( 'License is inactive.', 'instive' ),
            'license-key-is-disabled'   => __( 'License key is disabled.', 'instive' ),
            'site-is-inactive'          => __( 'Site is inactive.', 'instive' ),
            'license-status-unknown'    => __( 'License status is unknown.', 'instive' ),
            'update-notice'             => __( "Updating this theme will lose any customizations you have made. 'Cancel' to stop, 'OK' to update.", 'instive' ),
            'update-available'          => __( '<strong>%1$s %2$s</strong> is available. <a href="%3$s" class="thickbox" title="%4s">Check out what\'s new</a> or <a href="%5$s"%6$s>update now</a>.', 'instive' ),
        );

        new EDD_Theme_Updater( $config, $strings );
    }
}