<?php declare(strict_types = 1);
namespace LibertAPI\Tests\Functionals;

class GroupeGrandResponsableCest extends BaseTestCest
{
    public function testListe(\ApiTester $i)
    {
        $i->sendGET('/groupe/2/grand_responsable');

        $this->seeResponseNoContent($i);
    }
}
