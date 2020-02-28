<?php
namespace App\Controller;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

final class SensorManagement extends BaseController
{
    public function sensorList(Request $request, Response $response, $args)
    { 
		$device = $_GET["device"];
		$user_no = $_GET["user_no"];

		$sql="SELECT sensor_no,type,mac_address,sname FROM Sensors WHERE user_no=:user_no";
		$stmt=$this->em->getConnection()->prepare($sql);
		$params['user_no']=$user_no;
		$resultCount = $stmt->execute($params);
		$row = $stmt->fetchAll();
		$result=array('sensors'=>$row);
		echo json_encode($result);
	}

	public function sensorRegistration(Request $request, Response $response, $args)
    { 
		$device = $_POST["device"];
		$user_no = $_POST["user_no"];
		$type=$_POST["type"];
		$mac_address=$_POST["mac_address"];
		$sname=$_POST["sname"];
		
		/*$device = $_POST["device"];
		$user_no = 57;
		$type=2;
		$mac_address="BB:BB:BB:BB:BB";
		$sname="BEBE";
*/
		$sql="INSERT INTO Sensors (user_no, type, mac_address, sname) VALUES (:user_no,:type,:mac_address,:sname)";
		$stmt=$this->em->getConnection()->prepare($sql);
		$params['user_no']=$user_no;
		$params['type']=$type;
		$params['mac_address']=$mac_address;
		$params['sname']=$sname;
		$resultCount = $stmt->execute($params);
		echo $resultCount;
	}
	public function sensorAssociation(Request $request, Response $response, $args)
    { 
		$device = $_POST["device"];
		$sensor_no=$_POST["sensor_no"];
		$status = $_POST["status"];
		echo $status;
		$sql="UPDATE Sensors SET status=:status WHERE sensor_no=:sensor_no";
		$stmt=$this->em->getConnection()->prepare($sql);
		$params['status']=$status;
		$params['sensor_no']=$sensor_no;
		
		$resultCount = $stmt->execute($params);
		echo $resultCount;
	}
	public function sensorDeRegistration(Request $request, Response $response, $args)
    { 
		$device = $_POST["device"];
		$user_no = $_POST["user_no"];
		$sensor_no=$_POST["sensor_no"];
		echo $user_no;
		echo $sensor_no;
		$sql="DELETE FROM Sensors WHERE user_no=:user_no AND sensor_no=:sensor_no";
		$stmt=$this->em->getConnection()->prepare($sql);
		$params['user_no']=$user_no;
		$params['sensor_no']=$sensor_no;
		$resultCount = $stmt->execute($params);
		echo $resultCount;
	}

	public function polarDataTransfer(Request $request, Response $response, $args)
    { 
		$device = $_POST["device"];
		$sensor_no=$_POST["sensor_no"];
		$user_no = $_POST["user_no"];
		$time=$_POST["time"];
		$heart=$_POST["heart"];
		$latitude=$_POST["latitude"];
		$longitude=$_POST["longitude"];
		$rr_interval=$_POST["rr_interval"];
		
		$sql="INSERT INTO Heart_data (sensor_no,user_no,time_in,heart,latitude,longitude,rr_interval) VALUES (:sensor_no,:user_no,:time,:heart,:latitude,:longitude,:rr_interval)";
		$stmt=$this->em->getConnection()->prepare($sql);
		$params['sensor_no']=$sensor_no;
		$params['user_no']=$user_no;
		$params['time']=$time;
		$params['heart']=$heart;
		$params['latitude']=$latitude;
		$params['longitude']=$longitude;
		$params['rr_interval']=$rr_interval;
		$resultCount = $stmt->execute($params);
		echo $params;
	}

