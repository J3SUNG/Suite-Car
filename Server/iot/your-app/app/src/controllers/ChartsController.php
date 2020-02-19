<?php
namespace App\Controller;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

final class ChartsController extends BaseController
{
//     public function default(Request $request, Response $response, $args) {
//         $response = $this->view->render($response, 'example-chart.phtml');
//         return $response;
        
//    } 
   
   
//     public function chart1(Request $request, Response $response, $args) {
//         $response = $this->view->render($response, 'charts/example-chart.phtml');
//         return $response;
//     }    


//     public function chart1_json(Request $request, Response $response, $args) {
//        $json = '{
//         "cols": [
//         {"id":"","label":"year","type":"string"},
//         {"id":"","label":"sales 11000","type":"number"},
//         {"id":"","label":"sales 10","type":"number"},
//         {"id":"","label":"sales 20","type":"number"},
//         {"id":"","label":"sales 50","type":"number"},
//         {"id":"","label":"expenses","type":"number"}192
//         ],
//         "rows": [
//         {"c":[{"v":"2001"},{"v":3},{"v":5},{"v":150}]},
//         {"c":[{"v":"2002"},{"v":5},{"v":10},{"v":103}]},
//         {"c":[{"v":"2003"},{"v":6},{"v":4},{"v":432}]},
//         {"c":[{"v":"2004"},{"v":8},{"v":32},{"v":132}]},
//         {"c":[{"v":"2005"},{"v":3},{"v":56},{"v":156}]}
//         ]
//         }';

//         //$json = '{"cols":[{"air_id":"","label":"date\/time","type":"string"},{"air_id":"","label":"AQI_PM","type":"number"},{"air_id":"","label":"AQI_CO","type":"number"},{"air_id":"","label":"AQI_NO2","type":"number"},{"air_id":"","label":"AQI_SO2","type":"number"},{"air_id":"","label":"AQI_O3","type":"number"}],"rows":[{"c":[{"v":"2019-02-21 11:28:17"},{"v":21},{"v":1},{"v":152},{"v":44},{"v":146}]},{"c":[{"v":"2019-02-21 11:28:24"},{"v":16},{"v":2},{"v":161},{"v":78},{"v":116}]},{"c":[{"v":"2019-02-21 11:28:30"},{"v":15},{"v":2},{"v":152},{"v":50},{"v":97}]},{"c":[{"v":"2019-02-21 11:28:37"},{"v":18},{"v":1},{"v":160},{"v":66},{"v":62}]},{"c":[{"v":"2019-02-21 11:28:43"},{"v":24},{"v":1},{"v":149},{"v":42},{"v":148}]},{"c":[{"v":"2019-02-21 11:28:50"},{"v":18},{"v":1},{"v":154},{"v":51},{"v":117}]},{"c":[{"v":"2019-02-21 11:28:56"},{"v":15},{"v":1},{"v":154},{"v":83},{"v":136}]},{"c":[{"v":"2019-02-21 11:29:03"},{"v":18},{"v":2},{"v":149},{"v":79},{"v":118}]},{"c":[{"v":"2019-02-21 11:29:09"},{"v":23},{"v":1},{"v":156},{"v":67},{"v":147}]},{"c":[{"v":"2019-02-21 11:29:16"},{"v":17},{"v":2},{"v":156},{"v":71},{"v":136}]},{"c":[{"v":"2019-02-21 11:29:22"},{"v":14},{"v":1},{"v":149},{"v":41},{"v":93}]},{"c":[{"v":"2019-02-21 11:29:29"},{"v":19},{"v":1},{"v":150},{"v":56},{"v":125}]},{"c":[{"v":"2019-02-21 11:29:35"},{"v":21},{"v":1},{"v":162},{"v":97},{"v":125}]},{"c":[{"v":"2019-02-21 11:29:42"},{"v":15},{"v":1},{"v":156},{"v":40},{"v":126}]},{"c":[{"v":"2019-02-21 11:29:48"},{"v":22},{"v":1},{"v":153},{"v":58},{"v":113}]},{"c":[{"v":"2019-02-21 11:56:46"},{"v":188},{"v":1},{"v":150},{"v":86},{"v":203}]},{"c":[{"v":"2019-02-21 11:56:53"},{"v":188},{"v":1},{"v":146},{"v":69},{"v":96}]},{"c":[{"v":"2019-02-21 11:56:59"},{"v":188},{"v":1},{"v":148},{"v":51},{"v":66}]},{"c":[{"v":"2019-02-21 11:57:06"},{"v":188},{"v":1},{"v":151},{"v":29},{"v":42}]},{"c":[{"v":"2019-02-21 11:57:12"},{"v":188},{"v":1},{"v":143},{"v":66},{"v":33}]},{"c":[{"v":"2019-02-21 11:57:19"},{"v":188},{"v":1},{"v":147},{"v":42},{"v":41}]},{"c":[{"v":"2019-02-21 11:57:25"},{"v":188},{"v":1},{"v":146},{"v":24},{"v":40}]},{"c":[{"v":"2019-02-21 11:57:32"},{"v":188},{"v":1},{"v":154},{"v":51},{"v":42}]},{"c":[{"v":"2019-02-21 11:57:38"},{"v":188},{"v":1},{"v":153},{"v":35},{"v":42}]},{"c":[{"v":"2019-02-21 11:57:45"},{"v":188},{"v":1},{"v":149},{"v":49},{"v":48}]},{"c":[{"v":"2019-02-21 11:57:51"},{"v":102},{"v":1},{"v":151},{"v":64},{"v":43}]},{"c":[{"v":"2019-02-21 11:57:58"},{"v":188},{"v":1},{"v":149},{"v":70},{"v":67}]},{"c":[{"v":"2019-02-21 11:58:04"},{"v":188},{"v":1},{"v":149},{"v":49},{"v":48}]},{"c":[{"v":"2019-02-21 11:58:11"},{"v":188},{"v":1},{"v":156},{"v":74},{"v":34}]},{"c":[{"v":"2019-02-21 11:58:17"},{"v":188},{"v":1},{"v":151},{"v":25},{"v":41}]},{"c":[{"v":"2019-02-21 11:58:24"},{"v":188},{"v":1},{"v":147},{"v":63},{"v":63}]},{"c":[{"v":"2019-02-21 11:58:30"},{"v":188},{"v":1},{"v":144},{"v":28},{"v":44}]},{"c":[{"v":"2019-02-21 11:58:37"},{"v":188},{"v":1},{"v":145},{"v":43},{"v":81}]},{"c":[{"v":"2019-02-21 11:58:43"},{"v":188},{"v":1},{"v":153},{"v":60},{"v":140}]},{"c":[{"v":"2019-02-21 11:58:50"},{"v":188},{"v":1},{"v":146},{"v":10},{"v":98}]},{"c":[{"v":"2019-02-21 11:58:56"},{"v":188},{"v":1},{"v":144},{"v":45},{"v":102}]},{"c":[{"v":"2019-02-21 11:59:03"},{"v":188},{"v":1},{"v":147},{"v":41},{"v":69}]},{"c":[{"v":"2019-02-21 11:59:09"},{"v":188},{"v":1},{"v":146},{"v":65},{"v":139}]},{"c":[{"v":"2019-02-21 11:59:16"},{"v":188},{"v":1},{"v":149},{"v":26},{"v":107}]},{"c":[{"v":"2019-02-21 11:59:22"},{"v":188},{"v":1},{"v":152},{"v":33},{"v":57}]},{"c":[{"v":"2019-02-21 11:59:29"},{"v":2},{"v":1},{"v":149},{"v":25},{"v":35}]},{"c":[{"v":"2019-02-21 11:59:35"},{"v":2},{"v":1},{"v":150},{"v":62},{"v":47}]},{"c":[{"v":"2019-02-21 11:59:42"},{"v":188},{"v":1},{"v":154},{"v":41},{"v":88}]},{"c":[{"v":"2019-02-21 11:59:48"},{"v":188},{"v":1},{"v":155},{"v":30},{"v":50}]},{"c":[{"v":"2019-02-21 11:59:55"},{"v":188},{"v":1},{"v":154},{"v":41},{"v":80}]},{"c":[{"v":"2019-02-21 12:00:01"},{"v":188},{"v":1},{"v":155},{"v":46},{"v":62}]},{"c":[{"v":"2019-02-21 12:00:08"},{"v":188},{"v":1},{"v":141},{"v":57},{"v":72}]},{"c":[{"v":"2019-02-21 12:00:14"},{"v":188},{"v":1},{"v":145},{"v":47},{"v":106}]},{"c":[{"v":"2019-02-21 12:00:21"},{"v":188},{"v":1},{"v":148},{"v":70},{"v":50}]},{"c":[{"v":"2019-02-21 12:00:27"},{"v":188},{"v":1},{"v":145},{"v":39},{"v":52}]},{"c":[{"v":"2019-02-21 12:00:34"},{"v":188},{"v":1},{"v":152},{"v":52},{"v":50}]},{"c":[{"v":"2019-02-21 12:00:40"},{"v":188},{"v":1},{"v":157},{"v":37},{"v":67}]},{"c":[{"v":"2019-02-21 12:00:47"},{"v":188},{"v":1},{"v":143},{"v":101},{"v":57}]},{"c":[{"v":"2019-02-21 12:00:53"},{"v":22},{"v":1},{"v":144},{"v":58},{"v":46}]},{"c":[{"v":"2019-02-21 12:01:00"},{"v":16},{"v":1},{"v":151},{"v":51},{"v":47}]},{"c":[{"v":"2019-02-21 12:01:06"},{"v":7},{"v":1},{"v":153},{"v":20},{"v":45}]},{"c":[{"v":"2019-02-21 12:01:13"},{"v":6},{"v":2},{"v":141},{"v":69},{"v":153}]},{"c":[{"v":"2019-02-21 12:01:19"},{"v":10},{"v":2},{"v":141},{"v":45},{"v":115}]}]}' ;       
//         return $response->withHeader('Content-type', 'application/json')
//               ->withStatus(200)
//               ->write($json);
//     }

