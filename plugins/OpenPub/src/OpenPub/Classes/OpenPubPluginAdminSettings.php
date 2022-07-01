<?php

namespace KISS\OpenPub\Classes;

class OpenPubPluginAdminSettings
{
    public function __construct()
    {
        // The Admin menu Item
        add_action('admin_menu', [$this, 'openpub_options_page']);

        // Initiating the settings page
        add_action('admin_init', [$this, 'wporg_settings_init']);
    }


    /**
     * Lets define the basic settings page
     */
    public function openpub_overview_page_html()
    {
        // check user capabilities
        if (!current_user_can('manage_options')) {
            return;
        }

        ?>
        <div class="wrap">
            <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
            <form action="options.php" method="post">
                Overview
            </form>
        </div>
        <?php
    }

    /**
     * Lets define the basic settings page
     */
    public function openpub_posts_page_html()
    {
        // check user capabilities
        if (!current_user_can('manage_options')) {
            return;
        }

        ?>
        <div class="wrap">
            <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
            <form action="options.php" method="post">
                Posts
            </form>
        </div>
        <?php
    }


    /**
     * Lets define the basic settings page
     */
    public function openpub_catalogi_page_html()
    {
        // check user capabilities
        if (!current_user_can('manage_options')) {
            return;
        }

        ?>
        <div class="wrap">
            <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
            Catalogi
        </div>
        <?php
    }

    /**
     * Lets define the basic settings page
     */
    public function openpub_options_page_html()
    {
        // check user capabilities
        if (!current_user_can('manage_options')) {
            return;
        }

?>
        <div class="wrap">
            <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
            <form action="options.php" method="post">
                <?php
                // output security fields for the registered setting "wporg_options"
                settings_fields('openpub_options');
                // output setting sections and their fields
                // (sections are registered for "wporg", each field is registered to a specific section)
                do_settings_sections('openpub_api');
                // output save settings button
                submit_button(__('Save Settings', 'textdomain'));
                ?>
            </form>
        </div>
    <?php
    }

    /**
     * The settings menu item
     */
    public function openpub_options_page()
    {
        # Settings for custom admin menu
        $page_title = 'OpenPub';
        $menu_title = 'OpenPub';
        $capability = 'post';
        $menu_slug  = 'openpub';
        $function   =  [$this, 'openpub_overview_page_html'];// Callback function which displays the page content.
        $icon_url   = 'dashicons-admin-page';
        $position   = null;

        # Add custom admin menu
        add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );


        $submenu_pages = array(

            # Avoid duplicate pages. Add submenu page with same slug as parent slug.
            array(
                'parent_slug' => $menu_slug,
                'page_title'  => 'Publication',
                'menu_title'  => 'Publications',
                'capability'  => 'manage_options',
                'menu_slug'   => 'edit.php?post_type=kiss_openpub_pub',
                'function'    => null,// Uses the same callback function as parent menu.
            ),

            # Avoid duplicate pages. Add submenu page with same slug as parent slug.
            array(
                'parent_slug' => $menu_slug,
                'page_title'  => 'Add publication',
                'menu_title'  => 'Add publication',
                'capability'  => 'manage_options',
                'menu_slug'   => 'post-new.php?post_type=kiss_openpub_pub',
                'function'    => null,// Uses the same callback function as parent menu.
            ),

            # Avoid duplicate pages. Add submenu page with same slug as parent slug.
            array(
                'parent_slug' => $menu_slug,
                'page_title'  => 'Audiences',
                'menu_title'  => 'Audiences',
                'capability'  => 'manage_options',
                'menu_slug'   => 'edit-tags.php?taxonomy=openpub-audience&post_type=kiss_openpub_pub',
                'function'    => null,// Uses the same callback function as parent menu.
            ),

            # Avoid duplicate pages. Add submenu page with same slug as parent slug.
            array(
                'parent_slug' => $menu_slug,
                'page_title'  => 'Type',
                'menu_title'  => 'Type',
                'capability'  => 'manage_options',
                'menu_slug'   => 'edit-tags.php?taxonomy=openpub-type&post_type=kiss_openpub_pub',
                'function'    => null,// Uses the same callback function as parent menu.
            ),

            # Avoid duplicate pages. Add submenu page with same slug as parent slug.
            array(
                'parent_slug' => $menu_slug,
                'page_title'  => 'Usage',
                'menu_title'  => 'Usage',
                'capability'  => 'manage_options',
                'menu_slug'   => 'edit-tags.php?taxonomy=openpub-usage&post_type=kiss_openpub_pub',
                'function'    => null,// Uses the same callback function as parent menu.
            ),

            # Avoid duplicate pages. Add submenu page with same slug as parent slug.
            array(
                'parent_slug' => $menu_slug,
                'page_title'  => 'Shows',
                'menu_title'  => 'Shows',
                'capability'  => 'manage_options',
                'menu_slug'   => 'edit-tags.php?taxonomy=openpub-show-on&post_type=kiss_openpub_pub',
                'function'    => null,// Uses the same callback function as parent menu.
            ),

            # Avoid duplicate pages. Add submenu page with same slug as parent slug.
            array(
                'parent_slug' => $menu_slug,
                'page_title'  => 'Skill',
                'menu_title'  => 'Skill',
                'capability'  => 'manage_options',
                'menu_slug'   => 'edit-tags.php?taxonomy=openpub_skill&post_type=kiss_openpub_pub',
                'function'    => null,// Uses the same callback function as parent menu.
            ),

            # Avoid duplicate pages. Add submenu page with same slug as parent slug.
            array(
                'parent_slug' => 'openpub',
                'page_title'  => 'OpenPub | Configuration',
                'menu_title'  => 'Configuration',
                'capability'  => 'manage_options',
                'menu_slug'   => 'openpub_configuration',
                'function'    =>  [$this, 'openpub_options_page_html'],// Uses the same callback function as parent menu.
            ),
        );

