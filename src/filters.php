<?php

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

Route::filter('logviewer.logs', function () {
    $logs = array();
    $sapis = array(
        'apache' => 'Apache',
        'cgi-fcgi' => 'Fast CGI',
        'fpm-fcgi' => 'Nginx',
        'cli' => 'CLI'
    );

    foreach ($sapis as $sapi => $human) {
        $logs[$sapi]['sapi'] = $human;
        $dirs = Config::get('cms-logviewer::log_dirs');
        $files = array();

        foreach ($dirs as $app => $dir) {
            $files[$app] = glob($dir.'/log-'.$sapi.'*', GLOB_BRACE);
            if (is_array($files[$app])) {
                $files[$app] = array_reverse($files[$app]);
                foreach ($files[$app] as &$file) {
                    $file = preg_replace('/.*(\d{4}-\d{2}-\d{2}).*/', '$1', basename($file));
                }
            } else {
                $files[$app] = array();
            }
        }

        $logs[$sapi]['logs'] = $files;
    }

    View::share('logs', $logs);
});

Route::filter('logviewer.messages', function () {
    if (Session::has('success') || Session::has('error') || Session::has('info')) {
        View::share('has_messages', true);
    } else {
        View::share('has_messages', false);
    }
});
