<?php

/**
 * Controller for Rsa generator
 */
class RsaController extends BaseController
{

    /**
     * Generates pseudorandom sequence
     *
     * @param $fn number p
     * @param $sn number q
     * @param $cn number e
     * @param $seed number seed
     * @param $mn number number of bits in generated number
     * @param $count number of numbers to generate
     */
    public function generate($fn, $sn, $cn, $seed, $mn, $count)
    {
        if (!($this->validate($fn, $sn, $cn, $seed, $count))) {
            App::abort(500);
        }
        $tmp = array();
        $results = array();
        for ($i = 1; $i <= gmp_strval(gmp_mul($count, $mn)); $i++) {
            $seed = $this->nextNumber($seed, $cn, gmp_mul($fn, $sn), $mn);
            $tmp[] = $seed;
            if ($i % $mn === 0) {
                $results[] = $this->arrayToNumber($tmp);
                $tmp = array();
            }
        }
        Session::put('rsa', $results);
    }

    /**
     * Validates input data
     *
     * @param $fn number p
     * @param $sn number q
     * @param $cn number e
     * @param $seed number seed
     * @param $count number of numbers to generate
     *
     * @return bool if arguments are correct
     */
    public function validate($fn, $sn, $cn, $seed, $count)
    {
        $gen = App::make('GenerateController');
        if (!$gen->isPrime($fn) || !$gen->isPrime($sn) || !$gen->areCoprime($cn, $fn, $sn)
        ) {
            return false;
        }
        if (gmp_cmp(gmp_mul(($fn), ($sn)), $seed) == -1) {
            return false;
        }
        if ($count < 1) {
            return false;
        }
        return true;
    }

    /**
     * Generates next pseudorandom sequence number
     *
     * @param $x mixed number or GMP number
     * @param $e mixed number or GMP number
     * @param $N mixed number or GMP number
     *
     * @return number  next pseudorandom sequence number
     */
    private function nextNumber($x, $e, $N)
    {
        return gmp_powm($x, $e, $N);
    }

    /**
     * Converts number array to number
     *
     * @param $array array of numbers
     * @return GMP number
     */
    private function arrayToNumber($array)
    {
        $result = gmp_init(0);
        for ($i = 0; $i < count($array); $i++) {
            $result = gmp_add($result, gmp_mul(gmp_pow(2, $i), gmp_mod($array[$i], 2)));
        }
        return $result;
    }
}
