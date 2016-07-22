<?php
/**
* Plugin Name: Symposium Agenda
* Plugin URI: http://www.blackandwhitedigital.eu/product-category/plugins/
* Description: Easily build and display agendas and timetables for meetings, conferences, workshops, training days and events.
* Author: Black and White Digital Ltd
* Author URI: http://www.blackandwhitedigital.eu/product-category/plugins/
* Text Domain: Symposium Agenda
* Version: 0.1
* License: GPL License
*/

define( 'SYMPOAGENDA_VERSION', '1.0' );
define( 'SYMPOAGENDA_TITLE', 'Symposium Agenda');
define( 'AGENDA_SLUG', 'symposium_agenda');
define( 'AGENDA_PLUGIN_PATH', dirname( __FILE__ ));
define( 'SYMPOAGENDA_PLUGIN_ACTIVE_FILE_NAME', plugin_basename( __FILE__ ));
define( 'SYMPOAGENDA_PLUGIN_URL', plugins_url( '' , __FILE__ ));
define( 'AGENDA_LANGUAGE_PATH', dirname( plugin_basename( __FILE__ ) ) . '/languages');
require('lib/init.php');