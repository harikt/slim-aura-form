<?php
// web/index.php

use Aura\Input\Builder;
use Aura\Input\Filter;

require dirname(__DIR__) . '/vendor/autoload.php';
$app = new \Slim\Slim(array(
    'templates' => dirname(__DIR__) . '/templates'
));
$app->map('/contact', function () use ($app) {
    $form = new ContactForm(new Builder(), new Filter());
    if ($app->request->isPost()) {
        $form->fill($app->request->post('contact'));
        if ($form->filter()) {
            echo "Yes successfully validated and filtered";
            var_dump($data);
            $app->halt();
        }
    }
    $app->render('contact.php', array('form' => $form));
})->via('GET', 'POST')
->name('contact');

$app->run();
