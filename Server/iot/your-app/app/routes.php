<?php
// Routes

$app->get('/', 'App\Controller\HomeController:login')
    ->setName('login');

$app->get('/sendmail', 'App\Controller\HomeController:sendMail')
    ->setName('sendmail');

$app->get('/signup', 'App\Controller\HomeController:signup')
    ->setName('signup');

$app->get('/login', 'App\Controller\HomeController:login')
    ->setName('login');

$app->post('/signIn', 'App\Controller\HomeController:signIn')
    ->setName('signIn');

$app->post('/signout', 'App\Controller\HomeController:signout')
    ->setName('signout');

$app->post('/changePassword', 'App\Controller\HomeController:changePassword')
    ->setName('changePassword');

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

$app->post('/signup_check', 'App\Controller\HomeController:signup_check')
    ->setName('signup_check');

$app->get('/signup_authorization', 'App\Controller\HomeController:signup_authorization')
    ->setName('signup_authorization');

$app->get('/id_cancelation_page', 'App\Controller\HomeController:id_cancelation_page')
    ->setName('id_cancelation_page');

$app->post('/id_cancelation', 'App\Controller\HomeController:id_cancelation')
    ->setName('id_cancelation');
 
$app->get('/change_password_page', 'App\Controller\HomeController:change_password_page')
->setName('change_password_page');