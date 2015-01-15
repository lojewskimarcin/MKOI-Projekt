<?php

/**
 * Controller for Runs Test
 */
class RunsTestController extends BaseController
{

    /**
     * Gets results for Runs test
     *
     * @param $generator name of the generator
     *
     * @return array array of results
     */
    public static function getRunsTestResults($generator)
    {
        if ($generator === 'bm') {
            $bm = Session::get('bm');
            if (!isset($bm['runs_test'])) {
                $results = ResultsController::getBlumMicaliResults();

                $runs = RunsTestController::calculateRuns($results);

                $bm['runs_test'] = $runs;
                Session::put('bm', $bm);
            }
            return Session::get('bm')['runs_test'];
        } elseif ($generator == 'rsa') {
            $rsa = Session::get('rsa');
            if (!isset($rsa['runs_test'])) {
                $results = ResultsController::getRsaResults();

                $runs = RunsTestController::calculateRuns($results);

                $rsa['runs_test'] = $runs;
                Session::put('rsa', $rsa);
            }
            return Session::get('rsa')['runs_test'];
        }
    }

    /**
     * Calculate Runs number based on results
     *
     * @param $results array of results
     *
     * @return array calculated Runs number
     */
    private static function calculateRuns($results)
    {
        $last = -1;
        $ups = -1;
        $downs = 0;
        foreach ($results as $result) {
            $cmp = gmp_cmp($last, $result);
            if ($cmp > 0) {
                $downs++;
            } elseif ($cmp < 0) {
                $ups++;
            }
            $last = $result;
        }

        return array('ups' => $ups, 'downs' => $downs);
    }
}
