<?php
namespace App\Controller;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

final class HomeController extends BaseController
{
    public function dispatch(Request $request, Response $response, $args)
    {
        $this->logger->info("Home page action dispatched");

       // $this->flash->addMessage('info', 'Sample flash message');
		$sql="SELECT * FROM Users";
		$stmt=$this->em->getConnection()->prepare($sql);
		$result = $stmt->execute();
		echo $result;

        $this->view->render($response, 'home.twig');
        return $response;
    }
	
    public function sendMail($email, $username, $auth_code)
    {
		$mail = new PHPMailer(true);

		try {
			//Server settings
			//$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
			$mail->isSMTP();                                            // Send using SMTP
			$mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
			$mail->SMTPAuth   = true;                                   // Enable SMTP authentication
			$mail->Username   = 'wptjd6141@gmail.com';                     // SMTP username
			$mail->Password   = 'wpgns213';                               // SMTP password
			$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
			$mail->Port       = 587;                                    // TCP port to connect to

			//Recipients
			$mail->setFrom($email, 'J3SUNG Lee');
			$mail->addAddress($email);               // Name is optional
			// $mail->addReplyTo('info@example.com', 'Information');
			// $mail->addCC('cc@example.com');
			// $mail->addBCC('bcc@example.com');

			// Attachments
			// $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
			// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

			// Content
			$mail->isHTML(true);                                  // Set email format to HTML
			$mail->Subject = 'Website Activation Email';
			$mail->Body    = '<h1>THANK YOU123</h1> Please Click the link to activate your account.';
			$mail->AltBody = 'Thank you . Please Click the link to activate your account.';

			$mail->send();
			 //echo "<script>alert(\"Send Mail ($email)\");</script>";
			 echo 'Message has been sent <br>$auth_code';
			return 0;
		} catch (Exception $e) {
			 echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
			return -1;
		}
    }

    public function junk(Request $request, Response $response, $args)
    {
		echo "owen was here";
		
		print_r($myname);
		$myname = 'J3SUNG Lee';
		var_dump($myname);

		echo "<br />\n";

		$my_array = array("fname"=>"J3SUNG", "lname"=>"Lee");
		print_r($myname);
		echo "<br />\n";
		var_dump($my_array);

		die("stop here " . print_r($my_array, true));

		exit;
    }

    public function signup(Request $request, Response $response, $args)
    {
		$this->view->render($response, 'register.twig');
    }
	
	public function login(Request $request, Response $response, $args)
    {
		$this->view->render($response, 'login.twig');
    }
	
	public function forgotten(Request $request, Response $response, $args)
    {
		$this->view->render($response, 'forgotten.twig');
    }
	
    public function forgotten_check(Request $request, Response $response, $args)
    {
		$username = $_GET['username'];
		$email = $_GET['email'];

		$data = $request->getParsedBody();
		
		$sql = "select username from Users where (username = :username AND email = :email)";
		$stmt = $this->em->getConnection()->prepare($sql);
		//$params['username'] = $data['username'];
		$params['username'] = $username;
		$params['email'] = $email;
		$stmt->execute($params);
		
		$results = $stmt->fetchAll();	//fetch 한개만 나오고, fetchAll 여러개 값들 다 나옴

		if($results) {
			$auth_code = password_hash($username, PASSWORD_DEFAULT);
			// $sql = "insert into Auths(username, auth_code) values($username, $auth_code)";
			// $stmt = $this->em->getConnection()->prepare($sql);
			// $stmt->execute();
			echo "<script>alert(\"match!\");</script>";
			$this->sendMail($email, $username, $auth_code);
			$this->view->render($response, 'forgotten_auth.twig', ['username'=>$username, 'email'=>$email]);
		}
		else {
			echo "<script>alert(\"Not Found Mached Data\");</script>";
			$this->view->render($response, 'forgotten.twig', ['username'=>$username, 'email'=>$email]);
		}

		// return $response->withStatus(200)
		// ->withHeader('Content-Type', 'application/json')
		// ->write(json_encode($json_array));
    }


    public function forgotten_auth(Request $request, Response $response, $args)
    {
		$myname = "J3SUNG LEE";
		$yourname = 'Owen';

		$this->view->render($response, 'forgotten_auth.twig', ['myname'=>$myname, 'fakevariable' => "$1000 Million", 'post' => $_POST]);
    }

    public function forgotten_new_password(Request $request, Response $response, $args)
    {
		$myname = "J3SUNG LEE";
		$yourname = 'Owen';

		$this->view->render($response, 'forgotten_new_password.twig', ['myname'=>$myname, 'fakevariable' => "$1000 Million", 'post' => $_POST]);
    }

