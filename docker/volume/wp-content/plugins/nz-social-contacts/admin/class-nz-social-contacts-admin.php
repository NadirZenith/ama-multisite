<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Nz_Social_Contacts
 * @subpackage Nz_Social_Contacts/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Nz_Social_Contacts
 * @subpackage Nz_Social_Contacts/admin
 * @author     Your Name <email@example.com>
 */
class Nz_Social_Contacts_Admin
{

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $plugin_name       The name of this plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($plugin_name, $version)
    {

        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {

         wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/nz-social-contacts-admin.css', array(), $this->version, 'all'); 
    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {

        wp_enqueue_script($this->plugin_name . '-lodash', 'https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.5.1/lodash.min.js');
        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/nz-social-contacts-admin.js', array('jquery'), $this->version, false);
    }

    public function create_menu()
    {

        add_submenu_page('options-general.php', 'Nz Social Contacts', 'Nz Social Contacts', 'administrator', __FILE__, //
            array($this, 'nz_social_contacts_settings_page'));
    }

    function settings_api_init()
    {
        register_setting('nz-social-contacts', 'nz_social_contacts_fields');
        register_setting('nz-social-contacts', 'include_css');
    }

    function nz_social_contacts_settings_page()
    {
        ?>
        <div class="wrap">
            <h2>Nz Social Contacts</h2>
            <form id="social-contacts-save-form" method="post" action="options.php">
                <?php settings_fields('nz-social-contacts'); ?>
                <?php do_settings_sections('nz-social-contacts'); ?>
                <table class="form-table">
                    <tr valign="top">
                        <td>
                            <input name="include_css" value="1" type="checkbox"  class="code" <?php echo get_option('include_css') ? 'checked' : ''; ?> /> Include style
                        </td>
                    </tr>

                    <input id="contacts-fields-input" type="hidden" name="nz_social_contacts_fields" value="<?php echo esc_attr(get_option('nz_social_contacts_fields')); ?>" />
                </table>
                <?php submit_button(); ?>
            </form>

            <!--    js form to hanlde fields        -->
            <form action="#" id="contacts-fields-items">
                <button class="button-primary add">Add</button>
                <div class="contacts-list"></div>
            </form>
            
               <script type="text/template" class="fieldTpl">
                <fieldset class="contact-item">
                    <button class="button up">&#8613;</button>

                    <div>
                        <label>Link</label>
                        <input value="<%- field.link %>" name="link" type="text" placeholder="http://www.example.com" />
                    </div>

                    <div>
                        <label>Class</label>
                        <input value="<%- field.class %>" name="class" type="text" />
                    </div>

                    <div>
                        <label>Icon Class</label>
                        <input value="<%- field.icon_class %>" name="icon_class" type="text"  />
                    </div>

                    <div>
                        <label>Content</label>
                        <input value="<%- field.icon_content %>" name="icon_content" type="text"  />
                    </div>

                    <div>
                        <label>Detail</label>
                        <input value="<%- field.detail %>" name="detail" type="text" />
                    </div>

                    <button class="button <%- action %>"><%- action %></button>

                    <hr>
                </fieldset>
            </script>

            <pre> 
                    &lt;!-- current layout --&gt;
                    &lt;ul class="nz-socials"&gt;
                        &lt;li&gt;
                            &lt;a href="#link||mailto:contact@amagency.net" class="linkclass bg-color-brand"&gt;
                                &lt;i class="iconclass fa fa-envelope"&gt;iconcontent&lt;/i&gt;
                                &lt;div&gt;
                                    &lt;p&gt;
                                        contact@amagency.net (detail)
                                    &lt;/p&gt;
                                &lt;/div&gt;
                            &lt;/a&gt;
                        &lt;/li&gt;
                    &lt;/ul&gt;   
            </pre>

        </div>
        <?php
    }
}
