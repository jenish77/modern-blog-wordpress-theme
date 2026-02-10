<?php
/**
 * Plugin Name: Modern Blog Enhancer
 * Plugin URI: https://github.com/jenish77/modern-blog-wordpress-theme
 * Description: A simple plugin that adds reading time calculator and social share buttons to your blog posts.
 * Version: 1.0.0
 * Author: Jenish
 * Author URI: https://github.com/jenish77
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: modern-blog-enhancer
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Define plugin constants
define('MBE_VERSION', '1.0.0');
define('MBE_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('MBE_PLUGIN_URL', plugin_dir_url(__FILE__));

// Include required files
require_once MBE_PLUGIN_DIR . 'includes/class-plugin-core.php';
require_once MBE_PLUGIN_DIR . 'includes/class-admin-settings.php';

/**
 * Initialize the plugin
 */
function mbe_init() {
    $plugin_core = new MBE_Plugin_Core();
    $plugin_core->init();
    
    if (is_admin()) {
        $admin_settings = new MBE_Admin_Settings();
        $admin_settings->init();
    }
}
add_action('plugins_loaded', 'mbe_init');

/**
 * Activation hook
 */
function mbe_activate() {
    // Set default options
    $default_options = array(
        'enable_reading_time' => true,
        'enable_social_share' => true,
        'social_platforms' => array('facebook', 'twitter', 'linkedin', 'whatsapp'),
        'reading_time_position' => 'before_content'
    );
    
    add_option('mbe_settings', $default_options);
    
    flush_rewrite_rules();
}
register_activation_hook(__FILE__, 'mbe_activate');

/**
 * Deactivation hook
 */
function mbe_deactivate() {
    flush_rewrite_rules();
}
register_deactivation_hook(__FILE__, 'mbe_deactivate');

/**
 * Uninstall hook
 */
function mbe_uninstall() {
    delete_option('mbe_settings');
}
register_uninstall_hook(__FILE__, 'mbe_uninstall');
