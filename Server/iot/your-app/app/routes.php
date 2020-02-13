<?php
// HomeController route
$app->get('/', 'App\Controller\HomeController:login')
    ->setName('login');

$app->get('/login', 'App\Controller\HomeController:login')
    ->setName('login');

$app->get('/signup', 'App\Controller\HomeController:signup')
    ->setName('signup');

$app->get('/forgotten', 'App\Controller\HomeController:forgotten')
    ->setName('forgotten');

$app->get('/forgotten_auth', 'App\Controller\HomeController:forgotten_auth')
    ->setName('forgotten_auth');
	
$app->get('/home', 'App\Controller\HomeController:home')
    ->setName('home');

$app->get('/id_cancelation_page', 'App\Controller\HomeController:id_cancelation_page')
    ->setName('id_cancelation_page');

$app->get('/change_password_page', 'App\Controller\HomeController:change_password_page')
->setName('change_password_page');

$app->get('/maps', 'App\Controller\HomeController:maps')
->setName('maps');

//UserManagement Route
$app->get('/sendmail', 'App\Controller\UserManagement:sendMail')
    ->setName('sendmail');

$app->post('/id_cancelation', 'App\Controller\UserManagement:id_cancelation')
    ->setName('id_cancelation');

$app->post('/signup_check', 'App\Controller\UserManagement:signup_check')
    ->setName('signup_check');

$app->get('/signup_authorization', 'App\Controller\UserManagement:signup_authorization')
    ->setName('signup_authorization');

$app->get('/forgotten_new_password', 'App\Controller\UserManagement:forgotten_new_password')
    ->setName('forgotten_new_password');

$app->get('/forgotten_new_password_confirm', 'App\Controller\UserManagement:forgotten_new_password_confirm')
    ->setName('forgotten_new_password_confirm');

$app->get('/forgotten_check', 'App\Controller\UserManagement:forgotten_check')
    ->setName('forgotten_check');

$app->post('/signIn', 'App\Controller\UserManagement:signIn')
    ->setName('signIn');

$app->get('/signout', 'App\Controller\UserManagement:signout')
    ->setName('signout');

$app->post('/changePassword', 'App\Controller\UserManagement:changePassword')
    ->setName('changePassword');

//DataManagement route (Not sure to make. If functions in DataManagement is not called from FrontEnd, This section dosen't need.)
$app->get('/air_data_transfer', 'App\Controller\DataManagement:air_data_transfer')
    ->setName('air_data_transfer');

$app->get('/map_view', 'App\Controller\DataManagement:map_view')
    ->setName('map_view');

$app->get('/senser_view', 'App\Controller\DataManagement:senser_view')
    ->setName('senser_view');

$app->get('/fakesensors_as_json', 'App\Controller\DataManagement:fakesensors_as_json')
    ->setName('fakesensors_as_json');