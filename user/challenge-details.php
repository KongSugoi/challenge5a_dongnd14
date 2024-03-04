<?php
session_start();
include('../includes/dbconnection.php');
if (strlen($_SESSION['sturecmsuid'])==0){
    header("Location: logout.php");
} else {
    $cid=$_GET['cid'];
    $sql="SELECT * FROM challenge WHERE cid=:id";
    $query=$dbh->prepare($sql);
    $query->bindParam(':id',$cid,PDO::PARAM_STR);
    $query->execute();
    $result=$query->fetch(PDO::FETCH_OBJ);
    $filename=$result->cname;
    $correct_ans=substr($filename,0,-4);
    
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Hệ thống quản lý sinh viên ||  Thông tin thử thách</title>
        <!--plugins:css-->
        <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
        <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
        <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">


        <link rel="stylesheet" href="./css/style.css">
    </head>
    <body>
        <div class="container-scroller">
            <?php include_once('includes/header.php'); ?>
            <div class="container-fluid page-body-wrapper">
                <?php include_once('includes/sidebar.php');?>
                <div class="main-panel">
                    <div class="content-wrapper">
                        <div class="row">
                            <div class="col-md-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                    <h4 class="card-title" style="text-align: center;">Thử thách</h4>
                                    <p>Tên thử thách <?php echo htmlentities($result->cname); ?> </p>
                                    <form class="forms-sample" method="post" enctype="multipart/form-data">
                                        
                                        <div class="form-group">
                                            <label for="exampleInputName1">Gợi ý</label>
                                            <input type="text" name="hint" value="<?php  echo htmlentities($result->hint);?>" class="form-control" readonly='true'>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputName1">Nhập đáp án</label>
                                            <input type="text" name="answer" value="" class="form-control" required='true'>
                                        </div>
                                        <button type="submit" class="btn btn-primary mr-2" name="submit">Gửi</button>

                                    </form>
                                    <?php
                                        if (isset($_POST['submit'])){
                                            $ans=$_POST['answer'];
                                            if ($ans===$correct_ans) {
                                                echo '<script>alert("Đáp án chính xác")</script>';
                                                $challenge_file = "../public/challenges/" . $filename;
                                                $challenge_content = file_get_contents($challenge_file);
                                                echo "<p>Nội dung file thử thách:</p>";
                                                echo nl2br($challenge_content);
                                            } else {
                                                echo '<script>alert("Đáp án sai, hãy thử lại")</script>';
                                            }
                                        }
                                    ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- plugins:js -->
        <script src="vendors/js/vendor.bundle.base.js"></script>

        <script src="./vendors/chart.js/Chart.min.js"></script>
        <script src="./vendors/moment/moment.min.js"></script>
        <script src="./vendors/daterangepicker/daterangepicker.js"></script>
        <script src="./vendors/chartist/chartist.min.js"></script>

        <script src="js/off-canvas.js"></script>
        <script src="js/misc.js"></script>
        

    </body>
</html>
<?php } ?>