<?php

/**
 * Tests RSA generator
 */
class RsaTest extends TestCase
{
    /**
     * Test for RSA generator
     */
    public function testRsaGenerator()
    {
        $this->rsaGeneratorTest(array(
            'rsa_cb' => 'rsa',
            'first_num_rsa' => '5',
            'second_num_rsa' => '5',
            'coprime_num_rsa' => '3',
            'seed_rsa' => '2',
            'max_number_rsa' => '3',
            'count_rsa' => '5',
        ), array('4', '0', '1', '2', '4'));
    }

    /**
     * Tests RSA generator
     *
     * @param $parameters array form parameters
     * @param $exceptedResults array excepted results
     */
    private function rsaGeneratorTest($parameters, $exceptedResults)
    {
        $crawler = $this->client->request('GET', 'generate');
        $form = $crawler->selectButton('submit_btn')->form();
        $form->setValues($parameters);
        $this->client->submit($form);
        $this->assertSessionHas('rsa');

        $results = ResultsController::getRsaResults();
        $this->assertEquals(count($results), count($exceptedResults));

        for ($i = 0; $i < count($results); $i++) {
            $this->assertEquals($results[$i], $exceptedResults[$i]);
        }
        $this->client->restart();
    }
}
