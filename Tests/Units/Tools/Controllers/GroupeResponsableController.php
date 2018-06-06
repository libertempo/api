<?php declare(strict_types = 1);
namespace LibertAPI\Tests\Units\Tools\Controllers;

use LibertAPI\Utilisateur\UtilisateurEntite;

/**
 * Classe de test du contrôleur de responsable de groupe
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina
 *
 * @since 0.7
 */
class GroupeResponsableController extends GroupeEmployeController
{
    /**
     * {@inheritdoc}
     */
    protected function initRepository()
    {
        $this->mockGenerator->orphanize('__construct');
        $this->mockGenerator->shuntParentClassCalls();
        $this->repository = new \mock\LibertAPI\Groupe\Responsable\ResponsableRepository();
    }
}
