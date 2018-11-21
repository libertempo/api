<?php declare(strict_types = 1);
namespace LibertAPI\Tests\Functionals;

class GroupeCest extends BaseTestCest
{
    public function testListe(\ApiTester $i)
    {
        $i->sendGET('/groupe');

        $this->seeResponseOK($i);
    }

    public function testOneOK(\ApiTester $i)
    {
        $i->sendGET('/groupe/2');

        $this->seeResponseOK($i);
    }

    public function testOneKO(\ApiTester $i)
    {
        $i->sendGET('/groupe/1000');

        $this->seeResponseNotFound($i);
    }
}
