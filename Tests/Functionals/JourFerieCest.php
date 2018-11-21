<?php declare(strict_types = 1);
namespace LibertAPI\Tests\Functionals;

class JourFerieCest extends BaseTestCest
{
    public function testListe(\ApiTester $i)
    {
        $i->sendGET('/jour_ferie');

        $this->seeResponseOK($i);
    }
}
