<?php

/**
 * Plugin Name: Nzgallery
 * Version: 0.1-alpha
 * Description: PLUGIN DESCRIPTION HERE
 * Author: YOUR NAME HERE
 * Author URI: YOUR SITE HERE
 * Plugin URI: PLUGIN SITE HERE
 * Text Domain: nzgallery
 * Domain Path: /languages
 * @package Nzgallery
 */
class NzGallery
{

    const NAME = 'nzgallery';
    const VERSION = '0.0.1';
    const TPL_NAME = 'nzgallery_tpl.php';

    public function __construct()
    {

        $this->requireDeps();

        add_action('init', array($this, 'init'));

        add_shortcode(self::NAME, array($this, 'shortcode'));
    }

    public function requireDeps()
    {
        include_once __DIR__ . '/inc/model.php';
    }

    public function init()
    {
        NzGalleryModel::init();
    }

    public function getGallery($params)
    {
        if (!isset($params['name'])) {
            return;
        }
        $name = $params['name'];

        /* $term = get_term_by('slug', $name, NzGalleryModel::TAXONOMY); */
        $query = new WP_Query(
            array(
            'post_type' => NzGalleryModel::POST_TYPE,
            'posts_per_page' => '6',
            'tax_query' => array(
                array(
                    'taxonomy' => NzGalleryModel::TAXONOMY,
                    'field' => 'slug',
                    'terms' => $name
                ),
            ),
            )
        );

        return $query;
    }

    public function shortcode($name)
    {
        $query = $this->getGallery($name);

        //include theme folder gallery tpl or plugin folder default tpl
        $tpl = locate_template(array(self::TPL_NAME));
        include $tpl ? $tpl : plugin_dir_path(__FILE__) . self::TPL_NAME;

        return;

        ob_start();
        if (!$l) {

            include plugin_dir_path(__FILE__) . "nz-contact-me-form.php";
        } else {

            include $l;
        }

        $output = ob_get_clean();

        return $output;
    }
}

new NzGallery();
