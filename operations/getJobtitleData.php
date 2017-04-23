<?php


$cluster  = Cassandra::cluster()
                ->build();
$keyspace  = 'naukridhanda';
$session  = $cluster->connect($keyspace);

$statement = new Cassandra\SimpleStatement("SELECT * FROM jobtitlecount");
$result    = $session->execute($statement);
//unset($sortArray1);
$sortArray1 = array(); 
$i=1;
foreach($result as $res){ 
    
    $temp=array('jobtitle' => $res['jobtitle'], 'count' => $res['count']);
    array_push($sortArray1, $temp);
   $i++;
   
} 

foreach ($sortArray1 as $key => $row) {
    $cname[$key]  = $row['jobtitle'];
    $count[$key] = $row['count'];
}


array_multisort($count, SORT_DESC, $sortArray1);

$jsonArray = array();
$i=1;
foreach ($sortArray1 as $data) {
    
    $jsonArrayItem = array();
            $jsonArrayItem['label'] = $data['jobtitle'];
            $jsonArrayItem['value'] = $data['count'];
            array_push($jsonArray, $jsonArrayItem);
    $i++;
    if($i>10)
        break;

}
header('Content-type: application/json');
echo json_encode($jsonArray);