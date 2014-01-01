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

namespace GrahamCampbell\Tests\CMSLogViewer;

use GrahamCampbell\Tests\CMSCore\AbstractTestCase as TestCase;

/**
 * This is the abstract test case class.
 *
 * @package    CMS-LogViewer
 * @author     Graham Campbell
 * @copyright  Copyright (C) 2013-2014  Graham Campbell
 * @license    https://github.com/GrahamCampbell/CMS-LogViewer/blob/develop/LICENSE.md
 * @link       https://github.com/GrahamCampbell/CMS-LogViewer
 */
abstract class AbstractTestCase extends TestCase
{
    /**
     * Get the application base path.
     *
     * @return string
     */
    protected function getBasePath()
    {
        return __DIR__.'/../../../../src';
    }

    /**
     * Get the required service providers.
     *
     * @return array
     */
    protected function getRequiredServiceProviders()
    {
        return array_merge(parent::getRequiredServiceProviders(), array(
            'GrahamCampbell\CMSCore\CMSCoreServiceProvider'
        ));
    }

    /**
     * Get the service provider class.
     *
     * @return string
     */
    protected function getServiceProviderClass()
    {
        return 'GrahamCampbell\CMSLogViewer\CMSLogViewerServiceProvider';
    }
}
