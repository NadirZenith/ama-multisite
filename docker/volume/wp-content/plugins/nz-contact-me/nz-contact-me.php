<?php
/**
 * Plugin Name: Nz-contact-me
 * Version: 0.1-alpha
 * Description: PLUGIN DESCRIPTION HERE
 * Author: YOUR NAME HERE
 * Author URI: YOUR SITE HERE
 * Plugin URI: PLUGIN SITE HERE
 * Text Domain: nz-contact-me
 * Domain Path: /languages
 * @package Nz-contact-me
 */
class NzContactMe
{

    protected $version = '1.0';
    protected $name = 'nz-contact-me';

    public function __construct()
    {
        $this->loadDependencies();

        $admin = new NzContactMeAdmin();
        add_action('admin_menu', array($admin, 'create_menu'));
        add_action('admin_init', array($admin, 'settings_api_init'));

        /* $this->add('action', $obect, 'method'); */
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
        add_action('parse_request', array($this, 'parse_form_submission'));
        add_action('plugins_loaded', array($this, 'loadTextDomain'));
        add_shortcode('nz-contact-me', array($this, 'shortcode'));
    }

    function loadTextDomain()
    {
        load_plugin_textdomain($this->name, false, plugin_basename(dirname(__FILE__)) . '/languages');
    }

    function loadDependencies()
    {
        include __DIR__ . '/admin/NzContactMeAdmin.php';
    }

    function shortcode($atts)
    {
        $templates = [
            'nz-contact-me-form.php',
            /* plugin_dir_path(__FILE__) . "nz-contact-me-form.php" */
        ];
        $l = locate_template($templates);

        ob_start();
        if (!$l) {

            include plugin_dir_path(__FILE__) . "nz-contact-me-form.php";
        } else {

            include $l;
        }

        $output = ob_get_clean();

        return $output;
    }

    function enqueue_scripts()
    {
        wp_enqueue_script($this->name . '-validation', plugin_dir_url(__FILE__) . 'public/js/jqBootstrapValidation.js', array('jquery'), $this->version, false);
        wp_enqueue_script($this->name, plugin_dir_url(__FILE__) . 'public/js/contact_me.js', array('jquery', $this->name . '-validation'), $this->version, false);
    }

    function parse_form_submission($request)
    {

        if (!isset($_POST['name'], $_POST['email'], $_POST['message'])) {
            return $request;
        }

        $name = strip_tags(htmlspecialchars($_POST['name']));
        $email_address = strip_tags(htmlspecialchars($_POST['email']));
        $phone = '';
        if (!empty(get_option('nz_contact_me_use_phone'))) {
            if (!isset($_POST['phone'])) {
                return $request;
            }
            $phone = strip_tags(htmlspecialchars($_POST['phone']));
        }
        $message = strip_tags(htmlspecialchars($_POST['message']));

        $to = get_option('admin_email');
        $subject = "Website Contact Form:  $name";
        $body = "You have received a new message from your website contact form.\n\n" . "Here are the details:\n\nName: $name\n\nEmail: $email_address\n\nPhone: $phone\n\nMessage:\n$message";
        $headers = array('Content-Type: text/html; charset=UTF-8');

        $sent = wp_mail($to, $subject, $body, $headers);

        if ($sent) {
            return wp_send_json_success();
        } else {
            return wp_send_json_error();
        }
    }
}

new NzContactMe();

