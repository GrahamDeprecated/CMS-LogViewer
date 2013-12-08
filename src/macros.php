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
 *
 * @package    CMS-LogViewer
 * @author     Graham Campbell
 * @license    GNU AFFERO GENERAL PUBLIC LICENSE
 * @copyright  Copyright (C) 2013  Graham Campbell
 * @link       https://github.com/GrahamCampbell/CMS-LogViewer
 */

HTML::macro('nav_item', function($url, $text, $a_attr = array(), $active_class = 'active', $li_attrs = array()) {
    $href = HTML::link($url, $text, $a_attr);
    $response = '';
    
    if (Request::is($url) || Request::is($url.'/*')) {
        if (isset($li_attrs['class'])) {
            $li_attrs['class'] .= ' '.$active_class;
        } else {
            $li_attrs['class'] = $active_class;
        }
    }
    
    return '<li '.HTML::attributes($li_attrs).'>'.$href.'</li>';
});
