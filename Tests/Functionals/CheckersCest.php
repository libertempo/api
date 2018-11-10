<?php declare(strict_types = 1);
namespace LibertAPI\Tests\Functionals;

/**
 * Classe de test des vérifications communes
 */
class CheckersCest extends BaseTestCest
{
    public function testUnauthorized(\ApiTester $i)
    {
        $i->deleteHeader('Token');
        $i->sendGET('/groupe');

        $i->seeResponseCodeIs(401);
    }

    public function testBadRequest(\ApiTester $i)
    {
        $i->deleteHeader('Accept');
        $i->sendGET('/groupe');

        $i->seeResponseCodeIs(400);
    }
}
