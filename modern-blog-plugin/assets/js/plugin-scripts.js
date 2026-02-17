/**
 * Modern Blog Enhancer - Plugin Scripts
 */

(function($) {
    'use strict';
    
    $(document).ready(function() {
        
        // Add click tracking for social share buttons
        $('.mbe-share-btn').on('click', function(e) {
            var platform = '';
            
            if ($(this).hasClass('mbe-facebook')) {
                platform = 'Facebook';
            } else if ($(this).hasClass('mbe-twitter')) {
                platform = 'Twitter';
            } else if ($(this).hasClass('mbe-linkedin')) {
                platform = 'LinkedIn';
            } else if ($(this).hasClass('mbe-whatsapp')) {
                platform = 'WhatsApp';
            }
            
            // Log share event (you can integrate with analytics here)
            if (typeof console !== 'undefined') {
                console.log('Shared on ' + platform);
            }
            
            // Add animation feedback
            $(this).addClass('mbe-shared');
            setTimeout(function() {
                $('.mbe-share-btn').removeClass('mbe-shared');
            }, 1000);
        });
        
        // Add smooth scroll animation when reading time is clicked
        $('.mbe-reading-time').on('click', function() {
            $('html, body').animate({
                scrollTop: $('.entry-content, .post-content, article').offset().top - 100
            }, 500);
        });
        
        // Add copy link functionality (optional enhancement)
        addCopyLinkButton();
        
    });
    
    /**
     * Add a "Copy Link" button to social share section
     */
    function addCopyLinkButton() {
        if ($('.mbe-share-buttons').length) {
            var currentUrl = window.location.href;
            var copyBtn = $('<a href="#" class="mbe-share-btn mbe-copy-link" aria-label="Copy Link" title="Copy Link">' +
                '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">' +
                '<path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path>' +
                '<path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path>' +
                '</svg>' +
                '</a>');
            
            // Add gradient background for copy link button
            copyBtn.css({
                'background': 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)'
            });
            
            copyBtn.on('click', function(e) {
                e.preventDefault();
                
                // Copy to clipboard
                if (navigator.clipboard) {
                    navigator.clipboard.writeText(currentUrl).then(function() {
                        showCopyFeedback(copyBtn);
                    }).catch(function(err) {
                        console.error('Failed to copy: ', err);
                    });
                } else {
                    // Fallback for older browsers
                    var tempInput = $('<input>');
                    $('body').append(tempInput);
                    tempInput.val(currentUrl).select();
                    document.execCommand('copy');
                    tempInput.remove();
                    showCopyFeedback(copyBtn);
                }
            });
            
            $('.mbe-share-buttons').append(copyBtn);
        }
    }
    
    /**
     * Show feedback when link is copied
     */
    function showCopyFeedback(btn) {
        var originalTitle = btn.attr('title');
        btn.attr('title', 'Copied!');
        btn.addClass('mbe-copied');
        
        // Create a tooltip
        var tooltip = $('<span class="mbe-tooltip">Copied!</span>');
        tooltip.css({
            'position': 'absolute',
            'top': '-40px',
            'left': '50%',
            'transform': 'translateX(-50%)',
            'background': '#2ecc71',
            'color': '#fff',
            'padding': '6px 12px',
            'border-radius': '6px',
            'font-size': '12px',
            'white-space': 'nowrap',
            'z-index': '1000',
            'animation': 'mbe-fade-in-out 2s ease'
        });
        
        btn.css('position', 'relative').append(tooltip);
        
        setTimeout(function() {
            tooltip.fadeOut(300, function() {
                $(this).remove();
            });
            btn.removeClass('mbe-copied');
            btn.attr('title', originalTitle);
        }, 2000);
    }
    
    // Add CSS animation for tooltip
    if (!$('#mbe-dynamic-styles').length) {
        $('<style id="mbe-dynamic-styles">' +
            '@keyframes mbe-fade-in-out {' +
            '0% { opacity: 0; transform: translateX(-50%) translateY(5px); }' +
            '20% { opacity: 1; transform: translateX(-50%) translateY(0); }' +
            '80% { opacity: 1; transform: translateX(-50%) translateY(0); }' +
            '100% { opacity: 0; transform: translateX(-50%) translateY(-5px); }' +
            '}' +
            '.mbe-copied { animation: pulse 0.5s ease; }' +
            '@keyframes pulse {' +
            '0%, 100% { transform: scale(1); }' +
            '50% { transform: scale(1.1); }' +
            '}' +
            '</style>').appendTo('head');
    }
    
})(jQuery);
