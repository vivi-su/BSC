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


  /* ==========================================================
       Base CSS
    ========================================================== */

$styles = array(
    'vivi-variables' => array(
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

    /* ==========================================================
       Layout
    ========================================================== */
    'vivi-container' => array(
    'path' => '/assets/css/layout/container.css',
    'deps' => array('vivi-variables'),
    ),

    /* ==========================================================
       Shared Sections / Components
    ========================================================== */

    'vivi-buttons' => array(
        'path' => '/assets/css/components/buttons.css',
        'deps' => array('vivi-variables', 'vivi-typography'),
    ),

    'vivi-hero' => array(
        'path' => '/assets/css/sections/hero.css',
        'deps' => array('vivi-variables', 'vivi-typography'),
    ),
    

    'vivi-credentials-strip' => array(
        'path' => '/assets/css/sections/credentials-strip.css',
        'deps' => array('vivi-variables', 'vivi-typography'),
    ),

    'vivi-services' => array(
        'path' => '/assets/css/sections/services.css',
        'deps' => array('vivi-variables', 'vivi-typography'),
    ),
    
    'vivi-cta' => array(
    'path' => '/assets/css/sections/cta.css',
    'deps' => array(
        'vivi-variables',
        'vivi-typography',
        'vivi-buttons',
    ),
    ),
    'vivi-testimonials' => array(
        'path' => '/assets/css/sections/testimonials.css',
        'deps' => array('vivi-variables', 'vivi-typography'),
    ),

    'vivi-insurance' => array(
        'path' => '/assets/css/sections/insurance.css',
        'deps' => array('vivi-variables', 'vivi-typography'),
    ),

    'vivi-faq' => array(
        'path' => '/assets/css/sections/faq.css',
        'deps' => array('vivi-variables', 'vivi-typography'),
    ),
);


    /* ==========================================================
       Enqueue Shared Styles
    ========================================================== */

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


/* ==========================================================
   Page-Specific CSS
========================================================== */

/* About Page */
if (is_page('about-me')) {

    wp_enqueue_style(
        'vivi-about',
        $theme_uri . '/assets/css/pages/about.css',
        array(
            'vivi-variables',
            'vivi-reset',
            'vivi-typography',
            'vivi-container'
        ),
        filemtime(
            $theme_dir . '/assets/css/pages/about.css'
        )
    );
}


/* Single Blog Posts */
if (is_single()) {

    wp_enqueue_style(
        'vivi-article',
        $theme_uri . '/assets/css/pages/article.css',
        array(
            'vivi-variables',
            'vivi-reset',
            'vivi-typography',
            'vivi-container'
        ),
        filemtime(
            $theme_dir . '/assets/css/pages/article.css'
        )
    );

    wp_enqueue_script(
        'vivi-article',
        $theme_uri . '/assets/js/article.js',
        array(),
        filemtime(
            $theme_dir . '/assets/js/article.js'
        ),
        true
    );
}

}

add_action('wp_enqueue_scripts', 'vivi_enqueue_assets', 20);