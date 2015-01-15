<?php

/**
 * Controller for tests
 */
class TestsController extends BaseController
{
    /**
     * Returns view for the tests page.
     *
     * @return mixed view for the tests page.
     */
    public function showPage()
    {
        if (!ResultsController::areAvailable()) {
            return Redirect::to('/start');
        } else {
            $menuItem = MenuItems::TESTS;
            return View::make('tests/all', array('menuItem' => $menuItem));
        }
    }

    /**
     * Returns view for the statistics tests page.
     *
     * @return mixed view for the tests page.
     */
    public function showStatisticsPage()
    {
        if (!ResultsController::areAvailable()) {
            return Redirect::to('/start');
        } else {
            $menuItem = MenuItems::TESTS;
            return View::make('tests/statistics', array('menuItem' => $menuItem));
        }
    }

    /**
     * Returns view for the MC tests page.
     *
     * @return mixed view for the tests page.
     */
    public function showMcPage()
    {
        if (!ResultsController::areAvailable()) {
            return Redirect::to('/start');
        } else {
            $menuItem = MenuItems::TESTS;
            return View::make('tests/mc', array('menuItem' => $menuItem));
        }
    }

    /**
     * Returns view for the runs test page.
     *
     * @return mixed view for the runs test page.
     */
    public function showRunsTestPage()
    {
        if (!ResultsController::areAvailable()) {
            return Redirect::to('/start');
        } else {
            $menuItem = MenuItems::TESTS;
            return View::make('tests/runstest', array('menuItem' => $menuItem));
        }
    }
}
