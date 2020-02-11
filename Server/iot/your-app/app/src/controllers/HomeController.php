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
	
    public function forgotten_check(Request $request, Response $response, $args)
    {
		$username = $_GET['username'];
		$email = $_GET['email'];

		$data = $request->getParsedBody();
		
		$sql = "select username from Users where (username = :username AND email = :email)";
		$stmt = $this->em->getConnection()->prepare($sql);
		$params['username'] = $username;
		$params['email'] = $email;
		$stmt->execute($params);
		
		$results = $stmt->fetchAll();	//fetch 한개만 나오고, fetchAll 여러개 값들 다 나옴

		if($results) {
			$auth_code = substr(password_hash($username, PASSWORD_DEFAULT), 10, 8);
			$hashed_auth_code = password_hash($auth_code, PASSWORD_DEFAULT);

			$test = password_verify($auth_code, $hashed_auth_code);
			$this->sendMail($email, $username, $auth_code, "1");

			$sql = "UPDATE Users SET hashed_password = :password WHERE username = :username";
			$stmt = $this->em->getConnection()->prepare($sql);
			$params_pw['password'] = $hashed_auth_code;
			$params_pw['username'] = $username;
			$stmt->execute($params_pw);

			$date = date("Y-m-d");
			$sql = "UPDATE Users SET password_date = :date WHERE username = :username";
			$stmt = $this->em->getConnection()->prepare($sql);
			$params_pwd['date'] = $date;
			$params_pwd['username'] = $username;
			$stmt->execute($params_pwd);
			
			echo "<script>alert(\"sent you a temporary password via email.\");</script>";
			$this->view->render($response, 'login.twig');
		}
		else {
			echo "<script>alert(\"Not Found Mached Data\");</script>";
			$this->view->render($response, 'forgotten.twig', ['username'=>$username, 'email'=>$email]);
		}
    }

    public function forgotten_auth(Request $request, Response $response, $args)
    {
		$this->view->render($response, 'forgotten_auth.twig');
    }

    public function forgotten_new_password(Request $request, Response $response, $args)
    {
		$this->view->render($response, 'forgotten_new_password.twig');
    }

    public function forgotten_new_password_confirm(Request $request, Response $response, $args)
    {
		$password1 = $_GET["password1"];
		$password2 = $_GET["password2"];
		
		if ($password1 == $password2){
			echo "<script>alert(\"Confirm to change password\");</script>";
			$this->view->render($response, 'login.twig');
		}
		else{
			echo "<script>alert(\"Each password does not match\");</script>";
			$this->view->render($response, 'forgotten_new_password.twig');
		}
    }

    public function home(Request $request, Response $response, $args)
    {
		$this->view->render($response, 'home.twig');
    }

    public function signIn(Request $request, Response $response, $args)
    {
		$Pusername = $_POST['username'];
		$Ppassword = $_POST['password'];
		$Pdevice=$_POST['device'];
		$sql="SELECT user_no, hashed_password,password_date FROM Users WHERE username=:username";
		$stmt=$this->em->getConnection()->prepare($sql);
		$stmt->bindValue(":username",$Pusername);
		$resultCount = $stmt->execute();
		$row = $stmt->fetch();
		$str_now=strtotime(date("Y-m-d"));
		$str_db=strtotime($row['password_date']);
		
		if(password_verify($Ppassword,$row[hashed_password])){
			if($str_now>=$str_db) $result_code=2;
			else $result_code=1;

			$sql = "UPDATE Users SET login_flag = 2 WHERE user_no = :user_no";
			$stmt = $this->em->getConnection()->prepare($sql);
			$params['user_no'] =$row['user_no'];
			$stmt->execute($params);
		}else{			
			$result_code=0;		
		}
		$data=['result'=>$result_code,'user_no'=>(int)$row['user_no']];

		if($Pdevice==WEB){
			if($result_code==0){
				echo "<script>alert(\"Something is wrong.. You know what I'm Saying?!\");</script>";
				$this->view->render($response, 'login.twig');
			}else if($result_code==1){
				session_start();
				$_SESSION['user_no']=$row['user_no'];
				echo "<script>alert(\"Welcome to suiteCar!\");</script>";
				$this->view->render($response, 'home.twig', ['post' => $_POST]);	
			}else if($result_code==2){
				session_start();
				$_SESSION['user_no']=$row['user_no'];
				echo "<script>alert(\"you should change the password\");</script>";
				$this->view->render($response, 'home.twig', ['post' => $_POST]);
			}	
		}else if($Pdevice==ANDROID){
			header('Content-type: application/json');
			echo json_encode($data);
		}
		
    }

	public function signout(Request $request, Response $response, $args)
    {
		$user_no = $_GET['user_no'];
		$sql = "UPDATE Users SET login_flag = 1 WHERE user_no = :user_no";
		$stmt = $this->em->getConnection()->prepare($sql);
		$params['user_no'] = $user_no;
		$stmt->execute($params);

		$this->view->render($response, 'login.twig');
    }

	public function change_password_page(Request $request, Response $response, $args){
		$this->view->render($response, 'change_password_page.twig');
	}

	public function changePassword(Request $request, Response $response, $args)
    {
		//check the password and origin is same
		//check the password and confirm is same	Do it in js
		$Puser_no=$_POST['user_no'];
		$PoriginalPassword = $_POST['originalPassword'];
		$Ppassword = $_POST['newPassword'];
		$PpasswordConfirm = $_POST['confirmPassword'];
		$Pdevice=$_POST['device'];
		if($Pdevice==WEB){
			$Puser_no = $_SESSION['user_no'];
		}else if($Pdevice==ANDROID){
			$Puser_no=$_POST['user_no'];
		}
		$params1['user_no']=$Puser_no;
		$sql="SELECT hashed_password FROM Users WHERE user_no=:user_no";
		$stmt=$this->em->getConnection()->prepare($sql);
		$resultCount = $stmt->execute($params1);
		$row = $stmt->fetch();
		$hashed_password=$row['hashed_password'];

		//check the original password is valid
		if(password_verify($PoriginalPassword, $hashed_password)){
			$result_code=1;
			$hashed_password = password_hash($Ppassword,PASSWORD_DEFAULT);
			$sql="UPDATE Users SET hashed_password=:hashed_password, password_date=:password_date WHERE user_no=:user_no";
			$params2['user_no'] = $Puser_no;
			$params2['hashed_password'] = $hashed_password;
			$timestamp = strtotime("+6 months");
			$params2['password_date'] = date("Y-m-d", $timestamp);
			$stmt=$this->em->getConnection()->prepare($sql);
			$resultCount = $stmt->execute($params2);
		}else{	
			$result_code=0;	
		}
		
		$data = ['result'=>$result_code];

		if($Pdevice==WEB){
			if($result_code==0){
				echo "<script>alert(\"Something worng with you! Check again!\");</script>";
				$this->view->render($response, 'change_password_page.twig');
			}else if($result_code==1){
				echo "<script>alert(\"Login agian plz$resultCount\");</script>";
				$this->view->render($response, 'login.twig', ['post' => $_POST]);	
			}
		}else if($Pdevice==ANDROID){
			header('Content-type: application/json');
			echo json_encode($data);
		}
		
	}

	//Id cancelation function : erase every table related to user except outer air data
	public function id_cancelation(Request $request, Response $response, $args)
    {
		//get input data from web
		$username = $_POST['username'];
		$password = $_POST['password'];

		//check login_flag for safety
		$sql = "SELECT login_flag FROM Users WHERE username='$username';";
		$stmt= $this->em->getConnection()->prepare($sql);
		$stmt->execute();
		$temp_result = $stmt->fetch();
		$login_flag = $temp_result['login_flag'];

		//actual login_flag check for safety
		if($login_flag == 2){}
		else 
		{ 
			echo "<script>alert(\"Your Account is Not in Log-in State. Try again.\");</script>";
			echo "<script>location.replace('login')</script>"; 
		}

		//get hashed password from database
		$sql = "SELECT hashed_password FROM Users WHERE username='$username';";
		$stmt= $this->em->getConnection()->prepare($sql);
		$stmt->execute();
		$temp_result = $stmt->fetch();
		$hashed_password = $temp_result['hashed_password'];

		//compare and execute the cancelation procedure
		if(password_verify($password, $hashed_password)) // modified / if inserted password and hashed_password in db is same, execute.
		{
			try {
			//get user_no data through search of user table
			$sql = "SELECT user_no FROM Users WHERE (username = '$username');";
			$stmt= $this->em->getConnection()->prepare($sql);
			$stmt->execute();
			$temp_result = $stmt->fetch();
			$user_no = $temp_result['user_no'];
			
			//1. delete user_selection table
			$sql = "DELETE FROM User_selection WHERE (user_no = '$user_no');";
			$stmt= $this->em->getConnection()->prepare($sql);
			$stmt->execute();

			//2. delete heart data table
			$sql = "DELETE FROM Heart_data WHERE (user_no = '$user_no');";
			$stmt= $this->em->getConnection()->prepare($sql);
			$stmt->execute();

			//3. delete inner air data
			$sql = "DELETE Air_data FROM Air_data INNER JOIN Sensors ON Air_data.sensor_no = Sensors.sensor_no WHERE Sensors.type = 'I' 
					AND Sensors.user_no = $user_no";
			$stmt= $this->em->getConnection()->prepare($sql);
			$stmt->execute();

			//4. update outer air data to dummy value
			$sql = "SET foreign_key_checks = 0;
					UPDATE Air_data INNER JOIN Sensors ON Sensors.user_no = $user_no SET Air_data.sensor_no = 2147483647 WHERE (Sensors.type='O');";
			$stmt= $this->em->getConnection()->prepare($sql);
			$stmt->execute();

			//5. delete sensor table
			$sql = "DELETE Sensors FROM Sensors INNER JOIN Users ON Users.user_no = Sensors.user_no;";
			$stmt= $this->em->getConnection()->prepare($sql);
			$stmt->execute();

			//6. delete user table
			$sql = "DELETE Users FROM Users WHERE Users.username = '$username';";
			$stmt= $this->em->getConnection()->prepare($sql);
			$stmt->execute();

			//id cancelation success message
			echo "<script>alert(\"Thank you for using SuiteCar Service. ID cancelation is done successfully.\");</script>";
			echo "<script>location.replace('login')</script>";
		}

		catch(Exception $e)
		{
			$message = $e->getMessage();
			echo "<script>alert(\"$messsage .\");</script>";
		}
	}
		else
		{
			echo "<script>alert(\"passwords are not matched. Please type correct passwords.\");</script>";
			echo "<script>location.replace('id_cancelation_page')</script>";
		}
	}

	//signup checker before send mail
	public function signup_check(Request $request, Response $response, $args)
	{
		//store data
		$username = $_POST['username'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$hash_password = password_hash($password, PASSWORD_DEFAULT);
		$password_confirm = $_POST['password_confirm'];
		$phone_number = $_POST['phone'];
		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];

		//data for email phpmailer
		$hash_password = password_hash($password, PASSWORD_DEFAULT);
		$auth_code = password_hash($username, PASSWORD_DEFAULT);
		
		//check duplication of username
		$sql = "SELECT username FROM Users WHERE username = '$username';";
		$stmt= $this->em->getConnection()->prepare($sql);
		$stmt->execute();
		$temp_result = $stmt->fetch();
		$username_db_Users = $temp_result['username'];
		$sql = "SELECT username FROM Auths WHERE username = '$username';";
		$stmt= $this->em->getConnection()->prepare($sql);
		$stmt->execute();
		$temp_result2 = $stmt->fetch();
		$username_db_Auths = $temp_result2['username'];

		echo "Auth : $username_db_Auths<br>";
		echo "User : $username_db_Users<br>";
		
		if($username_db_Users != null || !$username_db_Auths != null) {
			echo "<script>alert(\"This Username is already registered or on procedure to be authorized Try other Username.\");</script>";
			echo "<script>location.replace('signup')</script>";
		}
		else{
		}
		
		//modify with java script
		//success, insert database & go to sendMail
		if(!empty($email) && !empty($username) && !empty($password) && !empty($password_confirm) 
		&& !empty($phone_number) && !empty($first_name) && !empty($last_name))
		{
			//database insertion : Auths
			$sql = "INSERT INTO Auths (username, auth_code) VALUES ('$username', '$auth_code');";
			$stmt= $this->em->getConnection()->prepare($sql);
			$stmt->execute();
			//database insertion : Users
			$timestamp = strtotime("+6 months");
			$password_date=date("Y-m-d", $timestamp);
			$sql = "INSERT INTO Users (username, hashed_password, login_flag, email, phone, fname, lname, password_date) VALUES ('$username', '$hash_password', 0,
					'$email', '$phone_number', '$first_name', '$last_name','$password_date')";
			$stmt= $this->em->getConnection()->prepare($sql);
			$stmt->execute();

			//move to sendMail

			$this->sendMail($email, $username, $auth_code, SIGN_UP);
		}

		//fail, move to default page : login page
		else
		{
			echo "<script>alert(\"Please Enter Every Information.\");</script>";
			echo "<script>location.replace('signup')</script>";
		}
		
	}

	//e-mail link click : authorization function
	public function signup_authorization(Request $request, Response $response, $args)
    {
		//get data from url of email
		$auth_code_email = $_GET['link'];
		$username = $_GET['user'];
		$temp = $_GET['temp'];

		//Sign-up authorization
		$sql = "SELECT auth_code FROM Auths WHERE username='$username';";
		$stmt= $this->em->getConnection()->prepare($sql);
		$stmt->execute();
		$auth_code_db = $stmt->fetch();

		//when email code & database code are same
		if(strcmp($auth_code_email, $auth_code_db['auth_code'])==0)
		{
			//Auths table delete
			$sql = "DELETE FROM Auths WHERE (username = '$username');";
			$stmt= $this->em->getConnection()->prepare($sql);
			$stmt->execute();

			$sql = "UPDATE Users SET login_flag = 1 WHERE username='$username';";
			$stmt= $this->em->getConnection()->prepare($sql);
			$stmt->execute();

			echo "<script>alert(\"Your Account is Now Authorized. Welcome to SuiteCar Service.\");</script>";
			echo "<script>location.replace('login')</script>";
		}
		//when email code & database code are different
		else
		{
			//Auths table delete
			$sql = "DELETE FROM Auths WHERE (username = '$username');";
			$stmt= $this->em->getConnection()->prepare($sql);
			$stmt->execute();
			//Users table delete
			$sql = "DELETE FROM Users WHERE (username = '$username');";
			$stmt= $this->em->getConnection()->prepare($sql);
			$stmt->execute();
			echo "<script>alert(\"Failed to Authenticate. Check Your Information and Try Again\");</script>";
			echo "<script>location.replace('login')</script>";
		}
	}

	public function id_cancelation_page(Request $request, Response $response, $args)
	{
		$this->view->render($response, 'id_cancelation_page.twig');
	}

	public function air_data_transfer(Request $request, Response $response, $args)
	{
		//$sql = "SELECT * FROM Air_data INNER JOIN Sensors ON Air_data.sensor_no = Sensors.sensor_no WHERE ";

		//SELECT auth_code FROM Auths WHERE username='$username'
		//DELETE Air_data FROM Air_data INNER JOIN Sensors ON Air_data.sensor_no = Sensors.sensor_no WHERE Sensors.type = 'I'
		
		//$stmt= $this->em->getConnection()->prepare($sql);
		//$stmt->execute();
	}

	public function maps(Request $request, Response $response, $args)
	{
		$this->view->render($response, 'maps.twig');
	}