        # Add each submenu item to custom admin menu.
        foreach ( $submenu_pages as $submenu ) {

            add_submenu_page(
                $submenu['parent_slug'],
                $submenu['page_title'],
                $submenu['menu_title'],
                $submenu['capability'],
                $submenu['menu_slug'],
                $submenu['function']
            );
        }

    }

    /**
     * Lets define some settings
     */
    public function wporg_settings_init()
    {
        // register a new setting for "reading" page
        register_setting('openpub_options', 'openpub_api_domain');
        register_setting('openpub_options', 'openpub_api_key');
        register_setting('openpub_options', 'openpub_organization');

        // register a new section in the "reading" page
        add_settings_section(
            'default', // id
            'API  Configuration', // title
            [$this, 'wporg_settings_section_callback'], // callback
            'openpub_api' // page
        );

        // register a new field in the "wporg_settings_section" section, inside the "reading" page
        add_settings_field(
            'openpub_api_domain_field', // id
            'API Domain',  // title
            [$this, 'openpub_api_domain_field_callback'], //callback
            'openpub_api',
            'default'
        );

        // register a new field in the "wporg_settings_section" section, inside the "reading" page
        add_settings_field(
            'openpub_api_key_field',
            'API  KEY',
            [$this, 'openpub_api_key_field_callback'],
            'openpub_api',
            'default'
        );

        // register a new field in the "wporg_settings_section" section, inside the "reading" page
        add_settings_field(
            'openpub_organization_field',
            'Organization',
            [$this, 'openpub_organization_field_callback'],
            'openpub_api',
            'default'
        );
    }

    /**
     * callback functions
     */

    // section content cb
    public function wporg_settings_section_callback()
    {
        echo '<p>In order to use the openpub api you wil need to provide api credentials.</p>';
    }

    // field content cb
    public function openpub_api_domain_field_callback()
    {
        // get the value of the setting we've registered with register_setting()
        $setting = get_option('openpub_api_domain');
        // output the field
    ?>
        <input type="text" name="openpub_api_domain" value="<?php echo isset($setting) ? esc_attr($setting) : ''; ?>">
    <?php
    }

    public function openpub_api_key_field_callback()
    {
        // get the value of the setting we've registered with register_setting()
        $setting = get_option('openpub_api_key');
        // output the field
    ?>
        <input type="text" name="openpub_api_key" value="<?php echo isset($setting) ? esc_attr($setting) : ''; ?>">
    <?php
    }

    public function openpub_organization_field_callback()
    {
        // get the value of the setting we've registered with register_setting()
        $setting = get_option('openpub_organization');
        // output the field
    ?>
        <input type="text" name="openpub_organization" value="<?php echo isset($setting) ? esc_attr($setting) : ''; ?>">
<?php
    }
}
