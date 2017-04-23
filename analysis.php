<?php

include("config.php");
error_reporting(0);
session_start();

$query = "SELECT DISTINCT * FROM `skillCount` WHERE skill!='' ORDER BY `count` DESC LIMIT 10";
                $result = mysql_query($query) or die(mysql_error());
                 $rows=array();
                 $table = array();
                $table['cols'] = array(

                    // Labels for your chart, these represent the column titles
                    // Note that one column is in "string" format and another one is in "number" format as pie chart only required "numbers" for calculating percentage and string will be used for column title
                    array('label' => 'Skill Name', 'type' => 'string'),
                    array('label' => 'Total Jobs', 'type' => 'number')

                );
              while ( $row = mysql_fetch_assoc( $result ) ) 
              {
                  $pname=$row['skill'];
                $temp = array();
                // the following line will be used to slice the Pie chart
                $temp[] = array('v' => (string) $row['skill']); 

                // Values of each slice
                $temp[] = array('v' => (int) $row['count']); 
                $rows[] = array('c' => $temp);
                 
              }
              $table['rows'] = $rows;
              $jsonTable = json_encode($table);



              $query = "SELECT `skill` FROM `resumes` WHERE `user_id`=19";
                $result = mysql_query($query) or die(mysql_error());
                $data=mysql_fetch_assoc($result);
                $skills=explode(",",$data['skill']);


                 $rows=array();
                 $table = array();
                $table['cols'] = array(

                    // Labels for your chart, these represent the column titles
                    // Note that one column is in "string" format and another one is in "number" format as pie chart only required "numbers" for calculating percentage and string will be used for column title
                    array('label' => 'Skill Name', 'type' => 'string'),
                    array('label' => 'Total Jobs', 'type' => 'number')

                );

              foreach ($skills as $skill) {

                  $query = "SELECT * FROM `skillCount` WHERE skill='$skill'";
                $result = mysql_query($query) or die(mysql_error());

                $data=mysql_fetch_assoc($result);
                $skillName=$data['skill'];
                $skillCount=$data['count'];

                $temp = array();
                // the following line will be used to slice the Pie chart
                $temp[] = array('v' => (string) $skillName); 

                // Values of each slice
                $temp[] = array('v' => (int) $skillCount); 
                $rows[] = array('c' => $temp);
                # code...
              }

              
              $table['rows'] = $rows;
              $jsonTable1 = json_encode($table);



?>



<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Test Layout</title>
        <style type="text/css">
            body, html
            {
                margin: 0; padding: 0; height: 100%; overflow: hidden;
            }

            #content
            {
                position:absolute; left: 0; right: 0; bottom: 0; top: 0px; 
            }
        </style>
    </head>
    <body>
        <div id="content">
            <iframe width="100%" height="100%" frameborder="0" src="operations/charts.html" />
        </div>
    </body>
</html>
