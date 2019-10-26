<?php
/**
 * User: diegofonseca
 * Date: 09/01/14
 * Time: 13:37
 */
$configuration = array(
    'db' => array(
        'dbname' => 'db_conges',
        'user' => 'root',
        'password' => 'root',
        'host' => 'mysql',
        'driver' => 'pdo_mysql'
    ),
    'annotation' => true,
    'getter_setter' => true,
    'entities'  =>  array('name' => 'Entities', 'path'  => __DIR__."/data/Entities"),
    'proxies'   =>  array('name' => 'Proxies',  'path'  => __DIR__."/data/Proxies"),
    'message' => '<strong>Entities generated with successful.</strong>',
    'display_error' => "On"
);