    public function chart2_json(Request $request, Response $response, $args) {
        // grab 10 most recent values, sort in asc order
        try {
            $user_no = $_GET['user_no'];
            $sensor_no = $_GET['sensor_no'];
            $type = $_GET['type'];
            $view_type = $_GET['view_type'];

            if($type == 0){
                $CO = $_GET['CO'];
                $SO2 = $_GET['SO2'];
                $O3 = $_GET['O3'];
                $NO2 = $_GET['NO2'];
                $PM25 = $_GET['PM25'];
                if($view_type == 0){
                    $sql = "SELECT * 
                    from Air_data 
                    WHERE sensor_no = :sensor_no
                    ORDER BY time
                    LIMIT 10";
                    $stmt = $this->em->getConnection()->prepare($sql);
                    $params['sensor_no'] = $sensor_no;
                    $stmt->execute($params);
                }
                else{
                    $start_date = $_GET['start_date'];
                    $end_date = $_GET['end_date'];
                    $sql = "SELECT * 
                            FROM Air_data 
                            WHERE sensor_no = :sensor_no 
                            AND STR_TO_DATE(time, '%Y-%m-%d %H:%i:%s')
                                BETWEEN STR_TO_DATE(:start_date, '%Y-%m-%d %H:%i:%s')
                                    AND STR_TO_DATE(:end_date, '%Y-%m-%d %H:%i:%s')";
                    $stmt = $this->em->getConnection()->prepare($sql);
                    $params['sensor_no'] = $sensor_no;
                    $params['start_date'] = $start_date;
                    $params['end_date'] = $end_date;
                    $stmt->execute($params);
                }
            }
            else if($type == 1){
                if($view_type == 0){
                    $sql = "SELECT * 
                            FROM (SELECT * 
                                FROM Heart_data 
                                WHERE user_no = :user_no 
                                ORDER BY time DESC LIMIT 10) A ORDER BY A.time";
                    $stmt = $this->em->getConnection()->prepare($sql);
                    $params['user_no'] = $user_no;
                    $stmt->execute($params);
                }
                else{
                    $start_date = $_GET['start_date'];
                    $end_date = $_GET['end_date'];
                    $sql = "SELECT * 
                            FROM Heart_data 
                            WHERE sensor_no = :sensor_no 
                                AND STR_TO_DATE(time, '%Y-%m-%d %H:%i:%s')
                                BETWEEN STR_TO_DATE(:start_date, '%Y-%m-%d %H:%i:%s')
                                    AND STR_TO_DATE(:end_date, '%Y-%m-%d %H:%i:%s')";
                    $stmt = $this->em->getConnection()->prepare($sql);
                    $params['sensor_no'] = $sensor_no;
                    $params['start_date'] = $start_date;
                    $params['end_date'] = $end_date;
                    $stmt->execute($params);
                }
            }
            
            $result = $stmt->fetchAll();
            
            if ($result && $type == 0) {
                // build array for Column labels
                $json_array['cols'] = array(
                    array('id'=>'', 'label'=>'date/time', 'type'=>'string'),
                    array('id'=>'', 'label'=>'CO', 'type'=>'number'),
                    array('id'=>'', 'label'=>'SO2', 'type'=>'number'),
                    array('id'=>'', 'label'=>'O3', 'type'=>'number'),
                    array('id'=>'', 'label'=>'PM2.5', 'type'=>'number'),
                    array('id'=>'', 'label'=>'NO2', 'type'=>'number')
                );

                // loop thru the sensor data and build sensor_array
                foreach ($result as $row) {
                    $sensor_array = array();
                    $sensor_array[] = array('v'=>$row['time']);
                    if($CO == 0){
                        $sensor_array[] = array('v'=>$row['CO_aqi']);
                    }
                    if($SO2 == 0){
                        $sensor_array[] = array('v'=>$row['SO2_aqi']);
                    }
                    if($O3 == 0){
                        $sensor_array[] = array('v'=>$row['O3_aqi']);
                    }
                    if($PM25 == 0){
                        $sensor_array[] = array('v'=>$row['PM2.5_aqi']);
                    }
                    if($NO2 == 0){
                        $sensor_array[] = array('v'=>$row['NO2_aqi']);
                    }
                   
                    // add current sensor_array line to $rows
                    $rows[] = array('c'=>$sensor_array);
                }
            
                // add $rows to $json_array
                $json_array['rows'] = $rows;
                
                return $response->withHeader('Content-type', 'application/json')
                ->write(json_encode($json_array, JSON_NUMERIC_CHECK))
                ->withStatus(200);
            } 
            else if ($result && $type == 1) {
                $json_array['cols'] = array(
                    array('id'=>'', 'label'=>'date/time', 'type'=>'string'),
                    array('id'=>'', 'label'=>'heart', 'type'=>'number')
                    // array('id'=>'', 'label'=>'SO2', 'type'=>'number'),
                    // array('id'=>'', 'label'=>'O3', 'type'=>'number'),
                    // array('id'=>'', 'label'=>'PM2.5', 'type'=>'number'),
                    // array('id'=>'', 'label'=>'NO2', 'type'=>'number')
                );

                // loop thru the sensor data and build sensor_array
                foreach ($result as $row) {
                    $sensor_array = array();
                    $sensor_array[] = array('v'=>$row['time']);
                    $sensor_array[] = array('v'=>$row['heart']);
                   
                    // add current sensor_array line to $rows
                    $rows[] = array('c'=>$sensor_array);
                }
            
                // add $rows to $json_array
                $json_array['rows'] = $rows;
                
                return $response->withHeader('Content-type', 'application/json')
                ->write(json_encode($json_array, JSON_NUMERIC_CHECK))
                ->withStatus(200);
            }
            else {
                $response = $response->withStatus(404);
            }
        } catch(PDOException $e) {
            echo '{"error":{"text":'. $e->getMessage() .'}}';
        }
   } 

