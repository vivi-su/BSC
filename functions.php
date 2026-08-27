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
        media="(max-width: 768px)">
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
            'deps' => array('divi-parent-style'),
        ),

        'vivi-reset' => array(
            'path' => '/assets/css/base/reset.css',
            'deps' => array(
                'vivi-variables',
            ),
        ),

        'vivi-typography' => array(
            'path' => '/assets/css/base/typography.css',
            'deps' => array(
                'vivi-reset',
            ),
        ),


        /* ==========================================================
           Layout
        ========================================================== */

        'vivi-container' => array(
            'path' => '/assets/css/layout/container.css',
            'deps' => array(
                'vivi-variables',
            ),
        ),


        /* ==========================================================
           Shared Components
        ========================================================== */

        'vivi-buttons' => array(
            'path' => '/assets/css/components/buttons.css',
            'deps' => array(
                'vivi-variables',
                'vivi-typography',
            ),
        ),

        'vivi-toc' => array(
            'path' => '/assets/css/components/toc.css',
            'deps' => array(
                'vivi-variables',
                'vivi-typography',
            ),
        ),


        'vivi-nav' => array(
            'path' => '/assets/css/components/nav.css',
            'deps' => array(
                'vivi-variables',
                'vivi-typography',
            ),
        ),


        /* ==========================================================
           Shared Page Systems
        ========================================================== */

        /*
         * Individual counselling service pages.
         * Loaded globally so new service pages do not require
         * another functions.php update. All selectors are scoped
         * under .service-single.
         */
        'vivi-service-single' => array(
            'path' => '/assets/css/pages/service-single-page.css',
            'deps' => array(
                'vivi-variables',
                'vivi-reset',
                'vivi-typography',
                'vivi-container',
                'vivi-buttons',
                'vivi-toc',
            ),
        ),


        /* ==========================================================
           Shared Sections
        ========================================================== */

        'vivi-hero' => array(
            'path' => '/assets/css/sections/hero.css',
            'deps' => array(
                'vivi-variables',
                'vivi-typography',
            ),
        ),

        'vivi-credentials-strip' => array(
            'path' => '/assets/css/sections/credentials-strip.css',
            'deps' => array(
                'vivi-variables',
                'vivi-typography',
            ),
        ),

        'vivi-services' => array(
            'path' => '/assets/css/sections/services.css',
            'deps' => array(
                'vivi-variables',
                'vivi-typography',
            ),
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
            'deps' => array(
                'vivi-variables',
                'vivi-typography',
            ),
        ),

        'vivi-insurance' => array(
            'path' => '/assets/css/sections/insurance.css',
            'deps' => array(
                'vivi-variables',
                'vivi-typography',
            ),
        ),

        'vivi-faq' => array(
            'path' => '/assets/css/sections/faq.css',
            'deps' => array(
                'vivi-variables',
                'vivi-typography',
            ),
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
       Shared TOC Script
    ========================================================== */

    $toc_js_path = $theme_dir . '/assets/js/toc.js';

    if (file_exists($toc_js_path)) {

        wp_enqueue_script(
            'vivi-toc-js',
            $theme_uri . '/assets/js/toc.js',
            array(),
            filemtime($toc_js_path),
            true
        );
    }


    /* ==========================================================
       Page-Specific CSS
    ========================================================== */

    /* About Page */
    if (is_page('about-me')) {

        $about_css_path = $theme_dir . '/assets/css/pages/about.css';

        if (file_exists($about_css_path)) {

            wp_enqueue_style(
                'vivi-about',
                $theme_uri . '/assets/css/pages/about.css',
                array(
                    'vivi-variables',
                    'vivi-reset',
                    'vivi-typography',
                    'vivi-container',
                ),
                filemtime($about_css_path)
            );
        }
    }


    /* ==========================================================
        Contact Page
    ========================================================== */

if (is_page('contact-us')) {

    /* Contact Page CSS */
    $contact_css_path = $theme_dir . '/assets/css/pages/contact.css';

    if (file_exists($contact_css_path)) {

        wp_enqueue_style(
            'vivi-contact',
            $theme_uri . '/assets/css/pages/contact.css',
            array(
                'vivi-variables',
                'vivi-reset',
                'vivi-typography',
                'vivi-container',
                'vivi-buttons',
            ),
            filemtime($contact_css_path)
        );
    }


    /* Contact Page JavaScript */
    $contact_js_path = $theme_dir . '/assets/js/contact.js';

    if (file_exists($contact_js_path)) {

        wp_enqueue_script(
            'vivi-contact-js',
            $theme_uri . '/assets/js/contact.js',
            array(),
            filemtime($contact_js_path),
            true
        );
    }
}


    /* ==========================================================
       Single Blog Posts
    ========================================================== */

    if (is_single()) {

        $article_css_path = $theme_dir . '/assets/css/pages/article.css';

        if (file_exists($article_css_path)) {

            wp_enqueue_style(
                'vivi-article',
                $theme_uri . '/assets/css/pages/article.css',
                array(
                    'vivi-variables',
                    'vivi-reset',
                    'vivi-typography',
                    'vivi-container',
                    'vivi-toc',
                ),
                filemtime($article_css_path)
            );
        }
    }

}

add_action('wp_enqueue_scripts', 'vivi_enqueue_assets', 20);


/* ==========================================================
   BSC Article Meta — Show Updated Date
========================================================== */

function bsc_last_modified_date($the_date) {

    if ('post' === get_post_type() && !is_admin()) {

        $published_time = get_post_time('U');
        $modified_time  = get_post_modified_time('U');

        /*
         * If the post has been modified after publication,
         * show "Updated" + modified date.
         * Otherwise show the original publication date.
         */
        if ($modified_time > $published_time) {

            return 'Updated ' . get_post_modified_time('M j, Y');
        }

        return get_post_time('M j, Y');
    }

    return $the_date;
}

add_filter('get_the_date', 'bsc_last_modified_date');
add_filter('get_the_time', 'bsc_last_modified_date');