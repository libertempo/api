<?php declare(strict_types = 1);
namespace LibertAPI\Tests\Units\Heure\Additionnelle;

/**
 * Classe de test du repository de l'heure de Additionnelle
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina
 *
 * @since 1.8
 */
final class AdditionnelleRepository extends \LibertAPI\Tests\Units\Tools\Libraries\ARepository
{
    final protected function getStorageContent() : array
    {
        return [
            'id_heure' => 42,
            'login' => 'Sherlock',
            'debut' => 7427,
            'fin' => 4527,
            'duree' => 78,
            'type_periode' => 26,
            'statut' => 3,
            'comment' => 'Arsène',
            'comment_refus' => 'Lupin',
        ];
    }

    protected function getConsumerContent() : array
    {
        return [
            'login' => 'Watson',
            'debut' => 77,
            'fin' => 89432,
        ];
    }
}
