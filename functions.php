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
        <link rel="preload" as="image" href="https://christiancounsellingbc.ca/wp-content/uploads/2025/05/Hero-BG-Dr-Schulz-curtain_3.webp" type="image/webp">

        <!-- Preload mobile hero background -->
        <link rel="preload" as="image" href="https://christiancounsellingbc.ca/wp-content/uploads/2025/05/Hero-BG-Dr-Schulz-curtain-mobile1.jpg" type="image/jpeg" media="(max-width: 768px)">
        <?php
    }
});


add_action('wp_enqueue_scripts', function() {
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Poppins:wght@400&family=Lora:wght@400;600&display=swap');
});


function vivi_enqueue_assets() {

    // Base
    wp_enqueue_style(
        'typography',
        get_stylesheet_directory_uri() . '/assets/css/base/typography.css'
    );

    wp_enqueue_style(
        'global',
        get_stylesheet_directory_uri() . '/assets/css/base/global.css'
    ); // not used yet

    // Components
    wp_enqueue_style(
        'hero',
        get_stylesheet_directory_uri() . '/assets/css/components/hero.css'
    ); // not used yet

    wp_enqueue_style(
        'buttons',
        get_stylesheet_directory_uri() . '/assets/css/components/buttons.css'
    ); // not used yet

    wp_enqueue_style(
        'faq',
        get_stylesheet_directory_uri() . '/assets/css/components/faq.css'
    ); // not used yet

}
add_action('wp_enqueue_scripts', 'vivi_enqueue_assets');