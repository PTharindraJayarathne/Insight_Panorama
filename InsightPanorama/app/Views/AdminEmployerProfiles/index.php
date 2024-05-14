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

  <title>Future Seekers.lk | Admin Portal</title>
</head>

<body>

  <div class="header">
    <div class="menu-bar">
      <nav class="navbar navbar-expand-lg navbar-light ">
        <a class="navbar-brand" href="<?php echo site_url('AdminHome/index') ?>"><span class="badge badge-primary admin_badge">ADMIN</span></a>
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
            
              </div>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="<?php echo site_url('AdminJobPostings/index') ?>">Job Postings </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo site_url('ManageAdmin/index') ?>">Manage Admins</a>
            </li>
            <li class="nav-item">
             
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
      <h2> Employer Profiles Summary </h2>
    </div>
  </div>


  <!-- New Profiles -->
  <div class="card">
    <div class="card-header">
      <!-- Message comes here -->
    </div>
    <div class="card-body">
      <h3 class="card-title">Profile Requests</h3>
      <form action="<?php echo site_url('/AdminEmployerProfiles/verify') ?>" method="POST">
        <div class="form-inline">
          <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Selected User ID: </label>
          <input name="account_id" id="account_id" type="text" readonly placeholder="Select Row" class="form-control my-1 mr-sm-2" />
          <button class="btn btn-success my-1 acceptbtn_admin" type="submit" id="auser" name="auser">Accept</button>
          <button class="btn btn-danger my-1 rejectbtn_admin" type="submit" id="ruser" name="ruser">Reject</button>
        </div>
        <br>
        <div class="table-responsive">
          <!-- new unverified profile table -->
          <table id="unverified_profile_tbl" class="table table-hover" style="width:100% !important">

            <thead style="background-color:#007BFF;color:#FFFFFF">
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>ContactNo</th>
                <th>JobPosition</th>
                <th>Email</th>
                <th>Username</th>
               
                <th>Company ID</th>
                <th>Company Name</th>
                <th>Company Contact No</th>
                <th>Company Email</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $Employer = new \App\Models\employerModel();
              $UserAccount = new \App\Models\userAccountModel();
              $Company = new \App\Models\companyModel();

              $query = $Employer->query("Select * from employer");
              foreach ($query->getResult() as $row) {
                $companyid = $row->company_id;
                $useraccountid = $row->user_account_id;

                $query_company = $Company->query("Select * from company where id = $companyid");
                foreach ($query_company->getResult() as $row2) {
                  $companyname = $row2->name;
                  $companycno = $row2->contactNo;
                  $companyemail = $row2->email;

                  $query_useraccount = $UserAccount->query("Select * from user_account where id = $useraccountid and status = 0");
                  foreach ($query_useraccount->getResult() as $row3) {
                    $username = $row3->username;
                    $password = $row3->password;
              ?>
                    <tr>
                      <td><?php echo $row->user_account_id; ?></td>
                      <td><?php echo $row->name; ?></td>
                      <td><?php echo $row->contactNo; ?></td>
                      <td><?php echo $row->jobPosition; ?></td>
                      <td><?php echo $row->email; ?></td>
                      <td><?php echo $username; ?></td>
                     
                      <td><?php echo $companyid; ?></td>
                      <td><?php echo $companyname; ?></td>
                      <td><?php echo $companycno; ?></td>
                      <td><?php echo $companyemail; ?></td>
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


  <!-- Verified Profiles -->
  <div class="card">
    <div class="card-header">
      <!-- Message comes here -->
    </div>
    <div class="card-body">
      <h3 class="card-title">Verified Profiles</h3>
      <form action="<?php echo site_url('/AdminEmployerProfiles/verify') ?>" method="POST">
        <div class="form-inline">
          <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Selected User ID: </label>
          <input name="account_id1" id="account_id1" type="text" readonly placeholder="Select Row" class="form-control my-1 mr-sm-2" />
        
          <button class="btn btn-danger my-1 rejectbtn_admin" type="submit" id="duser" name="duser">Delete Profile</button>
        </div>
        <br>
        <div class="table-responsive">
          <!-- verified profile table -->
          <table id="verified_profile_tbl" class="table table-hover" style="width:100% !important">

            <thead style="background-color:#007BFF;color:#FFFFFF">
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>ContactNo</th>
                <th>JobPosition</th>
                <th>Email</th>
                <th>Username</th>
                
                <th>Company ID</th>
                <th>Company Name</th>
                <th>Company Contact No</th>
                <th>Company Email</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $Employer = new \App\Models\employerModel();
              $UserAccount = new \App\Models\userAccountModel();
              $Company = new \App\Models\companyModel();

              $query = $Employer->query("Select * from employer");
              foreach ($query->getResult() as $row) {
                $companyid = $row->company_id;
                $useraccountid = $row->user_account_id;

                $query_company = $Company->query("Select * from company where id = $companyid");
                foreach ($query_company->getResult() as $row2) {
                  $companyname = $row2->name;
                  $companycno = $row2->contactNo;
                  $companyemail = $row2->email;

                  $query_useraccount = $UserAccount->query("Select * from user_account where id = $useraccountid and status = 1");
                  foreach ($query_useraccount->getResult() as $row3) {
                    $username = $row3->username;
                    $password = $row3->password;
              ?>
                    <tr>
                      <td><?php echo $row->user_account_id; ?></td>
                      <td><?php echo $row->name; ?></td>
                      <td><?php echo $row->contactNo; ?></td>
                      <td><?php echo $row->jobPosition; ?></td>
                      <td><?php echo $row->email; ?></td>
                      <td><?php echo $username; ?></td>
                     
                      <td><?php echo $companyid; ?></td>
                      <td><?php echo $companyname; ?></td>
                      <td><?php echo $companycno; ?></td>
                      <td><?php echo $companyemail; ?></td>
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


  <!-- Rejected Profiles -->
  <div class="card">
    <div class="card-header">
      <!-- Message comes here -->
    </div>
    <div class="card-body">
      <h3 class="card-title">Rejected Profiles</h3>

      <br>
      <div class="table-responsive">
        <!-- Rejected profile tables -->
        <table class="table" style="width:100% !important">

          <thead style="background-color:#007BFF;color:#FFFFFF">
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>ContactNo</th>
              <th>JobPosition</th>
              <th>Email</th>
              <th>Username</th>
          
              <th>Company ID</th>
              <th>Company Name</th>
              <th>Company Contact No</th>
              <th>Company Email</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $Employer = new \App\Models\employerModel();
            $UserAccount = new \App\Models\userAccountModel();
            $Company = new \App\Models\companyModel();

            $query = $Employer->query("Select * from employer");
            foreach ($query->getResult() as $row) {
              $companyid = $row->company_id;
              $useraccountid = $row->user_account_id;

              $query_company = $Company->query("Select * from company where id = $companyid");
              foreach ($query_company->getResult() as $row2) {
                $companyname = $row2->name;
                $companycno = $row2->contactNo;
                $companyemail = $row2->email;

                $query_useraccount = $UserAccount->query("Select * from user_account where id = $useraccountid and status = 2");
                foreach ($query_useraccount->getResult() as $row3) {
                  $username = $row3->username;
                  $password = $row3->password;
            ?>
                  <tr>
                    <td><?php echo $row->user_account_id; ?></td>
                    <td><?php echo $row->name; ?></td>
                    <td><?php echo $row->contactNo; ?></td>
                    <td><?php echo $row->jobPosition; ?></td>
                    <td><?php echo $row->email; ?></td>
                    <td><?php echo $username; ?></td>
                   
                    <td><?php echo $companyid; ?></td>
                    <td><?php echo $companyname; ?></td>
                    <td><?php echo $companycno; ?></td>
                    <td><?php echo $companyemail; ?></td>
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


  <!-- Delete Profile -->

  <div class="card">
    <div class="card-header">
      <!-- Message comes here -->
    </div>
    <div class="card-body">
      <h3 class="card-title">Deleted Profiles</h3>

      <br>
      <div class="table-responsive">
        <!-- Deleted profile table -->
        <table class="table" style="width:100% !important">

          <thead style="background-color:#007BFF;color:#FFFFFF">
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>ContactNo</th>
              <th>JobPosition</th>
              <th>Email</th>
              <th>Username</th>
              
              <th>Company ID</th>
              <th>Company Name</th>
              <th>Company Contact No</th>
              <th>Company Email</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $Employer = new \App\Models\employerModel();
            $UserAccount = new \App\Models\userAccountModel();
            $Company = new \App\Models\companyModel();

            $query = $Employer->query("Select * from employer");
            foreach ($query->getResult() as $row) {
              $companyid = $row->company_id;
              $useraccountid = $row->user_account_id;

              $query_company = $Company->query("Select * from company where id = $companyid");
              foreach ($query_company->getResult() as $row2) {
                $companyname = $row2->name;
                $companycno = $row2->contactNo;
                $companyemail = $row2->email;

                $query_useraccount = $UserAccount->query("Select * from user_account where id = $useraccountid and status = 3");
                foreach ($query_useraccount->getResult() as $row3) {
                  $username = $row3->username;
                  $password = $row3->password;
            ?>
                  <tr>
                    <td><?php echo $row->user_account_id; ?></td>
                    <td><?php echo $row->name; ?></td>
                    <td><?php echo $row->contactNo; ?></td>
                    <td><?php echo $row->jobPosition; ?></td>
                    <td><?php echo $row->email; ?></td>
                    <td><?php echo $username; ?></td>
                    
                    <td><?php echo $companyid; ?></td>
                    <td><?php echo $companyname; ?></td>
                    <td><?php echo $companycno; ?></td>
                    <td><?php echo $companyemail; ?></td>
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

  <script src= "<?= base_url('bootstrap/js/adminemployerprofile.js') ?>"></script>
</body>

</html>