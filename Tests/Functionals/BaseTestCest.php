<?php declare(strict_types = 1);
namespace LibertAPI\Tests\Functionals;

class BaseTestCest
{
    public function _before(\ApiTester $i)
    {
        $i->haveHttpHeader('stage', 'ci');
        $i->haveHttpHeader('Content-Type', 'application/json');
        $i->haveHttpHeader('Accept', 'application/json');
        $i->haveHttpHeader('Token', '$2y$10$2lNXyfseRGRWBwEzX0SVGeVfVmm0Rich75LZnS.rnQ3NEo2JjvtiK');
    }

    final protected function seeResponseOK(\ApiTester $i)
    {
        //$i->seeResponseEquals('');
        $i->seeResponseIsJson();
        $i->seeResponseCodeIs(200);
    }

    final protected function seeResponseNotFound(\ApiTester $i)
    {
        //$i->seeResponseEquals('');
        $i->seeResponseIsJson();
        $i->seeResponseCodeIs(404);
    }

    final protected function seeResponseNoContent(\ApiTester $i)
    {
        //$i->seeResponseEquals('');
        $i->seeResponseIsJson();
        $i->seeResponseCodeIs(204);
    }
}
