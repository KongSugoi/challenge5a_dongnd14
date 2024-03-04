<?php
session_start();
include('../includes/dbconnection.php');
if (strlen($_SESSION['sturecmsuid'])==0){
    header("Location: logout.php");
} else {
    $userid=$_SESSION['sturecmsuid'];

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Hệ thống quản lý sinh viên || Tin nhắn</title>
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
                                        <div class="d-sm-flex align-items-center mb-4">
                                            <h4 class="card-title mb-sm-0">Tin nhắn đã nhận</h4>
                                        </div>
                                        <div class="table-responsive border rounded p-1">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th class="font-weight-bold">ID</th>
                                                        <th class="font-weight-bold">Người gửi</th>
                                                        <th class="font-weight-bold">Tin nhắn</th>
                                                        <th class="font-weight-bold">Hành động</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $sql ="SELECT ID,Fullname,message_text FROM tbluser, message WHERE receiver_id=$userid AND tbluser.id=message.sender_id";
                                                    $query=$dbh->prepare($sql);
                                                    $query->execute();
                                                    $results=$query->fetchAll(PDO::FETCH_OBJ);
													$cnt=1;
                                                    if ($query->rowCount()>0){
                                                        foreach ($results as $row) {    ?>
                                                            <tr>
                                                                <td><?php  echo $cnt;?></td>
                                                                <td><?php  echo $row->Fullname;?></td>
                                                                <td><?php  echo $row->message_text;?></td>
                                                                <td>
                                                                    <div>
                                                                        <a href="delete-msg.php?receivedmsg=<?php echo ($row->ID);?>" onclick="return confirm('Bạn có chắc chắn muốn xóa ?');"> <i class="icon-trash"></i></a>
                                                                    </div>
                                                                </td>
                                                            </tr><?php $cnt=$cnt+1;
                                                        }
                                                    }   ?>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="d-sm-flex align-items-center mb-4">
                                            <h4 class="card-title mb-sm-0">Tin nhắn đã gửi</h4>
                                        </div>
                                        <div class="table-responsive border rounded p-1">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th class="font-weight-bold">ID</th>
                                                        <th class="font-weight-bold">Người nhận</th>
                                                        <th class="font-weight-bold">Tin nhắn</th>
                                                        <th class="font-weight-bold">Hành động</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $sql ="SELECT ID,Fullname,message_text FROM tbluser, message WHERE sender_id=$userid AND tbluser.ID= message.receiver_id";
                                                    $query=$dbh->prepare($sql);
                                                    $query->execute();
                                                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                                                    if ($query->rowCount()>0){
                                                        foreach ($results as $row) {    ?>
                                                            <tr>
                                                                <td><?php  echo htmlentities($row->ID);?></td>
                                                                <td><?php  echo htmlentities($row->Fullname);?></td>
                                                                <td><?php  echo htmlentities($row->message_text);?></td>
                                                                <td>
                                                                    <div>
                                                                        <a href="delete-msg.php?sentmsg=<?php echo ($row->ID);?>" onclick="return confirm('Bạn có chắc chắn muốn xóa?');"> <i class="icon-trash"></i></a>
                                                                    </div>
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