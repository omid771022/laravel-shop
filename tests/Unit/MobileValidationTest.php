<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Rules\ValidMobile;
class MobileValidationTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_mobile_can_not_be_less_then_10_character(){
     $result = (new ValidMobile())->passes('', '097689399');

     
      $this->assertEquals(0, $result);




    }

}
