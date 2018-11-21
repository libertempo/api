<?php declare(strict_types = 1);
namespace LibertAPI\Tests\Functionals;

class JournalCest extends BaseTestCest
{
    public function testListe(\ApiTester $i)
    {
        $i->sendGET('/journal');

        $this->seeResponseOK($i);
    }
}
