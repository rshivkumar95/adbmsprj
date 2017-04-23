<?php

$cluster  = Cassandra::cluster()
                ->build();
$keyspace  = 'naukridhanda';
$session  = $cluster->connect($keyspace);


$statement = new Cassandra\SimpleStatement("SELECT * FROM companycount");
$result    = $session->execute($statement);
unset($sortArray);
$sortArray = array(); 
$i=1;
foreach($result as $res){ 
    
    $temp=array('cname' => $res['cname'], 'count' => $res['count']);
    array_push($sortArray, $temp);
   $i++;
   
} 

foreach ($sortArray as $key => $row) {
    $cname[$key]  = $row['cname'];
    $count[$key] = $row['count'];
}


array_multisort($count, SORT_DESC, $cname, SORT_ASC, $sortArray);

$jsonArray = array();
$i=1;
foreach ($sortArray as $data) {

    if($data['cname']!="Confidential" and $data['cname']!="CONFIDENTIAL")
    {
    
    $jsonArrayItem = array();
            $jsonArrayItem['label'] = $data['cname'];
            $jsonArrayItem['value'] = $data['count'];
            array_push($jsonArray, $jsonArrayItem);
    $i++;
    if($i>5)
        break;
    }

}
header('Content-type: application/json');
echo json_encode($jsonArray);