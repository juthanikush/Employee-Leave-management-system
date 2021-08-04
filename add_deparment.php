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
        $deparment=mysqli_real_escape_string($con,$_POST['deparment']);
        $res=mysqli_query($con,"insert into department(department) values('$deparment')");
        ?>
            <script>
                window.location.href='index.php';
            </script>
        <?php
    }
}

$deparment='';
if(isset($_GET['id'])){
    $id=$_GET['id'];
    $res=mysqli_query($con,"select * from department where id='$id'");
    while($row=mysqli_fetch_assoc($res))
    $deparment=$row['department'];
    if(isset($_POST['submit'])){
        $deparment=$_POST['deparment'];
        $res=mysqli_query($con,"UPDATE department SET department='$deparment' where id='$id'");
        ?>
            <script>
                window.location.href='index.php';
            </script>
        <?php
    }
}

?>
<br>
<div class="col-lg-12">
   <div class="card">
      <div class="card-header">Add Deparment</div>
      <div class="card-body card-block">
         <form action="#" method="post" class="">
            <div class="form-group">
               <div class="input-group">
                  <input type="text" id="deparment" name="deparment" placeholder="Deparment" value="<?php echo $deparment; ?>" class="form-control" required>
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