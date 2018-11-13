<?php

class NzContactMeAdmin
{

    protected $name = 'nz-contact-me';

    public function __construct()
    {
        
    }

    public function create_menu()
    {

        add_submenu_page('options-general.php', 'Nz Contact Me', 'Nz Contact Me', 'administrator', __FILE__, //
            array($this, 'main_settings_page'));
    }

    function settings_api_init()
    {
        /* register_setting('nz-contact-me', 'phone_field'); */
        add_settings_section("main", "All Settings", null, "nz-contact-me");

        add_settings_field("nz_contact_me_use_phone", "Use phone field", array($this, "display_phone_field"), "nz-contact-me", "main");
        register_setting("main", "nz_contact_me_use_phone");
    }

    function main_settings_page()
    {
        ?>
        <div class="wrap">
            <h1>Nz Contact Me</h1>
            <form method="post" action="options.php" enctype='multipart/form-data'>
                <?php
                settings_fields("main");
                do_settings_sections("nz-contact-me");
                submit_button();
                ?>          
            </form>
        </div>
        <?php
    }

    public function display_phone_field()
    {
        ?>
        <input type="checkbox" name="nz_contact_me_use_phone" value="1" <?php checked(1, get_option('nz_contact_me_use_phone'), true); ?> /> 
        <?php
    }
}
