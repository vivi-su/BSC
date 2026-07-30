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

    $theme_dir = get_stylesheet_directory();
    $theme_uri = get_stylesheet_directory_uri();

    $styles = array(
        'vivi-variables'  => array(
            'path' => '/assets/css/base/variables.css',
            'deps' => array(),
        ),
        'vivi-reset' => array(
            'path' => '/assets/css/base/reset.css',
            'deps' => array('vivi-variables'),
        ),
        'vivi-typography' => array(
            'path' => '/assets/css/base/typography.css',
            'deps' => array('vivi-reset'),
        ),
        'vivi-buttons' => array(
            'path' => '/assets/css/components/buttons.css',
            'deps' => array('vivi-variables', 'vivi-typography'),
        ),
        'vivi-hero' => array(
            'path' => '/assets/css/components/hero.css',
            'deps' => array('vivi-variables', 'vivi-typography'),
        ),
        'vivi-faq' => array(
            'path' => '/assets/css/components/faq.css',
            'deps' => array('vivi-variables', 'vivi-typography'),
        ),
    );

    foreach ($styles as $handle => $style) {

        $file_path = $theme_dir . $style['path'];
        $file_url  = $theme_uri . $style['path'];

        if (file_exists($file_path)) {
            wp_enqueue_style(
                $handle,
                $file_url,
                $style['deps'],
                filemtime($file_path)
            );
        } else {
            error_log('Missing stylesheet: ' . $file_path);
        }
    }
}

add_action('wp_enqueue_scripts', 'vivi_enqueue_assets', 20);