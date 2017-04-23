<?php

session_start();


$cluster  = Cassandra::cluster()
                ->build();
$keyspace  = 'naukridhanda';
$session  = $cluster->connect($keyspace);

$query="CREATE TABLE IF NOT EXISTS jobusersimilarity (uid text, jid text, sim text,PRIMARY KEY (uid,jid));";
$statement = $session->execute(new Cassandra\SimpleStatement($query)); 
	$statement = $session->execute(new Cassandra\SimpleStatement("TRUNCATE TABLE jobusersimilarity")); 


$i=1;
$handle = fopen("jobresumesimilarity.txt", "r");
if ($handle) {
    while (($line = fgets($handle)) !== false) {
        
    	$content=explode(",",$line);
     
     	 $uid=$content[0];
     	 $jid=$content[1];
     	 $sim=trim($content[2]);


     	 $query1 = "INSERT INTO jobusersimilarity (uid , jid , sim ) VALUES ('$uid','$jid','$sim');" ;
		            
		            
	   	 $statement = $session->execute($query1);

        $i++;
    }
    echo "$i Row Inserted";
    fclose($handle);
} 