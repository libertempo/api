<?php declare(strict_types = 1);
namespace LibertAPI\Tests\Units\Tools\Controllers;

use LibertAPI\Utilisateur\UtilisateurEntite;

/**
 * Classe de test du contrôleur de grand responsable de groupe
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina
 *
 * @since 1.0
 */
final class GroupeGrandResponsableController extends GroupeResponsableController
{
    /**
     * {@inheritdoc}
     */
    protected function initRepository()
    {
        $this->mockGenerator->orphanize('__construct');
        $this->mockGenerator->shuntParentClassCalls();
        $this->repository = new \mock\LibertAPI\Groupe\GrandResponsable\GrandResponsableRepository();
    }
}
