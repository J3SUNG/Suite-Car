<?php
namespace App\Controller;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

define('SIGN_UP', 0);
define('FORGOTTEN', 1);
define('INTMAX', 2147483647);
define('WEB',0);
define('ANDROID',1);
final class DataManagement extends BaseController
{
	public function db_data_for_map(Request $request, Response $response, $args)
	{
		$sql = "SELECT Users.username, a.*
				FROM Users, Air_data AS a
				JOIN(
					SELECT sensor_no, MAX(time_in) time_in 
					FROM Air_data
					GROUP BY sensor_no) AS b
				ON a.sensor_no = b.sensor_no AND a.time_in = b.time_in;";
		$stmt= $this->em->getConnection()->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();


		if($result) {
			$map_data_db = [];
			foreach($result as $map_data) {
				$map_data_db[] =
				array("username"=>$map_data['username'],
				"Air_data_no"=>$map_data['Air_data_no'],
				"sensor_no"=>$map_data['sensor_no'],
				"time"=>$map_data['time_in'],
				"CO_raw"=>$map_data['CO_raw'],
				"CO_aqi"=>$map_data['CO_aqi'],
				"SO2_raw"=>$map_data['SO2_raw'],
				"SO2_aqi"=>$map_data['SO2_aqi'],
				"NO2_raw"=>$map_data['NO2_raw'],
				"NO2_aqi"=>$map_data['NO2_aqi'],
				"O3_raw"=>$map_data['O3_raw'],
				"O3_aqi"=>$map_data['O3_aqi'],
				"PM25_raw"=>$map_data['PM2.5_raw'],
				"PM25_aqi"=>$map_data['PM2.5_aqi'],
				"center"=>array("lat"=>$map_data['latitude'],
								"lng"=>$map_data['longtitude'])
			);
			}
			return $response->withHeader('Content-type', 'application/json')
					->write(json_encode($map_data_db, JSON_NUMERIC_CHECK))
					->withStatus(200);
		}
		else {
			$response = $response->withStatus(404);
		}

		//DELETE Air_data FROM Air_data INNER JOIN Sensors ON Air_data.sensor_no = Sensors.sensor_no WHERE Sensors.type = 'I' AND Sensors.user_no = $user_no";
    }
	
	
	public function fakesensors_as_json(Request $request, Response $response, $args) {
		try {
			$sql = "select * from sensors";
			$stmt = $this->em->getConnection()->prepare($sql);
			$stmt->execute();
			$results = $stmt->fetchAll();

			if($results) {
				$person_array = [];
				foreach ($results as $person) {
					$person_array[] =
					array("name"=>$person['name'],
					"x"=>$person['x'],
					"y"=>$person['y']);
				}

				// return $response->withStatus(200)
				// ->withHeader('Content-Type', 'application/json')
				// ->write(json_encode($person_array, JSON_NUMERIC_CHECK));

				//$this->view->render($response, 'maps.twig', ['name'=>"Abcd"]);
				return $response->withHeader('Content-type', 'application/json')
				->write(json_encode($person_array, JSON_NUMERIC_CHECK))
				->withStatus(200);
			}
			else{
				$response = $response->withStatus(404);
			}
		}
		catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
	}

	public function infowindow_to_chart(Request $request, Response $response, $args) {
		$user_no = $_SESSION['user_no'];
		$sql = "SELECT username, email FROM Users WHERE Users.user_no = $user_no;";
		$stmt= $this->em->getConnection()->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetch();

		$username = $result['username'];
        $email = $result['email'];
		$this->view->render($response, 'air_chart.twig', ['user_no'=>$user_no, 'username'=>$username, 'email'=>$email]);
	}
}