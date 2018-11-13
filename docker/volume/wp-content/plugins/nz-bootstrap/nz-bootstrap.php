<?php

/**
 * Plugin Name: Nz-bootstrap
 * Version: 0.1-alpha
 * Description: PLUGIN DESCRIPTION HERE
 * Author: YOUR NAME HERE
 * Author URI: YOUR SITE HERE
 * Plugin URI: PLUGIN SITE HERE
 * Text Domain: nz-bootstrap
 * Domain Path: /languages
 * @package Nz-bootstrap
 */
include __DIR__ . '/includes/NzBootstrap.php';


function nz_bootstrap_init()
{

    $plugin = new NzBootstrap();
    $plugin->init();
}
nz_bootstrap_init();
