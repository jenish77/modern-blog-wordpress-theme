<?php
/**
 * Admin Settings Page
 */

class MBE_Admin_Settings {
    
    /**
     * Initialize admin settings
     */
    public function init() {
        add_action('admin_menu', array($this, 'add_settings_page'));
        add_action('admin_init', array($this, 'register_settings'));
    }
    
    /**
     * Add settings page to WordPress admin menu
     */
    public function add_settings_page() {
        add_options_page(
            'Modern Blog Enhancer Settings',
            'Blog Enhancer',
            'manage_options',
            'modern-blog-enhancer',
            array($this, 'render_settings_page')
        );
    }
    
    /**
     * Register plugin settings
     */
    public function register_settings() {
        register_setting('mbe_settings_group', 'mbe_settings', array($this, 'sanitize_settings'));
        
        // Reading Time Section
        add_settings_section(
            'mbe_reading_time_section',
            'Reading Time Settings',
            array($this, 'reading_time_section_callback'),
            'modern-blog-enhancer'
        );
        
        add_settings_field(
            'enable_reading_time',
            'Enable Reading Time',
            array($this, 'enable_reading_time_callback'),
            'modern-blog-enhancer',
            'mbe_reading_time_section'
        );
        
        add_settings_field(
            'reading_time_position',
            'Reading Time Position',
            array($this, 'reading_time_position_callback'),
            'modern-blog-enhancer',
            'mbe_reading_time_section'
        );
        
        // Social Share Section
        add_settings_section(
            'mbe_social_share_section',
            'Social Share Settings',
            array($this, 'social_share_section_callback'),
            'modern-blog-enhancer'
        );
        
        add_settings_field(
            'enable_social_share',
            'Enable Social Share',
            array($this, 'enable_social_share_callback'),
            'modern-blog-enhancer',
            'mbe_social_share_section'
        );
        
        add_settings_field(
            'social_platforms',
            'Social Platforms',
            array($this, 'social_platforms_callback'),
            'modern-blog-enhancer',
            'mbe_social_share_section'
        );
    }
    
    /**
     * Sanitize settings
     */
    public function sanitize_settings($input) {
        $sanitized = array();
        
        $sanitized['enable_reading_time'] = isset($input['enable_reading_time']) ? true : false;
        $sanitized['enable_social_share'] = isset($input['enable_social_share']) ? true : false;
        $sanitized['reading_time_position'] = sanitize_text_field($input['reading_time_position']);
        
        if (isset($input['social_platforms']) && is_array($input['social_platforms'])) {
            $sanitized['social_platforms'] = array_map('sanitize_text_field', $input['social_platforms']);
        } else {
            $sanitized['social_platforms'] = array();
        }
        
        return $sanitized;
    }
    
    /**
     * Render settings page
     */
    public function render_settings_page() {
        ?>
        <div class="wrap">
            <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
            <form action="options.php" method="post">
                <?php
                settings_fields('mbe_settings_group');
                do_settings_sections('modern-blog-enhancer');
                submit_button('Save Settings');
                ?>
            </form>
            
            <div class="mbe-shortcode-info" style="margin-top: 30px; padding: 20px; background: #f0f0f1; border-left: 4px solid #2271b1;">
                <h2>Available Shortcodes</h2>
                <p><strong>[reading_time]</strong> - Display reading time anywhere in your content</p>
                <p><strong>[social_share]</strong> - Display social share buttons anywhere in your content</p>
            </div>
        </div>
        <?php
    }
    
    /**
     * Section callbacks
     */
    public function reading_time_section_callback() {
        echo '<p>Configure reading time display settings.</p>';
    }
    
    public function social_share_section_callback() {
        echo '<p>Configure social sharing settings.</p>';
    }
    
    /**
     * Field callbacks
     */
    public function enable_reading_time_callback() {
        $settings = get_option('mbe_settings');
        $checked = isset($settings['enable_reading_time']) && $settings['enable_reading_time'] ? 'checked' : '';
        ?>
        <label>
            <input type="checkbox" name="mbe_settings[enable_reading_time]" value="1" <?php echo $checked; ?>>
            Show reading time on blog posts
        </label>
        <?php
    }
    
    public function reading_time_position_callback() {
        $settings = get_option('mbe_settings');
        $position = isset($settings['reading_time_position']) ? $settings['reading_time_position'] : 'before_content';
        ?>
        <select name="mbe_settings[reading_time_position]">
            <option value="before_content" <?php selected($position, 'before_content'); ?>>Before Content</option>
            <option value="after_content" <?php selected($position, 'after_content'); ?>>After Content</option>
        </select>
        <?php
    }
    
    public function enable_social_share_callback() {
        $settings = get_option('mbe_settings');
        $checked = isset($settings['enable_social_share']) && $settings['enable_social_share'] ? 'checked' : '';
        ?>
        <label>
            <input type="checkbox" name="mbe_settings[enable_social_share]" value="1" <?php echo $checked; ?>>
            Show social share buttons on blog posts
        </label>
        <?php
    }
    
    public function social_platforms_callback() {
        $settings = get_option('mbe_settings');
        $platforms = isset($settings['social_platforms']) ? $settings['social_platforms'] : array();
        
        $available_platforms = array(
            'facebook' => 'Facebook',
            'twitter' => 'Twitter',
            'linkedin' => 'LinkedIn',
            'whatsapp' => 'WhatsApp'
        );
        
        foreach ($available_platforms as $key => $label) {
            $checked = in_array($key, $platforms) ? 'checked' : '';
            ?>
            <label style="display: block; margin-bottom: 5px;">
                <input type="checkbox" name="mbe_settings[social_platforms][]" value="<?php echo esc_attr($key); ?>" <?php echo $checked; ?>>
                <?php echo esc_html($label); ?>
            </label>
            <?php
        }
    }
}
