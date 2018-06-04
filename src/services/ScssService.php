<?php
/**
 * Scss plugin for Craft CMS 3.x
 *
 * Compiler for SCSS
 *
 * @link      https://chasegiunta.com
 * @copyright Copyright (c) 2018 Chase Giunta
 */

namespace chasegiunta\scss\services;

use chasegiunta\scss\Scss;

use Craft;
use craft\base\Component;

use Leafo\ScssPhp\Compiler;

use yii\web\View;

/**
 * ScssService Service
 *
 * All of your plugin’s business logic should go in services, including saving data,
 * retrieving data, etc. They provide APIs that your controllers, template variables,
 * and other plugins can interact with.
 *
 * https://craftcms.com/docs/plugins/services
 *
 * @author    Chase Giunta
 * @package   Scss
 * @since     1.0.0
 */
class ScssService extends Component
{
    // Public Methods
    // =========================================================================

    public function scss($scss = "", $attributes = "")
    {
        $attributes = unserialize($attributes);
        $scssphp = new Compiler();

        if (Craft::$app->getConfig()->general->devMode) {
            $outputFormat = Scss::$plugin->getSettings()->devModeOutputFormat;
        } else {
            $outputFormat = Scss::$plugin->getSettings()->outputFormat;
        }

        if ($attributes['expanded']) {
            $outputFormat = 'Expanded';
        }
        if ($attributes['crunched']) {
            $outputFormat = 'Crunched';
        }
        if ($attributes['compressed']) {
            $outputFormat = 'Compressed';
        }
        if ($attributes['compact']) {
            $outputFormat = 'Compact';
        }
        if ($attributes['nested']) {
            $outputFormat = 'Nested';
        }

        $scssphp->setFormatter("Leafo\ScssPhp\Formatter\\$outputFormat");

        $rootPath = Craft::getAlias('@root');
        $scssphp->setImportPaths($rootPath);

        if ($attributes['debug'] || Scss::$plugin->getSettings()->debug) {
            $scssphp->setLineNumberStyle(Compiler::LINE_COMMENTS);
        }

        $compiled = $scssphp->compile($scss);

        $result = $compiled;

        Craft::$app->view->registerCss($result);
    }
}
