<?php namespace GrahamCampbell\CMSLogViewer\Controllers;

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

use Carbon\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Paginator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Pagination\Environment;
use GrahamCampbell\Binput\Facades\Binput;
use GrahamCampbell\CMSLogViewer\Classes\LogViewer;
use GrahamCampbell\CMSCore\Controllers\BaseController;

class LogViewerController extends BaseController {

    /**
     * Constructor (setup access permissions).
     *
     * @return void
     */
    public function __construct() {
        $this->setPermissions(array(
            'getIndex'  => 'admin',
            'getDelete' => 'admin',
            'getShow'   => 'admin'
        ));

        parent::__construct();
    }

    /**
     * Redirect to the show page.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex() {
        $sapi = php_sapi_name();

        if (preg_match('/apache.*/', $sapi)) {
            $sapi = 'apache';
        }

        $today = Carbon::today()->format('Y-m-d');

        $dirs = Config::get('cms-logviewer::log_dirs');
        reset($dirs);
        $path = key($dirs);

        if (Session::has('success') || Session::has('error')) {
            Session::reflash();
        }

        return Redirect::to('logviewer/'.$path.'/'.$sapi.'/'.$today.'/all');
    }

    /**
     * Delete the log.
     *
     * @return \Illuminate\Http\Response
     */
    public function getDelete($path, $sapi, $date) {
        $logviewer = new LogViewer($path, $sapi, $date);

        if ($logviewer->delete()) {
            $today = Carbon::today()->format('Y-m-d');
            return Redirect::to('logviewer/'.$path.'/'.$sapi.'/'.$today.'/all')->with('success', 'Log deleted successfully!');
        } else {
            return Redirect::to('logviewer/'.$path.'/'.$sapi.'/'.$date.'/all')->with('error', 'There was an error while deleting the log.');
        }
    }

    /**
     * Show the log viewing page.
     *
     * @return \Illuminate\Http\Response
     */
    public function getShow($path, $sapi, $date, $level = null) {
        if (is_null($level) || !is_string($level)) {
            $level = 'all';
        }

        $page = Binput::get('page');
        if (is_null($page) || empty($page)) {
            $page = '1';
        }

        $logviewer = new LogViewer($path, $sapi, $date, $level);
        $levels = $logviewer->getLevels();

        $sapis = array(
            'apache' => 'Apache',
            'cgi-fcgi' => 'Fast CGI',
            'fpm-fcgi' => 'Nginx',
            'cli' => 'CLI'
        );

        $data = array(
            'date'       => $date,
            'sapi'       => $sapis[$sapi],
            'sapi_plain' => $sapi,
            'url'        => 'logviewer',
            'data_url'   => URL::route('logviewer.index').'/data/'.$path.'/'.$sapi.'/'.$date.'/'.$level.'?page='.$page,
            'levels'     => $levels,
            'current'    => $level,
            'path'       => $path
        );

        return $this->viewMake('cms-logviewer::show', $data, true);
    }

    /**
     * Show the log contents.
     *
     * @return \Illuminate\Http\Response
     */
    public function getData($path, $sapi, $date, $level = null) {
        $this->checkAjax();

        if (is_null($level) || !is_string($level)) {
            $level = 'all';
        }

        $logviewer = new LogViewer($path, $sapi, $date, $level);
        $log = $logviewer->log();
        $page = Paginator::make($log, count($log), Config::get('cms-logviewer::per_page', 20));
        $page->setBaseUrl('logviewer/'.$path.'/'.$sapi.'/'.$date.'/'.$level);

        $sapis = array(
            'apache' => 'Apache',
            'cgi-fcgi' => 'Fast CGI',
            'fpm-fcgi' => 'Nginx',
            'cli' => 'CLI'
        );

        $data = array(
            'paginator'  => $page,
            'log'        => (count($log) > $page->getPerPage() ? array_slice($log, $page->getFrom()-1, $page->getPerPage()) : $log),
            'empty'      => $logviewer->isEmpty()
        );

        return $this->viewMake('cms-logviewer::data', $data, true);
    }
}
