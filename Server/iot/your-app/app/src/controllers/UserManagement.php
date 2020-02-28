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
final class UserManagement extends BaseController
{
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
			$mail->isSMTP();                                            // Send using SMTP
			$mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
			$mail->SMTPAuth   = true;                                   // Enable SMTP authentication
			$mail->Username   = 'franklinpark10@gmail.com';                     // SMTP username
			$mail->Password   = 'frank123!';                               // SMTP password
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
			$mail->send();
			//echo "<script>alert(\"E-mail has been sent. Check your E-mail.\");</script>";
			echo "E-mail has been sent. Please Check your E-mail.";
		}
		catch (Exception $e) {
			echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
			//$this->view->render($response, 'failure_page.twig', ['alert_message' => "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"]);
		}
	}
	
    public function forgotten_check(Request $request, Response $response, $args)
    {
		$username = $_POST['username'];
		$email = $_POST['email'];

		//$data = $request->getParsedBody();
		
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
			
			echo "Sent you a temporary password via email.";
			//$this->view->render($response, 'login.twig');
		}
		else {
			echo "There is no matched data. Insert Correct Information";
		}
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

    public function signin(Request $request, Response $response, $args)
    {
		$Pusername = $_POST['username'];
		$Ppassword = $_POST['password'];
		$Pdevice=$_POST['device'];
		$sql="SELECT username, email, user_no, hashed_password,password_date FROM Users WHERE username=:username";
		$stmt=$this->em->getConnection()->prepare($sql);
		$stmt->bindValue(":username",$Pusername);
		$resultCount = $stmt->execute();
		$row = $stmt->fetch();
		$str_now=strtotime(date("Y-m-d"));
		$str_db=strtotime($row['password_date']);
		
		if(password_verify($Ppassword,$row['hashed_password'])){
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
				return "login_fail";
			}else if($result_code==1){
				session_start();
				$_SESSION['user_no']=$row['user_no'];
				$_SESSION['username'] = $row['username'];
				$_SESSION['email'] = $row['email'];
				return "login_success";	
			}else if($result_code==2){
				session_start();
				$_SESSION['user_no']=$row['user_no'];
				$_SESSION['username'] = $row['username'];
				$_SESSION['email'] = $row['email'];
				return "password_change";
			}	
		}else if($Pdevice==ANDROID){
			header('Content-type: application/json');
			echo json_encode($data);
		}
    }

	public function home(Request $request, Response $response, $args)
    {
		$user_no = $_SESSION['user_no'];

		if($user_no != null) {
        $sql = "SELECT username, email FROM Users WHERE Users.user_no = $user_no;";
		$stmt= $this->em->getConnection()->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetch();

		$username = $result['username'];
		$email = $result['email'];
    	
		$this->view->render($response, 'home.twig', ['username'=>$username, 'email'=>$email]);
		}

		else {
			echo "<script>alert(\"Unexcepted Approach. Please login first.\");</script>";
			echo "<script>location.replace('login')</script>";
		}
	}

	public function signout(Request $request, Response $response, $args)
    {
		$user_no = $_SESSION['user_no'];
		if($user_no != null) {
		$sql = "UPDATE Users SET login_flag = 1 WHERE user_no = :user_no";
		$stmt = $this->em->getConnection()->prepare($sql);
		$params['user_no'] = $user_no;
        $stmt->execute($params);
        
		session_destroy();
		return "success";
		}

		else {
			echo "<script>alert(\"Unexcepted Approach. Please login first.\");</script>";
			echo "<script>location.replace('login')</script>";
		}
    }

	public function changePassword(Request $request, Response $response, $args)
    {
		//check the password and origin is same
		//check the password and confirm is same	Do it in js
		//$Puser_no=$_POST['user_no'];
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
				return "re_enter";
			}else if($result_code==1){	
				return "success";
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
		$device_category = $_POST['device'];
		if($device_category == WEB) {
			$user_no = $_SESSION['user_no'];
		}
		else if($device_category == ANDROID) {
			$user_no = $_POST['user_no'];
		}
		$password = $_POST['password'];

		//check login_flag for safety
		$sql = "SELECT login_flag FROM Users WHERE user_no='$user_no';";
		$stmt= $this->em->getConnection()->prepare($sql);
		$stmt->execute();
		$temp_result = $stmt->fetch();
		$login_flag = $temp_result['login_flag'];
		//echo "$login_flag\n";

		//actual login_flag check for safety
		if($login_flag == 2){}
		else 
		{
			if($device_category == WEB) {
				return "not_in_login_state";
			}
			else if($device_category == ANDROID) {
				echo "0";
			}
		}

		//get hashed password from database
		$sql = "SELECT hashed_password FROM Users WHERE user_no=$user_no;";
		$stmt= $this->em->getConnection()->prepare($sql);
		$stmt->execute();
		$temp_result = $stmt->fetch();
		$hashed_password = $temp_result['hashed_password'];

		//echo "$password  ==  $hashed_password";
		//compare and execute the cancelation procedure
		if(password_verify($password, $hashed_password)) // if inserted password and hashed_password in db is same, execute.
		{
			try {
			//get user_no data through search of user table
			/*
			$sql = "SELECT user_no FROM Users WHERE (username = '$username');";
			$stmt= $this->em->getConnection()->prepare($sql);
			$stmt->execute();
			$temp_result = $stmt->fetch();
			$user_no = $temp_result['user_no'];
			*/
			
			//1. delete user_selection table
			$sql = "DELETE FROM User_selection WHERE user_no = $user_no;";
			$stmt= $this->em->getConnection()->prepare($sql);
			$stmt->execute();
			//echo "no.1 done\n";

			//2. delete heart data table
			$sql = "DELETE FROM Heart_data WHERE user_no = $user_no;";
			$stmt= $this->em->getConnection()->prepare($sql);
			$stmt->execute();
			//echo "no.2 done\n";

			//3. delete inner air data
			$sql = "DELETE Air_data FROM Air_data INNER JOIN Sensors ON Air_data.sensor_no = Sensors.sensor_no WHERE Sensors.type = 'INAIRSENSOR' 
					AND Sensors.user_no = $user_no";
			$stmt= $this->em->getConnection()->prepare($sql);
			$stmt->execute();
			//echo "no.3 done\n";

			//4. update outer air data to dummy value
			$sql = "SET foreign_key_checks = 0;
					UPDATE Air_data INNER JOIN Sensors ON Sensors.sensor_no = Air_data.sensor_no SET Air_data.sensor_no = 0 WHERE Sensors.type='OUTAIRSENSOR'
					AND Sensors.user_no = $user_no;";
			$stmt= $this->em->getConnection()->prepare($sql);
			$stmt->execute();
			//echo "no.4 done\n";

			//5. delete sensor table
			$sql = "DELETE Sensors FROM Sensors INNER JOIN Users ON Users.user_no = Sensors.user_no WHERE Sensors.user_no = $user_no;";
			$stmt= $this->em->getConnection()->prepare($sql);
			$stmt->execute();
			//echo "no.5 done\n";

			//6. delete user table
			$sql = "DELETE Users FROM Users WHERE Users.user_no = $user_no;";
			$stmt= $this->em->getConnection()->prepare($sql);
			$stmt->execute();
			//echo "no.6 done\n";

			//id cancelation success message
			session_destroy();
			if($device_category == WEB) {
				return "success";
			}
			else if($device_category == ANDROID) {
				echo "1";
			}
			}
			catch(Exception $e)
			{
				if($device_category == WEB) {
					return "DB_problem";
				}
				else if($device_category == ANDROID) {
					echo "0";
				}
			}
		}
		else
		{
			if($device_category == WEB) {
				return "password_not_match";
			}
			else if($device_category == ANDROID) {
				echo "0";
			}
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
		$temp_result = $stmt->fetch();
		$username_db_Auths = $temp_result['username'];
		
		if($username_db_Users != null || $username_db_Auths != null) {
			echo "This Username is already registered or on procedure to be authorized Try other Username.";
			//echo "<script>location.replace('signup')</script>";
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
			echo "Please Enter Every Information.";
			//echo "<script>location.replace('signup')</script>";
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
}