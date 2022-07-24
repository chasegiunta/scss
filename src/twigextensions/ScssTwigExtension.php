<?php
/**
 * SCSS plugin for Craft CMS 3.x
 *
 * Compiler for SCSS
 *
 * @link      https://chasegiunta.com
 * @copyright Copyright (c) 2018 Chase Giunta
 */

namespace chasegiunta\scss\twigextensions;

use chasegiunta\scss\Scss;

use Craft;

use craft\web\twig\tokenparsers\RegisterResourceTokenParser;


/**
 * Twig can be extended in many ways; you can add extra tags, filters, tests, operators,
 * global variables, and functions. You can even extend the parser itself with
 * node visitors.
 *
 * http://twig.sensiolabs.org/doc/advanced.html
 *
 * @author    Chase Giunta
 * @package   Scss
 * @since     1.0.0
 */
class ScssTwigExtension extends \Twig\Extension\AbstractExtension
{
    // Public Methods
    // =========================================================================

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'Scss';
    }

    /**
     * Returns the token parser instances to add to the existing list.
     *
     * @return array An array of Twig_TokenParserInterface or
     * Twig_TokenParserBrokerInterface instances
     */
    public function getTokenParsers()
    {
        return [
            new ScssTokenParser(),
        ];
    }
}
