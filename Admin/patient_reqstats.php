<?php 
  require_once 'utils/is_login.php';
  require_once '../Models/EmployeeModel.php';
  require_once '../Models/PatientModel.php';
  require_once '../Models/RequestModel.php';
  $head_title = 'Patient Details';
  $page_title = 'Dashboard';
  $employeeModel = new EmployeeModel();
  $employee = $employeeModel->getEmployeeById($_SESSION['id']);
  
  $requestModel = new RequestModel();
  $request = $requestModel->getRequestById($_GET['request_id']);
  $servicesList = '';
  foreach($request->services as $services){
    $servicesList .= $services->name. " ";
  }

?>
<!DOCTYPE html>
<html lang="en">

<?php require 'components/head.html' ?>
<style>
  label{
    font-weight: 00;
  }
</style>
<body>

  <?php require 'components/header.html' ?>
    <!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <?php require 'components/sidebar.html' ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Personal Details</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
          <li class="breadcrumb-item">Request Form</li>
          <li class="breadcrumb-item active">Personal Details</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row align-items-top">
        <div class="col-lg-4">
         
          
          
          <!-- Default Card -->
          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img src="../assets/img/user-profile-icon-in-flat-style-member-avatar-illustration-on-isolated-background-human-permission-s.ico" alt="Profile" class="rounded-circle" style="width: 200px;">
              <div class="col-md-12">
                <input type="text" class="form-control " style="font-weight: 800; font-size: 20px; text-align:center;" id="inputName5" value="<?php echo $request->patient->getFullName() ?>" readonly>
              </div>
              <h3>ID #: <?php echo $request->patient->id ?></h3>
              


            </div>
          </div>
        </div>

        <div class="col-lg-8">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Personal Details</h5>
              <input type="date" class="form-control" id="inputName5" value="<?php echo $request->request_date ?>" readonly>
              <hr>
              <!-- Multi Columns Form -->
              <form action="" method="POST" class="row g-3">
                <div class="col-md-4">
                  <label for="inputName5" class="form-label">Lastname</label>
                  <input type="text" class="form-control" id="inputName5" value="<?php echo $request->patient->last_name ?>" readonly>
                </div>
                <div class="col-md-4">
                  <label for="inputName5" class="form-label">Firstname</label>
                  <input type="text" class="form-control" id="inputName5" value="<?php echo $request->patient->first_name ?>" readonly>
                </div>
                <div class="col-md-4">
                  <label for="inputName5" class="form-label">Gender</label>
                  <input type="text" class="form-control" id="inputName5" value="<?php echo $request->patient->gender ?>" readonly>
                </div>
                <div class="col-md-4">
                  <label for="inputName5" class="form-label">Date Of Birth</label>
                  <input type="text" class="form-control" id="inputName5" value="<?php echo $request->patient->birthdate ?>" readonly>
                </div>
                <div class="col-md-4">
                  <label for="inputName5" class="form-label">Age</label>
                  <input type="number" class="form-control" id="inputName5" value="<?php echo $request->patient->age ?>" readonly>
                </div>
                <div class="col-md-4">
                  <label for="inputName5" class="form-label">Mobile Number</label>
                  <input type="text" class="form-control" id="inputName5" value="<?php echo $request->patient->mobile_number ?>" readonly>
                </div>
                <div class="col-md-6">
                  <label for="inputName5" class="form-label">Province</label>
                  <input type="text" class="form-control" id="inputName5" value="<?php echo $request->patient->province ?>" readonly>
                </div>
                <div class="col-md-6">
                  <label for="inputName5" class="form-label">City</label>
                  <input type="text" class="form-control" id="inputName5" value="<?php echo $request->patient->city ?>" readonly>
                </div>
                <div class="col-md-6">
                  <label for="inputEmail5" class="form-label">Barangay</label>
                  <input type="email" class="form-control" id="inputEmail5" value="<?php echo $request->patient->barangay ?>" readonly>
                </div>
                <div class="col-md-6">
                  <label for="inputPassword5" class="form-label">Purok</label>
                  <input type="text" class="form-control" id="inputPassword5" value="<?php echo $request->patient->purok ?>" readonly>
                </div>
                <div class="col-12">
                  <label for="inputName5" class="form-label">Service Avail</label>
                  <input  type="text" class="form-control"  style="height:100px;" id="inputPassword5" value="<?php echo $servicesList ?>"  readonly>
                  </div>
                  <div class="col-12">
                  <label for="inputName5" class="form-label">ID</label>
                  <img src=<?php echo "../uploads/".$request->patient->image_url?> style="width:400px;" alt="asdf" >
                  </div>
                </div>

                <hr> 
                <div class="text-center">
                 
                  <button type="submit" name="submit" class="btn btn-primary" value='approve'>Approve</button>
                  <button type="submit" name="reject" class="btn btn-danger" value='reject'>Reject</button>
                  

                </div>
                <hr>
              </form><!-- End Multi Columns Form -->
             

            </div>
          </div>

        </div>
      </div>
      </div>
      <?php 
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          $requestModel = new RequestModel();
          if (isset($_POST['submit'])) {
              $requestModel->updateRequestStatus($request->id, 'Approved');
              
              echo '<script>alert("Data Updated Successfully")</script>';
              echo '<script>window.location.href = "pending-forms-elements.php";</script>';
          } elseif (isset($_POST['reject'])) {
              $requestModel->updateRequestStatus($request->id, 'Rejected');
              echo '<script>window.location.href = "pending-forms-elements.php";</script>';
          }
        }
      ?>
    </section>

  </main><!-- End #main -->



  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <?php require 'components/required_js.html' ?>

