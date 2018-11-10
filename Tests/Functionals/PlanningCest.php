<?php declare(strict_types = 1);
namespace LibertAPI\Tests\Functionals;

class PlanningCest extends BaseTestCest
{
    public function testListe(\ApiTester $i)
    {
        $i->sendGET('/planning');

        $this->seeResponseOK($i);
    }

    public function testOneOK(\ApiTester $i)
    {
        $i->sendGET('/planning/2');

        $this->seeResponseOK($i);
    }

    public function testOneKO(\ApiTester $i)
    {
        $i->sendGET('/planning/1000');

        $this->seeResponseNotFound($i);
    }
}
