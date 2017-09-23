<?php
namespace LibertAPI\Tests\Units\Tools\Libraries;

/**
 * Classe commune de test du DAO
 *
 * @author Prytoegrian <prytoegrian@protonmail.com>
 * @author Wouldsmina
 *
 * @since 0.1
 */
abstract class ADao extends \Atoum
{
    /**
     * @var \PDO Mock du connecteur
     */
    protected $connector;

    /**
     * @var \PDOStatement Mock du curseur de résultat PDO
     */
    protected $statement;

    /**
     * Init des tests
     */
    public function beforeTestMethod($method)
    {
        $this->mockGenerator->orphanize('__construct');
        $this->mockGenerator->shuntParentClassCalls();
        $this->statement = new \mock\PDOStatement();
        $this->statement->getMockController()->execute = '';
        $this->mockGenerator->orphanize('__construct');
        $this->mockGenerator->shuntParentClassCalls();
        $this->connector = new \mock\PDO();
        $this->connector->getMockController()->prepare = $this->statement;
    }
}