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

$app->post('/signin', 'App\Controller\UserManagement:signin')
    ->setName('signin');

$app->post('/home', 'App\Controller\UserManagement:home')
    ->setName('home');

$app->get('/signout', 'App\Controller\UserManagement:signout')
    ->setName('signout');

$app->post('/changePassword', 'App\Controller\UserManagement:changePassword')
    ->setName('changePassword');

//DataManagement route (Not sure to make. If functions in DataManagement is not called from FrontEnd, This section dosen't need.)
$app->get('/db_data_for_map', 'App\Controller\DataManagement:db_data_for_map')
    ->setName('db_data_for_map');

$app->get('/map_view', 'App\Controller\DataManagement:map_view')
    ->setName('map_view');

$app->get('/senser_view', 'App\Controller\DataManagement:senser_view')
    ->setName('senser_view');

$app->get('/fakesensors_as_json', 'App\Controller\DataManagement:fakesensors_as_json')
    ->setName('fakesensors_as_json');

$app->get('/charts/chartdata-as-json', 'App\Controller\ChartsController:chart1_json')
    ->setName('/chart1_json');

$app->get('/charts/chart1', 'App\Controller\ChartsController:chart1')
    ->setName('/chart1');

$app->get('/charts/dynamic_chart_json', 'App\Controller\ChartsController:dynamic_chart_json')
    ->setName('/dynamic_chart_json');

$app->get('/charts/chart2_json', 'App\Controller\ChartsController:chart2_json')
    ->setName('/chart2_json');

$app->get('/charts/chart3_json', 'App\Controller\ChartsController:chart3_json')
    ->setName('/chart3_json');

$app->get('/charts/chart3', 'App\Controller\ChartsController:chart3')
    ->setName('/chart3');

$app->get('/air_chart', 'App\Controller\ChartsController:air_chart')
    ->setName('/air_chart');

$app->get('/heart_chart', 'App\Controller\ChartsController:heart_chart')
    ->setName('/heart_chart');

$app->get('/charts/receive_combobox', 'App\Controller\ChartsController:receive_combobox')
    ->setName('/charts/receive_combobox');

$app->get('/infowindow_to_chart', 'App\Controller\DataManagement:infowindow_to_chart')
    ->setName('/infowindow_to_chart');