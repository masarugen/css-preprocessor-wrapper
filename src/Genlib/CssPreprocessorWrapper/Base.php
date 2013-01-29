<?php

namespace Genlib\CssPreprocessorWrapper;

abstract class Base
{
    protected $options = array();
    protected $params = array();
    protected $command = array();
    protected $prefix = array();

    protected function __construct($className, $command)
    {
        $this->prefix = strtolower(substr($className, strrpos($className, '\\') + 1));
        if ($command === null) {
            $command = $this->prefix;
        }
        $this->command = $command;
    }

    protected function addOption($option)
    {
        $this->options[] = $option;
    }

    protected function addParam($key, $param)
    {
        if (!isset($this->params[$key])) {
            $this->params[$key] = array();
        }
        $this->params[$key][] = $param;
    }

    protected function convertOptionName($option)
    {
        $option = str_replace($this->prefix, '', $option);
        $option = preg_replace('/([A-Z])/', '-$1', $option);
        $option = strtolower($option);

        return ltrim($option, '-');
    }

    public function dryrun($clear = false)
    {
        return $this->run(false, false, $clear);
    }

    protected function run($output = true, $dryrun = false, $clear = true, $addCommand = null, $paramSeparator = ' ')
    {
        $param = '';
        $stdout = '';
        $stderr = '';
        foreach ($this->options as $option) {
            $param .= ' --'.$this->convertOptionName($option);
            if (isset($this->params[$option])) {
                foreach ($this->params[$option] as $row) {
                    $param .= $paramSeparator.$row;
                }
            }
        }
        $command = $this->command.$param;
        $command = escapeshellcmd($command);
        $command .= $addCommand;
        if ($dryrun === false) {
            $descriptorspec = array(
                0 => array('pipe', 'r'), // stdin
                1 => array('pipe', 'w'), // stdout
                2 => array('pipe', 'w')  // stderr
            );
            $proc = proc_open($command, $descriptorspec, $pipes);
            if (is_resource($proc)) {
                $stdout = stream_get_contents($pipes[1]);
                $stderr = stream_get_contents($pipes[2]);
                if ($output === true) {
                    echo $stdout;
                    echo $stderr;
                }
                fclose($pipes[0]);
                fclose($pipes[1]);
                fclose($pipes[2]);
                proc_close($proc);
            }
        }
        if ($clear) {
            $this->options = array();
            $this->params = array();
        }

        return array($command, $stdout, $stderr);
    }

}
