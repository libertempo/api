<?php declare(strict_types = 1);
namespace LibertAPI\Tests\Functionals;

class AbsenceTypeCest extends BaseTestCest
{
    public function testListe(\ApiTester $i)
    {
        $i->sendGET('/absence/type');

        $this->seeResponseOK($i);
    }

    public function testOneOK(\ApiTester $i)
    {
        $i->sendGET('/absence/type/2');

        $this->seeResponseOK($i);
    }

    public function testOneKO(\ApiTester $i)
    {
        $i->sendGET('/absence/type/1000');

        $this->seeResponseNotFound($i);
    }
}
