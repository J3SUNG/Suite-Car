<?php
// Routes

$app->get('/', 'App\Controller\HomeController:dispatch')
    ->setName('homepage');

$app->get('/sendmail', 'App\Controller\HomeController:sendMail')
    ->setName('sendmail');

$app->get('/signup', 'App\Controller\HomeController:signup')
    ->setName('signup');

$app->get('/login', 'App\Controller\HomeController:login')
    ->setName('login');

$app->post('/signIn', 'App\Controller\HomeController:signIn')
    ->setName('signIn');

$app->get('/forgotten', 'App\Controller\HomeController:forgotten')
    ->setName('forgotten');

$app->get('/forgotten_check', 'App\Controller\HomeController:forgotten_check')
    ->setName('forgotten_check');

$app->get('/forgotten_auth', 'App\Controller\HomeController:forgotten_auth')
    ->setName('forgotten_auth');

$app->get('/forgotten_new_password', 'App\Controller\HomeController:forgotten_new_password')
    ->setName('forgotten_new_password');

$app->get('/forgotten_new_password_confirm', 'App\Controller\HomeController:forgotten_new_password_confirm')
    ->setName('forgotten_new_password_confirm');

$app->get('/ucsd/iot/testJSON/{start}/{end}', 'App\Controller\HomeController:longerpath')
    ->setName('longerpath');

$app->get('/testQuery', 'App\Controller\HomeController:testQuery')
    ->setName('testQuery');
	
$app->get('/home', 'App\Controller\HomeController:home')
    ->setName('home');

$app->post('/handlesignup', 'App\Controller\HomeController:handlesignup')
    ->setName('handlesignup');

$app->get('/post/{id}', 'App\Controller\HomeController:viewPost')
    ->setName('view_post');

$app->get('/testJSON', 'App\Controller\HomeController:testJSON')
    ->setName('testJSON');

$app->get('/ucsd/iot/testJSON/{start}/{end}/', 'App\Controller\HomeController:longerpath')
    ->setName('longerpath');

$app->post('/receive', 'App\Controller\HomeController:receive')
    ->setName('receive');