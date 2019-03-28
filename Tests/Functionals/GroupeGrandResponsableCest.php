<?php declare(strict_types = 1);
namespace LibertAPI\Tests\Functionals;

class GroupeGrandResponsableCest extends BaseTestCest
{
    public function testListe(\ApiTester $i)
    {
        $i->sendGET('/groupe/2/grand_responsable');

        $i->seeDataEquals(1);
    }

    public function testListeKO(\ApiTester $i)
    {
        $i->sendGET('/groupe/1/grand_responsable');

        $this->seeResponseNoContent($i);
    }
}
