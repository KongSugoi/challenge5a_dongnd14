<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['sturecmsuid']) == 0) {
  header('location:logout.php');
} else {
  if(isset($_POST['submit'])) { 
    $image=$_FILES["image"]["name"];
    $extension = pathinfo($image, PATHINFO_EXTENSION);
    $sid = $_SESSION['sturecmsuid'];
    $image=$image;
    move_uploaded_file($_FILES["image"]["tmp_name"],"../admin/images/".$image);
    $sql="update tbluser set Image=:image where ID=:sid";
    $query=$dbh->prepare($sql);
    $query->bindParam(':image',$image,PDO::PARAM_STR);
    $query->bindParam(':sid',$sid,PDO::PARAM_STR);
    $query->execute();
    echo '<script>alert("Thông tin sinh viên đã được cập nhật")</script>';
  }
?>
<!DOCTYPE html>
<html lang="en">
<head> 
	<title>Hệ thống quản lý sinh viên || Thông tin sinh viên</title>
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
				<h3 class="page-title"> Xem thông tin sinh viên </h3>
				<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="dashboard.php">Trang chủ</a></li>
					<li class="breadcrumb-item active" aria-current="page"> Xem thông tin sinh viên</li>
				</ol>
				</nav>
			</div>
			<div class="row">
				<div class="col-12 grid-margin stretch-card">
					<div class="card">
						<div class="card-body">
							<form class="forms-sample" method="post" enctype="multipart/form-data">
								<table border="1" class="table table-bordered mg-b-0">
	<?php
		$sid=$_SESSION['sturecmsuid'];
		$sql="SELECT * from tbluser where tbluser.ID=:sid";
		$query = $dbh -> prepare($sql);
		$query->bindParam(':sid',$sid,PDO::PARAM_STR);
		$query->execute();
		$results=$query->fetchAll(PDO::FETCH_OBJ);
		$cnt=1;
		if($query->rowCount() > 0) {
			foreach($results as $row) { ?>
				<tr align="center" class="table-warning">
					<td colspan="4" style="font-size:20px;color:blue">
						Thông tin sinh viên</td></tr>
				<tr class="table-info">
				<th>Tên sinh viên</th>
					<td><?php echo $row->Fullname;?></td>
				<th>Email</th>
					<td><?php echo $row->Email;?></td>
				</tr>  
				<tr class="table-primary">
				<th>Số điện thoại</th>
					<td><?php echo $row->Phone;?></td>   
				</tr>
				<tr class="table-progress">    
				<th>Tên tài khoản</th>
					<td><?php echo $row->Username;?></td>
				</tr>
				<tr class="table-info">
				<th>Ảnh đại diện</th>
					<td>
						<img src="../admin/images/<?php echo $row->Image;?>" width="200" height="200" value="<?php echo $row->Image;?>">
						<input type="file" name="image" value="Đổi ảnh đại diện" class="form-control" required='true'> 
					</td>
				</tr>
		<?php $cnt=$cnt+1;}} ?>
								</table>
		<button type="submit" class="btn btn-primary mr-2" name="submit">Cập nhật</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>

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
<?php }  ?>
