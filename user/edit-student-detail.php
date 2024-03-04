<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['sturecmsuid']) == 0) {
  header('location:logout.php');
  } else{
  if (isset($_POST['submit'])){
    $message=$_POST['message'];
    $senderid=$_SESSION['sturecmsuid'];
    $receiverid=$_GET['editid'];
    //echo $receiverid;
    $sql="";
    $ret="SELECT * FROM message WHERE receiver_id=:receiverid AND sender_id=:senderid";
    $query=$dbh->prepare($ret);
    $query->bindParam(':receiverid',$receiverid,PDO::PARAM_STR);
    $query->bindParam(':senderid',$senderid,PDO::PARAM_STR);
    $query->execute();
    if ($query->rowCount()>0){
      $sql="UPDATE message SET message_text=:message WHERE receiver_id=:receiverid AND sender_id=:senderid";
    } else {
      $sql="INSERT INTO message(receiver_id,sender_id,message_text) VALUE (:receiverid,:senderid,:message)";
    }
    $query=$dbh->prepare($sql);
    $query->bindParam(':receiverid',$receiverid,PDO::PARAM_STR);
    $query->bindParam(':senderid',$senderid,PDO::PARAM_STR);
    $query->bindParam(':message',$message,PDO::PARAM_STR);
    $query->execute();
    echo '<script>alert("Tin nhắn đã được gửi đi")</script>';
    echo "<script>window.location.href ='message.php'</script>";
  }
  ?>
<!DOCTYPE html>
<html lang="en">
  <head>
   
    <title>Hệ thống quản lý sinh viên || Cập nhật thông tin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="vendors/select2/select2.min.css">
    <link rel="stylesheet" href="vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="css/style.css" />
    
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
     <?php include_once('includes/header.php');?>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
      <?php include_once('includes/sidebar.php');?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title"> Cập nhật thông tin </h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="dashboard.php">Trang chủ</a></li>
                  <li class="breadcrumb-item active" aria-current="page"> Cập nhật thông tin</li>
                </ol>
              </nav>
            </div>
            <div class="row">
          
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title" style="text-align: center;">Cập nhật thông tin</h4>
                   
                    <form class="forms-sample" method="post" enctype="multipart/form-data">
                      <?php
$eid = $_GET['editid'];
$sql="SELECT * from tbluser where tbluser.ID=:eid";
$query = $dbh -> prepare($sql);
$query->bindParam(':eid',$eid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
                      <div class="form-group">
                        <label for="exampleInputName1">Tên sinh viên</label>
                        <input type="text" name="stuname" value="<?php  echo $row->Fullname;?>" class="form-control" readonly required='true'>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputName1">Email</label>
                        <input type="text" name="stuemail" value="<?php  echo $row->Email;?>" class="form-control" readonly required='true'>
                      </div>     
					  <div class="form-group">
                        <label for="exampleInputName1">Số điện thoại</label>
                        <input type="text" name="connum" value="<?php  echo $row->Phone;?>" class="form-control" readonly required='true' maxlength="10" pattern="[0-9]+">
                      </div> 					  
                      <div class="form-group">
                        <label for="exampleInputName1">Ảnh đại diện</label>
                        <img src="../admin/images/<?php echo $row->Image;?>" width="100" height="100" value="<?php  echo $row->Image;?>" readonly>
                      </div> 
					   <?php
					  $eid = $_GET['editid'];
                      $senderid=$_SESSION['sturecmsuid'];
                      $sql="SELECT * FROM message WHERE receiver_id=:eid AND sender_id=:senderid";
                      $query = $dbh -> prepare($sql);
                      $query->bindParam(':eid',$eid,PDO::PARAM_STR);
                      $query->bindParam(':senderid',$senderid,PDO::PARAM_STR);
                      $query->execute();
                      $result=$query->fetch(PDO::FETCH_OBJ);
                      ?>
                      <div class="form-group">
                        <label for="exampleInputName1">Để lại lời nhắn</label>
                        <input type="text" name="message" value="<?php  echo $result->message_text;?>" class="form-control" required='true'>
                      </div>
					  <button type="submit" class="btn btn-primary mr-2" name="submit">Gửi</button>
						<?php $cnt=$cnt+1;}} ?>
                      
  <?php } ?>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->          
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="vendors/select2/select2.min.js"></script>
    <script src="vendors/typeahead.js/typeahead.bundle.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="js/off-canvas.js"></script>
    <script src="js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="js/typeahead.js"></script>
    <script src="js/select2.js"></script>
    <!-- End custom js for this page -->
  </body>
  </html>