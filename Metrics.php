<?php

require_once 'DBManager.php';

#view average time for order, days earnings 

class Metrics{

    private $conn;

    function __construct($dbmanager)
    {
        $this->conn = $dbmanager->getConn();
    }

    function retrieveDB(){

        #todays date in the format 03/Jan/2028
        $date = date('d/M/Y');

        #count orders forom different locations
        $uwi_count = 0;
        $mona_count = 0;
        $hope_pastures_count = 0;
        $papine_count =0;
        $old_hope_count = 0;
        $jc_count = 0;

        $uwi_earnings = 0;
        $mona_earnings = 0;
        $hope_pastures_earnings = 0;
        $papine_earnings = 0;
        $old_hope_earnings = 0;
        $jc_earnings = 0;

        $totalTime = 0;

        
        #get todays orders
        $stmt = $this->conn->prepare("SELECT * FROM `orders` WHERE `date` = :date");
        $stmt->bindParam(':date', $date, PDO::PARAM_STR);

        #tries to execute statement
        if($stmt->execute()){
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $ordersToday = $stmt->rowcount();

            foreach($results as $row){
                
                switch($row['gen_del_location']){
                    case 'UWI':
                        $uwi_count += 1;
                        $uwi_earnings += $row['total'];
                        break;
                    case 'Mona':
                        $mona_count += 1;
                        $mona_earnings += $row['total'];
                        break;
                    case 'Hope Pastures':
                        $hope_pastures_count += 1;
                        $hope_pastures_earnings += $row['total'];
                        break;
                    case 'Papine':
                        $papine_count += 1;
                        $papine_earnings += $row['total'];
                        break;
                    case 'Old Hope Road':
                        $old_hope_count += 1;
                        $old_hope_earnings += $row['total'];
                        break;
                    case 'Jamaica College':
                        $jc_count += 1;
                        $jc_earnings += $row['total'];
                        break;
                    default:
                        break;
                }

                #find time elapsed in miutes
                $time1 = strtotime($row['start_time']);
                $time2 = strtotime($row['end_time']);
                $difference = abs(($time2 - $time1)/60);
                $totalTime += $difference;

            }

            #finds average time, divides the sum of elapsed time on each order by the number of orders
            $totalTime = abs($totalTime/$ordersToday);
            echo $totalTime;
            
            echo $ordersToday." ";
            echo $uwi_count, $mona_count, $hope_pastures_count, $jc_count." ";
            echo $uwi_earnings." ", $mona_earnings." ", $hope_pastures_earnings." ", $jc_earnings;

            return ['ordersToday'=>$ordersToday];

            echo 'information retrieve successfully';
        }else{
            echo 'information couldnt be retrieved';
        }


        
    }

    function generateReport(){

        $res = $this->retrieveDB();
        echo " ".$res['ordersToday'];

    }
}

?>