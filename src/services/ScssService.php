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

use ScssPhp\ScssPhp\Compiler;
use ScssPhp\ScssPhp\OutputStyle\Compressed;
use ScssPhp\ScssPhp\OutputStyle\Expanded;

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
        $compiler = new Compiler();

        if (Craft::$app->getConfig()->general->devMode) {
            $outputFormat = Scss::$plugin->getSettings()->devModeOutputFormat;
        } else {
            $outputFormat = Scss::$plugin->getSettings()->outputFormat;
        }

        if ($attributes['expanded']) {
            $outputFormat = 'expanded';
        }
        if ($attributes['compressed']) {
            $outputFormat = 'compressed';
        }

        $compiler->setOutputStyle($outputFormat);

        $rootPath = Craft::getAlias('@root');
        $compiler->setImportPaths($rootPath);

        // if ($attributes['debug'] || Scss::$plugin->getSettings()->debug) {
        //     $compiler->setSourceMap(Compiler::SOURCE_MAP_INLINE);
        // }

        $compiled = $compiler->compileString($scss);

        $result = $compiled->getCss();

        Craft::$app->view->registerCss($result);
    }
}
