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



$input = fopen("company/part-r-00000", "r") or die("Unable to open file!");
$i=1;
$query="CREATE TABLE IF NOT EXISTS companycount (id int, cname text, count int,PRIMARY KEY (id));";
$statement = $session->execute(new Cassandra\SimpleStatement($query)); 
$statement = $session->execute(new Cassandra\SimpleStatement("TRUNCATE TABLE companycount"));
while(!feof($input)) {

	$data=explode(",",fgets($input));

	if(strlen($data[0])<35 and !empty($data[1]))
	{
		$cname=$data[0];
		$count=(int)trim($data[1]);
		
		$query = "INSERT INTO companycount (id, cname, count)VALUES ($i,'$cname',$count);" ;
		         //echo "Inserted $i";   
		       
	    $statement = $session->execute($query);
		$i++;
	}
	
}
fclose($input);



/*
 *
 * Company End
 *
 *
 */

// ---------------------------------------------------------------------------------


/*
 *
 * Skill Start
 *
 *
 */



$input = fopen("skills/part-r-00000", "r") or die("Unable to open file!");
$i=1;
$query="CREATE TABLE IF NOT EXISTS skillcount (id int, sname text, count int,PRIMARY KEY (id));";
$statement = $session->execute(new Cassandra\SimpleStatement($query)); 
$statement = $session->execute(new Cassandra\SimpleStatement("TRUNCATE TABLE skillcount"));
while(!feof($input)) {

	$data=explode(",",fgets($input));
	//var_dump($data);
	//echo $data[1];
	if(strlen($data[0])<35 and !empty($data[1]))
	{
		$cname=$data[0];
		$count=(int)trim($data[1]);
		//fwrite($output,$i.",".$str."\n");
		$query = "INSERT INTO skillcount (id, sname, count)VALUES ($i,'$cname',$count);" ;
		         echo "Inserted $i";   
		       
	    $statement = $session->execute($query);
		$i++;
	}
	
}
fclose($input);


/*
 *
 * Skills End
 *
 *
 */

// ---------------------------------------------------------------------------------


/*
 *
 * Location Start
 *
 *
 */

$input = fopen("location/part-r-00000", "r") or die("Unable to open file!");
$i=1;
$query="CREATE TABLE IF NOT EXISTS locationcount (id int, lname text, count int,PRIMARY KEY (id));";
$statement = $session->execute(new Cassandra\SimpleStatement($query)); 
$statement = $session->execute(new Cassandra\SimpleStatement("TRUNCATE TABLE locationcount"));
while(!feof($input)) {

	$data=explode(",",fgets($input));
	//var_dump($data);
	//echo $data[1];
	if(strlen($data[0])<35 and !empty($data[1]))
	{
		$cname=$data[0];
		$count=(int)trim($data[1]);
		//fwrite($output,$i.",".$str."\n");
		$query = "INSERT INTO locationcount (id, lname, count)VALUES ($i,'$cname',$count);" ;
		         echo "Inserted $i";   
		       
	    $statement = $session->execute($query);
		$i++;
	}
	
}
fclose($input);


/*
 *
 * Location End
 *
 *
 */

// ---------------------------------------------------------------------------------


/*
 *
 * Salary Start
 *
 *
 */

$input = fopen("salary/part-r-00000", "r") or die("Unable to open file!");
$i=1;
$query="CREATE TABLE IF NOT EXISTS salarycount (id int, salary text, count int,PRIMARY KEY (id));";
$statement = $session->execute(new Cassandra\SimpleStatement($query)); 
$statement = $session->execute(new Cassandra\SimpleStatement("TRUNCATE TABLE salarycount"));
while(!feof($input)) {

	$data=explode(",",fgets($input));
	//var_dump($data);
	//echo $data[1];
	if(strlen($data[0])<35 and !empty($data[1]))
	{
		$cname=$data[0];
		$count=(int)trim($data[1]);
		//fwrite($output,$i.",".$str."\n");
		$query = "INSERT INTO salarycount (id, salary, count)VALUES ($i,'$cname',$count);" ;
		         echo "Inserted $i";   
		       
	    $statement = $session->execute($query);
		$i++;
	}
	
}
fclose($input);

/*
 *
 * Salary End
 *
 *
 */

// ---------------------------------------------------------------------------------


/*
 *
 * Jobtitle Start
 *
 *
 */

$input = fopen("jobtitle/part-r-00000", "r") or die("Unable to open file!");
$i=1;
$query="CREATE TABLE IF NOT EXISTS jobtitlecount (id int, jobtitle text, count int,PRIMARY KEY (id));";
$statement = $session->execute(new Cassandra\SimpleStatement($query)); 
$statement = $session->execute(new Cassandra\SimpleStatement("TRUNCATE TABLE jobtitlecount"));
while(!feof($input)) {

	$data=explode(",",fgets($input));
	//var_dump($data);
	//echo $data[1];
	if(strlen($data[0])<35 and !empty($data[1]))
	{
		$cname=$data[0];
		$count=(int)trim($data[1]);
		//fwrite($output,$i.",".$str."\n");
		$query = "INSERT INTO jobtitlecount (id, jobtitle, count)VALUES ($i,'$cname',$count);" ;
		         echo "Inserted $i";   
		       
	    $statement = $session->execute($query);
		$i++;
	}
	
}
fclose($input);


/*
 *
 * Jobtitle End
 *
 *
 */

// ---------------------------------------------------------------------------------


/*
 *
 * Experience Start
 *
 *
 */

$input = fopen("experience/part-r-00000", "r") or die("Unable to open file!");
$i=1;
$query="CREATE TABLE IF NOT EXISTS experiencecount (id int, experience text, count int,PRIMARY KEY (id));";
$statement = $session->execute(new Cassandra\SimpleStatement($query)); 
$statement = $session->execute(new Cassandra\SimpleStatement("TRUNCATE TABLE experiencecount"));
while(!feof($input)) {

	$data=explode(",",fgets($input));
	//var_dump($data);
	//echo $data[1];
	if(strlen($data[0])<35 and !empty($data[1]))
	{
		$cname=$data[0];
		$count=(int)trim($data[1]);
		//fwrite($output,$i.",".$str."\n");
		$query = "INSERT INTO experiencecount (id, experience, count)VALUES ($i,'$cname',$count);" ;
		         echo "Inserted $i";   
		       
	    $statement = $session->execute($query);
		$i++;
	}
	
}
fclose($input);

