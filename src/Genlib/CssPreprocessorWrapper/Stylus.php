<?php

namespace Genlib\CssPreprocessorWrapper;

class Stylus extends Base
{

    public function __construct($command = null)
    {
        parent::__construct(__CLASS__, $command);
        $this->functions['options'][] = 'interactive';
        $this->functions['options'][] = 'stylusUse';
        $this->functions['options'][] = 'inline';
        $this->functions['options'][] = 'watch';
        $this->functions['options'][] = 'out';
        $this->functions['options'][] = 'css';
        $this->functions['options'][] = 'stylusInclude';
        $this->functions['options'][] = 'compress';
        $this->functions['options'][] = 'compare';
        $this->functions['options'][] = 'firebug';
        $this->functions['options'][] = 'lineNumbers';
        $this->functions['options'][] = 'import';
        $this->functions['options'][] = 'includeCss';
        $this->functions['options'][] = 'version';
        $this->functions['options'][] = 'help';
        $this->functions['subs'][] = 'css';
        $this->functions['params'][] = 'stylusUse';
        $this->functions['params'][] = 'out';
        $this->functions['params'][] = 'stylusInclude';
        $this->functions['params'][] = 'import';
    }

    protected function subCss($args)
    {
        $this->addParam(__FUNCTION__, $args[0]);
        if (isset($args[1])) {
            $this->addParam(__FUNCTION__, $args[1]);
        }
    }

    /**
     * run
     */
    public function run($output = true, $dryrun = false, $clear = true)
    {
        $command = parent::run($output, $dryrun, $clear);

        return $command;
    }

}
