<?php declare(strict_types = 1);
namespace LibertAPI\Tests\Functionals;

/**
 * Since theses tests aren't deterministic (they change token), they a run at the end
 */
class ZZAuthenticateUserCest extends BaseTestCest
{
    public function testConnectionBadHeaders(\ApiTester $i)
    {
        $i->sendGET('/authentification');

        $i->seeResponseCodeIs(400);
        $i->seeResponseIsJson();
    }

    public function testConnectionBadCredentials(\ApiTester $i)
    {
        $i->haveHttpHeader('Authorization', 'Basic ' . base64_encode('hr:ragondin'));

        $i->sendGET('/authentification');

        $this->seeResponseNotFound($i);
    }

    public function testConnectionGoodCredentials(\ApiTester $i)
    {
        $i->haveHttpHeader('Authorization', 'Basic ' . base64_encode('hr:hr'));

        $i->sendGET('/authentification');

        $this->seeResponseOK($i);
    }
}
