

<?php


$domxml = new DOMDocument('1.0','UTF-8');
$domxml->formatOutput = true;
$root = $domxml->createElement('data');
$domxml->appendChild($root);
$job1=1;

// JOBS BY DESIGNATION PAGE LINK

$html = file_get_contents('https://www.naukri.com/top-jobs-by-designations');
@$dom = DOMDocument::loadHTML($html);
$xpath = new DOMXpath($dom);
$no=1;

fun1('https://www.naukri.com/lab-technician-jobs');

//PARSE JOB LISTING PAGE AND FING LINKS OF EACH JOB POSTING

function fun1($url)
{
  global $job1;
  echo "<h1>NEW</h1>";
  $html2 = file_get_contents($url);
  if($html2===FALSE)
  {

  }
  else
  {
    @$dom1 = DOMDocument::loadHTML($html2);
    $xpath1 = new DOMXpath($dom1);
    $links1=$xpath1->query('//div[contains(@class, "row")]//a[contains(@class, "content")]');
    $i=1;
    foreach ($links1 as $link ) 
    {
      echo $job1."<br><br>";
      $job1=$job1+1;
   
      getData($link->getAttribute('href'));

    }

    $links2=$xpath1->query('(//div[contains(@class,"pagination")]//a)[last()]');
  
 
  echo "One page Done<br>";
  if(trim($links2->item(0)->nodeValue)=="Next")
    fun1($links2->item(0)->getAttribute('href'));
  }
  

  
  

}


function file_get_contents_curl($url) {
$ch = curl_init();
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //Set curl to return the data instead of printing it to the browser.
curl_setopt($ch, CURLOPT_URL, $url);
$data = curl_exec($ch);
curl_close($ch);
return $data;
}



function getData($link)
{
   global $domxml,$root;
  echo $link;
  $html3 = file_get_contents($link);
  if($html3===FALSE)
  { 
  	 echo "@////////////////////////";

  }
  else
  {
    @$dom3 = DOMDocument::loadHTML($html3);
  $xpath3 = new DOMXpath($dom3);
  $result =$domxml->createElement('job');
  $root->appendChild($result);

 

$name = $result->appendChild($domxml->createElement('link')); 
$name->appendChild($domxml->createCDATASection($link)); 

$job_description=$xpath3->query('//div[contains(@class, "hdSec")]//h1[contains(@class, "small_title jobType hotjob")]');
//echo $job_description->item(0)->nodeValue;
//echo "<br>";
$result->appendChild($domxml->createElement('job_title',$job_description->item(0)->nodeValue));

$cmp_name=$xpath3->query('//div[contains(@class, "hdSec")]//a[contains(@id, "jdCpName")]');
//echo $cmp_name->item(0)->nodeValue;
//echo "<br>";
$result->appendChild($domxml->createElement('cmp_name',$cmp_name->item(0)->nodeValue));

$experience=$xpath3->query('//div[contains(@class, "hdSec")]//div[contains(@class, "p")]//span[contains(@itemprop,experienceRequirements)]');
//echo $experience->item(0)->nodeValue;
//echo "<br>";
$result->appendChild($domxml->createElement('experience',$experience->item(0)->nodeValue));



$cmp_location=$xpath3->query('//div[contains(@class, "hdSec")]//div[contains(@class, "p")]//div[contains(@class, "loc")]//a');
//echo $cmp_location->item(0)->nodeValue;
//echo "<br>";
$result->appendChild($domxml->createElement('cmp_location',$cmp_location->item(0)->nodeValue));



$salary=$xpath3->query('//div[contains(@class, "sumFoot")]//span[contains(@class, "sal")]');
//echo $salary->item(0)->nodeValue;
//echo "<br>";
$result->appendChild($domxml->createElement('salary',$salary->item(0)->nodeValue));


$skills=$xpath3->query('//div[contains(@class, "ksTags")]//a//font');
$skill_string=" ";
foreach ($skills as $skill ) 
{
  $skill_string=$skill->nodeValue .",".$skill_string;
}
//echo  $skill_string;
//echo "<br>";
$result->appendChild($domxml->createElement('skills',$skill_string));

}
  
$domxml->save('lab_technician_jobs.xml') ;  

}
 


?>


