<?php

/**
 * Controller for Blum-Micali generator
 */
class BlumMicaliController extends BaseController
{

    /**
     * Generates pseudorandom sequence
     *
     * @param $fn number a
     * @param $sn number p
     * @param $seed number seed
     * @param $mn number number of bits in generated number
     * @param $count number of numbers to generate
     */
    public function generate($fn, $sn, $seed, $mn, $count)
    {
        if (!($this->validate($fn, $sn, $seed, $count))) {
            App::abort(500);
        }
        $tmp = array();
        $results = array();
        for ($i = 1; $i <= gmp_strval(gmp_mul($count, $mn)); $i++) {
            $seed = $this->nextNumber($fn, $sn, $seed);
            $tmp[] = $seed;
            if ($i % $mn === 0) {
                $results[] = $this->arrayToNumber($tmp, $sn);
                $tmp = array();
            }
        }
        Session::put('bm', $results);
    }

    /**
     * Validates input data
     *
     * @param $fn number a
     * @param $sn number p
     * @param $seed number seed
     * @param $count number of numbers to generate
     *
     * @return bool if arguments are correct
     */
    public function validate($fn, $sn, $seed, $count)
    {
        $gen = App::make('GenerateController');
        if (!$gen->isPrime($fn) || !$gen->isPrime($sn)) {
            return false;
        }
        if ($count < 1 || $seed < 0) {
            return false;
        }
        return true;
    }

    /**
     * Generates next pseudorandom sequence number
     *
     * @param $a mixed number or GMP number
     * @param $p mixed number or GMP number
     * @param $x mixed number or GMP number
     *
     * @return number  next pseudorandom sequence number
     */
    private function nextNumber($a, $p, $x)
    {
        return gmp_powm($a, $x, $p);
    }

    /**
     * Converts number array to number
     *
     * @param $array array of numbers
     * @param $p mixed number or GMP number
     *
     * @return GMP number
     */
    private function arrayToNumber($array, $p)
    {
        $result = gmp_init(0);
        $tmp = 0;
        for ($i = 0; $i < count($array); $i++) {
            if (gmp_cmp($array[$i], gmp_div(gmp_sub($p, 1), 2)) == -1) {
                $tmp = 1;
            }
            $result = gmp_add($result, gmp_mul(gmp_pow(2, $i), $tmp));
        }
        return $result;
    }
}
