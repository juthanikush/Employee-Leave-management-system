<?php
require('header.inc.php');
if($_SESSION['ROLE']==2){
    ?>
        <script>
            window.location.href='add_employee.php?id=<?php echo $_SESSION['USER_ID'] ?>'
        </script>
    <?php
}
if(!isset($_GET['id'])){
    if(isset($_POST['submit'])){
        $leave_type=mysqli_real_escape_string($con,$_POST['leave_type']);
        $res=mysqli_query($con,"insert into leave_type(leave_type) values('$leave_type')");
        ?>
            <script>
                window.location.href='leave_type.php';
            </script>
        <?php
    }
}

$leave_type='';
if(isset($_GET['id'])){
    $id=$_GET['id'];
    $res=mysqli_query($con,"select * from leave_type where id='$id'");
    while($row=mysqli_fetch_assoc($res))
    $leave_type=$row['leave_type'];
    if(isset($_POST['submit'])){
        $leave_type=$_POST['leave_type'];
        $res=mysqli_query($con,"UPDATE leave_type SET leave_type='$leave_type' where id='$id'");
        ?>
            <script>
                window.location.href='leave_type.php';
            </script>
        <?php
    }
}

?>
<br>
<div class="col-lg-12">
   <div class="card">
      <div class="card-header">Add Leave Type</div>
      <div class="card-body card-block">
         <form action="#" method="post" class="">
            <div class="form-group">
               <div class="input-group">
                  <input type="text" id="deparment" name="leave_type" placeholder="Leave Type" value="<?php echo $leave_type; ?>" class="form-control" required>
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