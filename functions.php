<?php
// Enqueue parent and child styles
function divi_child_enqueue_styles() {
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
}
add_action('wp_enqueue_scripts', 'divi_child_enqueue_styles');

// Add preconnect, preload fonts, and lazy-load stylesheet
add_action('wp_head', function () {
    // Preconnect to font domains
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . PHP_EOL;
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . PHP_EOL;

    // Preload font files (optional, for extra performance boost)
    echo '<link rel="preload" href="https://fonts.gstatic.com/s/poppins/v20/pxiEyp8kv8JHgFVrJJfedw.woff2" as="font" type="font/woff2" crossorigin>' . PHP_EOL; // 400
    echo '<link rel="preload" href="https://fonts.gstatic.com/s/poppins/v20/pxiByp8kv8JHgFVrLDz8Z11lFc-K.woff2" as="font" type="font/woff2" crossorigin>' . PHP_EOL; // 600

    // Lazy-load Google Fonts CSS
    echo '<link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" onload="this.onload=null;this.rel=\'stylesheet\'">' . PHP_EOL;
    echo '<noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap"></noscript>' . PHP_EOL;
});


// add_action('wp_footer', function() {
//     echo '<p style="text-align:center; color:red;">Child theme is active!</p>';
// });