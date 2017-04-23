<?php

$cluster  = Cassandra::cluster()
                ->build();
$keyspace  = 'naukridhanda';
$session  = $cluster->connect($keyspace);

$statement = new Cassandra\SimpleStatement("SELECT * FROM skillcount");
$result    = $session->execute($statement);
unset($sortArray);
$sortArray = array(); 
$i=1;
foreach($result as $res){ 
    
    $temp=array('sname' => $res['sname'], 'count' => $res['count']);
    array_push($sortArray, $temp);
   $i++;
   
} 

foreach ($sortArray as $key => $row) {
    $cname[$key]  = $row['sname'];
    $count[$key] = $row['count'];
}


array_multisort($count, SORT_DESC, $cname, SORT_ASC, $sortArray);

$jsonArray = array();
$i=1;
foreach ($sortArray as $data) {
    
    $jsonArrayItem = array();
            $jsonArrayItem['label'] = $data['sname'];
            $jsonArrayItem['value'] = $data['count'];
            array_push($jsonArray, $jsonArrayItem);
    $i++;
    if($i>20)
        break;

}
header('Content-type: application/json');
echo json_encode($jsonArray);
