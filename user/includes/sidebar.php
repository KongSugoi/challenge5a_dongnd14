<nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-profile">
              <a href="#" class="nav-link">
                <div class="profile-image">
                  <img class="img-xs rounded-circle" src="../admin/images/<?php echo $row->Image;?>" alt="profile image">
                  <div class="dot-indicator bg-success"></div>
                </div>
                <div class="text-wrapper">
                  <?php
         $uid= $_SESSION['sturecmsuid'];
$sql="SELECT * from tbluser where ID=:uid";

$query = $dbh -> prepare($sql);
$query->bindParam(':uid',$uid,PDO::PARAM_STR);
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
              <span class="nav-link">Trang chủ</span>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="dashboard.php">
                <span class="menu-title">Trang chủ</span>
                <i class="icon-screen-desktop menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="view-notice.php">
                <span class="menu-title">Bài tập</span>
                <i class="icon-book-open menu-icon"></i>
              </a>
            </li>
			<li class="nav-item">
              <a class="nav-link" href="view-challenges.php">
                <span class="menu-title">Thử thách</span>
                <i class="icon-book-open menu-icon"></i>
              </a>
            </li>
			<li class="nav-item">
              <a class="nav-link" href="message.php">
                <span class="menu-title">Nhắn tin</span>
                <i class="icon-book-open menu-icon"></i>
              </a>
            </li>
			<li class="nav-item">
              <a class="nav-link" href="manage-students.php">
                <span class="menu-title">Xem sinh viên</span>
                <i class="icon-people menu-icon"></i>
              </a>
            </li>
          </ul>
        </nav>