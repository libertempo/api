<?php declare(strict_types = 1);
namespace LibertAPI\Tests\Functionals;

class GroupeResponsableCest extends BaseTestCest
{
    public function testListe(\ApiTester $i)
    {
        $i->sendGET('/groupe/2/responsable');

        $this->seeResponseNoContent($i);
    }
}
