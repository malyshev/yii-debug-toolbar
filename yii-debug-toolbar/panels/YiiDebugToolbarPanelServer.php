<?php
/**
 * YiiDebugToolbarPanelVersions class file.
 *
 * @author Sergey Malyshev <malyshev.php@gmail.com>
 */


/**
 * YiiDebugToolbarPanelVersions represents an ...
 *
 * Description of YiiDebugToolbarPanelVersions
 *
 * @author Sergey Malyshev <malyshev.php@gmail.com>
 * @version $Id$
 * @package
 * @since 1.1.7
 */

class YiiDebugToolbarPanelServer extends YiiDebugToolbarPanel implements DebugToolbarPanelInterface
{
    public function getMenuTitle()
    {
        return 'Server';
    }

    public function getMenuSubTitle()
    {
        return 'Yii ' . Yii::getVersion();
    }

    public function getTitle()
    {
        return 'Server Info';
    }

    public function run()
    {
        $this->render('server');
    }

    public function getPhpInfoContent()
    {
        ob_start();
        phpinfo(INFO_MODULES);
        $info = ob_get_contents();
        ob_end_clean();

        preg_match('/<body>(.*?)<\/body>/msS', $info, $matches);

        if (isset($matches[1]))
        {
            $content = preg_replace('/\s?class\="\w+"/', '', $matches[1]);
            $content = explode("\n", $content);
            $counter = 0;
            foreach($content as &$row)
            {
                if (0===strpos($row, '<tr>'))
                {
                    $replace = '<tr class="'.($counter%2?'odd':'even').'">';
                    $row = str_replace('<tr>', $replace, $row);
                    $counter++;
                }
                else
                {
                    $counter = 0;
                }
            }
            return implode("\n", $content);
        }

        return;
    }

}
