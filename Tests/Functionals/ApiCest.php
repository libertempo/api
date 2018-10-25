<?php
class ApiCest
{
    public function testHelloWorld(ApiTester $i)
    {
        $i->haveHttpHeader('Content-Type', 'application/json');
        $i->haveHttpHeader('Accept', 'application/json');

        $i->sendGET('/hello_world');

        $i->seeResponseCodeIs(200);
        $i->seeResponseIsJson();
        $i->seeResponseEquals('"Hi there !"');
    }
}