	public function udooDataTransfer(Request $request, Response $response, $args)
    { 
		$device = $_POST["device"];
		$sensor_no=$_POST["sensor_no"];
		$time=$_POST["time"];
		$temperature=$_POST["temperature"];
		$NO2=$_POST["NO2"];
		$O3=$_POST["O3"];
		$CO=$_POST["CO"];
		$SO2=$_POST["SO2"];
		$PM25=$_POST["PM25"];
		$NO2_AQI=$_POST["NO2_AQI"];
		$O3_AQI=$_POST["O3_AQI"];
		$CO_AQI=$_POST["CO_AQI"];
		$SO2_AQI=$_POST["SO2_AQI"];
		$PM25_AQI=$_POST["PM25_AQI"];
		$latitude=$_POST["latitude"];
		$longitude=$_POST["longitude"];
		echo "Asd";
		$sql="INSERT INTO Air_data (sensor_no,time_in,temperature,NO2_raw,O3_raw,CO_raw,SO2_raw,PM25_raw,NO2_aqi,O3_aqi,CO_aqi,SO2_aqi,PM25_aqi,latitude,longitude) 
		VALUES (:sensor_no,:time_in,:temperature,:NO2,:O3,:CO,:SO2,:PM25,:NO2_AQI,:O3_AQI,:CO_AQI,:SO2_AQI,:PM25_AQI,:latitude,:longitude)";
		$stmt=$this->em->getConnection()->prepare($sql);
		$params['sensor_no']=$sensor_no;
		$params['time_in']=$time;
		$params['temperature']=$temperature;
		$params['NO2']=$NO2;
		$params['O3']=$O3;
		$params['CO']=$CO;
		$params['SO2']=$SO2;
		$params['PM25']=$PM25;
		$params['NO2_AQI']=$NO2_AQI;
		$params['O3_AQI']=$O3_AQI;
		$params['CO_AQI']=$CO_AQI;
		$params['SO2_AQI']=$SO2_AQI;
		$params['PM25_AQI']=$PM25_AQI;
		$params['latitude']=$latitude;
		$params['longitude']=$longitude;
		$resultCount = $stmt->execute($params);
		echo $params;
	}

