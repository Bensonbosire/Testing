
<?php
 $pagetitle="Subjects Information";
 include "includes/header.php"; ?>
 <?php $db = new db(); ?>

<div class="container">


              <div class="row">
                    <div class="templatemo-line-header" style="margin-top: 0px;" >
                        <div class="text-center">
                            <hr class="team_hr team_hr_left hr_gray"/><span class="span_blog txt_darkgrey txt_orange">Units Details</span>
                            <hr class="team_hr team_hr_right hr_gray" />
                        </div>
                    </div>
                </div>
               <p><a href="subject_entry.php" class="ui blue tiny button "><i class="glyphicon glyphicon-plus"> </i>Insert</a></p>
                <div class="table-responsive">
                 <table class="ui celled table table table-hover">
                  <thead>
                    <tr>          
                      <th>Unitid</th>
                      <th>Unitname</th>
                      <th>Lecturer Name</th>
                      <th>Field</th>
                      <th>Semester</th>
                    </tr>
                  </thead>
      <tbody>
          <?php        
            $veiw = $db->get_all_subject($conn,'subject_table',10);
            foreach ($veiw as $post) {
            $sub_id = $post['Unitid'];
  
            echo '<tr>';        
            echo '<td>'. $post['Unitid'] . '</td>';
            echo '<td>'. $post['Unitname'] . '</td>';
            echo '<td>'. $post['lecturername'] . '</td>';
            echo '<td>'. $post['field'] . '</td>';
            echo '<td>'. $post['semester'] . '</td>';
            }
           ?>
      </tbody>     
             </table>



</div> <!--table-responsive-->
</div><!--container-->
<?php include "includes/footer.php"; ?>
