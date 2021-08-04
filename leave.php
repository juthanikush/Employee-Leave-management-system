<?php

require('header.inc.php');
if(!isset($_GET['value'])){
    if(isset($_GET['id'])){
        $id=$_GET['id'];
        mysqli_query($con,"Delete from `leave` where id='$id'");
    }
}else{
    if(isset($_GET['id']) && isset($_GET['value'])){
        $id=$_GET['id'];
        $status=$_GET['value'];
        $res=mysqli_query($con,"Update `leave` SET leave_status='$status' where id='$id'");
        ?>
        <script>
            window.location.href='leave.php';
        </script>
    <?php

    }
}
if($_SESSION['ROLE']==1){
    $sql="SELECT `leave`.*,employee.name FROM `leave`,employee where `leave`.employee_id=employee.id order by `leave`.id desc";
}else{
    $id=$_SESSION['USER_ID'];
    $sql="SELECT * FROM `leave` where employee_id='$id'  order by id desc";
}


$res=mysqli_query($con,$sql);
$count=mysqli_num_rows($res);
if(isset($_GET['status'])){
    $status=$_GET['status'];
    $res=mysqli_query($con,"UPDATE `leave` SET status='$status'");
    ?>
    <script>
        window.location.href='leave.php';
    </script>
<?php
}
?>
 <div class="content">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">leave Master</strong><br>
                                <?php if($_SESSION['ROLE']!=1){?>
                                <a href="add_leave.php" class="btn btn-success btn-sm">+Add leave</a>
                                <?php } ?>
                            </div>
                            <div class="table-stats order-table ov-h">
                                <?php
                                if($count>0){?>
                                
                                    <table class="table ">
                                        <thead>
                                            <tr>
                                                
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>From</th>
                                                <th>To</th>
                                                <th>Status</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                while($row=mysqli_fetch_assoc($res)){?>
                                                <tr>
                                                    <td class="serial"><?php echo $row['id'];?></td>
                                                    <td class="serial"><?php echo $row['name'];?></td>
                                                    <td>  <span class="name"><?php echo $row['leave_from'];?></span> </td>
                                                    <td>  <span class="name"><?php echo $row['leave_to'];?></span> </td>
                                                    <td>  <span class="name"><?php 
                                                        if($row['leave_status']==1){
                                                            echo "Applied";
                                                        }
                                                        if($row['leave_status']==2){
                                                            echo "Approved";
                                                        }
                                                        if($row['leave_status']==3){
                                                            echo "Rejected";
                                                        }
                                                    ?></span> </td>
                                                    <td>
                                                        <?php if($_SESSION['ROLE']!=1){
                                                                if($row['leave_status']==1){
                                                            ?>
                                                            <a href="leave.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">delete</a>
                                                       <?php }} ?>

                                                       <?php if($_SESSION['ROLE']==1){?>
                                                            <select class="form-control" onchange="update_leave_status(<?php echo $row['id']; ?>,this.options[this.selectedIndex].value)">
                                                                <option value="0">Update Status</option>
                                                                <option value="2" >Approved Status</option>
                                                                <option value="3">Rejected Status</option>
                                                            </select>
                                                       <?php } ?>
                                                        
                                                    </td>
                                                </tr>
                                                
                                                <?php
                                                }
                                            ?>
                                            
                                        </tbody>
                                    </table>
                                <?php
                                }else{?>
                                    <center><h1>No Data Found</h1><center>
                                    
                                <?php
                                }
                                ?>
                               
                            </div> <!-- /.table-stats -->
                        </div>
                    </div>
             
                </div>

               

                
            </div>




            
        </div>
    </div><!-- .animated -->
</div>
<script>
    function update_leave_status(id,value){
    window.location.href='leave.php?id='+id+'&value='+value;
}
</script>
<?php
require('footer.inc.php');
?>