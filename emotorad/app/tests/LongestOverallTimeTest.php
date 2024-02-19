<?php

namespace Tests;

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class LongestOverallTimeTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_that_base_endpoint_returns_a_successful_response()
    {
        $this->get('/longest-overall-time');
        $res = '{"activity_id":"Math-1","avgtime":"1442.6000"}';
        $this->assertEquals(
           $res , $this->response->getContent()
        );
    }
}
