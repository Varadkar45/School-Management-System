<?php
include_once './config/config.php';
if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header('location: index.php');
    exit;
}
?>
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="./uploads/IngeniousLogo.png" alt="IngeniousLogo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">INGENIOUS</span>
    </a>

    <?php
      
      $admin_id = $_SESSION['id'];

			$sql = "SELECT * FROM admin WHERE id='$admin_id'";
			$result = mysqli_query($conn, $sql);
			$row = mysqli_fetch_assoc($result);
		

    ?>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo $row["image"]; ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $row["name"]; ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="dashboard.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>             
            </a>
          </li>
          <li class="nav-item">
            <a href="admin_profile.php" class="nav-link">
              <i class="nav-icon fas fa-user-alt"></i>
              <p>My Profile</p>             
            </a>
          </li>
          <li class="nav-item">
            <a href="classroom.php" class="nav-link">
              <i class="nav-icon fas fa-building"></i>
              <p>Classroom</p>             
            </a>
          </li>
          <li class="nav-item">
            <a href="subject.php" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>Subject</p>             
            </a>
          </li>
          <li class="nav-item">
            <a href="grade.php" class="nav-link">
              <i class="nav-icon fas fa-graduation-cap"></i>
              <p>Grade</p>             
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chalkboard-teacher"></i>
              <p>
                Teacher
                <i class="fas fa-angle-left right"></i>
               
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="teacher.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Teacher</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="all_teacher.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Teacher</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="subject_routing.php" class="nav-link">
              <i class="nav-icon fas fa-sitemap"></i>
              <p>Subject Routing</p>             
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user-graduate"></i>
              <p>
                Student
                <i class="fas fa-angle-left right"></i>
               
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="student.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Student</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="all_student.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Student</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>