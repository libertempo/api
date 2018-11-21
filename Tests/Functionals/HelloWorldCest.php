<?php declare(strict_types = 1);
namespace LibertAPI\Tests\Functionals;

class HelloWorldCest
{
    public function _before(\ApiTester $i)
    {
        $i->haveHttpHeader('stage', 'ci');
    }

    public function testOk(\ApiTester $i)
    {
        $i->haveHttpHeader('Content-Type', 'application/json');
        $i->haveHttpHeader('Accept', 'application/json');

        $i->sendGET('/hello_world');

        $i->seeResponseCodeIs(200);
        $i->seeResponseIsJson();
        $i->seeResponseEquals('"Hi there !"');
    }

    public function testWithoutHeaders(\ApiTester $i)
    {
        $i->sendGET('/hello_world');

        $i->seeResponseCodeIs(400);
    }
}
