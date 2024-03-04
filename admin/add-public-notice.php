<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['sturecmsaid']) == 0) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {
        $nottitle = $_POST['nottitle'];
        $notmsg = $_POST['notmsg'];

        // Handle file upload
        $pdf_file = $_FILES['pdf_file']['name'];
        $pdf_tmp_name = $_FILES['pdf_file']['tmp_name'];

        // Move uploaded file to desired location
        $pdf_target_dir = "../public/uploads/";
        $pdf_target_file = $pdf_target_dir . basename($pdf_file);
        move_uploaded_file($pdf_tmp_name, $pdf_target_file);

        // Insert notice data into database including file information
        $sql = "INSERT INTO tblpublicnotice (NoticeTitle, NoticeMessage, FileName) VALUES (:nottitle, :notmsg, :pdf_file)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':nottitle', $nottitle, PDO::PARAM_STR);
        $query->bindParam(':notmsg', $notmsg, PDO::PARAM_STR);
        $query->bindParam(':pdf_file', $pdf_target_file, PDO::PARAM_STR);
        $query->execute();

        $LastInsertId = $dbh->lastInsertId();
        if ($LastInsertId > 0) {
            echo '<script>alert("Bài tập đã được thêm vào.")</script>';
            echo "<script>window.location.href ='add-public-notice.php'</script>";
        } else {
            echo '<script>alert("Có lỗi xảy ra. Hãy thử lại")</script>';
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
  <head>
   
    <title>Hệ thống quản lý sinh viên || Thêm bài tập</title>
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
              <h3 class="page-title">Thêm bài tập </h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="dashboard.php">Trang chủ</a></li>
                  <li class="breadcrumb-item active" aria-current="page"> Thêm bài tập</li>
                </ol>
              </nav>
            </div>
            <div class="row">
          
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title" style="text-align: center;">Thêm bài tập</h4>
                   
                    <form class="forms-sample" method="post" enctype="multipart/form-data">
                      
                      <div class="form-group">
                        <label for="exampleInputName1">Đề bài</label>
                        <input type="text" name="nottitle" value="" class="form-control" required='true'>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputName1">Mô tả</label>
                        <textarea name="notmsg" value="" class="form-control" required='true'></textarea>
                      </div>
					  <div class="form-group">
                        <label for="exampleInputName1">Bài tập</label>
                        <input type="file" class="form-control-file" id="pdf_file" name="pdf_file" accept="application/pdf" required>
                      </div>
                      <button type="submit" class="btn btn-primary mr-2" name="submit">Thêm</button>
                     
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
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
</html><?php }  ?>