// public function marker(double latitude, double longitude, int color)
	// {
	// 	switch(color){
	// 		case green:
	// 			//draw 해당 위도 경도
	// 			break;
	// 		case yellow:
	// 			//draw 해당 위도 경도
	// 			break;
	// 		case orange:
	// 			//draw 해당 위도 경도
	// 			break;
	// 		case red:
	// 			//draw 해당 위도 경도
	// 			break;
	// 		case purple:
	// 			//draw 해당 위도 경도
	// 			break;
	// 	}
	// }

	// public function color(double co, double co2, double so2, double nc2, double o3)
	// {
	// 	//$tatal = 수식

	// 	//if total = very_low return Green
	// 	//if total = low return yellow
	// 	//if tatal = mid return orange
	// 	//if total = high return red
	// 	//if total = very high return purple	
	// }

	// public function range_view(double latitude, double longitude, int level)
	// {
	// 	// sql문 작성 (경도와 위도가 - (level * x) 이상이면서 경도와 위도가 + (level * x) 이하인 데이터)
	// 	// for(int i=0; i<count; ++i){
	// 		// color(range[i]['co'], range[i]['co2'], range[i]['so2'], range[i]['nc2'], range[i]['o3']);
	// 		// draw marker(range[i]['latitude'], range[i]['longitude], color);
	// 	// }
	// }

	// public function map_view()	// 맵 전체 뷰
	// {
	// 	// latitude = 현재 구글맵 중심의 위치 위도
	// 	// longitude = 현재 구글맵 중심의 위치 경도
	// 	// level = 구글맵의 줌 레벨
	// 	range_view(latitude, longitude, level);
	// }

	// public function senser_view()	// 하나의 센서를 클릭시
	// {
	// 	// $sql = 해당센서의 센서넘버와, 범위의 날짜에 해당하는 air데이터 값들 전부 받음
	// 	// 프론트에 해당하는 값들 삽입, 차트 생성
	// 	//$this->view->render($response, 'sensor_view.twig', [co, co2, ....]);	// 프론트로 값을 넘김
	// }

}