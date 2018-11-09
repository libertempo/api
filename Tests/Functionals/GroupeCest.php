<?php declare(strict_types = 1);
namespace LibertAPI\Tests\Functionals;

class GroupeCest
{
    public function _before(\ApiTester $i)
    {
        $i->haveHttpHeader('stage', 'ci');
        $i->haveHttpHeader('Content-Type', 'application/json');
        $i->haveHttpHeader('Accept', 'application/json');
        $i->haveHttpHeader('Token', '$2y$10$2lNXyfseRGRWBwEzX0SVGeVfVmm0Rich75LZnS.rnQ3NEo2JjvtiK');
    }


    public function testListe(\ApiTester $i)
    {
        $i->sendGET('/absence/type');

        $i->seeResponseCodeIs(200);
        $i->seeResponseIsJson();
        //$i->seeResponseEquals('');
    }

    public function testOneOK(\ApiTester $i)
    {
        $i->sendGET('/absence/type/2');

        $i->seeResponseCodeIs(200);
        $i->seeResponseIsJson();
        //$i->seeResponseEquals('');
    }

    public function testOneKO(\ApiTester $i)
    {
        $i->sendGET('/absence/type/1000');

        $i->seeResponseCodeIs(404);
        $i->seeResponseIsJson();
        //$i->seeResponseEquals('');
    }
}
