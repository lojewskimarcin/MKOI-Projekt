<?php

/**
 * Controller for MC Test
 */
class McController extends BaseController
{

    /**
     * Gets results for MC test
     *
     * @param $generator name of the generator
     *
     * @return array array of results
     */
    public static function getMcResults($generator)
    {
        if ($generator === 'bm') {
            $bm = Session::get('bm');
            if (!isset($bm['MC'])) {
                $results = ResultsController::getBlumMicaliResults();
                $max = ResultsController::getMaxBlumMicali();

                $pi = McController::calculatePi($results, $max);

                $mc = array();
                $mc['pi'] = $pi;

                $bm['MC'] = $mc;
                Session::put('bm', $bm);
            }
            return Session::get('bm')['MC']['pi'];
        } elseif ($generator == 'rsa') {
            $rsa = Session::get('rsa');
            if (!isset($rsa['MC'])) {
                $results = ResultsController::getRsaResults();
                $max = ResultsController::getMaxRsa();

                $pi = McController::calculatePi($results, $max);

                $mc = array();
                $mc['pi'] = $pi;

                $rsa['MC'] = $mc;
                Session::put('rsa', $rsa);
            }
            return Session::get('rsa')['MC']['pi'];
        }
    }

    /**
     * Calculate Pi number based on results
     *
     * @param $results array of results
     * @param $max string maximum number to generate
     *
     * @return float calculated Pi number
     */
    private static function calculatePi($results, $max)
    {
        $r2 = gmp_mul($max, $max);
        $cir = $sqr = 0;
        $x = $y = null;
        foreach ($results as $result) {
            if (is_null($x)) {
                $x = $result;
                continue;
            }
            $y = $result;
            if (gmp_cmp(gmp_add(gmp_mul($x, $x), gmp_mul($y, $y)), $r2) <= 0) {
                $cir++;
                $sqr++;
            } else {
                $sqr++;
            }
            $x = $y = null;
        }

        bcscale(10);
        $ideal = '3.1415926535';
        $calculated = bcdiv(4 * $cir, $sqr, 5);
        $absolute = str_replace('-', '', bcsub($ideal, $calculated));
        $relative = bcdiv($absolute, $ideal);

        return array('ideal' => $ideal, 'calculated' => $calculated,
            'absolute' => $absolute, 'relative' => $relative);
    }
}
