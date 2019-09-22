<?php declare(strict_types = 1);
namespace LibertAPI\Tests\Functionals;

class SoldeCest extends BaseTestCest
{
    public function testListe(\ApiTester $i)
    {
        $i->sendGET('/employe/me/solde');

        $this->seeResponseOK($i);
    }
}
