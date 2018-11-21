<?php declare(strict_types = 1);
namespace LibertAPI\Tests\Functionals;

class PlanningCreneauCest extends BaseTestCest
{
    public function testListeFull(\ApiTester $i)
    {
        $i->sendGET('/planning/1/creneau');

        $this->seeResponseOK($i);
    }

    public function testListeEmpty(\ApiTester $i)
    {
        $i->sendGET('/planning/2/creneau');

        $this->seeResponseNoContent($i);
    }

    public function testOneError(\ApiTester $i)
    {
        $i->sendGET('/planning/1/creneau/1');

        $i->seeResponseCodeIs(500);
    }
}
