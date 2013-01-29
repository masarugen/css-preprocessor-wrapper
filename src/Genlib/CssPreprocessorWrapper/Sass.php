<?php

namespace Genlib\CssPreprocessorWrapper;

class Sass extends Base
{

    const STYLE_NESTED = 0;
    const STYLE_EXPANDED = 1;
    const STYLE_COMPACT = 2;
    const STYLE_COMPRESSED = 3;

    private $stdin = null;

    public function __construct($command = null)
    {
        parent::__construct(__CLASS__, $command);
    }

    /**
     * -s, --stdin
     * Read input from standard input instead of an input file.
     */
    public function stdin($file = null)
    {
        if ($file !== null) {
            $this->stdin = "< {$file}";
        }

        return $this;
    }

    /**
     * --trace
     * Show a full traceback on error.
     */
    public function trace()
    {
        $this->addOption(__FUNCTION__);

        return $this;
    }

    /**
     * --unix-newlines
     * Use Unix-style newlines in written files.
     */
    public function unixNewlines()
    {
        $this->addOption(__FUNCTION__);

        return $this;
    }

    /**
     * --scss
     * Use the CSS-superset SCSS syntax.
     */
    public function scss()
    {
        $this->addOption(__FUNCTION__);

        return $this;
    }

    /**
     * --watch
     * Watch files or directories for changes.
     * The location of the generated CSS can be set using a colon:
     * sass --watch input.sass:output.css
     * sass --watch input-dir:output-dir
     */
    public function watch($input, $output)
    {
        $this->addOption(__FUNCTION__);
        $param = "{$input}:{$output}";
        $this->addParam(__FUNCTION__, $param);

        return $this;
    }

    /**
     * --update
     * Compile files or directories to CSS.
     * Locations are set like --watch.
     */
    public function update($input, $output)
    {
        $this->addOption(__FUNCTION__);
        $param = "{$input}:{$output}";
        $this->addParam(__FUNCTION__, $param);

        return $this;
    }

    /**
     * --stop-on-error
     * If a file fails to compile, exit immediately.
     * Only meaningful for --watch and --update.
     */
    public function stopOnError()
    {
        $this->addOption(__FUNCTION__);

        return $this;
    }

    /**
     * --poll
     * Check for file changes manually, rather than relying on the OS.
     * Only meaningful for --watch.
     */
    public function poll()
    {
        $this->addOption(__FUNCTION__);

        return $this;
    }

    /**
     * -f, --force
     * Recompile all Sass files, even if the CSS file is newer.
     * Only meaningful for --update.
     */
    public function force()
    {
        $this->addOption(__FUNCTION__);

        return $this;
    }

    /**
     * -c, --check
     * Just check syntax, don't evaluate.
     */
    public function check()
    {
        $this->addOption(__FUNCTION__);

        return $this;
    }

    /**
     * -t, --style NAME
     * Output style. Can be nested (default), compact, compressed, or expanded.
     */
    public function style($style = self::STYLE_NESTED)
    {
        $this->addOption(__FUNCTION__);
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
        $this->addParam(__FUNCTION__, $param);

        return $this;
    }

    /**
     * --precision NUMBER_OF_DIGITS
     * How many digits of precision to use when outputting decimal numbers.
     * Defaults to 3.
     */
    public function precision($numberOfDigits)
    {
        $this->addOption(__FUNCTION__);
        $this->addParam(__FUNCTION__, $numberOfDigits);

        return $this;
    }

    /**
     * -q, --quiet
     * Silence warnings and status messages during compilation.
     */
    public function quiet()
    {
        $this->addOption(__FUNCTION__);

        return $this;
    }

    /**
     * --compass
     * Make Compass imports available and load project configuration.
     */
    public function compass()
    {
        $this->addOption(__FUNCTION__);

        return $this;
    }

    /**
     * -g, --debug-info
     * Emit extra information in the generated CSS that can be used by the FireSass Firebug plugin.
     */
    public function debugInfo()
    {
        $this->addOption(__FUNCTION__);

        return $this;
    }

    /**
     * -l, --line-numbers, --line-comments
     * Emit comments in the generated CSS indicating the corresponding source line.
     */
    public function lineNumbers()
    {
        $this->addOption(__FUNCTION__);

        return $this;
    }

    /**
     * -i, --interactive
     * Run an interactive SassScript shell.
     */
    public function interactive()
    {
        $this->addOption(__FUNCTION__);

        return $this;
    }

    /**
     * -I, --load-path PATH
     * Add a sass import path.
     */
    public function loadPath($path)
    {
        $this->addOption(__FUNCTION__);
        $this->addParam(__FUNCTION__, $path);

        return $this;
    }

    /**
     * -r, --require LIB
     * Require a Ruby library before running Sass.
     */
    public function sassRequire($library)
    {
        $this->addOption(__FUNCTION__);
        $this->addParam(__FUNCTION__, $library);

        return $this;
    }

    /**
     * --cache-location PATH
     * The path to put cached Sass files. Defaults to .sass-cache.
     */
    public function cacheLocation($path)
    {
        $this->addOption(__FUNCTION__);
        $this->addParam(__FUNCTION__, $path);

        return $this;
    }

    /**
     * -C, --no-cache
     * Don't cache to sassc files.
     */
    public function noCache()
    {
        $this->addOption(__FUNCTION__);

        return $this;
    }

    /**
     * -E encoding
     * Specify the default encoding for Sass files.
     */
    public function encoding()
    {
        $this->addOption(__FUNCTION__);

        return $this;
    }

    /**
     * -?, -h, --help
     * Show this message
     */
    public function help()
    {
        $this->addOption(__FUNCTION__);

        return $this;
    }

    /**
     * -v, --version
     * Print version
     */
    public function version()
    {
        $this->addOption(__FUNCTION__);

        return $this;
    }

    /**
     * run
     */
    public function run($output = true, $dryrun = false, $clear = true)
    {
        $command = '';
        if ($this->stdin !== null) {
            $command .= " --stdin";
            $command .= " {$this->stdin}";
        }
        $command = escapeshellcmd($command);
        $command = parent::run($output, $dryrun, $clear, $command);
        if ($clear) {
            $this->stdin = null;
        }

        return $command;
    }

}
