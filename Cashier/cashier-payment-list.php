<?php 
  require_once 'utils/is_login.php';
  require_once '../Models/EmployeeModel.php';
  require_once '../Models/AppointmentModel.php';
  require_once '../Models/RequestModel.php';
  $head_title = 'Payment List';
  $page_title = 'Dashboard';
  $employeeModel = new EmployeeModel();
  $employee = $employeeModel->getEmployeeById($_SESSION['id']);
  $requestModel = new RequestModel();
  $appointmentModel = new AppointmentModel();
  $requests = $requestModel->getRequestsByStatus(Request::PAID) ;?>
<!DOCTYPE html>
<html lang="en">

<?php require 'components/head.html' ?>
<style>
 
 .search
{
	border: 2px solid #fff;
	overflow: auto;
	border-radius: 5px;
	-moz-border-radius: 5px;
	-webkit-border-radius: 5px;
  box-shadow: 1px 1px 10px rgba(0, 0, 0, 0.20);


}

.search input[type="text"]
{
	border: 0px;
	width: 67%;
	padding: 10px 10px;
}

.search input[type="text"]:focus
{
	outline: 0;
}

.search input[type="submit"]
{
	border: 0px;
	background: none;
	background-color: #0d6efd;
	color: #fff;
	float: right;
	padding: 10px;

	-moz-border-radius-top-right: 5px;
	-webkit-border-radius-top-right: 5px;

	-moz-border-radius-bottom-right: 5px;
	-webkit-border-radius-bottom-right: 5px;
        cursor:pointer;
}

/* ===========================
   ====== Medua Query for Search Box ====== 
   =========================== */

@media only screen and (min-width : 150px) and (max-width : 780px)
{
	}
	.search
	{
		width: 95%;
		margin: 0 auto;
	}

</style>
<body>

  <?php require 'components/header.html'?>
  <?php require 'components/sidebar.html'?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Payment</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Payment</a></li>
          <li class="breadcrumb-item">Payment List</li>
          <li class="breadcrumb-item active">Accordion</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
             <hr>
             <div class="position-relative">
              <h5>List of Payments</h5>
             <div class="col-5 position-absolute top-0 end-0">
             <div class="search">
				        <form class="search-form">
                  <input type="text" placeholder="Search Patient By Name" id="search-bar" oninput='filterRequests()'/>
                  <input type="submit" value="Submit" />
                </form>
			</div>  
    
             </div>
             </div>
              <div class="col-lg-12">
             
              <br>
            
     
      
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th scope="col">Payment ID</th>
                      <th scope="col">Lastname</th>
                      <th scope="col">Firstname</th>
                      <th scope="col">Total Amount</th>
                      <th scope="col">Status</th>
                      
                     
                    </tr>
                  </thead>
                  <tbody>
                    
                    <?php foreach($requests as $request) {?>
                        <tr id="request-row-<?php echo $request->id ?>">
                          <th><?php echo $request->id ?></th>
                          <td><?php echo $request->patient->last_name ?></td>
                          <td><?php echo $request->patient->first_name ?></td>
                          <td><?php echo $request->total ?></td>
                          <td><?php echo $request->status ?></td>

                         
                        </tr>
                      <?php } ?>
                   
                    
                  </tbody>
                </table>
              </div>
            </div>
          </div>
              
             

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

 

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <?php require 'components/required_js.html' ?>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script>
      const requests = <?php echo json_encode($requests) ?>;
      for(const request of requests){
        request.patient.fullName = `${request.patient.first_name} ${request.patient.last_name}`
      }
      function filterRequests() {
        console.log('hello')
        var searchValue = $('#search-bar').val().toLowerCase();
        
        // Loop through requests and hide/show based on search input
        requests.forEach(function (request) {
          var requestName = request.patient.fullName.toLowerCase();
          var row = $('#request-row-' + request.patient.id);

          if (requestName.includes(searchValue)) {
            row.show();
          } else {
            row.hide();
          }
        });
      }
    </script>
</body>

</html>