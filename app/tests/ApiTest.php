<?php

/**
 * Tests API located in application
 */
class ApiTest extends TestCase
{
    /**
     * Tests /api/isPrime
     */
    function testIsPrime()
    {
        $url = 'api/isPrime/';
        $primes = array('2', '13', '17', '3533', '1125899839733759', '1298074214633706835075030044377087',
            '43143988327398957279342419750374600193');
        foreach ($primes as $prime) {
            $this->client->restart();
            $response = $this->call('GET', $url . $prime);
            $this->assertResponseOk();
            $this->assertEquals('{"isPrime":true}', $response->getContent());
        }

        $nonePrimes = array('4', '8', '25', '3534', '1125899839733760', '1298074214633706835075030044377100',
            '43143988327398957279342419750374600293');
        foreach ($nonePrimes as $nonePrime) {
            $this->client->restart();
            $response = $this->call('GET', $url . $nonePrime);
            $this->assertResponseOk();
            $this->assertEquals('{"isPrime":false}', $response->getContent());
        }
    }

    /**
     * Tests /api/areCoprime
     */
    function testAreCoprime()
    {
        $url = 'api/areCoprime/';
        $coprimes = array(array(2, 2, 2), array(2, 12, 8), array(5, 5, 5));
        foreach ($coprimes as $coprime) {
            $this->client->restart();
            $response = $this->call('GET', $url . $coprime[0] . ',' . $coprime[1] . ',' . $coprime[2]);
            $this->assertResponseOk();
            $this->assertEquals('{"areCoprime":true}', $response->getContent());
        }

        $noneCoprimes = array(array(5, 6, 6), array(2, 8, 7), array(9, 10, 4));
        foreach ($noneCoprimes as $noneCoprime) {
            $this->client->restart();
            $response = $this->call('GET', $url . $noneCoprime[0] . ',' . $noneCoprime[1] . ',' . $noneCoprime[2]);
            $this->assertResponseOk();
            $this->assertEquals('{"areCoprime":false}', $response->getContent());
        }
    }
}
