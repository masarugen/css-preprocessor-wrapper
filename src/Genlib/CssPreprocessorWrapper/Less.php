<?php

namespace Genlib\CssPreprocessorWrapper;

class Less extends Base
{

    const LINE_NUMBERS_COMMENTS = 0;
    const LINE_NUMBERS_MEDIAQUERY = 1;
    const LINE_NUMBERS_ALL = 2;

    private $paths = array();
    private $optimization = null;
    private $input = null;
    private $output = null;

    public function __construct($command = null)
    {
        if ($command === null) {
            $command = 'lessc';
        }
        parent::__construct(__CLASS__, $command);
        $this->functions['options'][] = 'help';
        $this->functions['options'][] = 'noColor';
        $this->functions['options'][] = 'silent';
        $this->functions['options'][] = 'strictImports';
        $this->functions['options'][] = 'verbose';
        $this->functions['options'][] = 'version';
        $this->functions['options'][] = 'compress';
        $this->functions['options'][] = 'yuiCompress';
        $this->functions['options'][] = 'lineNumbers';
        $this->functions['subs'][] = 'includePath';
        $this->functions['subs'][] = 'subOptimization';
        $this->functions['subs'][] = 'lineNumbers';
        $this->functions['subs'][] = 'input';
        $this->functions['subs'][] = 'output';
        $this->functions['params'][] = 'lineNumbers';
    }

    protected function subIncludePath($args)
    {
        $this->paths = array_merge($this->paths, $args);
    }

    protected function subOptimization($args)
    {
        $optimization = null;
        $level = $args[0];
        switch ($level) {
        case 0:
            $optimization = 0;
            break;
        case 1:
            $optimization = 1;
            break;
        case 2:
            $optimization = 2;
            break;
        }
        if ($optimization !== null) {
            $this->optimization = $optimization;
        }
    }

    protected function subLineNumbers($args)
    {
        $type = isset($args[0]) ? $args[0] : self::LINE_NUMBERS_COMMENTS;
        switch ($type) {
            case self::LINE_NUMBERS_MEDIAQUERY:
                $param = 'mediaquery';
                break;
            case self::LINE_NUMBERS_ALL:
                $param = 'all';
                break;
            case self::LINE_NUMBERS_COMMENTS:
            default:
                $param = 'comments';
                break;
        }

        return $param;
    }

    protected function subInput($args)
    {
        $this->input = $args[0];
    }

    protected function subOutput($args)
    {
        $this->output = $args[0];
    }

    public function run($output = true, $dryrun = false, $clear = true)
    {
        $command = '';
        if ($this->optimization !== null) {
            $command .= " -O{$this->optimization}";
        }
        if (count($this->paths) > 0) {
            $command .= ' --include-path=';
            foreach ($this->paths as $path) {
                $command .= $path.PATH_SEPARATOR;
            }
            $command = rtrim($command, PATH_SEPARATOR);
        }
        if ($this->input !== null) {
            $command .= " {$this->input}";
        }
        $command = escapeshellcmd($command);
        if ($this->output !== null) {
            $command .= " > {$this->output}";
        }
        $command = parent::run($output, $dryrun, $clear, $command, '=');
        if ($clear) {
            $this->paths = array();
            $this->optimization = null;
            $this->input = null;
            $this->output = null;
        }

        return $command;
    }

}
