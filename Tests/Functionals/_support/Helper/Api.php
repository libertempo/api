<?php
namespace LibertAPI\Tests\Functionals\_support\Helper;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

class Api extends \Codeception\Module
{
    /**
     * Check that the data list size is equals to expected
     */
    final public function seeDataEquals(int $value)
    {
        $rest = $this->getModule('REST');
        $rest->seeResponseIsJson();
        $response = json_decode($rest->grabResponse());

        $this->assertEquals($value, count($response->data));

    }
}