</body>

</html>

<?php

  

  
          // Assuming you have a database connection established
          // $conn = mysqli_connect("hostname", "username", "password", "database_name");
          
      //    // Check if the 'updateid' parameter is set in the URL
      //    if (isset($_GET['updateid'])) {
      //    $request_ID = $_GET['updateid'];
      //        
      //        // SQL query to fetch the specific row based on request_ID
      //        $sql = "SELECT * FROM `request_form` WHERE request_ID = $request_ID";
      //        
      //        // Execute the SQL query
      //        $result = mysqli_query($conn, $sql);
      //    
      //        // Check if the query was successful
      //        if ($result) {
      //            // Fetch the row as an associative array
      //            $row = mysqli_fetch_assoc($result);
      //            if ($row) {
      //                // Assign retrieved values to variables
      //                $request_lastname = $row['request_lastname'];
      //                $request_firstname = $row['request_firstname'];
      //                $request_birthdate = $row['request_birthdate'];
      //                $request_age = $row['request_age'];
      //                $request_gender = $row['request_gender'];
      //                $request_province = $row['request_province'];
      //                $request_city = $row['request_city'];
      //                $request_barangay = $row['request_barangay'];
      //                $request_purok = $row['request_purok'];
      //                $request_phone = $row['request_phone'];
      //                $request_test = $row['request_test'];
      //                $request_status = $row['request_status'];
      //                $request_date = $row['request_date'];
      //                $request_amount = $row['request_amount'];
      //    
      //           
      //                if (isset($_POST['submit'])) {
      //                  $request_lastname = $_POST['request_lastname'];
      //                  $request_firstname = $_POST['request_firstname'];
      //                  $request_birthdate = $_POST['request_birthdate'];
      //                  $request_age = $_POST['request_age'];
      //                  $request_gender = $_POST['request_gender'];
      //                  $request_province = $_POST['request_province'];
      //                  $request_city = $_POST['request_city'];
      //                  $request_barangay = $_POST['request_barangay'];
      //                  $request_purok = $_POST['request_purok'];
      //                  $request_phone = $_POST['request_phone'];
      //                  $request_test = $_POST['request_test'];
      //                  $request_status = $_POST['request_status'];
      //                  $request_date = $_POST['request_date'];
      //                  $request_amount = $_POST['request_amount'];
//
      //                  $sql = "UPDATE `request_form` SET request_status='Approved' WHERE request_ID = $request_ID";
//
//
      //                    $result = mysqli_query($conn, $sql);
      //                    if ($result) {
      //                        //echo "Updated inserted successfully";
      //                      
      //                        //echo '<script>alert("Data Updated Successfully")</script>';
      //                        header('Location:request-forms-layouts.php');
      //                    } else {
      //                        die(mysqli_error($conn));
      //                    }
      //                }
      //               else if (isset($_POST['reject'])) {
      //                  $request_lastname = $_POST['request_lastname'];
      //                  $request_firstname = $_POST['request_firstname'];
      //                  $request_birthdate = $_POST['request_birthdate'];
      //                  $request_age = $_POST['request_age'];
      //                  $request_gender = $_POST['request_gender'];
      //                  $request_province = $_POST['request_province'];
      //                  $request_city = $_POST['request_city'];
      //                  $request_barangay = $_POST['request_barangay'];
      //                  $request_purok = $_POST['request_purok'];
      //                  $request_phone = $_POST['request_phone'];
      //                  $request_test = $_POST['request_test'];
      //                  $request_status = $_POST['request_status'];
      //                  $request_date = $_POST['request_date'];
      //                  $request_amount = $_POST['request_amount'];
//
      //                  $sql = "UPDATE `request_form` SET request_status='Reject' WHERE request_ID = $request_ID";
//
//
      //                    $result = mysqli_query($conn, $sql);
      //                    if ($result) {
      //                        //echo "Updated inserted successfully";
      //                       // echo '<script>alert("Data Updated Successfully")</script>';
      //                        header('Location:request-forms-layouts.php');
      //                        //echo '<script>alert("Data Updated Successfully")</script>';
      //                    } else {
      //                        die(mysqli_error($conn));
      //                    }
      //                }
      //              }
      //            }
      //          }
      //    ?>