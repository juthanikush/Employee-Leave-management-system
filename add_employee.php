<?php
require('header.inc.php');
if(!isset($_GET['id'])){
    if(isset($_POST['submit'])){
        $name=mysqli_real_escape_string($con,$_POST['name']);
        $email=mysqli_real_escape_string($con,$_POST['email']);
        $mobile=mysqli_real_escape_string($con,$_POST['mobile']);
        $password=mysqli_real_escape_string($con,$_POST['password']);
        $department_id=mysqli_real_escape_string($con,$_POST['department_id']);
        $address=mysqli_real_escape_string($con,$_POST['address']);
        $birthday=mysqli_real_escape_string($con,$_POST['birthday']);
        $role=2;
        
        $res=mysqli_query($con,"insert into employee(name,email,mobile,password,department_id,address,birthday,role) values('$name','$email',$mobile,'$password',$department_id,'$address','$birthday',$role)");
        ?>
            <script>
                window.location.href='employee.php';
            </script>
        <?php
    }
}

$name="";
$email="";
$mobile="";
$password="";
$department_id="";
$address="";
$birthday="";

if(isset($_GET['id'])){
    $id=$_GET['id'];
    if($_SESSION['ROLE']==2 && $_SESSION['USER_ID']!=$id){
        die('You change url   !!!!!!!!!!!!!!');
    }
    $res=mysqli_query($con,"select * from employee where id='$id'");
    while($row=mysqli_fetch_assoc($res)){
        $name=$row['name'];
        $email=$row['email'];
        $mobile=$row['mobile'];
        $password=$row['password'];
        $department_id=$row['department_id'];
        $address=$row['address'];
        $birthday=$row['birthday'];
    }
    

    if(isset($_POST['submit'])){
        $name=$_POST['name'];
        $email=$_POST['email'];
        $mobile=$_POST['mobile'];
        $password=$_POST['password'];
        $department_id=$_POST['department_id'];
        $address=$_POST['address'];
        $birthday=$_POST['birthday'];
        $res=mysqli_query($con,"UPDATE employee SET name='$name',email='$email',mobile='$mobile',password='$password',department_id='$department_id',birthday='$birthday' where id='$id'");
        ?>
            <script>
                window.location.href='employee.php';
            </script>
        <?php
    }
}
$res1=mysqli_query($con,"SELECT * FROM `department`")

?>
<br>
<div class="col-lg-12">
   <div class="card">
      <div class="card-header">Add Employee</div>
      <div class="card-body card-block">
         <form action="#" method="post" class="">
            <div class="form-group">
               <div class="input-group">
                  <input type="text" id="deparment" name="name" placeholder="Employee Name" value="<?php echo $name; ?>" class="form-control" required>
               </div><br>
               <div class="input-group">
                  <input type="text" id="deparment" name="email" placeholder="Employee Email" value="<?php echo $email; ?>" class="form-control" required>
               </div>
               <br>
               <div class="input-group">
                  <input type="text" id="deparment" name="mobile" placeholder="Employee Mobile" value="<?php echo $mobile; ?>" class="form-control" required>
               </div><br>
               <div class="input-group">
                  <input type="text" id="deparment" name="password" placeholder="Employee Password" value="<?php echo $password; ?>" class="form-control" required>
               </div><br>
              
               <div class="input-group">
                  <input type="text" id="deparment" name="address" placeholder="Employee Address" value="<?php echo $address; ?>" class="form-control" required>
               </div><br>
               <div class="input-group">
                  <input type="date" id="deparment" name="birthday" placeholder="Employee Birthday" value="<?php echo $birthday; ?>" class="form-control" required>
               </div><br>
               <select id="select" class="form-control" name="department_id">
                        <option value="0">Please select</option>
                        <?php
                        while($row=mysqli_fetch_assoc($res1)){
                            
                                if($department_id==$row['id']){?>
                                    <option selected value="<?php echo $row['id'] ?>"><?php echo $row['department'] ?></option>
                                <?php }else{?>
                                    <option value="<?php echo $row['id'] ?>"><?php echo $row['department'] ?></option>
                             <?php   }
                            
                        }

                    ?>
                    </select>
                    <br>
            </div>
            <?php if($_SESSION['ROLE']==2){

            }else{?>
<div class="form-actions form-group"><button type="submit" name="submit" class="btn btn-success ">Submit</button></div>
           <?php } ?>
            
         </form>
      </div>
   </div>
</div>
<?php
require('footer.inc.php');
?>