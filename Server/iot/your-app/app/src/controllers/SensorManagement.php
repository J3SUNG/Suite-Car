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
}