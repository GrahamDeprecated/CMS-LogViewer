<?php namespace GrahamCampbell\CMSLogViewer\Classes;

/**
 * This file is part of CMS LogViewer by Graham Campbell.
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 */

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Psr\Log\LogLevel;
use ReflectionClass;

class LogViewer
{    
    public $path;
    public $sapi;
    public $date;
    public $level;
    public $empty;
    
    /**
     * Create a new LogViewer.
     * 
     * @param  string  $app
     * @param  string  $sapi
     * @param  string  $date
     * @param  string  $level
     */
    public function __construct($app, $sapi, $date, $level = 'all')
    {
        $log_dirs = Config::get('cms-logviewer::log_dirs');
        $this->path = $log_dirs[$app];
        $this->sapi = $sapi;
        $this->date = $date;
        $this->level = $level;
    }
    
    /**
     * Check if the log is empty.
     * 
     * @return bool
     */
    public function isEmpty()
    {
        return $this->empty;
    }
    
    /**
     * Open and parse the log.
     * 
     * @return array
     */
    public function log()
    {
        $this->empty = true;
        $log = array();
        
        $pattern = "/\[\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}\].*/";
        
        $log_levels = $this->getLevels();
        
        $log_file = glob($this->path.'/log-'.$this->sapi.'*-'.$this->date.'.txt');
        
        if (!empty($log_file)) {
            $this->empty = false;
            $file = File::get($log_file[0]);
            
            preg_match_all($pattern, $file, $headings);
            $log_data = preg_split($pattern, $file);
            
            if ($log_data[0] < 1) {
                $trash = array_shift($log_data);
                unset($trash);
            }
            
            foreach ($headings as $h) {
                for ($i=0, $j = count($h); $i < $j; $i++) {
                    foreach ($log_levels as $ll) {
                        if ($this->level == $ll OR $this->level == 'all') {
                            if (strpos(strtolower($h[$i]), strtolower('.'.$ll))) {
                                $log[] = array('level' => $ll, 'header' => $h[$i], 'stack' => $log_data[$i]);
                            }
                        }
                    }
                }
            }
        }
        
        unset($headings);
        unset($log_data);
        
        $log = array_reverse($log);

        return $log;
    }
    
    /**
     * Delete the log.
     * 
     * @return bool
     */
    public function delete()
    {
        $log_file = glob($this->path.'/log-'.$this->sapi.'*-'.$this->date.'.txt');
        
        if (!empty($log_file)) {
            return File::delete($log_file[0]);
        }
    }
    
    /**
     * Get the log levels from psr/log.
     * 
     * @return array
     */
    public function getLevels()
    {
        $class = new ReflectionClass(new LogLevel);
        return $constants = $class->getConstants();
    }
}
