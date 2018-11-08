<?php declare(strict_types = 1);
namespace LibertAPI\Tests\Functionals;

use LibertAPI\Tests\Functionals\_support\ApiTester;

class TypeAbsenceUserCest
{
    public function _before(ApiTester $i)
    {
        $i->haveHttpHeader('stage', 'ci');
        $i->haveHttpHeader('Content-Type', 'application/json');
        $i->haveHttpHeader('Accept', 'application/json');
    }

    /*
    public function testListe(ApiTester $i)
    {
        $i->haveHttpHeader('Token', '$2y$10$7kGga5Z8nkKJn8a15h5AGuVp7Is6DcIa5iNY1qU7ybtel0fL94PCi');

        $i->sendGET('/absence/type');

        $i->seeResponseEquals('');
        $i->seeResponseCodeIs(200);
        $i->seeResponseIsJson();
    }

    /*public function testConnectionBadCredentials(ApiTester $i)
    {
        $i->haveHttpHeader('Authorization', 'Basic ' . base64_encode('hr:ragondin'));

        $i->sendGET('/authentification');

        $i->seeResponseCodeIs(404);
        $i->seeResponseIsJson();
    }

    public function testConnectionGoodCredentials(ApiTester $i)
    {
        $i->haveHttpHeader('Authorization', 'Basic ' . base64_encode('hr:hr'));

        $i->sendGET('/authentification');

        $i->seeResponseEquals('');
        $i->seeResponseCodeIs(200);
        $i->seeResponseIsJson();
    }*/
}
