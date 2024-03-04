<?php
session_start();
include('../includes/dbconnection.php');
if (strlen($_SESSION['sturecmsuid'])==0){
    header("Location: logout.php");
} else {

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Hệ thông quản lý sinh viên || Thử thách</title>
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
                        <div class="page-header">
                            <h3 class="page-title">Danh sách thử thách</h3>
                        </div>
                        <div class="row">
                            <div class="col-md-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive border rounded p-1">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th class="font-weight-bold">ID</th>
                                                        <th class="font-weight-bold">Thử thách</th>
                                                        <th class="font-weight-bold">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php                                                                                                      
                                                    $ret = "SELECT * FROM challenge";
                                                    $query1 = $dbh->prepare($ret);
                                                    $query1->execute();
                                                    $results1=$query1->fetchAll(PDO::FETCH_OBJ);
                                                    $total_rows=$query1->rowCount();                                                    
                                                    if ($query1->rowCount()>0){
                                                        foreach ($results1 as $row) {    ?>
                                                            <tr>
                                                                <td><?php  echo htmlentities($row->cid);?></td>
                                                                <td><?php  echo htmlentities($row->cname);?></td>
                                                                <td>
                                                                    <a href="challenge-details.php?cid=<?php echo htmlentities($row->cid);?>"> &nbsp; Xem chi tiết</a>
                                                                </td>
                                                            </tr><?php
                                                        }
                                                    }   ?>
                                                </tbody>
                                            </table>
                                        </div>                                        
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