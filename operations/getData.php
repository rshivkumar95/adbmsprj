<?php

$cluster  = Cassandra::cluster()
                ->build();
$keyspace  = 'naukridhanda';
$session  = $cluster->connect($keyspace);


/*
 *
 * Company Start
 *
 *
 */

/*
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

echo "<br><br>";

echo "<br><br>";

foreach ($sortArray as $key => $row) {
    $cname[$key]  = $row['cname'];
    $count[$key] = $row['count'];
}


array_multisort($count, SORT_DESC, $cname, SORT_ASC, $sortArray);

echo "<h3>Top Companies and Total Openings</h3>";
echo "<table>";
$i=1;
foreach ($sortArray as $data) {
    
    echo "<tr>";
    echo "<td>".$data['cname']."</td>";
    echo "<td>".$data['count']."</td>";
    echo "</tr>";
    $i++;
    if($i>50)
        break;
    # code...
}

echo "</table>";
*/

/*
 *
 * Company End
 *
 *
 */
// -------------------------------------------------------------------------------
/*
 *
 * Skills Start
 *
 *
 */

/*
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

echo "<br><br>";

echo "<br><br>";

foreach ($sortArray as $key => $row) {
    $cname[$key]  = $row['sname'];
    $count[$key] = $row['count'];
}


array_multisort($count, SORT_DESC, $cname, SORT_ASC, $sortArray);

echo "<h3>Top Skills</h3>";
echo "<table>";
$i=1;
foreach ($sortArray as $data) {
    
    echo "<tr>";
    echo "<td>".$data['sname']."</td>";
    echo "<td>".$data['count']."</td>";
    echo "</tr>";
    $i++;
    if($i>50)
        break;
    # code...
}

echo "</table>";
*/

/*
 *
 * Skills End
 *
 *
 */
// -------------------------------------------------------------------------------
/*
 *
 * Location Start
 *
 *
 */

/*
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

echo "<br><br>";

echo "<br><br>";

foreach ($sortArray1 as $key => $row) {
    $cname[$key]  = $row['lname'];
    $count[$key] = $row['count'];
}


array_multisort($count, SORT_DESC, $sortArray1);

echo "<h3>Top Skills</h3>";
echo "<table>";
$i=1;
foreach ($sortArray1 as $data) {
    
    echo "<tr>";
    echo "<td>".$data['lname']."</td>";
    echo "<td>".$data['count']."</td>";
    echo "</tr>";
    $i++;
    if($i>10)
        break;
    # code...
}

echo "</table>";
*/

/*
 *
 * Location End
 *
 *
 */
// -------------------------------------------------------------------------------
/*
 *
 * Salary Start
 *
 *
 */

/*
$statement = new Cassandra\SimpleStatement("SELECT * FROM salarycount");
$result    = $session->execute($statement);
//unset($sortArray1);
$sortArray1 = array(); 
$i=1;
foreach($result as $res){ 
    
    $temp=array('salary' => $res['salary'], 'count' => $res['count']);
    array_push($sortArray1, $temp);
   $i++;
   
} 

echo "<br><br>";

echo "<br><br>";

foreach ($sortArray1 as $key => $row) {
    $cname[$key]  = $row['salary'];
    $count[$key] = $row['count'];
}


array_multisort($count, SORT_DESC, $sortArray1);

echo "<h3>Top Skills</h3>";
echo "<table>";
$i=1;
foreach ($sortArray1 as $data) {
    
    echo "<tr>";
    echo "<td>".$data['salary']."</td>";
    echo "<td>".$data['count']."</td>";
    echo "</tr>";
    $i++;
    if($i>10)
        break;
    # code...
}

echo "</table>";
*/

/*
 *
 * Salary End
 *
 *
 */
// -------------------------------------------------------------------------------
/*
 *
 * Jobtitle Start
 *
 *
 */

/*
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

echo "<br><br>";

echo "<br><br>";

foreach ($sortArray1 as $key => $row) {
    $cname[$key]  = $row['jobtitle'];
    $count[$key] = $row['count'];
}


array_multisort($count, SORT_DESC, $sortArray1);

echo "<h3>Top Skills</h3>";
echo "<table>";
$i=1;
foreach ($sortArray1 as $data) {
    
    echo "<tr>";
    echo "<td>".$data['jobtitle']."</td>";
    echo "<td>".$data['count']."</td>";
    echo "</tr>";
    $i++;
    if($i>10)
        break;
    # code...
}

echo "</table>";
*/

/*
 *
 * Jobtitle End
 *
 *
 */
// -------------------------------------------------------------------------------
/*
 *
 * Experience Start
 *
 *
 */


$statement = new Cassandra\SimpleStatement("SELECT * FROM experiencecount");
$result    = $session->execute($statement);
//unset($sortArray1);
$sortArray1 = array(); 
$i=1;
foreach($result as $res){ 
    
    $temp=array('experience' => $res['experience'], 'count' => $res['count']);
    array_push($sortArray1, $temp);
   $i++;
   
} 

foreach ($sortArray1 as $key => $row) {
    $cname[$key]  = $row['experience'];
    $count[$key] = $row['count'];
}


array_multisort($count, SORT_DESC, $sortArray1);

/*echo "<h3>Top Skills</h3>";
echo "<table>";
$i=1;
foreach ($sortArray1 as $data) {
    
    echo "<tr>";
    echo "<td>".$data['experience']."</td>";
    echo "<td>".$data['count']."</td>";
    echo "</tr>";
    $i++;
    if($i>20)
        break;
    # code...
}

echo "</table>";*/



$jsonArray = array();
$i=1;
foreach ($sortArray1 as $data) {
    
    $jsonArrayItem = array();
            $jsonArrayItem['label'] = $data['experience'];
            $jsonArrayItem['value'] = $data['count'];
            array_push($jsonArray, $jsonArrayItem);
    $i++;
    if($i>20)
        break;

}
header('Content-type: application/json');
echo json_encode($jsonArray);