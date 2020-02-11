<?php
namespace App\Controller;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

define('SIGN_UP', 0);
define('FORGOTTEN', 1);
define('INTMAX', 2147483647);
define('WEB',0);
define('ANDROID',1);
final class HomeController extends BaseController
{
    public function dispatch(Request $request, Response $response, $args)
    {
    	$this->view->render($response, 'login.twig');
	}

    public function signup(Request $request, Response $response, $args)
    {
		$this->view->render($response, 'signup.twig');
    }
	
	public function login(Request $request, Response $response, $args)
    {
		$this->view->render($response, 'login.twig');
    }
	
	public function forgotten(Request $request, Response $response, $args)
    {
		$this->view->render($response, 'forgotten.twig');
    }

    public function forgotten_auth(Request $request, Response $response, $args)
    {
		$this->view->render($response, 'forgotten_auth.twig');
    }

    public function forgotten_new_password(Request $request, Response $response, $args)
    {
		$this->view->render($response, 'forgotten_new_password.twig');
    }

    public function home(Request $request, Response $response, $args)
    {
		$this->view->render($response, 'home.twig');
    }

	public function change_password_page(Request $request, Response $response, $args){
		$this->view->render($response, 'change_password_page.twig');
	}

	public function id_cancelation_page(Request $request, Response $response, $args)
	{
		$this->view->render($response, 'id_cancelation_page.twig');
	}

	public function maps(Request $request, Response $response, $args)
	{
		$this->view->render($response, 'maps.twig');
	}
}