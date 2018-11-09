<?php declare(strict_types = 1);
namespace LibertAPI\Tests\Functionals;

class GroupeEmployeCest extends BaseTestCest
{
    public function testListe(\ApiTester $i)
    {
        $i->sendGET('/groupe/2/employe');

        $this->seeResponseNoContent($i);
    }
}
