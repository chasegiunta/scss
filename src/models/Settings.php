<?php
/**
 * Scss plugin for Craft CMS 3.x
 *
 * scss
 *
 * @link      https://chasegiunta.com
 * @copyright Copyright (c) 2018 Chase Giunta
 */

namespace chasegiunta\scss\models;

use chasegiunta\scss\Scss;

use Craft;
use craft\base\Model;

/**
 * ScssModel Model
 *
 * Models are containers for data. Just about every time information is passed
 * between services, controllers, and templates in Craft, it’s passed via a model.
 *
 * https://craftcms.com/docs/plugins/models
 *
 * @author    Chase Giunta
 * @package   Scss
 * @since     1.0.0
 */
class Settings extends Model
{
    // Public Properties
    // =========================================================================

    /**
     * Some model attribute
     *
     * @var string
     */
    public $outputFormat = 'Crunched';
    
    /**
     * Some model attribute
     *
     * @var string
     */

    public $devModeOutputFormat = 'Expanded';

    /**
     * Some model attribute
     *
     * @var boolean
     */

    public $debug = false;

    // Public Methods
    // =========================================================================

    /**
     * Returns the validation rules for attributes.
     *
     * Validation rules are used by [[validate()]] to check if attribute values are valid.
     * Child classes may override this method to declare different validation rules.
     *
     * More info: http://www.yiiframework.com/doc-2.0/guide-input-validation.html
     *
     * @return array
     */
    public function rules()
    {
        return [
            ['outputFormat', 'string'],
            ['outputFormat', 'default', 'value' => 'Crunched'],
            ['devModeOutputFormat', 'string'],
            ['devModeOutputFormat', 'default', 'value' => 'Expanded'],
            ['debug', 'boolean'],
            ['debug', 'default', 'value' => false],
        ];
    }
}