	public function test_function(Request $request, Response $response, $args)
    { 
		
		$device = $_POST["device"];
		$sensor_no=$_POST["sensor_no"];
		$time=$_POST["time"];
		$temperature=$_POST["temperature"];
		$NO2=$_POST["NO2"];
		$O3=$_POST["O3"];
		$CO=$_POST["CO"];
		$SO2=$_POST["SO2"];
		$PM25=$_POST["PM25"];
		$NO2_AQI=$_POST["NO2_AQI"];
		$O3_AQI=$_POST["O3_AQI"];
		$CO_AQI=$_POST["CO_AQI"];
		$SO2_AQI=$_POST["SO2_AQI"];
		$PM25_AQI=$_POST["PM25_AQI"];
		$latitude=$_POST["latitude"];
		$longitude=$_POST["longitude"];

		$O3 = (1.952 * $O3) - 3.041;
		$PM25 = (1.952 * $PM25) - 3.041;
		$CO = (1.952 * $CO) - 3.041;
		$SO2 = (1.952 * $SO2) - 3.041;
		$NO2 = (1.952 * $NO2) - 3.041;

		$input_value[] = 
			array(
				0=>$O3,
				1=>$PM25,
				2=>$CO,
				3=>$SO2,
				4=>$NO2
			);
		

		$aqi_table[] =
			array(
				0=>array("good"=>array("low"=>0,
											"high"=>54),
							"moderate"=>array("low"=>55,
												"high"=>70),
							"unhealthy_S"=>array("low"=>71,
												"high"=>85),
							"unhealthy"=>array("low"=>86,
												"high"=>105),
							"very"=>array("low"=>106,
											"high"=>200)
							),
				1=>array("good"=>array("low"=>0,
											"high"=>12),
							"moderate"=>array("low"=>12.1,
												"high"=>35.4),
							"unhealthy_S"=>array("low"=>35.5,
												"high"=>55.4),
							"unhealthy"=>array("low"=>55.5,
												"high"=>150.4),
							"very"=>array("low"=>150.5,
											"high"=>250.4),
							"hazard_low"=>array("low"=>250.5,
											"high"=>350.4),
							"hazard_high"=>array("low"=>350.5,
											"high"=>500.4)
							),
				2=>array("good"=>array("low"=>0,
											"high"=>4.4),
							"moderate"=>array("low"=>4.5,
												"high"=>9.4),
							"unhealthy_S"=>array("low"=>9.5,
												"high"=>12.4),
							"unhealthy"=>array("low"=>12.5,
												"high"=>15.4),
							"very"=>array("low"=>15.5,
											"high"=>30.4),
							"hazard_low"=>array("low"=>30.5,
											"high"=>40.4),
							"hazard_high"=>array("low"=>40.5,
											"high"=>50.4),
							),
				3=>array("good"=>array("low"=>0,
											"high"=>35),
							"moderate"=>array("low"=>36,
												"high"=>75),
							"unhealthy_S"=>array("low"=>76,
												"high"=>185),
							"unhealthy"=>array("low"=>186,
												"high"=>304),
							"very"=>array("low"=>305,
											"high"=>604),
							"hazard_low"=>array("low"=>605,
											"high"=>804),
							"hazard_high"=>array("low"=>805,
											"high"=>1004),
							),
				4=>array("good"=>array("low"=>0,
											"high"=>53),
							"moderate"=>array("low"=>54,
												"high"=>100),
							"unhealthy_S"=>array("low"=>101,
												"high"=>360),
							"unhealthy"=>array("low"=>361,
												"high"=>649),
							"very"=>array("low"=>650,
											"high"=>1249),
							"hazard_low"=>array("low"=>1250,
											"high"=>1649),
							"hazard_high"=>array("low"=>1650,
											"high"=>2049),
							),
				5=>array("good"=>array("low"=>0,
											"high"=>50),
							"moderate"=>array("low"=>51,
												"high"=>100),
							"unhealthy_S"=>array("low"=>101,
												"high"=>150),
							"unhealthy"=>array("low"=>151,
												"high"=>200),
							"very"=>array("low"=>201,
											"high"=>300),
							"hazard_low"=>array("low"=>301,
											"high"=>400),
							"hazard_high"=>array("low"=>401,
											"high"=>500),
							)
				);
		//echo $aqi_table["CO"]["good"]["high"];
		//print_r($aqi_table[0]["AQI"]["good"]["high"]);
		//print_r("\nABC\n");
		//print_r($aqi_table);
		if($input_value[0]) {
			$aqi_results = [];
			for($i = 0; $i < count($input_value[0]); $i++) {
				if($input_value[0][$i] <= $aqi_table[0][$i]["good"]["high"] && $input_value[0][$i] >= $aqi_table[0][$i]["good"]["low"]) {
					$aqi_results[] = array((($aqi_table[0][5]["good"]["high"] - $aqi_table[0][5]["good"]["low"]) /
										($aqi_table[0][$i]["good"]["high"] - $aqi_table[0][$i]["good"]["low"]))
										* ($input_value[0][$i] - $aqi_table[0][$i]["good"]["low"])
										+ $aqi_table[0][5]["good"]["low"]);
				}
				else if($input_value[0][$i] <= $aqi_table[0][$i]["moderate"]["high"] && $input_value[0][$i] >= $aqi_table[0][$i]["moderate"]["low"]) {
					$aqi_results[] = array((($aqi_table[0][5]["moderate"]["high"] - $aqi_table[0][5]["moderate"]["low"]) /
										($aqi_table[0][$i]["moderate"]["high"] - $aqi_table[0][$i]["moderate"]["low"]))
										* ($input_value[0][$i] - $aqi_table[0][$si]["moderate"]["low"])
										+ $aqi_table[0][5]["moderate"]["low"]);
				}
				else if($input_value[0][$i] <= $aqi_table[0][$i]["unhealthy_S"]["high"] && $input_value[0][$i] >= $aqi_table[0][$i]["unhealthy_S"]["low"]) {
					$aqi_results[] = array((($aqi_table[0][5]["unhealthy_S"]["high"] - $aqi_table[0][5]["unhealthy_S"]["low"]) /
										($aqi_table[0][$i]["unhealthy_S"]["high"] - $aqi_table[0][$i]["unhealthy_S"]["low"]))
										* ($input_value[0][$i] - $aqi_table[0][$i]["unhealthy_S"]["low"])
										+ $aqi_table[0][5]["unhealthy_S"]["low"]);
				}
				else if($input_value[0][$i] <= $aqi_table[0][$i]["unhealthy"]["high"] && $input_value[0][$i] >= $aqi_table[0][$i]["unhealthy"]["low"]) {
					$aqi_results[] = array((($aqi_table[0][5]["unhealthy"]["high"] - $aqi_table[0][5]["unhealthy"]["low"]) /
										($aqi_table[0][$i]["unhealthy"]["high"] - $aqi_table[0][$i]["unhealthy"]["low"]))
										* ($input_value[0][$i] - $aqi_table[0][$i]["unhealthy"]["low"])
										+ $aqi_table[0][5]["unhealthy"]["low"]);
				}
				else if($input_value[0][$i] <= $aqi_table[0][$i]["very"]["high"] && $input_value[0][$i] >= $aqi_table[0][$i]["very"]["low"]) {
					$aqi_results[] = array((($aqi_table[0][5]["very"]["high"] - $aqi_table[0][5]["very"]["low"]) /
										($aqi_table[0][$i]["very"]["high"] - $aqi_table[0][$i]["very"]["low"]))
										* ($input_value[0][$i] - $aqi_table[0][$i]["very"]["low"])
										+ $aqi_table[0][5]["very"]["low"]);
				}
				else if($input_value[0][$i] <= $aqi_table[0][$i]["hazard_low"]["high"] && $input_value[0][$i] >= $aqi_table[0][$i]["hazard_low"]["low"]) {
					$aqi_results[] = array((($aqi_table[0][5]["hazard_low"]["high"] - $aqi_table[0][5]["hazard_low"]["low"]) /
										($aqi_table[0][$i]["hazard_low"]["high"] - $aqi_table[0][$i]["hazard_low"]["low"]))
										* ($input_value[0][$i] - $aqi_table[0][$i]["hazard_low"]["low"])
										+ $aqi_table[0][5]["hazard_low"]["low"]);
				}
				else if($input_value[0][$i] <= $aqi_table[0][$i]["hazard_high"]["high"] && $input_value[0][$i] >= $aqi_table[0][$i]["hazard_high"]["low"]) {
					$aqi_results[] = array((($aqi_table[0][5]["hazard_high"]["high"] - $aqi_table[0][5]["hazard_high"]["low"]) /
										($aqi_table[0][$i]["hazard_high"]["high"] - $aqi_table[0][$i]["hazard_high"]["low"]))
										* ($input_value[0][$i] - $aqi_table[0][$i]["hazard_high"]["low"])
										+ $aqi_table[0][5]["hazard_high"]["low"]);
				}
				else {
					$aqi_results[] = array($input_value[0][$i]);
				}
			print_r("\nindex : ");
			print_r($i);
			print_r("\ninput value : ");
			print_r($input_value[0][$i]);
			print_r("\nresult_value : ");
			print_r($aqi_results[$i][0]);
			}
		}

		$sql="INSERT INTO Air_data (sensor_no,time_in,temperature,NO2_raw,O3_raw,CO_raw,SO2_raw,PM25_raw,NO2_aqi,O3_aqi,CO_aqi,SO2_aqi,PM25_aqi,latitude,longitude) 
		VALUES (:sensor_no,:time_in,:temperature,:NO2,:O3,:CO,:SO2,:PM25,:NO2_AQI,:O3_AQI,:CO_AQI,:SO2_AQI,:PM25_AQI,:latitude,:longitude)";
		$stmt=$this->em->getConnection()->prepare($sql);
		$params['sensor_no']=$sensor_no;
		$params['time_in']=$time;
		$params['temperature']=$temperature;
		$params['NO2']=$NO2;
		$params['O3']=$O3;
		$params['CO']=$CO;
		$params['SO2']=$SO2;
		$params['PM25']=$PM25;
		$params['NO2_AQI']=$aqi_results[4][0];
		$params['O3_AQI']=$aqi_results[0][0];
		$params['CO_AQI']=$aqi_results[2][0];
		$params['SO2_AQI']=$aqi_results[3][0];
		$params['PM25_AQI']=$aqi_results[1][0];
		$params['latitude']=$latitude;
		$params['longitude']=$longitude;
		$resultCount = $stmt->execute($params);

	}
}