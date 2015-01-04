<?php

/**
 * Controller for the generate page.
 */
class GenerateController extends BaseController
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
        if (Session::has('rsa') || Session::has('bm')) {
            return Redirect::to('results');
        }
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
        $isPrime = !gmp_cmp(gmp_prob_prime($number), 0) == 0;
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
        $areCoprime = gmp_cmp(gmp_gcd($number, gmp_mul(gmp_sub($number1, 1), gmp_sub($number2, 1))), 1) == 0;
        return Response::json(array('areCoprime' => $areCoprime));
    }

    /**
     * Generates data base on input form
     *
     * @return mixed view with the results or error if data is wrong
     */
    public function generate()
    {
        $isSet = false;
        if (Input::get('blum-micali_cb') === 'blum-micali') {
            $isSet = true;
            App::make('BlumMicaliController')->generate(Input::get('first_num_bm'), Input::get('second_num_bm'),
                Input::get('seed_bm'), Input::get('max_number_bm'), Input::get('count_bm'));
        }
        if (Input::get('rsa_cb') === 'rsa') {
            $isSet = true;
            App::make('RsaController')->generate(Input::get('first_num_rsa'), Input::get('second_num_rsa'),
                Input::get('coprime_num_rsa'), Input::get('seed_rsa'), Input::get('max_number_rsa'),
                Input::get('count_rsa'));
        }
        if (!$isSet) {
            App::abort(500);
        }
        return Redirect::to('results');
    }
}
