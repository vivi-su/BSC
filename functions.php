<?php
// Enqueue parent and child styles
function divi_child_enqueue_styles() {
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
}
add_action('wp_enqueue_scripts', 'divi_child_enqueue_styles');

add_action('wp_head', function () {
    if (is_front_page()) {
        ?>
        <!-- Preload desktop hero background -->
        <link rel="preload" as="image" href="https://christiancounsellingbc.ca/wp-content/uploads/2025/05/Hero-BG-Dr-Schulz-curtain_3.webp" imagesrcset="https://christiancounsellingbc.ca/wp-content/uploads/2025/05/Hero-BG-Dr-Schulz-curtain_3.webp 1200w" imagesizes="100vw">

        <!-- Preload mobile hero background -->
        <link rel="preload" as="image" href="https://christiancounsellingbc.ca/wp-content/uploads/2025/05/Hero-BG-Dr-Schulz-curtain-mobile1.jpg" media="(max-width: 768px)" imagesrcset="https://christiancounsellingbc.ca/wp-content/uploads/2025/05/Hero-BG-Dr-Schulz-curtain-mobile1.jpg 768w" imagesizes="100vw">
        <?php
    }
});

// automatically add width and height to lazyloaded images 
add_filter('wp_get_attachment_image_attributes', function($attr, $attachment) {
    if (!isset($attr['width']) || !isset($attr['height'])) {
        $image = wp_get_attachment_metadata($attachment->ID);
        if ($image && isset($image['width']) && isset($image['height'])) {
            $attr['width'] = $image['width'];
            $attr['height'] = $image['height'];
        }
    }
    return $attr;
}, 10, 2);


add_action('wp_enqueue_scripts', function() {
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

});
