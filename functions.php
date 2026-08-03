<?php

/* ==========================================================
   Parent Theme
========================================================== */

function divi_child_enqueue_styles() {

    wp_enqueue_style(
        'divi-parent-style',
        get_template_directory_uri() . '/style.css',
        array(),
        wp_get_theme(get_template())->get('Version')
    );

}
add_action('wp_enqueue_scripts', 'divi_child_enqueue_styles');


/* ==========================================================
   Google Fonts
========================================================== */

function vivi_enqueue_google_fonts() {

    wp_enqueue_style(
        'vivi-google-fonts',
        'https://fonts.googleapis.com/css2?family=Lora:wght@400;500;600&family=Poppins:wght@400;500;600;700&display=swap',
        array(),
        null
    );

}
add_action('wp_enqueue_scripts', 'vivi_enqueue_google_fonts');


/* ==========================================================
   Hero Image Preload
========================================================== */

add_action('wp_head', function () {

    if (!is_front_page()) {
        return;
    }

?>
<link
    rel="preload"
    as="image"
    href="https://christiancounsellingbc.ca/wp-content/uploads/2025/05/Hero-BG-Dr-Schulz-curtain_3.webp"
    type="image/webp">

<link
    rel="preload"
    as="image"
    href="https://christiancounsellingbc.ca/wp-content/uploads/2025/05/Hero-BG-Dr-Schulz-curtain-mobile1.jpg"
    type="image/jpeg"
    media="(max-width:768px)">

<?php

});


/* ==========================================================
   Child Theme Assets
========================================================== */


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
           'vivi-credentials-strip' => array(
            'path' => '/assets/css/sections/credentials-strip.css',
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