<?php
namespace ABOSS;
require_once plugin_dir_path( __FILE__ ) . 'events_widget.php';

class PluginAdmin {
  protected $pluginName;
  protected $pluginVersion;

  public function __construct($pluginName, $pluginVersion) {
    $this->$pluginName = $plugin_name;
    $this->$pluginVersion = $version;
  }

  public function add_admin_menu() {
    add_menu_page(
      __( 'ABOSS Events', 'aboss-events' ),
      'ABOSS Events',
      'manage_options',
      'aboss_events/aboss-events-admin.php',
      '\ABOSS\PluginAdmin::admin_page',
      plugins_url( 'aboss_events/images/icon.png' ),
      6
    );
  }
  public function register_widgets() {
    register_widget('ABOSS\EventsWidget');
  }

  public function admin_page($args) {
    require_once plugin_dir_path( dirname( __FILE__ ) ) . 'aboss/partials/admin-display.php';
  }

  public function settings_api_init() {
    add_settings_section(
    	'aboss-events-basics',
    	'Settings for the ABOSS API',
    	array($this, 'eg_setting_section_callback_function'),
    	'aboss-events'
    );

    register_setting('aboss-events', 'aboss_events-api-key');
    register_setting('aboss-events', 'aboss_events-system');
    register_setting('aboss-events', 'aboss_events-agency-id');
  }

  public function eg_setting_section_callback_function() {
    require_once plugin_dir_path( dirname( __FILE__ ) ) . 'aboss/partials/admin-settings.php';
  }
}