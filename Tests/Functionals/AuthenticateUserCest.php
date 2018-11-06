<?php declare(strict_types = 1);

class AuthenticateUserCest
{
    public function _before(ApiTester $i)
    {
        $i->haveHttpHeader('stage', 'ci');
        $i->haveHttpHeader('Content-Type', 'application/json');
        $i->haveHttpHeader('Accept', 'application/json');
    }

    public function testConnectionBadHeaders(ApiTester $i)
    {
        $i->sendGET('/authentification');

        $i->seeResponseCodeIs(400);
        $i->seeResponseIsJson();
    }

    public function testConnectionBadCredentials(ApiTester $i)
    {
        $i->haveHttpHeader('Authorization', 'Basic ' . base64_encode('hr:ragondin'));

        $i->sendGET('/authentification');

        $i->seeResponseCodeIs(404);
        $i->seeResponseIsJson();
    }

    public function testConnectionGoodCredentials(ApiTester $i)
    {
        $i->haveHttpHeader('Authorization', 'Basic ' . base64_encode('hr:hr'));

        $i->sendGET('/authentification');

        $i->seeResponseCodeIs(200);
        $i->seeResponseIsJson();
    }
}
