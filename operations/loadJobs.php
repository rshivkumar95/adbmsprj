<?php


$xmlDoc = new DOMDocument();
$xmlDoc->load("alljobs.xml");
$i=0;
$x = $xmlDoc->documentElement;
// foreach ($x->childNodes AS $item) {
// 	/*foreach ($item->childNodes as $job) {
// 		# code...
// 		//var_dump($item->item(0)->nodeValue);
// 		//print $data->nodeName . " = " . $data->nodeValue . "<br>";
// 		$a=$job->getElementsByTagName('jobid');
// 		echo $job->nodeValue."<br>";
  		
//   		//break;

// 	}*/
// 	//echo $item->nodeValue;
// 	//$abc = $item->getElementsByTagName('link');
// 	$skills1 = $item->getElementsByTagName('skills');
// 	//echo $skills1[0]->nodeValue->nodeValue;
//     echo $skills=str_replace('_', '-',str_replace('\'', '-',trim($skills1[0]->nodeValue)));
// 	//var_dump($abc[0]->nodeValue);
// 	$link1 = $item->getElementsByTagName('link');
//     echo $link=str_replace('_', '-',str_replace('\'', '-',trim($link1[0]->nodeValue)));
//     $jobtitle1 = $item->getElementsByTagName('jobtitle');
//     echo $jobtitle=str_replace('_', '-',str_replace('\'', '-',trim($jobtitle1[0]->nodeValue)));
//     $company1 = $item->getElementsByTagName('company');
//     echo $company=str_replace('_', '-',str_replace('\'', '-',trim($company1[0]->nodeValue)));
//     $date1 = $item->getElementsByTagName('date');
//     echo $date=str_replace('_', '-',str_replace('\'', '-',trim($date1[0]->nodeValue)));
//     $experience1 = $item->getElementsByTagName('experience');
//     echo $experience=str_replace('_', '-',str_replace('\'', '-',trim($experience1[0]->nodeValue)));
//     $location1 = $item->getElementsByTagName('location');
//     echo $location=str_replace('_', '-',str_replace('\'', '-',trim($location1[0]->nodeValue)));
//     $salary1 = $item->getElementsByTagName('salary');
//     echo $salary=str_replace('_', '-',str_replace('\'', '-',trim($salary1[0]->nodeValue)));
//     if($skills!="" and (strpos($link, '_') === FALSE))
//     {
// 	$i++;
// }
// 	echo "<br><br>";
	
//   	//break;

// }

// echo $i;


// 


$cluster  = Cassandra::cluster()
                ->build();
$keyspace  = 'naukridhanda';
$session  = $cluster->connect($keyspace);

$query="CREATE TABLE IF NOT EXISTS jobs (jobid int, link text, jobtitle text, cmpname text, experience text ,cmplocation text, salary text,skills text,PRIMARY KEY (jobid));";
	    		
			
	    
	$statement = $session->execute(new Cassandra\SimpleStatement($query)); 
	$statement = $session->execute(new Cassandra\SimpleStatement("TRUNCATE TABLE jobs"));     

$i=1;
foreach ($x->childNodes AS $item) {
	$skills1 = $item->getElementsByTagName('skills');
	//echo $skills1[0]->nodeValue->nodeValue;
    $skills=str_replace('_', '-',str_replace('\'', '-',trim($skills1[0]->nodeValue)));
    $link1 = $item->getElementsByTagName('link');
    $link=str_replace('_', '-',str_replace('\'', '-',trim($link1[0]->nodeValue)));
    $jobtitle1 = $item->getElementsByTagName('jobtitle');
    $jobtitle=str_replace('_', '-',str_replace('\'', '-',trim($jobtitle1[0]->nodeValue)));
    $company1 = $item->getElementsByTagName('company');
    $company=str_replace('_', '-',str_replace('\'', '-',trim($company1[0]->nodeValue)));
    $date1 = $item->getElementsByTagName('date');
    $date=str_replace('_', '-',str_replace('\'', '-',trim($date1[0]->nodeValue)));
    $experience1 = $item->getElementsByTagName('experience');
    $experience=str_replace('_', '-',str_replace('\'', '-',trim($experience1[0]->nodeValue)));
    $location1 = $item->getElementsByTagName('location');
    $location=str_replace('_', '-',str_replace('\'', '-',trim($location1[0]->nodeValue)));
    $salary1 = $item->getElementsByTagName('salary');
    $salary=str_replace('_', '-',str_replace('\'', '-',trim($salary1[0]->nodeValue)));
   
    //echo $i."<br>";
    if($skills!="" and (strpos($link, '_') === FALSE))
    {
	   $query1 = "INSERT INTO jobs (jobid, link, jobtitle, cmpname, experience, cmplocation, salary, skills)VALUES ($i,'$link','$jobtitle','$company','$experience','$location','$salary','$skills');" ;
	            
	echo "$i,'$link','$jobtitle','$company','$experience','$location','$salary','$skills'<br><br>";            
	   $statement = $session->execute($query1);

	    $i++;

	}

	
    
} 

echo "$i";

?>