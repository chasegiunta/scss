<?php
/**
 * SCSS plugin for Craft CMS 3.x
 *
 * SCSS
 *
 * @link      https://chasegiunta.com
 * @copyright Copyright (c) 2018 Chase Giunta
 */

namespace chasegiunta\scss\twigextensions;

use chasegiunta\scss\twigextensions\ScssNode;

/**
 * SCSS twig token parser
 *
 * @author    chasegiunta
 * @package   SCSS
 * @since     1.0.0
 */
class ScssTokenParser extends \Twig_TokenParser
{
    // Public Methods
    // =========================================================================

    /**
     * Parses {% scss %}...{% endscss %} tags
     *
     * @param \Twig_Token $token
     *
     * @return \chasegiunta\scss\twigextensions\ScssNode
     */
    public function parse(\Twig_Token $token)
    {
        $lineNo = $token->getLine();
        $stream = $this->parser->getStream();

        $attributes = [
            'compact'       => false,
            'expanded'      => false,
            'compressed'    => false,
            'nested'        => false,
            'crunched'      => false,
            'debug'         => false,
        ];

        if ($stream->test(\Twig_Token::NAME_TYPE, 'expanded')) {
            $attributes['expanded'] = true;
            $stream->next();
        }

        if ($stream->test(\Twig_Token::NAME_TYPE, 'crunched')) {
            $attributes['crunched'] = true;
            $stream->next();
        }

        if ($stream->test(\Twig_Token::NAME_TYPE, 'compressed')) {
            $attributes['compressed'] = true;
            $stream->next();
        }

        if ($stream->test(\Twig_Token::NAME_TYPE, 'compact')) {
            $attributes['compact'] = true;
            $stream->next();
        }

        if ($stream->test(\Twig_Token::NAME_TYPE, 'nested')) {
            $attributes['nested'] = true;
            $stream->next();
        }

        if ($stream->test(\Twig_Token::NAME_TYPE, 'debug')) {
            $attributes['debug'] = true;
            $stream->next();
        }

        $stream->expect(\Twig_Token::BLOCK_END_TYPE);
        $nodes['body'] = $this->parser->subparse([$this, 'decideScssEnd'], true);
        $stream->expect(\Twig_Token::BLOCK_END_TYPE);

        return new ScssNode($nodes, $attributes, $lineNo, $this->getTag());
    }

    /**
     * @return string
     */
    public function getTag()
    {
        return 'scss';
    }

    /**
     * @param \Twig_Token $token
     *
     * @return bool
     */
    public function decideScssEnd(\Twig_Token $token)
    {
        return $token->test('endscss');
    }
}