    public function heart_chart(Request $request, Response $response, $args) {
        //$response = $this->view->render($response, 'charts/dynamic-chart.phtml');
        $response = $this->view->render($response, 'heart_chart.twig');
        return $response;
    }    

    public function air_chart(Request $request, Response $response, $args) {
        //$response = $this->view->render($response, 'charts/dynamic-chart.phtml');
        $response = $this->view->render($response, 'air_chart.twig');
        return $response;
    }    

//     public function chart3(Request $request, Response $response, $args) {
//         $response = $this->view->render($response, 'charts/dynamic-chart-s1.phtml');
//         return $response;
//     }    
    
//     public function chart3_json(Request $request, Response $response, $args) {
//         $sql = "SELECT * from Air_data";
//         $stmt = $this->em->getConnection()->prepare($sql);
//         $stmt->execute();
//         try {
//             $result = $stmt->fetchAll();

//             if ($result) {
//                 foreach (array("s1"=>'O2', "s2"=>'N', "s3"=>'PM', "s4"=>'Temperature', "s5"=>'SO2', "s6"=>'XYZ') as $sensor=>$sensor_label) {
//                     // build array for Column labels
//                     $json_array['cols'] = array(
//                             array('id'=>'', 'label'=>'date/time', 'type'=>'string'),
//                             array('id'=>'', 'label'=>$sensor_label, 'type'=>'number'));

//                     // loop thru the sensor data and build sensor_array
//                     foreach ($result as $row) {
//                         $sensor_array = array();
//                         $sensor_array[] = array('v'=>$row['datetime']);
//                         $sensor_array[] = array('v'=>$row[$sensor]);
                    
//                         // add current sensor_array line to $rows
//                         $rows[] = array('c'=>$sensor_array);
//                     }
                
//                     // add $rows to $json_array
//                     $json_array['rows'] = $rows;
//                     $rows = array();
                
//                     $master_array[$sensor][] = $json_array;
//                 }
                
//               return $response->withHeader('Content-type', 'application/json')
//               ->write(json_encode($master_array, JSON_NUMERIC_CHECK))
//               ->withStatus(200);

//             } else {
//                 $response = $response->withStatus(404);
//             }
//         } catch(PDOException $e) {
//             echo '{"error":{"text":'. $e->getMessage() .'}}';
//         }

//    } 

