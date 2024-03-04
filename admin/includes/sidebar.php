<nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-profile">
              <a href="#" class="nav-link">
                <div class="profile-image">
                  <img class="img-xs rounded-circle" src="images/faces/face8.jpg" alt="profile image">
                  <div class="dot-indicator bg-success"></div>
                </div>
                <div class="text-wrapper">
                  <?php
         $aid= $_SESSION['sturecmsaid'];
$sql="SELECT * from tbluser where ID=:aid";

$query = $dbh -> prepare($sql);
$query->bindParam(':aid',$aid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
                  <p class="profile-name"><?php  echo htmlentities($row->Fullname);?></p>
                  <p class="designation"><?php  echo htmlentities($row->Email);?></p><?php $cnt=$cnt+1;}} ?>
                </div>
               
              </a>
            </li>
            <li class="nav-item nav-category">
              <span class="nav-link">Tùy chọn</span>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="dashboard.php">
                <span class="menu-title">Trang chủ</span>
                <i class="icon-screen-desktop menu-icon"></i>
              </a>
            </li>
            
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#ui-basic1" aria-expanded="false" aria-controls="ui-basic1">
                <span class="menu-title">Sinh viên</span>
                <i class="icon-people menu-icon"></i>
              </a>
              <div class="collapse" id="ui-basic1">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="add-students.php">Thêm sinh viên</a></li>
                  <li class="nav-item"> <a class="nav-link" href="manage-students.php">Quản lý sinh viên</a></li>
				  <li class="nav-item"> <a class="nav-link" href="message.php">Nhắn tin</a></li>
				  
                </ul>
              </div>
			  
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                <span class="menu-title">Bài tập</span>
                <i class="icon-doc menu-icon"></i>
              </a>
              <div class="collapse" id="auth">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="add-public-notice.php"> Thêm bài tập </a></li>
                  <li class="nav-item"> <a class="nav-link" href="manage-public-notice.php"> Quản lý bài tập </a></li>
				  <li class="nav-item"> <a class="nav-link" href="manage-assignment.php"> Xem bài tập đã nộp</a></li>
                </ul>
              </div>
			  </li>	<li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#fake" aria-expanded="false" aria-controls="fake">
                <span class="menu-title">Thử thách</span>
                <i class="icon-doc menu-icon"></i>
              </a>
              <div class="collapse" id="fake">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="add-challenges.php"> Thêm thử thách </a></li>
                  <li class="nav-item"> <a class="nav-link" href="manage-challenges.php"> Quản lý thử thách </a></li>
                </ul>
              </div>
			  </li>			  			  
            <li class="nav-item">
              <a class="nav-link" href="search.php">
                <span class="menu-title">Tìm kiếm sinh viên</span>
                <i class="icon-magnifier menu-icon"></i>
              </a>
            </li>
            </li>
          </ul>
        </nav>