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
<<<<<<< Updated upstream
	//Request $request, Response $response, $args
	//e-mail sender : under the check of all input
    public function sendMail($email, $username, $auth_code, $temp)
	{
		//data for email phpmailer
		if($temp == SIGN_UP)
		{
			$message = "<a href=http://teamc-iot.calit2.net/signup_authorization?link=$auth_code&user=$username&temp=$temp>
						<img src='cid:Logoimage'></a><h1>THANK YOU</h1><h2>Please Click the image above to activate your account.</h2>
						<br>";
		}
		else if($temp == FORGOTTEN)
		{
			$message = "<img src='cid:Logoimage'><h1>Don't Worry</h1><h2>Your New Temporary Password is Issued Below</h2>
						<br>$auth_code<br>";
		}
					
		//email send (problem occur : maybe composer process need)
		$mail = new PHPMailer(true);

		try {
			//Server settings
			//$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
			/*$mail->isSMTP();                                            // Send using SMTP
			$mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
			$mail->SMTPAuth   = true;                                   // Enable SMTP authentication
			$mail->Username   = 'wptjd6141@gamil.com';                     // SMTP username
			$mail->Password   = 'wpgns213';                               // SMTP password
			$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
			$mail->Port       = 587;                                    // TCP port to connect to

			//Recipients
			$mail->setFrom($email, $username);
			$mail->addAddress($email);               // Name is optional
			//$mail->addReplyTo('info@example.com', 'Information');
			//$mail->addCC('cc@example.com');
			//$mail->addBCC('bcc@example.com');
			//Attachments
			//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
			//$mail->addAttachment('images/icon/logo.png', 'new.jpg');    // Optional name  'images/icon/logo.png', 'testImage', 'images/icon/logo.png'
			//Content
			$mail->isHTML(true);                                  // Set email format to HTML
			$mail->Subject = "SuiteCar Issued E-mail to $username";
			$mail->AddEmbeddedImage('images/logo.png', 'Logoimage');
			$mail->Body=$message;
			$mail->AltBody = 'Thank you . Please Click the link to activate your account.';
			$mail->send();*/
			echo "<script>alert(\"E-mail has been sent. Check your E-mail.\");</script>";
			echo "<script>location.replace('login')</script>";

			echo "not server setting<br>";
		}
		catch (Exception $e) {
			echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
			//$this->view->render($response, 'failure_page.twig', ['alert_message' => "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"]);
	}
=======
>>>>>>> Stashed changes

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