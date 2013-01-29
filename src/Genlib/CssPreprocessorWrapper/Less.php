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
    }

    /**
     * -h, --help
     * help (this message) and exit.
     */
    public function help()
    {
        $this->addOption(__FUNCTION__);

        return $this;
    }

    /**
     * --include-path
     * Set include paths. Separated by `:'. Use `;' on Windows.
     */
    public function includePath($path)
    {
        $this->addPath($path);

        return $this;
    }

    /**
     * --no-color
     * Disable colorized output.
     */
    public function noColor()
    {
        $this->addOption(__FUNCTION__);

        return $this;
    }

    /**
     * -s, --silent
     * Suppress output of error messages.
     */
    public function silent()
    {
        $this->addOption(__FUNCTION__);

        return $this;
    }

    /**
     * --strict-imports
     * Force evaluation of imports.
     */
    public function strictImports()
    {
        $this->addOption(__FUNCTION__);

        return $this;
    }

    /**
     * --verbose
     * Be verbose.
     */
    public function verbose()
    {
        $this->addOption(__FUNCTION__);

        return $this;
    }

    /**
     * -v, --version
     * Print version number and exit.
     */
    public function version()
    {
        $this->addOption(__FUNCTION__);

        return $this;
    }

    /**
     * -x, --compress
     * Compress output by removing some whitespaces.
     */
    public function compress()
    {
        $this->addOption(__FUNCTION__);

        return $this;
    }

    /**
     * --yui-compress
     * Compress output using cssmin.js.
     */
    public function yuiCompress()
    {
        $this->addOption(__FUNCTION__);

        return $this;
    }

    /**
     * -O0, -O1, -O2
     * Set the parser's optimization level. The lower
     * the number, the less nodes it will create in the
     * tree. This could matter for debugging, or if you
     * want to access the individual nodes in the tree.
     */
    public function optimization($level)
    {
        $optimization = null;
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

        return $this;
    }

    /**
     * --line-numbers=TYPE
     * Outputs filename and line numbers.
     * TYPE can be either 'comments', which will output
     * the debug info within comments, 'mediaquery'
     * that will output the information within a fake
     * media query which is compatible with the SASS
     * format, and 'all' which will do both.
     */
    public function lineNumbers($type = self::LINE_NUMBERS_COMMENTS)
    {
        $this->addOption(__FUNCTION__);
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
        $this->addParam(__FUNCTION__, $param);

        return $this;
    }

    public function input($path)
    {
        $this->input = $path;

        return $this;
    }

    public function output($path)
    {
        $this->output = $path;

        return $this;
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
