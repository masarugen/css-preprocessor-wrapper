<?php

namespace Genlib\CssPreprocessorWrapper;

class Stylus extends Base
{

    public function __construct($command = null)
    {
        parent::__construct(__CLASS__, $command);
    }

    /**
     * -i, --interactive
     * Start interactive REPL
     */
    public function interactive()
    {
        $this->addOption(__FUNCTION__);

        return $this;
    }

    /**
     * -u, --use <path>
     * Utilize the stylus plugin at <path>
     */
    public function stylusUse($path)
    {
        $this->addOption(__FUNCTION__);
        $this->addParam(__FUNCTION__, $path);

        return $this;
    }

    /**
     * -U, --inline
     * Utilize image inlining via data uri support
     */
    public function inline()
    {
        $this->addOption(__FUNCTION__);

        return $this;
    }

    /**
     * -w, --watch
     * Watch file(s) for changes and re-compile
     */
    public function watch()
    {
        $this->addOption(__FUNCTION__);

        return $this;
    }

    /**
     * -o, --out <dir>
     * Output to <dir> when passing files
     */
    public function out($path)
    {
        $this->addOption(__FUNCTION__);
        $this->addParam(__FUNCTION__, $path);

        return $this;
    }

    /**
     * -C, --css <src> [dest]
     * Convert css input to stylus
     */
    public function css($in, $out = null)
    {
        $this->addOption(__FUNCTION__);
        $this->addParam(__FUNCTION__, $in);
        if ($out !== null) {
            $this->addParam(__FUNCTION__, $out);
        }

        return $this;
    }

    /**
     * -I, --include <path>
     * Add <path> to lookup paths
     */
    public function stylusInclude($path)
    {
        $this->addOption(__FUNCTION__);
        $this->addParam(__FUNCTION__, $path);

        return $this;
    }

    /**
     * -c, --compress
     * Compress css output
     */
    public function compress()
    {
        $this->addOption(__FUNCTION__);

        return $this;
    }

    /**
     * -d, --compare
     * Display input along with output
     */
    public function compare()
    {
        $this->addOption(__FUNCTION__);

        return $this;
    }

    /**
     * -f, --firebug
     * Emits debug infos in the generated css that
     *    can be used by the FireStylus Firebug plugin
     */
    public function firebug()
    {
        $this->addOption(__FUNCTION__);

        return $this;
    }

    /**
     * -l, --line-numbers
     * Emits comments in the generated css
     * indicating the corresponding stylus line
     */
    public function lineNumbers()
    {
        $this->addOption(__FUNCTION__);

        return $this;
    }

    /**
     * --import <file>
     * Import stylus <file>
     */
    public function import($path)
    {
        $this->addOption(__FUNCTION__);
        $this->addParam(__FUNCTION__, $path);

        return $this;
    }

    /**
     * --include-css
     * Include regular css on @import
     */
    public function includeCss()
    {
        $this->addOption(__FUNCTION__);

        return $this;
    }

    /**
     * -V, --version
     * Display the version of stylus
     */
    public function version()
    {
        $this->addOption(__FUNCTION__);

        return $this;
    }

    /**
     * -h, --help
     * Display help information
     */
    public function help()
    {
        $this->addOption(__FUNCTION__);

        return $this;
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
