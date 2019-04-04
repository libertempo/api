<?php declare(strict_types = 1);
namespace LibertAPI\Tests\Functionals;

class GroupeEmployeCest extends BaseTestCest
{
    public function testListeOK(\ApiTester $i)
    {
        $i->sendGET('/groupe/2/employe');

        $i->seeDataEquals(1);
    }

    public function testListeKO(\ApiTester $i)
    {
        $i->sendGET('/groupe/1000/employe');

        $this->seeResponseNoContent($i);
    }
}
