# Modern Blog Enhancer

A WordPress plugin that enhances your blog with reading time calculator and social share buttons.

## Features

✨ **Reading Time Calculator**
- Automatically calculates and displays estimated reading time for blog posts
- Customizable position (before or after content)
- Beautiful gradient design with icon
- Shortcode support: `[reading_time]`

📱 **Social Share Buttons**
- Share posts on Facebook, Twitter, LinkedIn, and WhatsApp
- Modern, animated button design with hover effects
- Copy link functionality included
- Fully customizable platform selection
- Shortcode support: `[social_share]`

🎨 **Premium Design**
- Modern gradient styling
- Smooth animations and transitions
- Responsive design for all devices
- Dark mode support
- Accessible with ARIA labels

## Installation

### Method 1: Manual Installation (Current Setup)
1. The plugin is already created in `modern-blog-plugin` directory
2. Copy the `modern-blog-plugin` folder to your WordPress plugins directory:
   - Typically: `wp-content/plugins/`
3. Go to WordPress Admin → Plugins
4. Find "Modern Blog Enhancer" and click "Activate"

### Method 2: ZIP Installation
1. Compress the `modern-blog-plugin` folder into a ZIP file
2. Go to WordPress Admin → Plugins → Add New
3. Click "Upload Plugin"
4. Choose the ZIP file and click "Install Now"
5. Click "Activate Plugin"

## Configuration

After activation, configure the plugin:

1. Go to **Settings → Blog Enhancer** in WordPress admin
2. Configure Reading Time settings:
   - Enable/disable reading time display
   - Choose position (before or after content)
3. Configure Social Share settings:
   - Enable/disable social share buttons
   - Select which platforms to display

## Usage

### Automatic Display
Once enabled, the plugin automatically adds:
- Reading time indicator to single blog posts
- Social share buttons at the end of blog posts

### Shortcodes
Use these shortcodes anywhere in your content:

```
[reading_time]
```
Displays the reading time for the current post.

```
[social_share]
```
Displays social share buttons.

### Template Integration
Add to your theme templates:

```php
<?php
// Display reading time
echo do_shortcode('[reading_time]');

// Display social share buttons
echo do_shortcode('[social_share]');
?>
```

## File Structure

```
modern-blog-plugin/
├── modern-blog-enhancer.php      # Main plugin file
├── includes/
│   ├── class-plugin-core.php     # Core functionality
│   └── class-admin-settings.php  # Admin settings page
├── assets/
│   ├── css/
│   │   └── plugin-styles.css     # Plugin styles
│   └── js/
│       └── plugin-scripts.js     # Plugin scripts
└── README.md                      # This file
```

## Features in Detail

### Reading Time Calculator
- Calculates based on average reading speed (200 words/minute)
- Displays in a visually appealing gradient badge
- Includes clock icon for better UX
- Hover effect for interactivity

### Social Share Buttons
- **Facebook**: Share to Facebook timeline
- **Twitter**: Tweet with post title and link
- **LinkedIn**: Share to LinkedIn feed
- **WhatsApp**: Share via WhatsApp
- **Copy Link**: Copy post URL to clipboard (auto-added)

### Admin Settings
- Simple, user-friendly settings page
- Toggle features on/off
- Customize display options
- View available shortcodes

## Browser Support
- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Mobile browsers

## Requirements
- WordPress 5.0 or higher
- PHP 7.0 or higher
- jQuery (included with WordPress)

## Customization

### Custom Styling
Override plugin styles in your theme's CSS:

```css
.mbe-reading-time {
    /* Your custom styles */
}

.mbe-social-share {
    /* Your custom styles */
}
```

### Modify Reading Speed
Edit `class-plugin-core.php` line 45 to change the reading speed calculation:

```php
$reading_time = ceil($word_count / 200); // Change 200 to your preferred WPM
```

## Changelog

### Version 1.0.0
- Initial release
- Reading time calculator
- Social share buttons (Facebook, Twitter, LinkedIn, WhatsApp)
- Admin settings page
- Shortcode support
- Copy link functionality
- Responsive design
- Dark mode support

## Support

For issues or questions:
- GitHub: https://github.com/jenish77/modern-blog-wordpress-theme
- Create an issue in the repository

## License

GPL v2 or later

## Author

**Jenish**
- GitHub: [@jenish77](https://github.com/jenish77)

## Credits

- Icons: Feather Icons (embedded SVG)
- Inspired by modern web design trends
