<?php
namespace LibertAPI\Journal;

use LibertAPI\Tools\Libraries\AEntite;

/**
 * {@inheritDoc}
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina
 *
 * @since 0.5
 * @see \LibertAPI\Tests\Units\Journal\JournalRepository
 */
class JournalRepository extends \LibertAPI\Tools\Libraries\ARepository
{
    /*************************************************
     * GET
     *************************************************/

    /**
     * @inheritDoc
     */
    public function getOne($id)
    {
        throw new \RuntimeException('Journal#' . $id . ' is not a callable resource');
    }

    /**
     * @inheritDoc
     */
    final protected function getParamsConsumer2Dao(array $paramsConsumer)
    {
        $filterInt = function ($var) {
            return filter_var(
                $var,
                FILTER_VALIDATE_INT,
                ['options' => ['min_range' => 1]]
            );
        };
        $results = [];
        if (!empty($paramsConsumer['limit'])) {
            $results['limit'] = $filterInt($paramsConsumer['limit']);
        }
        if (!empty($paramsConsumer['start-after'])) {
            $results['lt'] = $filterInt($paramsConsumer['start-after']);
        }
        if (!empty($paramsConsumer['start-before'])) {
            $results['gt'] = $filterInt($paramsConsumer['start-before']);
        }
        return $results;
    }

    /*************************************************
     * POST
     *************************************************/

    /**
     * @inheritDoc
     */
    public function postOne(array $data, AEntite $entite)
    {
        throw new \RuntimeException('Action is forbidden');
    }

    /*************************************************
     * PUT
     *************************************************/

    /**
     * @inheritDoc
     */
    public function putOne(array $data, AEntite $entite)
    {
        throw new \RuntimeException('Action is forbidden');
    }

    /*************************************************
     * DELETE
     *************************************************/

    /**
     * @inheritDoc
     */
    public function deleteOne(AEntite $entite)
    {
        throw new \RuntimeException('Action is forbidden');
    }
}
