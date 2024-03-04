<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['sturecmsaid']==0)) {
  header('location:logout.php');
  } else{
   // Code for deletion
if(isset($_GET['delid']))
{
$rid=intval($_GET['delid']);
$sql="delete from tbluser where ID=:rid";
$query=$dbh->prepare($sql);
$query->bindParam(':rid',$rid,PDO::PARAM_STR);
$query->execute();
 echo "<script>alert('Sinh viên đã được xóa');</script>"; 
  echo "<script>window.location.href = 'manage-students.php'</script>";     


}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
   
    <title>Student  Management System|||Search Students</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="./vendors/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="./vendors/chartist/chartist.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="./css/style.css">
    <!-- End layout styles -->
   
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
              <h3 class="page-title"> Search Student </h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                  <li class="breadcrumb-item active" aria-current="page"> Search Student</li>
                </ol>
              </nav>
            </div>
            <div class="row">
              <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <form method="post">
                                <div class="form-group">
                                   <strong>Search Student:</strong>
                                   
                                    <input id="searchdata" type="text" name="searchdata" required="true" class="form-control" placeholder="Search by Student ID"></div>
                               
                                <button type="submit" class="btn btn-primary" name="search" id="submit">Search</button>
                            </form>
                    <div class="d-sm-flex align-items-center mb-4">


                       <?php
if(isset($_POST['search']))
{ 

$sdata=$_POST['searchdata'];
  ?>
  <h4 align="center">Tìm kiếm "<?php echo $sdata;?>" </h4>
                    </div>
                    <div class="table-responsive border rounded p-1">
                      
                      <table class="table">
                        <thead>
                          <tr>
                            <th class="font-weight-bold">STT</th>                            
                            <th class="font-weight-bold">Tên sinh viên</th>
                            <th class="font-weight-bold">Tài khoản</th>
							<th class="font-weight-bold">Mật khẩu</th>
							<th class="font-weight-bold">Số điện thoại</th>
							<th class="font-weight-bold">Email</th>							
                            <th class="font-weight-bold">Hành động</th>                            
                          </tr>
                        </thead>
                        <tbody>
                           <?php                           
        // Formula for pagination        
       $ret = "SELECT ID FROM tbluser where type='student'";
$query1 = $dbh -> prepare($ret);
$query1->execute();
$results1=$query1->fetchAll(PDO::FETCH_OBJ);
$total_rows=$query1->rowCount();
$sql = "SELECT * FROM tbluser WHERE tbluser.Fullname LIKE '$sdata%' OR tbluser.Username LIKE '$sdata%'";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>   
                          <tr>
                           
                            <td><?php echo $cnt;?></td>
                            <td><?php  echo $row->Fullname;?></td>
                            <td><?php  echo $row->Username;?></td>
                            <td><?php  echo $row->Password;?></td>
							<td><?php  echo $row->Phone;?></td>
                            <td><?php  echo $row->Email;?></td>                            
                            <td>
                              <div><a href="edit-student-detail.php?editid=<?php echo $row->ID; ?>"><i class="icon-eye"></i></a>
                                                || <a href="manage-students.php?delid=<?php echo ($row->ID);?>" onclick="return confirm('Bạn có chắc muốn xóa sinh viên này ?');"> <i class="icon-trash"></i></a></div>
                            </td> 
                          </tr><?php 
$cnt=$cnt+1;
} } else { ?>
  <tr>
    <td colspan="8"> Không có sinh viên này</td>

  </tr>
  <?php } }?>
                        </tbody>
                      </table>
                    </div>                    
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->        
          <!-- partial -->
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
    <script src="./vendors/chart.js/Chart.min.js"></script>
    <script src="./vendors/moment/moment.min.js"></script>
    <script src="./vendors/daterangepicker/daterangepicker.js"></script>
    <script src="./vendors/chartist/chartist.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="js/off-canvas.js"></script>
    <script src="js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="./js/dashboard.js"></script>
    <!-- End custom js for this page -->
  </body>
</html><?php }  ?>