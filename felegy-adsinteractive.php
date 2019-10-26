<?php
/**
 * Felegy Adsinteractive advertismen zone widget
 *
 * The WordPress Widget Boilerplate is an organized, maintainable boilerplate for building
 * widgets using WordPress best practices.
 *
 * @package   Felegy/Adsinteractive
 * @author    Gabor FELEGYHAZI <@felegy>
 * @license   GPL-3.0+
 * @link      https://github.com/felegy/adsinteractive
 * @copyright 2011 - 2019 felegy
 *
 * @wordpress-plugin
 * Plugin Name:       Adsinteractive advertismen zone widget
 * Plugin URI:        https://github.com/felegy/adsinteractive
 * Description:       An object-oriented foundation for building WordPress Widgets.
 * Version:           2.0.0
 * Author:            Gabor FELEGYHAZI <@felegy>
 * Author URI:        https://keybase.io/felegy
 * Text Domain:       felegy-adsinteractive
 * License:           GPL-3.0+
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 * Domain Path:       /languages
 */

namespace Felegy\Adsinteractive
{
    use Felegy\Adsinteractive\Utilities\Registry;
    use Felegy\Adsinteractive\Plugin;
    use Felegy\Adsinteractive\Subscriber\WidgetSubscriber;
    use Felegy\Adsinteractive\Subscriber\DeleteWidgetCacheSubscriber;

    // Prevent this file from being called directly.
    defined('WPINC') || die;

    // Include the autoloader.
    require_once __DIR__ . '/vendor/autoload.php';

    // Setup a filter so we can retrieve the registry throughout the plugin.
    $registry = new Registry();
    add_filter('wpwBoilerplateRegistry', function () use ($registry) {
        return $registry;
    });

    // Add subscribers.
    $registry->add('deleteWidgetCacheSubscriber', new DeleteWidgetCacheSubscriber('flush_widget_cache'));

    // Add the Widget base class to the Registry.
    $registry->add('widgetSubscriber', new WidgetSubscriber('widgets_init'));

    // Start the machine.
    (new Plugin($registry))->start();
}
