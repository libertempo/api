<?php
// cli-config.php
require_once "bootstrap.php";

$productRepository = $entityManager->getRepository('LibertAPI\Absence\Periode\Entite');

$a = new LibertAPI\Absence\Periode\Entite();
$date = new \DateTimeImmutable();
$a  ->setLogUserLoginPar('bar')
    ->setLogPNum(7)
    ->setLogUserLoginPour('foo')
    ->setLogEtat('zpodjzf')
    ->setLogDate($date);

$entityManager->persist($a);
$entityManager->flush();

$products = $productRepository->findAll();


$p = $entityManager->find('LibertAPI\data\Entities\CongesLogs', 8968);

// var_dump($products);exit();

return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet($entityManager);
