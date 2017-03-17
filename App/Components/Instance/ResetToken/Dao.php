<?php
namespace App\Components\Instance\ResetToken;

/**
 * DAO du mécanisme de la redéfinition du token d'instance
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina
 *
 * @since 0.2
 *
 * Ne devrait être contacté que par Instance\ResetToken\Repository
 * Ne devrait contacter personne
 */
class Dao
{
    /**
     * @var \PDO Connecteur à la BDD
     */
    protected $storageConnector;

    public function __construct(\PDO $storageConnector)
    {
        $this->storageConnector = $storageConnector;
    }
}