    public function forgotten_new_password_confirm(Request $request, Response $response, $args)
    {
		$myname = "J3SUNG LEE";
		$yourname = 'Owen';
		//$password = $_GET["password"];
		$password1 = $_GET["password1"];
		$password2 = $_GET["password2"];
		
		//echo "{$password}<br>";
		//echo "{$password1}<br>";
		//echo "{$password2}<br>";
		
		if ($password1 == $password2){
			echo "<script>alert(\"Confirm to change password\");</script>";
			$this->view->render($response, 'login.twig', ['myname'=>$myname, 'fakevariable' => "$1000 Million", 'post' => $_POST]);
		}
		else{
			echo "<script>alert(\"Each password does not match\");</script>";
			$this->view->render($response, 'forgotten_new_password.twig', ['myname'=>$myname, 'fakevariable' => "$1000 Million", 'post' => $_POST]);

		}
    }

    public function home(Request $request, Response $response, $args)
    {
		$myname = "J3SUNG LEE";
		$yourname = 'Owen';

		$this->view->render($response, 'home.twig', ['myname'=>$myname, 'fakevariable' => "$1000 Million", 'post' => $_POST]);
    }

    public function signIn(Request $request, Response $response, $args)
    {
		//$data = $request->getParesedBody();
		
		$Pusername = $_POST['username'];
		$Ppassword = $_POST['password'];
		$Pdevice=$_POST['device'];
		$sql="SELECT hashed_password FROM Users WHERE username=:username";

		$stmt=$this->em->getConnection()->prepare($sql);
		$stmt->bindValue(":username",$Pusername);
		$resultCount = $stmt->execute();
		$row = $stmt->fetch();
		
		if(password_verify($Ppassword,$row[hashed_password])){
			$data = ['result'=>true];
			if($Pdevice==0){
			}else{
				$this->view->render($response, 'login.twig', ['post' => $_POST]);				
			}
		}else{	
			$data = ['result'=>false];		
		}
		header('Content-type: application/json');
		echo json_encode($data);
    }

    public function handlesignup(Request $request, Response $response, $args)
    {
	// $_GET is an array
	// $_POST is an array

		print_r($_POST);
		
		$sql = "select id from users where email = '" . $_POST['email'] . "'";
		echo $sql;

		exit;
	
        $this->view->render($response, 'signup.twig', ['myname'=>$myname, 'fakevariable' => "$1000 Million", 'post' => $_POST]);
    }

    public function viewPost(Request $request, Response $response, $args)
    {
        $this->logger->info("View post using Doctrine with Slim 3");

        $messages = $this->flash->getMessage('info');

        try {
            $post = $this->em->find('App\Model\Post', intval($args['id']));
        } catch (\Exception $e) {
            echo $e->getMessage();
            die;
        }

        $this->view->render($response, 'post.twig', ['post' => $post, 'flash' => $messages]);
        return $response;
	}
	
	public function testQuery(Request $request, Response $response, $args)
	{
		$sql = "select fname from Users where (fname = :id1 OR fname = :id2)";
		$stmt = $this->em->getConnection()->prepare($sql);
		$params['id1'] = 'Yunkwon';
		$params['id2'] = 'Seungsoo';
		$stmt->execute($params);
		
		$results = $stmt->fetchAll();	//fetch 한개만 나오고, fetchAll 여러개 값들 다 나옴
		//print_r($results);

		return $response->withStatus(200)
		->withHeader('Content-Type', 'application/json')
		->write(json_encode($results));

		$this->view->render($response, 'map.twig', ['results'=>$results]);
	}

	public function testJSON(Request $request, Response $response, $args)
    {
		$my_array = array();
		$my_array[] = array("name"=>"J3SUNG", "address"=>"123 Pine");
		$my_array[] = array("status"=>"EUNJAE", "address"=>"7600 Pennsylvania");
		return $response->withStatus(200)
		->withHeader('Content-Type', 'application/json')
		->write(json_encode($my_array));
	}
	
	public function longerpath(Request $request, Response $response, $args)
    {
		var_dump($args['start']);
		var_dump($args['end']);
		
		exit;
			$my_array = array();
			$my_array[] = array("name"=>"J3SUNG", "address"=>"123 Pine");
			$my_array[] = array("status"=>"EUNJAE", "address"=>"7600 Pennsylvania");
			return $response->withStatus(200)
			->withHeader('Content-Type', 'application/json')
			->write(json_encode($my_array));
	}
	
	public function receive(Request $request, Response $response, $args)
    {
		$data = $request->getParsedBody();
		
		$sql = "select * from Users where (username = :id)";
		$stmt = $this->em->getConnection()->prepare($sql);
		$params['id'] = $data['username'];
		$stmt->execute($params);
		
		$results = $stmt->fetchAll();	//fetch 한개만 나오고, fetchAll 여러개 값들 다 나옴
		if($results) {
			$json_array = array("status" => "fail", "message" => "User already exists");
		}
		else {
			$json_array = array("status" => "true");
		}

		return $response->withStatus(200)
		->withHeader('Content-Type', 'application/json')
		->write(json_encode($json_array));

		print_r($results);

		// return $response->withStatus(200)
		// ->withHeader('Content-Type', 'application/json')
		// ->write(json_encode($results));

		// echo "I see your birthday is " . $data['birthday'];
		// echo "<br />\n";
		// foreach($data as $field){
		// 	print_r($field);
		// }
		// var_dump($data);
		// exit;
    }
}
