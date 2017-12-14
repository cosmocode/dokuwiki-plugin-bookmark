<?php
/**
 * Plugin bookmark: Creates a bookmark to your document.
 *
 * @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author     Otto Vainio <bookmark.plugin@valjakko.net>
 */

if (!defined('DOKU_INC')) {
    die('must be run from within DokuWiki');
}

/**
 * All DokuWiki plugins to extend the parser/rendering mechanism
 * need to inherit from this class
 */
class syntax_plugin_bookmark extends DokuWiki_Syntax_Plugin
{

    /**
     * What kind of syntax are we?
     */
    public function getType()
    {
        return 'substition';
    }

    public function getSort()
    {
        return 357;
    }

    public function connectTo($mode)
    {
        $this->Lexer->addSpecialPattern('<BOOKMARK:\w+>', $mode, 'plugin_bookmark');
    }


    /**
     * Handle the match
     */
    public function handle($match, $state, $pos, Doku_Handler $handler)
    {
        $bookMarkString = substr($match, 10, -1); //strip <BOOKMARK: from start and > from end
        return array(strtolower($bookMarkString));
    }

    /**
     * Create output
     */
    public function render($mode, Doku_Renderer $renderer, $data)
    {
        if ($mode === 'xhtml') {
            $renderer->doc .= '<a name="' . $data[0] . '"></a>';
            return true;
        }
        return false;
    }
}
