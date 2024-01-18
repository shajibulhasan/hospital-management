<?php include 'connection.php' ?>
<?php session_start(); ?>
<?php include 'isLoggedin.php'; ?>
<?php $role = $_SESSION['user_role']; ?>

<?php $name = $_SESSION['user_name']; ?>
<?php
    if($_SESSION['user_role']=='Doctor'){
        header('location: dashboardDoctor.php');
    }
    if($_SESSION['user_role']=='Patient'){
      header('location: dashboardPatient.php');
    }
?>

<?php
  $s = "select * from doctors where role = 'Doctor'";
  $q = mysqli_query($conn, $s);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Create Appointment</title>
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="shortcut icon" href="assets/images/favicon.ico" />
  </head>
  <body>
    <div class="container-scroller">
      <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
          <a class="navbar-brand brand-logo" href="dashboardPatient.php"><img class="w-25 h-25" src="image/logo.png" alt="logo" /></a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-stretch">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
          </button>
          <div class="search-field d-none d-md-block">
            <span class="d-flex align-items-center h-100 text-primary font-weight-bold ">HOSPITAL MANAGEMENT SYSTEM</span>
          </div>
          <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown">
              <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="nav-profile-text">
                  <p class="mb-1 text-black"><?php echo $name ?></p>
                </div>
              </a>
              <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="logout.php">
                  <i class="mdi mdi-logout me-2 text-primary"></i> Signout </a>
              </div>
            </li>
        </div>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-profile">
              <a href="" class="nav-link">
                <div class="nav-profile-text d-flex flex-column">
                  <span class="font-weight-bold mb-2"><?php echo $name ?></span>
                  <span class="text-secondary text-small"><?php echo $role ?></span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="dashboardScheduler.php">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="appointmentCreateScheduler.php">
                <span class="menu-title">Create Appointment</span>
                <i class="mdi mdi-account-plus menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="pendingAppointment.php">
                <span class="menu-title">Pending Appointment</span>
                <i class="mdi mdi-lan-pending menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="appointmentList.php">
                <span class="menu-title">Appointment List</span>
                <i class="mdi mdi-view-list menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="patientReport.php">
                <span class="menu-title">Patient Reports</span>
                <i class="mdi mdi-message-text menu-icon"></i>
              </a>
            </li>
          </ul>
        </nav>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-account-plus"></i>
                </span> Create Appointment
              </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                  </li>
                </ul>
              </nav>
            </div>
            
            
              <form action="" method="post">
                  <div class="form-group">
                      <label for="name">Patient Name:</label>
                      <input type="text" class="form-control" value="" id="name" name="name">
                  </div>
                  <div class="form-group">
                      <label for="email">Email:</label>
                      <input type="email" class="form-control" value="" id="email" name="email">
                  </div>
                  <div class="form-group">
                      <label for="phone">Phone:</label>
                      <input type="number" class="form-control" value="" id="phone" name="phone">
                  </div>
                  <div class="form-group">
                      <label for="password">Password:</label>
                      <input type="password" class="form-control" value="" id="password" name="password">
                  </div>
                  <div class="form-group">
                      <label for="address">Address:</label>
                      <input type="text" class="form-control" value="" id="address" name="address">
                  </div>
                  <div class="form-group">
                      <label for="doctor">Doctor: </label>
                      <select name="doctor" id="doctor" class="form-control">
                          <option value="">Select Doctor</option>
                          <?php 
                            while($row = mysqli_fetch_assoc($q)){ ?>
                              <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                            <?php  }
                          ?>
                      </select>
                  </div>
                  <div class="form-group">
                      <label for="problem">Problem:</label>
                      <input type="text" class="form-control" value="" id="problem" name="problem">
                  </div>
                  <div class="form-group">
                      <button type="submit" class="btn btn-primary" name="btnCreate">Create Appointment</button>
                  </div>
              </form>

              
            </div>
            </div>
          </div>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="assets/vendors/chart.js/Chart.min.js"></script>
    <script src="assets/js/jquery.cookie.js" type="text/javascript"></script>
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <script src="assets/js/dashboard.js"></script>
    <script src="assets/js/todolist.js"></script>
  </body>
</html>
<?php  
    if(isset($_POST['btnCreate'])){
        $name = $_POST['name'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $doctor = $_POST['doctor'];
        $problem = $_POST['problem'];
        $role = 'Patient';
        $s1 = "insert into users(name, email, password, phone, address, role)
              values('".$name."', '".$email."', '".$password."', '".$phone."', '".$address."', '".$role."')";
        if(mysqli_query($conn, $s1)){
          $id = mysqli_insert_id($conn);
          $s = "Insert into records(problem, userId, doctorId) 
                values ('".$problem."','".$id."', '".$doctor."')";
                if(mysqli_query($conn, $s)){
                  $last_id = mysqli_insert_id($conn);
                  $s = "UPDATE records SET status='Serial No $last_id', Report='Waiting' where id=$last_id";
                  if(mysqli_query($conn, $s)){
                    echo 'Successfully Create Appointment.';
                  }
                  
                }
        }
    }
?>