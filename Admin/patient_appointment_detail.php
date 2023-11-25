<?php 
  require_once 'utils/is_login.php';
  require_once '../Models/EmployeeModel.php';
  require_once '../Models/PatientModel.php';
  require_once '../Models/AppointmentModel.php';
  $head_title = 'Patient Details';
  $page_title = 'Dashboard';
  $employeeModel = new EmployeeModel();
  $employee = $employeeModel->getEmployeeById($_SESSION['id']);
  $patientModel = new PatientModel(); 
  $patient = $patientModel->getPatientById($_GET['patient_id']);
  $appointmentModel = new AppointmentModel();
  $appointment = $appointmentModel->getAppointmentById($_GET['appointment_id']);
  $servicesList = '';
  foreach($appointment->services as $services){
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
          <li class="breadcrumb-item">Appointment Form</li>
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
                <input type="text" class="form-control " style="font-weight: 800; font-size: 20px; text-align:center;" id="inputName5" value="<?php echo $patient->getFullName() ?>" readonly>
              </div>
              <h3>ID #: <?php echo $patient->id ?></h3>
              


            </div>
          </div>
        </div>

        <div class="col-lg-8">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Personal Details</h5>
              <input type="date" class="form-control" id="inputName5" value="<?php echo $appointment->appointment_date ?>" readonly>
              <hr>
              <!-- Multi Columns Form -->
              <form action="" method="POST" class="row g-3">
                <div class="col-md-4">
                  <label for="inputName5" class="form-label">Lastname</label>
                  <input type="text" class="form-control" id="inputName5" value="<?php echo $patient->last_name ?>" readonly>
                </div>
                <div class="col-md-4">
                  <label for="inputName5" class="form-label">Firstname</label>
                  <input type="text" class="form-control" id="inputName5" value="<?php echo $patient->first_name ?>" readonly>
                </div>
                <div class="col-md-4">
                  <label for="inputName5" class="form-label">Gender</label>
                  <input type="text" class="form-control" id="inputName5" value="<?php echo $patient->gender ?>" readonly>
                </div>
                <div class="col-md-4">
                  <label for="inputName5" class="form-label">Date Of Birth</label>
                  <input type="text" class="form-control" id="inputName5" value="<?php echo $patient->birthdate ?>" readonly>
                </div>
                <div class="col-md-4">
                  <label for="inputName5" class="form-label">Age</label>
                  <input type="number" class="form-control" id="inputName5" value="<?php echo $patient->age ?>" readonly>
                </div>
                <div class="col-md-4">
                  <label for="inputName5" class="form-label">Mobile Number</label>
                  <input type="text" class="form-control" id="inputName5" value="<?php echo $patient->mobile_number ?>" readonly>
                </div>
                <div class="col-md-6">
                  <label for="inputName5" class="form-label">Province</label>
                  <input type="text" class="form-control" id="inputName5" value="<?php echo $patient->province ?>" readonly>
                </div>
                <div class="col-md-6">
                  <label for="inputName5" class="form-label">City</label>
                  <input type="text" class="form-control" id="inputName5" value="<?php echo $patient->city ?>" readonly>
                </div>
                <div class="col-md-6">
                  <label for="inputEmail5" class="form-label">Barangay</label>
                  <input type="email" class="form-control" id="inputEmail5" value="<?php echo $patient->barangay ?>" readonly>
                </div>
                <div class="col-md-6">
                  <label for="inputPassword5" class="form-label">Purok</label>
                  <input type="text" class="form-control" id="inputPassword5" value="<?php echo $patient->purok ?>" readonly>
                </div>
                <div class="col-12">
                  <label for="inputName5" class="form-label">Service Avail</label>
                  <input  type="text" class="form-control"  style="height:100px;" id="inputPassword5" value="<?php echo $servicesList ?>"  readonly>
                  </div>
                  <div class="col-12">
                  <label for="inputName5" class="form-label">ID</label>
                  <img src=<?php echo "../uploads/".$patient->image_url?> style="width:400px;" alt="asdf" >
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
          if (isset($_POST['submit'])) {
              $appointmentModel->updateAppointmentStatus($appointment->id, 'Approved');
              
              echo '<script>alert("Data Updated Successfully")</script>';
              echo '<script>window.location.href = "appointment-forms-validation.php";</script>';
          } elseif (isset($_POST['reject'])) {
              $appointmentModel->updateAppointmentStatus($appointment->id, 'Reject');
              echo "You clicked the 'Reject' button";
              echo '<script>window.location.href = "appointment-forms-validation.php";</script>';
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

