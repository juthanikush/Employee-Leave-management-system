<?php
require('header.inc.php');
if($_SESSION['ROLE']==2){
   ?>
       <script>
           window.location.href='add_employee.php?id=<?php echo $_SESSION['USER_ID'] ?>'
       </script>
   <?php
}
if(isset($_GET['id'])){
    $id=$_GET['id'];
    mysqli_query($con,"Delete from leave_type where id='$id'");
}
$sql="SELECT * FROM leave_type order by id desc";
$res=mysqli_query($con,$sql);
$count=mysqli_num_rows($res);

?>

<div class="content">
   <div class="animated fadeIn">
      <div class="row">
         <div class="col-lg-12">
            <div class="card">
               <div class="card-header">
                  <strong class="card-title">Leave Type Master</strong><br>
                  <a href="add_leave_type.php" class="btn btn-success btn-sm">+Add Leave </a>
               </div>
               <div class="table-stats order-table ov-h">
                  <?php
                     if($count>0){?>
                  <table class="table ">
                     <thead>
                        <tr>
                           <th>ID</th>
                           <th>Leave Type Name</th>
                           <th></th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                           while($row=mysqli_fetch_assoc($res)){?>
                        <tr>
                           <td class="serial"><?php echo $row['id'];?></td>
                           <td>  <span class="name"><?php echo $row['leave_type'];?></span> </td>
                           <td>
                              <a href="leave_type.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                              <a href="add_leave_type.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
                           </td>
                        </tr>
                        <?php
                           }
                           ?>
                     </tbody>
                  </table>
                  <?php
                     }else{?>
                  <center>
                  <h1>No Data Found</h1>
                  <center>
                  <?php
                     }
                     ?>
               </div>
               <!-- /.table-stats -->
            </div>
         </div>
      </div>
   </div>
</div>
</div><!-- .animated -->
</div><!-- .co
<?php
require('footer.inc.php');
?>