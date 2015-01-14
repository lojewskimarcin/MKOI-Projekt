<?php

/**
 * Controller for statistics tests
 */
class StatisticsController extends BaseController
{
    public static $STATISTICS_TESTS = array('mean', 'variation', 'standard_deviation', 'average_deviation');

    /**
     * Gets results for statistics test
     *
     * @param $generator name of the generator
     * @param $test name of the test
     *
     * @return array array of results
     */
    public static function getStatisticsResults($generator, $test)
    {
        if ($generator === 'bm') {
            $bm = Session::get('bm');
            if (!isset($bm['statistics'])) {
                $results = ResultsController::getBlumMicaliResults();
                $max = ResultsController::getMaxBlumMicali();

                $mean = StatisticsController::calculateMean($results, $max);

                $statistics = array();
                $statistics['mean'] = $mean;

                $variation = StatisticsController::calculateVariation($results, $max, $mean['calculated']);
                $statistics['variation'] = $variation;

                $standardDeviation = StatisticsController::calculateStandardDeviation($max, $variation['calculated']);
                $statistics['standard_deviation'] = $standardDeviation;

                $averageDeviation = StatisticsController::calculateAverageDeviation($results, $max, $mean['calculated']);
                $statistics['average_deviation'] = $averageDeviation;

                $bm['statistics'] = $statistics;
                Session::put('bm', $bm);
            }
            return Session::get('bm')['statistics'][$test];
        } elseif ($generator == 'rsa') {
            $rsa = Session::get('rsa');
            if (!isset($rsa['statistics'])) {
                $results = ResultsController::getRsaResults();
                $max = ResultsController::getMaxRsa();

                $mean = StatisticsController::calculateMean($results, $max);

                $statistics = array();
                $statistics['mean'] = $mean;

                $variation = StatisticsController::calculateVariation($results, $max, $mean['calculated']);
                $statistics['variation'] = $variation;

                $standardDeviation = StatisticsController::calculateStandardDeviation($max, $variation['calculated']);
                $statistics['standard_deviation'] = $standardDeviation;

                $averageDeviation = StatisticsController::calculateAverageDeviation($results, $max, $mean['calculated']);
                $statistics['average_deviation'] = $averageDeviation;

                $rsa['statistics'] = $statistics;
                Session::put('rsa', $rsa);
            }
            return Session::get('rsa')['statistics'][$test];
        }
    }

    /**
     * Calculates mean value
     *
     * @param $results array of results
     * @param $max string maximum number to generate
     *
     * @return array mean value
     */
    private static function calculateMean($results, $max)
    {
        $ideal = gmp_div($max, 2);
        $sum = gmp_init(0);
        foreach ($results as $result) {
            $sum = gmp_add($sum, $result);
        }
        $mean = gmp_div($sum, count($results));
        $absolute = gmp_abs(gmp_sub($ideal, $mean));
        $relative = bcdiv(gmp_strval($absolute), gmp_strval($ideal), 10);
        return array('ideal' => gmp_strval($ideal), 'calculated' => gmp_strval($mean),
            'absolute' => gmp_strval($absolute), 'relative' => ($relative));
    }

    /**
     * Calculates variation
     *
     * @param $results array of results
     * @param $max string maximum number to generate
     * @param $mean string mean value of results
     *
     * @return array variation
     */
    private static function calculateVariation($results, $max, $mean)
    {
        $ideal = gmp_div(gmp_pow($max, 2), 12);
        $sum = gmp_init(0);
        foreach ($results as $result) {
            $sum = gmp_add($sum, gmp_pow(gmp_sub($result, $mean), 2));
        }
        $variation = gmp_div($sum, count($results) - 1);
        $absolute = gmp_abs(gmp_sub($ideal, $variation));
        $relative = bcdiv(gmp_strval($absolute), gmp_strval($ideal), 10);
        return array('ideal' => gmp_strval($ideal), 'calculated' => gmp_strval($variation),
            'absolute' => gmp_strval($absolute), 'relative' => ($relative));
    }

    /**
     * Calculates standard deviation
     *
     * @param $max string maximum number to generate
     * @param $variation string variation value of results
     *
     * @return array variation
     */
    private static function calculateStandardDeviation($max, $variation)
    {
        bcscale(10);
        $ideal = bcdiv($max, bcmul(2, bcsqrt(3)), 0);
        $standardDeviation = gmp_sqrt($variation);
        $absolute = gmp_abs(gmp_sub($ideal, $standardDeviation));
        $relative = bcdiv(gmp_strval($absolute), $ideal);
        return array('ideal' => $ideal, 'calculated' => gmp_strval($standardDeviation),
            'absolute' => gmp_strval($absolute), 'relative' => ($relative));
    }

    /**
     * Calculates average deviation
     *
     * @param $results array of results
     * @param $max string maximum number to generate
     * @param $mean string mean value of results
     *
     * @return array variation
     */
    private static function calculateAverageDeviation($results, $max, $mean)
    {
        $ideal = gmp_div($max, 4);
        $sum = gmp_init(0);
        foreach ($results as $result) {
            $sum = gmp_add($sum, gmp_abs(gmp_sub($result, $mean)));
        }
        $averageDeviation = gmp_div($sum, count($results));
        $absolute = gmp_abs(gmp_sub($ideal, $averageDeviation));
        $relative = bcdiv(gmp_strval($absolute), gmp_strval($ideal), 10);
        return array('ideal' => gmp_strval($ideal), 'calculated' => gmp_strval($averageDeviation),
            'absolute' => gmp_strval($absolute), 'relative' => ($relative));
    }
}
