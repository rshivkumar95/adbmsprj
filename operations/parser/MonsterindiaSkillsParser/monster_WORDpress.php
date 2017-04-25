<?php

//error_reporting(0);

//$url1=' ';
//header('Content-Type: text/html; charset=utf-8');
$domxml=new DOMDocument('1.0','utf-8');
$domxml->formatOutput=true;
$root=$domxml->createElement('data');
$domxml->appendChild($root);
$job1=1;

$html=file_get_contents('monster_page.html');
@$dom= DOMDocument::loadHTML($html);
$xpath= new DOMXpath($dom);
$no=1;
//$links=$xpath->query('//a[contains(@class,"ar_lnk")]');

/*foreach ($links as $link)
{
  $links=$link->getAttribute('href')."<br>";
  fun1($links);
}*/

fun1('http://www.monsterindia.com/wordpress-jobs.html');

function fun1($url)
{
  global $no;
  global $url1;

  //echo $url;
 
  echo "<h1>NEW</h1>";
  $html2 = file_get_contents_curl($url);

  if($html2===FALSE)
  {

  }
 else
 {
@$dom1 = DOMDocument::loadHTML($html2);
$xpath1 = new DOMXpath($dom1);

$links1=$xpath1->query('//div[contains(@class, "row")]//a[contains(@class, "joblnk")]');
$no=1;

    foreach ($links1 as $link ) 
    {
      echo $no."<br><br>";
      $no=$no+1;
   
      getData($link->getAttribute('href'));

    }
    echo "<br>";
}
    //$links2=$xpath1->query('(//div[contains(@class,"pagination")]//a)]');
  
}

function file_get_contents_curl($url)
{
  $ch=curl_init();
  curl_setopt($ch,CURLOPT_HEADER, 0);
  curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
  curl_setopt($ch,CURLOPT_URL,$url);
  $data=curl_exec($ch);
  curl_close($ch);
  return $data;
}

function getData($link)
{
  global $domxml,$root;

  $html3=file_get_contents_curl($link);
  /*if($html3===FALSE)
  {

  }
  else
  {*/
    @$dom3=DOMDocument::loadHTML($html3);
    $xpath3=new DOMXpath($dom3);
    $result=$domxml->createElement('job');
    $root->appendChild($result);
    //echo "*****";
   // echo $link;
    //echo "<br>";
    $name=$result->appendChild($domxml->createElement('link'));
    $name->appendChild($domxml->createCDATASection($link));

    $job_title=$xpath3->query('//div[contains(@class,"container-fluid")]//div[contains(@class,"job_title")]');
   // echo $job_title->item(0)->nodeValue;
    //echo "<br>";
    $result->appendChild($domxml->createElement('job_title',$job_title->item(0)->nodeValue));

    $cmp_name=$xpath3->query('//div[contains(@class,"container-fluid")]//div[contains(@class,"company")]');
    //echo $cmp_name->item(0)->nodeValue;
    //echo "<br>";
    $result->appendChild($domxml->createElement('cmp_name',$cmp_name->item(0)->nodeValue));

    $experience=$xpath3->query('//div[contains(@class,"container-fluid")]//a[contains(@class,"joblnk")]//div[contains(@class,"jtxt jico ico2 pull-left mar_left10")]');
    //echo $experience->item(0)->nodeValue;
    //echo "<br>";
    $result->appendChild($domxml->createElement('experience',$experience->item(0)->nodeValue));

    $cmp_location=$xpath3->query('//div[contains(@class,"container-fluid")]//div[contains(@class,"col-md-12")]//a[contains(@class,"joblnk")]//div[contains(@class,"jtxt jico ico1 pull-left")]');
    //echo $cmp_location->item(0)->nodeValue;
    //echo "<br>";
    $result->appendChild($domxml->createElement('cmp_location',$cmp_location->item(0)->nodeValue));

    $skills=$xpath3->query('//div[contains(@class,"container-fluid")]//div[contains(@class,"keyskill")]');
    $var=$skills->item(0)->nodeValue;
    $var1=str_replace('Keywords / Skills :', ' ', $var);
    //echo $var1;
    //echo "<br>";
    /*$skill_string=" ";
    foreach ($skills as $skill_string)
     {
      $skill_string=$skills->item(0)->nodeValue.",".skill_string;
     }
    //echo $skills->item(0)->nodeValue;
    //echo "<br>";*/
    $result->appendChild($domxml->createElement('skills',$var1));


 /*   $date=$xpath3->query('//div[contains(@class,"container-fluid")]//div[contains(@class,"posted")]');
    //echo $date->item(0)->nodeValue;
    //$sam1=str_replace('Posted:', ' ', $sam);
    //echo $sam1;
    //echo "<br>";
    $date1=$date->item(0)->nodeValue;
    $date2=str_replace('Posted:', ' ', $date1);
    $result->appendChild($domxml->createElement('date',$date2));*/

  //}
    $domxml->save('monster_WORDpress.xml');
}

//$domxml->save('result222.xml');

?>