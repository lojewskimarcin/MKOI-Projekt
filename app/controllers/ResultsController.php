<?php

/**
 * Controller for the results page.
 */
class ResultsController extends BaseController
{

    /**
     * Gets results of Blum-Micali generator
     *
     * @return array results of Blum-Micali generator
     */
    public static function getBlumMicaliResults()
    {
        return Session::get('bm')['results'];
    }

    /**
     * Gets results of RSA generator
     *
     * @return array results of RSA generator
     */
    public static function getRsaResults()
    {
        return Session::get('rsa')['results'];
    }

    /**
     * @return string maximum generated number for Blum-Micali
     */
    public static function getMaxBlumMicali()
    {
        return gmp_strval(gmp_sub(gmp_pow(2, Session::get('bm')['bits']), 1));
    }

    /**
     * @return string maximum generated number for RSA
     */
    public static function getMaxRsa()
    {
        return gmp_strval(gmp_sub(gmp_pow(2, Session::get('rsa')['bits']), 1));
    }

    /**
     * Gets paginator for data
     *
     * @param $data array data to be shown
     * @param $perPage int items per page
     * @param null $page int page number
     * @return Paginator
     */
    public static function paginateArray($data, $perPage, $page = null)
    {
        $page = $page ? (int)$page * 1 : (isset($_REQUEST['page']) ? (int)$_REQUEST['page'] * 1 : 1);
        $offset = ($page * $perPage) - $perPage;
        return Paginator::make(array_slice($data, $offset, $perPage, true), count($data), $perPage);
    }

    /**
     * Returns view for the results page.
     *
     * @return mixed view for the generate page.
     */
    public function showPage()
    {
        if (!ResultsController::areAvailable()) {
            return Redirect::to('/start');
        } elseif (ResultsController::isBlumMicali() && !ResultsController::isRsa()) {
            return Redirect::to('/results/blummicali');
        } elseif (!ResultsController::isBlumMicali() && ResultsController::isRsa()) {
            return Redirect::to('/results/rsa');
        } elseif (ResultsController::isBlumMicali() && ResultsController::isRsa()) {
            $menuItem = MenuItems::RESULTS;
            $resultsItem = ResultsItems::ALL;
            return View::make('results/results', array('menuItem' => $menuItem, 'resultsItem' => $resultsItem));
        }
    }

    /**
     * Checks if results are available
     *
     * @return bool if results are available
     */
    public static function areAvailable()
    {
        if (Session::has('bm') || Session::has('rsa')) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Checks if results for Blum-Micali are available
     *
     * @return bool if results are available
     */
    public static function isBlumMicali()
    {
        if (Session::has('bm')) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Checks if results for RSA are available
     *
     * @return bool if results are available
     */
    public static function isRsa()
    {
        if (Session::has('rsa')) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Returns view for the Blum-Micali results page.
     *
     * @return mixed view for the generate page.
     */
    public function showBlumMicaliPage()
    {
        if (!ResultsController::isBlumMicali()) {
            return Redirect::to('/results');
        }
        $menuItem = MenuItems::RESULTS;
        $resultsItem = ResultsItems::BLUM_MICALI;
        return View::make('results/results', array('menuItem' => $menuItem, 'resultsItem' => $resultsItem));
    }

    /**
     * Returns view for the RSA results page.
     *
     * @return mixed view for the generate page.
     */
    public function showRsaPage()
    {
        if (!ResultsController::isRsa()) {
            return Redirect::to('/results');
        }
        $menuItem = MenuItems::RESULTS;
        $resultsItem = ResultsItems::RSA;
        return View::make('results/results', array('menuItem' => $menuItem, 'resultsItem' => $resultsItem));
    }
}
