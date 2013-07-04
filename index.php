<?php
/**
 * Front controller.
 *
 * @package Packagename
 * @subpackage Index
 * @copyright 2013 Max Roeleveld
 */

setlocale(LC_ALL, array('nl_NL.utf-8'));
require_once __DIR__ . '/vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

$data = array();

$app = new Silex\Application();
$app->register(
    new Silex\Provider\SessionServiceProvider(),
    array('session.storage.options' => array('name' => 'sessid'))
);
$app->register(
    new Silex\Provider\TwigServiceProvider(),
    array(
        'twig.path' => __DIR__ . '/views',
        'twig.options' => array('debug' => true, 'cache' => false)
    )
);
$app->register(
    new Silex\Provider\DoctrineServiceProvider(),
    array(
        'db.options' => array(
            'driver' => 'pdo_mysql',
            'dbname' => 'CHANGEME',
            'user' => 'CHANGEME',
            'password' => 'CHANGEME',
            'charset' => 'utf8',
            'driverOptions' => array(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES utf8')
        )
    )
);

$app->get(
    '/',
    function () use ($app, $data) {
        return $app['twig']->render('index.twig', $data);
    }
);

$app->run();
