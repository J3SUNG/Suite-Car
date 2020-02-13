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
		$user_no = $_SESSION['user_no'];

		$sql = "SELECT * FROM Air_data INNER JOIN Sensors ON Sensors.user_no = $user_no AND WHERE username='$username';";
		$stmt= $this->em->getConnection()->prepare($sql);
		$stmt->execute();
		$auth_code_db = $stmt->fetch();

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

				$this->view->render($response, 'maps.twig', ['name'=>"Abcd", 'x'=>"person['x']", 'y'=>"person['y']"]);
				// return $response->withHeader('Content-type', 'application/json')
				// ->write(json_encode($person_array, JSON_NUMERIC_CHECK))
				// ->withStatus(200);
			}
			else{
				$response = $response->withStatus(404);
			}
		}
		catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
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
	// 	//$this->view->render($response, 'sensor_view.twig', [co, co2, ....]);	// 프론트로 value를 넘김
	// }

}