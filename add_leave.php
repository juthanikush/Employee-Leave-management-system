<?php
require('header.inc.php');

if(!isset($_GET['id'])){
    if(isset($_POST['submit'])){
        $leave_from=mysqli_real_escape_string($con,$_POST['leave_from']);
        $leave_to=mysqli_real_escape_string($con,$_POST['leave_to']);
        $leave_description=mysqli_real_escape_string($con,$_POST['desc']);
        $leave_id=mysqli_real_escape_string($con,$_POST['leave_id']);
        $employee_id=$_SESSION['USER_ID'];
        //echo $sq="insert into `leave`(employee_id,leave_id,leave_from,leave_to,leave_description) values($employee_id,$leave_id,'$leave_from','$leave_to','$leave_description')";
        $res=mysqli_query($con,"insert into `leave`(employee_id,leave_id,leave_from,leave_to,leave_description,leave_status) values($employee_id,$leave_id,'$leave_from','$leave_to','$leave_description',1)");
        ?>
            <script>
               window.location.href='leave.php';
            </script>
        <?php
    }
}
$res2=mysqli_query($con,"SELECT * FROM `leave_type`");



?>
<br>
<div class="col-lg-12">
   <div class="card">
      <div class="card-header">Add Leave</div>
      <div class="card-body card-block">
         <form action="#" method="post" class="">

            <div class="form-group">
               <div class="input-group">
                  <input type="date" id="deparment" name="leave_from" placeholder="Leave From" class="form-control" required>
               </div>
            </div>
            <div class="form-group">
               <div class="input-group">
                  <input type="date" id="deparment" name="leave_to" placeholder="Leave To" class="form-control" required>
               </div>
            </div>
            <div class="form-group">
               <div class="input-group">
                  <input type="text" id="deparment" name="desc" placeholder="Leave Description" class="form-control" required>
               </div>
            </div>
            <div class="form-group">
               <div class="input-group">
                    <select id="select" class="form-control" name="leave_id">
                        <option value="0">Please select leave Type</option>
                        <?php
                        while($row=mysqli_fetch_assoc($res2)){?>
                        <option value="<?php echo $row['id'] ?>"><?php echo $row['leave_type'] ?></option>
                        <?php }

                    ?>
                    </select>
                </div>
            </div>
            
            <div class="form-actions form-group"><button type="submit" name="submit" class="btn btn-success ">Submit</button></div>
         </form>
      </div>
   </div>
</div>
<?php
require('footer.inc.php');
?>