<?php

require_once 'DBManager.php';

#view average time for order, days earnings 

class Metrics{

    private $conn;
    private $dbmanager;

    function __construct($dbmanager)
    {
        $this->conn = $dbmanager->getConn();
        $this->dbmanager = $dbmanager;
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

            #finds average time, divides the sum of elapsed time on each order by the numnber of orders
            
            $avg_time = abs($totalTime/$ordersToday);
            
            #return total orders, average time, earnings and number of orders at each location 
            return ['orders_today'=>$ordersToday, 'avg_time'=>$avg_time, 'uwi_num'=>$uwi_count, 'mona_num'=>$mona_count, 'hope_past_num'=>$hope_pastures_count, 'papine_num'=>$papine_count, 'old_hope_num'=>$old_hope_count, 'jc_num'=>$jc_count, 'uwi_earn'=>$uwi_earnings, 'mona_earn'=>$mona_earnings, 'hope_past_earn'=>$hope_pastures_earnings, 'papine_earn'=>$papine_earnings, 'old_hope_earn'=>$old_hope_earnings, 'jc_earn'=>$jc_earnings];

            echo 'information retrieve successfully';
        }else{
            echo 'information couldnt be retrieved';
        }


        
    }

    function generateReport(){

        $results = $this->retrieveDB();


        echo'
        <!--JS Library to make charts-->
        <canvas id="earnChart" style="width:100%;max-width:700px"></canvas>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
        <script>
            
            var xValues = ["UWI", "Mona", "Papine", "Hope Pastures", "Old Hope Road", "Jamaica College"];
            var yValues = ['.$results["uwi_earn"].','.$results["mona_earn"].','.$results["papine_earn"].','.$results["hope_past_earn"].','.$results["old_hope_earn"].','.$results["jc_earn"].'];
            var barColors = ["#A86959", "#F58F76", "#6BD7F6", "#A88938", "#F5CA5D", "#93BEF5"];

            new Chart("earnChart", {
            type: "bar",
            data: {
                labels: xValues,
                datasets: [{
                backgroundColor: barColors,
                data: yValues
                }]
            },
            options: {
                legend: {display: false},
                title: {
                display: true,
                text: "Todays earnings based on destination"
                }
            }
            });

            
        </script>';
        
        
        
        
    }
}

?>