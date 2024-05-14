<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" name="This is the admin portal page of FutureSeekers.lk, Admins can control the profiles, job adverts and web page from here">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?= base_url('bootstrap/css/bootstrap.min.css') ?>" />

  <link rel="stylesheet" href="<?= base_url('bootstrap/css/admin.css') ?>" />

  <!-- CSS stylesheet for navigation bar -->
  <link rel="stylesheet" href="<?= base_url('bootstrap/css/navbar.css') ?>" />

  <!-- For the Font Library -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;300&family=Raleway:wght@300&display=swap" rel="stylesheet">

  <!-- Scripts for Navbar -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <title>Future Seekers.lk | Admin Job Postings</title>
</head>

<body>
  <div class="header">
    <div class="menu-bar">
      <nav class="navbar navbar-expand-lg navbar-light ">
        <a class="navbar-brand" href="#"><span class="badge badge-primary admin_badge">ADMIN</span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="<?php echo site_url('AdminHome/index') ?>">Dashboard </a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Member Profiles
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="<?php echo site_url('AdminEmployerProfiles/index') ?>">Company Profiles</a>
                <a class="dropdown-item" href="<?php echo site_url('AdminApplicantProfiles/index') ?>">Applicant Profiles</a>
                <!-- <a class="dropdown-item" href="#">Something else here</a> -->
              </div>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="<?php echo site_url('AdminJobPostings/index') ?>">Job Postings </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo site_url('ManageAdmin/index') ?>">Manage Admins</a>
            </li>
            <li class="nav-item">
              <!-- For blue button: btn btn-primary -->
              <a class="nav-link btn btn-danger logoutbtn" href="<?php echo site_url('Home/logout') ?>">Log out</a>
            </li>
            <li class="nav-item mobile_logout">
              <a class="nav-link mobilelogoutbtn" href="<?php echo site_url('Home/logout') ?>">Log out</a>
            </li>
          </ul>
        </div>
      </nav>
    </div>
  </div>

  <div class="card">
    <div class="card-header">
      <h2> Job Postings Summary </h2>
    </div>
  </div>
  <div class="card">
    <div class="card-header">
      <!-- Message comes here -->
    </div>
    <div class="card-body">
      <h3 class="card-title">Advertisement Requests</h3>
      <form action="<?php echo site_url('/AdminJobPostings/verify') ?>" method="POST">
        <div class="form-inline">
          <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Selected Advert ID: </label>
          <input name="jobidfield" id="jobidfield" type="text" readonly placeholder="Select Row" class="form-control my-1 mr-sm-2" />
          <button class="btn btn-success my-1 acceptbtn_admin" type="submit" id="ajob" name="ajob">Accept</button>
          <button class="btn btn-danger my-1 rejectbtn_admin" type="submit" id="rjob" name="rjob">Reject</button>
          <button class="btn btn-info" type="submit" id="vjob" name="vjob">Download PDF</button>
        </div>
        <br>
        <div class="table-responsive">
          <table id="unverified_job_tbl" class="table table-hover" style="width:100% !important">

            <thead style="background-color:#007BFF;color:#FFFFFF">
              <tr>
                <th>ID</th>
                <th>Job Title</th>
                <th>Job Category</th>
                <th>Posted Date and Time</th>
                <th>Closing Date and Time</th>
                <th>Employer ID</th>
                <!-- <th>Password</th> -->
                <th>Company ID</th>
                <th>Company Name</th>
                <th>Company Email</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $Employer = new \App\Models\employerModel();
              $UserAccount = new \App\Models\userAccountModel();
              $Company = new \App\Models\companyModel();
              $JobAdvert = new \App\Models\jobDetailsModel();

              $query = $JobAdvert->query("Select * from job_details where status = 0");
              foreach ($query->getResult() as $row) {
                $jobid = $row->id;
                $jobTitle = $row->jobtitle;
                $jobCategory = $row->jobCategory;
                $pDate = $row->dateTime;
                $cDate = $row->closingDate;
                $employerId = $row->employer_id;
                $pdfname = $row->description;

                $query_employer = $Employer->query("Select * from employer where id = $employerId");
                foreach ($query_employer->getResult() as $row2) {
                  $companyID = $row2->company_id;

                  $query_company = $UserAccount->query("Select * from company where id = $companyID");
                  foreach ($query_company->getResult() as $row3) {
                    $companyName = $row3->name;
                    $companyEmail = $row3->email;
              ?>
                    <tr>
                      <td><?php echo $row->id; ?></td>
                      <td><?php echo $row->jobtitle; ?></td>
                      <td><?php echo $row->jobCategory; ?></td>
                      <td><?php echo $row->dateTime; ?></td>
                      <td><?php echo $row->closingDate; ?></td>
                      <td><?php echo $row->employer_id; ?></td>
                      <!-- <td><?php // echo $password; 
                                ?></td> -->
                      <td><?php echo $row2->company_id; ?></td>
                      <td><?php echo $row3->name; ?></td>
                      <td><?php echo $row3->email; ?></td>

                    </tr>
                  <?php
                  }
                  ?>
                <?php
                }
                ?>
              <?php
              }
              ?>
            </tbody>
          </table>
        </div>
      </form>
    </div>
  </div>

  <div class="card">
    <div class="card-header">
      <!-- Message comes here -->
    </div>
    <div class="card-body">
      <h3 class="card-title">Accepted Advertisements</h3>
      <form action="<?php echo site_url('/AdminJobPostings/verify') ?>" method="POST">
        <div class="form-inline">
          <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Selected Advert ID: </label>
          <input name="jobidfield" id="ajobidfield" type="text" readonly placeholder="Select Row" class="form-control my-1 mr-sm-2" />
          <button class="btn btn-danger my-1 rejectbtn_admin" type="submit" id="djob" name="djob">Reject</button>
          <button class="btn btn-info" type="submit" id="vjob" name="vjob">Download PDF</button>
        </div>
        <br>
        <div class="table-responsive">
          <table id="accepted_job_tbl" class="table table-hover" style="width:100% !important">

            <thead style="background-color:#007BFF;color:#FFFFFF">
              <tr>
                <th>ID</th>
                <th>Job Title</th>
                <th>Job Category</th>
                <th>Posted Date and Time</th>
                <th>Closing Date and Time</th>
                <th>Employer ID</th>
                <!-- <th>Password</th> -->
                <th>Company ID</th>
                <th>Company Name</th>
                <th>Company Email</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $Employer = new \App\Models\employerModel();
              $UserAccount = new \App\Models\userAccountModel();
              $Company = new \App\Models\companyModel();
              $JobAdvert = new \App\Models\jobDetailsModel();

              $query = $JobAdvert->query("Select * from job_details where status = 1");
              foreach ($query->getResult() as $row) {
                $jobid = $row->id;
                $jobTitle = $row->jobtitle;
                $jobCategory = $row->jobCategory;
                $pDate = $row->dateTime;
                $cDate = $row->closingDate;
                $employerId = $row->employer_id;
                $pdfname = $row->description;

                $query_employer = $Employer->query("Select * from employer where id = $employerId");
                foreach ($query_employer->getResult() as $row2) {
                  $companyID = $row2->company_id;

                  $query_company = $UserAccount->query("Select * from company where id = $companyID");
                  foreach ($query_company->getResult() as $row3) {
                    $companyName = $row3->name;
                    $companyEmail = $row3->email;
              ?>
                    <tr>
                      <td><?php echo $row->id; ?></td>
                      <td><?php echo $row->jobtitle; ?></td>
                      <td><?php echo $row->jobCategory; ?></td>
                      <td><?php echo $row->dateTime; ?></td>
                      <td><?php echo $row->closingDate; ?></td>
                      <td><?php echo $row->employer_id; ?></td>
                      <!-- <td><?php // echo $password; 
                                ?></td> -->
                      <td><?php echo $row2->company_id; ?></td>
                      <td><?php echo $row3->name; ?></td>
                      <td><?php echo $row3->email; ?></td>

                    </tr>
                  <?php
                  }
                  ?>
                <?php
                }
                ?>
              <?php
              }
              ?>
            </tbody>
          </table>
        </div>
      </form>
    </div>
  </div>

  <div class="card">
    <div class="card-header">
      <!-- Message comes here -->
    </div>
    <div class="card-body">
      <h3 class="card-title">Rejected Advertisements</h3>
      <form action="<?php echo site_url('/AdminJobPostings/verify') ?>" method="POST">
        <div class="form-inline">
          <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Selected Advert ID: </label>
          <input name="jobidfield" id="rjobidfield" type="text" readonly placeholder="Select Row" class="form-control my-1 mr-sm-2" />
          <button class="btn btn-info" type="submit" id="vjob" name="vjob">Download PDF</button>
        </div>
        <br>
        <div class="table-responsive">
          <table id="rejected_job_tbl" class="table table-hover" style="width:100% !important">

            <thead style="background-color:#007BFF;color:#FFFFFF">
              <tr>
                <th>ID</th>
                <th>Job Title</th>
                <th>Job Category</th>
                <th>Posted Date and Time</th>
                <th>Closing Date and Time</th>
                <th>Employer ID</th>
                <!-- <th>Password</th> -->
                <th>Company ID</th>
                <th>Company Name</th>
                <th>Company Email</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $Employer = new \App\Models\employerModel();
              $UserAccount = new \App\Models\userAccountModel();
              $Company = new \App\Models\companyModel();
              $JobAdvert = new \App\Models\jobDetailsModel();

              $query = $JobAdvert->query("Select * from job_details where status = 2");
              foreach ($query->getResult() as $row) {
                $jobid = $row->id;
                $jobTitle = $row->jobtitle;
                $jobCategory = $row->jobCategory;
                $pDate = $row->dateTime;
                $cDate = $row->closingDate;
                $employerId = $row->employer_id;
                $pdfname = $row->description;

                $query_employer = $Employer->query("Select * from employer where id = $employerId");
                foreach ($query_employer->getResult() as $row2) {
                  $companyID = $row2->company_id;

                  $query_company = $UserAccount->query("Select * from company where id = $companyID");
                  foreach ($query_company->getResult() as $row3) {
                    $companyName = $row3->name;
                    $companyEmail = $row3->email;
              ?>
                    <tr>
                      <td><?php echo $row->id; ?></td>
                      <td><?php echo $row->jobtitle; ?></td>
                      <td><?php echo $row->jobCategory; ?></td>
                      <td><?php echo $row->dateTime; ?></td>
                      <td><?php echo $row->closingDate; ?></td>
                      <td><?php echo $row->employer_id; ?></td>
                      <!-- <td><?php // echo $password; 
                                ?></td> -->
                      <td><?php echo $row2->company_id; ?></td>
                      <td><?php echo $row3->name; ?></td>
                      <td><?php echo $row3->email; ?></td>

                    </tr>
                  <?php
                  }
                  ?>
                <?php
                }
                ?>
              <?php
              }
              ?>
            </tbody>
          </table>
        </div>
      </form>
    </div>
  </div>










  <script src= "<?= base_url('bootstrap/js/adminjobpostings.js') ?>"></script>

</body>

</html>