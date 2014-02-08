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

return array(

    /*
    |--------------------------------------------------------------------------
    | Log Directories
    |--------------------------------------------------------------------------
    |
    | This defines the paths to the log directories.
    |
    | Default to array('app' => storage_path().'/logs').
    |
    */

    'log_dirs' => array('app' => storage_path().'/logs'),

    /*
    |--------------------------------------------------------------------------
    | Logs Per Page
    |--------------------------------------------------------------------------
    |
    | This defines how many log entries are displayed per page.
    |
    | Default to 20.
    |
    */

    'per_page' => 20

);
