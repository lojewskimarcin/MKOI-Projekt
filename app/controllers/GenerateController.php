<?php

/**
 * Controller for the generate page.
 */
class GenerateController extends Controller
{

    /**
     * Returns view for the generate page.
     *
     * @return mixed view for the generate page.
     */
    public function showPage()
    {
        $menuItem = MenuItems::GENERATE;
        return View::make('generate', array('menuItem' => $menuItem));
    }

    /**
     * Returns view for the start page.
     *
     * @return mixed view for the start page.
     */
    public function showStartPage()
    {
        return Redirect::to('generate');
    }

    /**
     * Checks if supplier number is prime number
     *
     * @param $number number to check
     *
     * @return mixed is prime number
     */
    public function isPrime($number)
    {
        $isPrime = !(gmp_prob_prime($number) === 0);
        return Response::json(array('isPrime' => $isPrime));
    }

    /**
     * Checks if supplied number is coprime with (number1 - 1) * (number2 - 1)
     *
     * @param $number number to check
     * @param $number1 number to check
     * @param $number2 number to check
     *
     * @return mixed are coprime numbers
     */
    public function areCoprime($number, $number1, $number2)
    {
        $areCoprime = gmp_strval(gmp_gcd($number, gmp_mul(($number1 - 1), ($number2 - 1)))) === '1';
        return Response::json(array('areCoprime' => $areCoprime));
    }

    /**
     * Generates data base on input form
     *
     * @return mixed view with the results or error if data is wrong
     */
    public function generate()
    {
        print_r(Input::except('_token'));
        /*
         * blum-micali_cb
         * rsa_cb
         * first_num_bm
         * second_num_bm
         * seed_bm
         * max_number_bm
         * count_bm
         * first_num_rsa
         * second_num_rsa
         * coprime_num_rsa
         * seed_rsa
         * count_rsa
         */
    }
}
