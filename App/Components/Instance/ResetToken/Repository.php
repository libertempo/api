<?php
namespace App\Components\Instance\ResetToken;

/**
 * Garant de la cohérence métier et des interactions avec le stockage.
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina
 *
 * @since 0.2
 * @see \Tests\Units\App\Components\Instance\ResetToken\Repository
 *
 * Ne devrait être contacté que par le Instance\ResetToken\Controller
 * Ne devrait contacter que le Instance\ResetToken\Dao
 */
class Repository
{
    /**
     * @var \App\Libraries\ADao $dao Data Access Object
     */
    protected $dao;

    public function __construct(\App\Libraries\ADao $dao)
    {
        $this->dao = $dao;
    }
}
