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

namespace GrahamCampbell\CMSLogViewer\Subscribers;

use GrahamCampbell\CMSCore\Facades\PageProvider;
use GrahamCampbell\Navigation\Facades\Navigation;
use GrahamCampbell\Credentials\Facades\Credentials;

/**
 * This is the navigation subscriber class.
 *
 * @package    CMS-LogViewer
 * @author     Graham Campbell
 * @copyright  Copyright (C) 2013-2014  Graham Campbell
 * @license    https://github.com/GrahamCampbell/CMS-LogViewer/blob/master/LICENSE.md
 * @link       https://github.com/GrahamCampbell/CMS-LogViewer
 */
class NavigationSubscriber
{

    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher  $events
     * @return array
     */
    public function subscribe($events)
    {
        $events->listen('navigation.main', 'GrahamCampbell\CMSLogViewer\Subscribers\NavigationSubscriber@onNavigationMain', 7);
        $events->listen('navigation.bar', 'GrahamCampbell\CMSLogViewer\Subscribers\NavigationSubscriber@onNavigationBar', 7);
    }

    /**
     * Handle a navigation.main event.
     *
     * @param  mixed  $event
     * @return void
     */
    public function onNavigationMain($event)
    {
        if (PageProvider::getNavUser()) {
            if (Credentials::hasAccess('admin')) {
                // add the logviewer link
                Navigation::addMain(array('title' => 'Logs', 'slug' => 'logviewer', 'icon' => 'wrench'), 'admin');
            }
        }
    }

    /**
     * Handle a navigation.bar event.
     *
     * @param  mixed  $event
     * @return void
     */
    public function onNavigationBar($event)
    {
        if (PageProvider::getNavUser()) {
            if (Credentials::hasAccess('admin')) {
                // add the logviewer link
                Navigation::addBar(array('title' => 'View Logs', 'slug' => 'logviewer', 'icon' => 'wrench'));
            }
        }
    }
}
