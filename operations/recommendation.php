<?php

$cluster  = Cassandra::cluster()
                ->build();
$keyspace  = 'naukridhanda';
$session  = $cluster->connect($keyspace);


//echo $email='rshivkumar95@gmail.com';
//$limit=20;
$statement = new Cassandra\SimpleStatement("SELECT jid, sim FROM jobusersimilarity where uid='$email'");
$result    = $session->execute($statement);
unset($sortArray);
$sortArray = array(); 
$i=1;
foreach($result as $res){ 
    
    $temp=array('jid' => $res['jid'], 'sim' => $res['sim']);
    array_push($sortArray, $temp);
   $i++;
   
} 

foreach ($sortArray as $key => $row) {
    $cname[$key]  = $row['jid'];
    $count[$key] = $row['sim'];
}


array_multisort($count, SORT_DESC, $cname, SORT_ASC, $sortArray);



$recomd=array();
$i=1;
foreach ($sortArray as $data) {

    $jid=(int)$data['jid'];
    $statement = new Cassandra\SimpleStatement("SELECT * FROM jobs where jobid=$jid");
    $result    = $session->execute($statement);

    foreach ($result as $res) {
       
      
    array_push($recomd, $res);
    $i++;
    }

    if($i>$limit)
        break;
    
     

    
}

/*foreach ($recomd as $data) {

    echo "<br/><br/>";
    print_r($data);
    # code...
}
*/

//header('Content-type: application/json');
//echo json_encode($jsonArray);
