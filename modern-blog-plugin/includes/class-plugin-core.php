<?php
/**
 * Core Plugin Functionality
 */

class MBE_Plugin_Core {
    
    /**
     * Initialize the plugin
     */
    public function init() {
        // Enqueue scripts and styles
        add_action('wp_enqueue_scripts', array($this, 'enqueue_assets'));
        
        // Add reading time to content
        add_filter('the_content', array($this, 'add_reading_time'));
        
        // Add social share buttons to content
        add_filter('the_content', array($this, 'add_social_share_buttons'));
        
        // Add shortcodes
        add_shortcode('reading_time', array($this, 'reading_time_shortcode'));
        add_shortcode('social_share', array($this, 'social_share_shortcode'));
    }
    
    /**
     * Enqueue plugin assets
     */
    public function enqueue_assets() {
        wp_enqueue_style(
            'mbe-styles',
            MBE_PLUGIN_URL . 'assets/css/plugin-styles.css',
            array(),
            MBE_VERSION
        );
        
        wp_enqueue_script(
            'mbe-scripts',
            MBE_PLUGIN_URL . 'assets/js/plugin-scripts.js',
            array('jquery'),
            MBE_VERSION,
            true
        );
    }
    
    /**
     * Calculate reading time for a post
     */
    public function calculate_reading_time($content) {
        $word_count = str_word_count(strip_tags($content));
        $reading_time = ceil($word_count / 200); // Average reading speed: 200 words per minute
        
        return $reading_time;
    }
    
    /**
     * Add reading time to content
     */
    public function add_reading_time($content) {
        if (!is_single() || !is_main_query()) {
            return $content;
        }
        
        $settings = get_option('mbe_settings');
        
        if (empty($settings['enable_reading_time'])) {
            return $content;
        }
        
        $reading_time = $this->calculate_reading_time($content);
        $reading_time_html = $this->get_reading_time_html($reading_time);
        
        if ($settings['reading_time_position'] === 'before_content') {
            return $reading_time_html . $content;
        } else {
            return $content . $reading_time_html;
        }
    }
    
    /**
     * Get reading time HTML
     */
    private function get_reading_time_html($minutes) {
        $text = $minutes == 1 ? 'minute' : 'minutes';
        
        return sprintf(
            '<div class="mbe-reading-time">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <polyline points="12 6 12 12 16 14"></polyline>
                </svg>
                <span>%d %s read</span>
            </div>',
            $minutes,
            $text
        );
    }
    
    /**
     * Add social share buttons to content
     */
    public function add_social_share_buttons($content) {
        if (!is_single() || !is_main_query()) {
            return $content;
        }
        
        $settings = get_option('mbe_settings');
        
        if (empty($settings['enable_social_share'])) {
            return $content;
        }
        
        $share_buttons = $this->get_social_share_html();
        
        return $content . $share_buttons;
    }
    
    /**
     * Get social share buttons HTML
     */
    private function get_social_share_html() {
        $settings = get_option('mbe_settings');
        $platforms = isset($settings['social_platforms']) ? $settings['social_platforms'] : array();
        
        $post_url = urlencode(get_permalink());
        $post_title = urlencode(get_the_title());
        
        $html = '<div class="mbe-social-share">
            <h4>Share this post:</h4>
            <div class="mbe-share-buttons">';
        
        if (in_array('facebook', $platforms)) {
            $html .= sprintf(
                '<a href="https://www.facebook.com/sharer/sharer.php?u=%s" target="_blank" rel="noopener" class="mbe-share-btn mbe-facebook" aria-label="Share on Facebook">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                    </svg>
                </a>',
                $post_url
            );
        }
        
        if (in_array('twitter', $platforms)) {
            $html .= sprintf(
                '<a href="https://twitter.com/intent/tweet?url=%s&text=%s" target="_blank" rel="noopener" class="mbe-share-btn mbe-twitter" aria-label="Share on Twitter">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                    </svg>
                </a>',
                $post_url,
                $post_title
            );
        }
        
        if (in_array('linkedin', $platforms)) {
            $html .= sprintf(
                '<a href="https://www.linkedin.com/shareArticle?mini=true&url=%s&title=%s" target="_blank" rel="noopener" class="mbe-share-btn mbe-linkedin" aria-label="Share on LinkedIn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                    </svg>
                </a>',
                $post_url,
                $post_title
            );
        }
        
        if (in_array('whatsapp', $platforms)) {
            $html .= sprintf(
                '<a href="https://wa.me/?text=%s%%20%s" target="_blank" rel="noopener" class="mbe-share-btn mbe-whatsapp" aria-label="Share on WhatsApp">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                    </svg>
                </a>',
                $post_title,
                $post_url
            );
        }
        
        $html .= '</div></div>';
        
        return $html;
    }
    
    /**
     * Reading time shortcode
     */
    public function reading_time_shortcode($atts) {
        global $post;
        
        if (!$post) {
            return '';
        }
        
        $reading_time = $this->calculate_reading_time($post->post_content);
        return $this->get_reading_time_html($reading_time);
    }
    
    /**
     * Social share shortcode
     */
    public function social_share_shortcode($atts) {
        return $this->get_social_share_html();
    }
}
