<?php declare(strict_types = 1);
namespace LibertAPI\Tools\Services;

use LibertAPI\Tools\Libraries\ARepository;

/**
 * Service d'authentification interne (dbconges)
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina
 *
 * @since 1.1
 */
class InterneAuthentifierService extends AAuthentifierFactoryService
{
    public function __construct(ARepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * {@inheritDoc}
     */
    public function isAuthentificationSucceed(string $login, string $password) : bool
    {
        $utilisateur = $this->repository->find([
            'login' => $login,
            'isActif' => true,
        ]);

        return $utilisateur->isPasswordMatching($password);
    }

    /**
     * @var ARepository Repository utilisateur
     */
    private $repository;
}
