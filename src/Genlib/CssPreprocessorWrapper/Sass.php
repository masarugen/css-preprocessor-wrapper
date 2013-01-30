<?php

namespace Genlib\CssPreprocessorWrapper;

class Sass extends Base
{

    const STYLE_NESTED = 0;
    const STYLE_EXPANDED = 1;
    const STYLE_COMPACT = 2;
    const STYLE_COMPRESSED = 3;

    private $stdin = null;
    private $encoding = null;

    public function __construct($command = null)
    {
        parent::__construct(__CLASS__, $command);
        $this->functions['options'][] = 'stdin';
        $this->functions['options'][] = 'trace';
        $this->functions['options'][] = 'unixNewlines';
        $this->functions['options'][] = 'scss';
        $this->functions['options'][] = 'watch';
        $this->functions['options'][] = 'update';
        $this->functions['options'][] = 'stopOnError';
        $this->functions['options'][] = 'poll';
        $this->functions['options'][] = 'force';
        $this->functions['options'][] = 'check';
        $this->functions['options'][] = 'style';
        $this->functions['options'][] = 'precision';
        $this->functions['options'][] = 'quiet';
        $this->functions['options'][] = 'compass';
        $this->functions['options'][] = 'debugInfo';
        $this->functions['options'][] = 'lineNumbers';
        $this->functions['options'][] = 'interactive';
        $this->functions['options'][] = 'loadPath';
        $this->functions['options'][] = 'sassRequire';
        $this->functions['options'][] = 'cacheLocation';
        $this->functions['options'][] = 'noCache';
        $this->functions['options'][] = 'help';
        $this->functions['options'][] = 'version';
        $this->functions['subs'][] = 'stdin';
        $this->functions['subs'][] = 'watch';
        $this->functions['subs'][] = 'update';
        $this->functions['subs'][] = 'style';
        $this->functions['subs'][] = 'encoding';
        $this->functions['params'][] = 'watch';
        $this->functions['params'][] = 'update';
        $this->functions['params'][] = 'style';
        $this->functions['params'][] = 'precision';
        $this->functions['params'][] = 'loadPath';
        $this->functions['params'][] = 'sassRequire';
        $this->functions['params'][] = 'cacheLocation';
    }

    protected function subStdin($args)
    {
        if (isset($args[0])) {
            $this->stdin = "< {$args[0]}";
        }
    }

    protected function subWatch($args)
    {
        $param = "{$args[0]}:{$args[1]}";

        return $param;
    }

    protected function subUpdate($args)
    {
        $param = "{$args[0]}:{$args[1]}";

        return $param;
    }

    protected function subStyle($args)
    {
        $style = isset($args[0]) ? $args[0] : self::STYLE_NESTED;
        switch ($style) {
            case self::STYLE_EXPANDED:
                $param = 'expanded';
                break;
            case self::STYLE_COMPACT:
                $param = 'compact';
                break;
            case self::STYLE_COMPRESSED:
                $param = 'compressed';
                break;
            case self::STYLE_NESTED:
            default:
                $param = 'nested';
                break;
        }

        return $param;
    }

    protected function subEncoding($encoding)
    {
        $this->encoding = $encoding;
    }

    public function run($output = true, $dryrun = false, $clear = true)
    {
        $command = '';
        if ($this->encoding !== null) {
            $commnad .= " -E";
            $command .= " {$this->encoding}";
        }
        $command = escapeshellcmd($command);
        if ($this->stdin !== null) {
            $command .= " {$this->stdin}";
        }
        $command = parent::run($output, $dryrun, $clear, $command);
        if ($clear) {
            $this->stdin = null;
        }

        return $command;
    }

}
