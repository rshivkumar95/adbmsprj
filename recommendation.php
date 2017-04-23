 
 <?php

 include("config.php");
 if(isset($_POST['page'])){
    //Include pagination class file
    include('Pagination.php');
$userid=$_SESSION['userid'];

 $start = !empty($_POST['page'])?$_POST['page']:0;
    $limit = 30;

            

                $query="SELECT * FROM jobs,JobUserSimilarity WHERE jobs.id=ANY(SELECT JobUserSimilarity.jobID FROM JobUserSimilarity WHERE JobUserSimilarity.similarity>0 AND JobUserSimilarity.userID='$userid') and JobUserSimilarity.jobID=jobs.id ORDER BY JobUserSimilarity.similarity DESC";
              //$query="SELECT * FROM `jobs` WHERE `job_title`!='' ORDER BY RAND() LIMIT 6";

                 $result=mysql_query($query);
                 $rowCount=mysql_num_rows($result);

                 $pagConfig = array('baseURL'=>'getData.php', 'totalRows'=>$rowCount, 'currentPage'=>$start, 'perPage'=>$limit, 'contentDiv'=>'job-list');
                 $pagination =  new Pagination($pagConfig);

                  $query="SELECT * FROM jobs,JobUserSimilarity WHERE jobs.id=ANY(SELECT JobUserSimilarity.jobID FROM JobUserSimilarity WHERE JobUserSimilarity.similarity>0 AND JobUserSimilarity.userID='$userid') and JobUserSimilarity.jobID=jobs.id ORDER BY JobUserSimilarity.similarity DESC LIMIT '$start','$limit'";
              //$query="SELECT * FROM `jobs` WHERE `job_title`!='' ORDER BY RAND() LIMIT 6";

                 $result=mysql_query($query);
                  
                 while ($obj=mysql_fetch_assoc($result)) {
                 	

       ?>

			<li><a href="viewjob.php?jobid=<?php ?>">
				<div class="job-list-content">
					<h4 style="margin-bottom: 0px;"><?php if($obj['job_title']!="") echo $obj['job_title']; else echo "Job Position Not Revealed";?></h4>
					<p style="margin-top: 0px;"><?php echo $obj['cmp_name']; ?></p>
					<div class="job-icons">
						<span><i class="fa fa-briefcase"></i><?php echo $obj['experience']; ?></span>
						<span><i class="fa fa-map-marker"></i><?php echo $obj['cmp_location']; ?></span>
						<span><i class="fa fa-money"></i><?php if($obj['salary']=="") echo "Not Disclosed by Recruiter"; else echo trim($obj['salary']); ?></span>
					</div>

					<h4>
                    <?php
                              
                              $skills=explode(',', $obj['skills']);

                              foreach ($skills as $skill) {
                              	


                    ?>


					<span class="full-time"><?php echo $skill; ?></span>
                    <?php

                     }
                    ?>

					</h4>
				</div>
				</a>
				<div class="clearfix"></div>
			</li>

			<?php

		}
		echo $pagination->createLinks(); 
	}	
		
		
         

		?>