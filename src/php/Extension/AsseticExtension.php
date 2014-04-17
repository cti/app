<?php

namespace Extension;

use Symfony\Component\Filesystem\Filesystem;

class AsseticExtension
{
    /**
     * @inject
     * @var Cti\Core\Application
     */
    protected $application;

    public function buildJavascript($script)
    {
        $result = '';

        foreach(array_reverse($this->getDependencyList($script)) as $coffee) {

            $javascript = null;
            foreach(array('src', 'resource') as $src) {
                if(strpos($coffee, $this->application->getPath("$src coffee")) === 0) {
                    $script_path = substr($coffee, strlen($this->application->getPath("$src coffee")) + 1);
                    $dir = dirname($script_path);
                    $name = basename($script_path, '.coffee');
                    $path = "build js";
                    if($dir != '.') {
                        $path .= " $dir";
                    }
                    $path .= " $name.js";
                    $javascript = $this->application->getPath($path);
                }
            }

            if(!$javascript) {
                throw new \Exception(sprintf("Where did you found %s?", $coffee));
            }

            $list[] = $javascript;

            $out = dirname($javascript);
            $command = "coffee -b -o $out -c $coffee";

            $input = $output = array();
            exec($command, $input, $output);

            $result .= file_get_contents($javascript) . PHP_EOL;
        }

        $file = $this->application->getPath('public js ' . basename($script, '.coffee') .'.js');

        $fs = new Filesystem;
        $fs->dumpFile($file, $result);

        return $file;
    }

    protected function getDependencyList($script)
    {
        $result = array();
        if(file_exists($script)) {
            $contents = file_get_contents($script);
        } else {
            $file = $this->application->getPath('resource coffee '. $script . '.coffee');
            if(file_exists($file)) {
                $script = $file;
                $contents = file_get_contents($file);
            }
        }
        $result[] = $script;
        foreach($this->getScriptDependencies($contents) as $class) {
            if(strpos($class, 'Ext.') !== 0) {
                $file = $this->application->getPath('src coffee ' . str_replace('.', ' ', $class) . '.coffee');
                if(!in_array($file, $result)) {
                    $result[] = $file;
                }
                foreach($this->getDependencyList($file) as $dependency) {
                    if(!in_array($dependency, $result)) {
                        $result[] = $dependency;
                    }
                }
            }
        }
        return $result;
    }

    protected function getScriptDependencies($text)
    {
        return array_merge(
            $this->getRequires($text),
            $this->getMixins($text),
            $this->getCreate($text),
            $this->getExtend($text)
        );

        $dependencies = array();
        $dependencies = array_merge($dependencies, $this->getRequires($text));
        $dependencies = array_merge($dependencies, $this->getMixins($text));
        $dependencies = array_merge($dependencies, $this->getCreate($text));
        $dependencies = array_merge($dependencies, $this->getExtend($text));

        return $dependencies;
    }

    protected function getRequires($text)
    {
        $requires = array();
        $pregs = array(
            "/Ext.require ['\"]([a-zA-Z0-9.]+)['\"]/",
            "/Ext.syncRequire ['\"]([a-zA-Z0-9.]+)['\"]/",
        );
        foreach ($pregs as $p) {
            preg_match_all($p, $text, $answer);
            $requires = array_merge($requires,$answer[1]);
        }

        $p = "/requires\s*:\s*\[['\"a-zA-Z0-9.,\s]+\]/";
        preg_match_all($p, $text, $output);
        $p = "/['\"]([a-zA-Z0-9.]*)['\"]/";
        $required_classes = array();
        foreach ($output[0] as $require) {
            preg_match_all($p, $require, $match);
            $required_classes = array_merge($required_classes, $match[1]);
        }

        return array_merge($requires,$required_classes);

    }

    protected function getMixins($text)
    {
        $mix = array();
        $p = "/mixins\s*:\s*[\[{][^\[\]}{]+[\]}]/";
        preg_match_all($p, $text, $match);
        $p = "/['\"]([a-zA-Z0-9._]+)['\"]/";
        foreach ($match[0] as $mixin) {
            preg_match_all($p, $mixin, $classes);
            if ($classes[1]) {
                $mix = array_merge($mix, $classes[1]);
            }
        }

        return $mix;
    }

    protected function getExtend($text)
    {
        $p = "/extend\s*:\s*['\"]([a-zA-Z0-9._]+)['\"]/";
        preg_match_all($p, $text, $answer);

        return $answer[1];
    }

    protected function getCreate($text)
    {
        $p = "/Ext.create ['\"]([a-zA-Z0-9.]+)['\"]/";
        preg_match_all($p, $text, $answer);

        return $answer[1];
    }

}