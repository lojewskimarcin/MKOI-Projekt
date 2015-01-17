<?php

/**
 * Controller for Chi Square
 */
class ChiSquareController extends BaseController
{

    /**
     * Gets results for Chi Square test
     *
     * @param $generator name of the generator
     *
     * @return array array of results
     */
    public static function getChiSquareResults($generator)
    {
        if ($generator === 'bm') {
            $bm = Session::get('bm');
            if (!isset($bm['chi_square'])) {
                $results = ResultsController::getBlumMicaliResults();
                $max = ResultsController::getMaxBlumMicali();

                $chiSquare = ChiSquareController::calculateChiSquare($results, $max);

                $bm['chi_square'] = $chiSquare;
                Session::put('bm', $bm);
            }
            return Session::get('bm')['chi_square'];
        } elseif ($generator == 'rsa') {
            $rsa = Session::get('rsa');
            if (!isset($rsa['chi_square'])) {
                $results = ResultsController::getRsaResults();
                $max = ResultsController::getMaxRsa();

                $chiSquare = ChiSquareController::calculateChiSquare($results, $max);

                $rsa['chi_square'] = $chiSquare;
                Session::put('rsa', $rsa);
            }
            return Session::get('rsa')['chi_square'];
        }
    }

    /**
     * Calculates Chi Square
     *
     * @param $results array of results
     * @param $max string maximum number to generate
     *
     * @return array Chi Square result
     */
    private static function calculateChiSquare($results, $max)
    {
        $freqs = ChiSquareController::getFrequencies($results);
        bcscale(10);
        $n_r = bcdiv(count($results), $max);
        $chiSquare = 0;
        foreach ($freqs as $value => $count) {
            $f = bcsub($count, $n_r);
            $chiSquare = bcmul($f, $f);
        }
        $chiSquare = bcdiv($chiSquare, $n_r);
        $passed = bccomp(abs(bcsub($chiSquare, $max)), bcmul(2, bcsqrt($max))) <= 0;
        return array('calculated' => $chiSquare, 'passed' => $passed);
    }

    /**
     * @param array $numbers array of results
     *
     * @return array of frequencies
     */
    private static function getFrequencies(array $numbers)
    {
        $freqs = array();
        foreach ($numbers as $number) {
            if (isset($freqs[$number])) {
                $freqs[$number] = $freqs[$number] + 1;
            } else {
                $freqs[$number] = 1;
            }
        }
        return $freqs;
    }
}
