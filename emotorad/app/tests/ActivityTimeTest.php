<?php

namespace Tests;

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class ActivityTimeTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testActivityTimeTest()
    {
        $this->get('/student-activity-time?user_id=user137,user164&activity_id=Math-1');
        $res = '{"user137":[99,90,910,103],"user164":[100,90,910,103]}';
        $this->assertEquals(
           $res , $this->response->getContent()
        );
    }
}