    public function receive_combobox(Request $request, Response $response, $args) {
        $user_no = $_GET['user_no'];
        $type = $_GET['type'];
        
        if($type == 0){
            $sql = "SELECT sensor_no from Sensors WHERE user_no = :user_no AND type = 'A'";
            $stmt = $this->em->getConnection()->prepare($sql);
            $params['user_no'] = $user_no;
            $stmt->execute($params);
        }
        else{
            $sql = "SELECT sensor_no from Sensors WHERE user_no = :user_no AND type = 'H' LIMIT 1";
            $stmt = $this->em->getConnection()->prepare($sql);
            $params['user_no'] = $user_no;
            $stmt->execute($params);
        }

        try {
            $result = $stmt->fetchAll();

            if ($result) {
                $combobox = [];
				foreach ($result as $combo) {
                    $combobox[] =
					array(
                        "sensor_no"=>$combo['sensor_no']
                    );
                }
                
                return $response->withHeader('Content-type', 'application/json')
                ->write(json_encode($combobox, JSON_NUMERIC_CHECK))
                ->withStatus(200);

            } else {
                $response = $response->withStatus(404);
            }
        } catch(PDOException $e) {
            echo '{"error":{"text":'. $e->getMessage() .'}}';
        }
    } 

//     public function supercoffee(Request $request, Response $response, $args) {
//         $response = $this->view->render($response, 'super-coffee.phtml');
//         return $response;
//     }    

//     public function test_json(Request $request, Response $response, $args) {
//         try {
//             $chartdata = $this->charts->getUdooData();

//             if ($chartdata) {
//                 // build array for Column labels
//                 $json_array['cols'] = array(
//                     array('id'=>'data/time', 'label'=>'date/time', 'type'=>'string'),
//                     array('id'=>'CO', 'label'=>'CO2', 'type'=>'number'),
//                     array('id'=>'SO2', 'label'=>'SO2', 'type'=>'number'),
//                     array('id'=>'O3', 'label'=>'NO2', 'type'=>'number'),
//                     array('id'=>'PM2.5', 'label'=>'temp', 'type'=>'number'),
//                     array('id'=>'NO2', 'label'=>'pm25', 'type'=>'number'));

//                 // loop thru the sensor data and build sensor_array
//                 foreach ($chartdata as $row) {
//                     $sensor_array = array();
//                     $sensor_array[] = array('v'=>$row['datetime']);
//                     $sensor_array[] = array('v'=>$row['s1']);
//                     $sensor_array[] = array('v'=>$row['s2']);
//                     $sensor_array[] = array('v'=>$row['s3']);
//                     $sensor_array[] = array('v'=>$row['s4']);
//                     $sensor_array[] = array('v'=>$row['s5']);
                   
//                     // add current sensor_array line to $rows
//                     $rows[] = array('c'=>$sensor_array);
//                 }
            
//                 // add $rows to $json_array
//                 $json_array['rows'] = $rows;
                
//               return $response->withHeader('Content-type', 'application/json')
//               ->write(json_encode($json_array, JSON_NUMERIC_CHECK))
//               ->withStatus(200);
   
//             } else {
//                 $response = $response->withStatus(404);
//             }
//         } catch(PDOException $e) {
//             echo '{"error":{"text":'. $e->getMessage() .'}}';
//         }   
//      }




//   public function test_json_big(Request $request, Response $response, $args) {
//         try {
//             $chartdata = $this->charts->getUdooData();

//             if ($chartdata) {
//                 foreach (array("s1"=>'O2', "s2"=>'N', "s3"=>'PM', "s4"=>'Temperature', "s5"=>'SO2', "s6"=>'XYZ') as $sensor=>$sensor_label) {
//                     // build array for Column labels
//                     $json_array['cols'] = array(
//                             array('id'=>'', 'label'=>'date/time', 'type'=>'string'),
//                             array('id'=>'', 'label'=>$sensor_label, 'type'=>'number'));

//                     // loop thru the sensor data and build sensor_array
//                     foreach ($chartdata as $row) {
//                         $sensor_array = array();
//                         $sensor_array[] = array('v'=>$row['datetime']);
//                         $sensor_array[] = array('v'=>$row[$sensor]);
                    
//                         // add current sensor_array line to $rows
//                         $rows[] = array('c'=>$sensor_array);
//                     }
                
//                     // add $rows to $json_array
//                     $json_array['rows'] = $rows;
//                     $rows = array();
                
//                     $master_array[$sensor][] = $json_array;
//                 }
                
//               return $response->withHeader('Content-type', 'application/json')
//               ->write(json_encode($master_array, JSON_NUMERIC_CHECK))
//               ->withStatus(200);

//             } else {
//                 $response = $response->withStatus(404);
//             }
//         } catch(PDOException $e) {
//             echo '{"error":{"text":'. $e->getMessage() .'}}';
//         }
//     }
}
