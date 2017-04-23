<?php

$cluster  = Cassandra::cluster()
                ->build();
$keyspace  = 'naukridhanda';
$session  = $cluster->connect($keyspace);

$statement = new Cassandra\SimpleStatement("SELECT * FROM locationcount");
$result    = $session->execute($statement);
unset($sortArray1);
$sortArray1 = array(); 
$i=1;
foreach($result as $res){ 
    
    $temp=array('lname' => $res['lname'], 'count' => $res['count']);
    array_push($sortArray1, $temp);
   $i++;
   
} 

foreach ($sortArray1 as $key => $row) {
    $cname[$key]  = $row['lname'];
    $count[$key] = $row['count'];
}


array_multisort($count, SORT_DESC, $sortArray1);


$jsonArray = array();
$i=1;
foreach ($sortArray1 as $data) {

    if($data['lname']!="India" and $data['lname']!="INDIA")
    {
    
    $jsonArrayItem = array();
            $jsonArrayItem['label'] = $data['lname'];
            $jsonArrayItem['value'] = $data['count'];
            array_push($jsonArray, $jsonArrayItem);
    $i++;
    if($i>10)
        break;
    }

}
header('Content-type: application/json');
echo json_encode($jsonArray);