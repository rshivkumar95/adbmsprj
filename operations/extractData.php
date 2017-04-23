<?php
$xml=simplexml_load_file("alljobs.xml") or die("Error: Cannot create object");
unlink("skills.txt");
unlink("company.txt");
unlink("jobtitle.txt");
unlink("experience.txt");
unlink("salary.txt");
unlink("location.txt");


$myfile = fopen("skills.txt", "w") or die("Unable to open file!");
$companyFile = fopen("company.txt", "w") or die("Unable to open file!");
$jobtitleFile= fopen("jobtitle.txt", "w") or die("Unable to open file!");
$experienceFile= fopen("experience.txt", "w") or die("Unable to open file!");
$salaryFile= fopen("salary.txt", "w") or die("Unable to open file!");
$locationFile= fopen("location.txt", "w") or die("Unable to open file!");




$i=1;
foreach($xml->children() as $job) { 

$common_words = array("developer", "development", "core", " ");
$skills=explode(",",str_replace('_', '-',str_replace('\'', '-',trim($job->skills))));
foreach ($skills as $skill) {
 	if($skill!=="")
 			fwrite($myfile, str_replace($common_words,"",strtolower(trim($skill))."\n"));
 }


$company=str_replace('_', '-',str_replace('\'', '-',trim($job->company)));
if($company!=="")
  fwrite($companyFile, trim($company)."\n");


$jobtitle=str_replace('_', '-',str_replace('\'', '-',trim($job->jobtitle)));
if($jobtitle!=="")
  fwrite($jobtitleFile, trim($jobtitle)."\n");

$experience=str_replace('_', '-',str_replace('\'', '-',trim($job->experience)));
if($experience!=="")
  fwrite($experienceFile, trim($experience)."\n");

$location=str_replace('_', '-',str_replace('\'', '-',trim($job->location)));
if($location!=="")
  fwrite($locationFile, trim($location)."\n");



$salary=str_replace('_', '-',str_replace('\'', '-',trim($job->salary)));
if($salary!=="" and $salary!="Not Disclosed by Recruiter" and $salary!="Not Disclosed By Recruiter" and strlen($salary)<25)
  {
	$sal=explode("P.A", $salary);
	
		fwrite($salaryFile, trim($sal[0])."\n");
	
  	
  } 

}

fclose($myfile);



