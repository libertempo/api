<?php declare(strict_types = 1);
namespace LibertAPI\Tests\Functionals;

class GroupeResponsableCest extends BaseTestCest
{
    public function testListeOK(\ApiTester $i)
    {
        $i->sendGET('/groupe/2/responsable');

        $i->seeDataEquals(1);
    }

    public function testListeKO(\ApiTester $i)
    {
        $i->sendGET('/groupe/1000/responsable');

        $this->seeResponseNoContent($i);
    }
}
