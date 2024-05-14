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

  <link rel="stylesheet" href="<?= base_url('bootstrap/css/employerviewprofiles.css') ?>" />

  <!-- For the Font Library -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;300&family=Raleway:wght@300&display=swap" rel="stylesheet">

  <!-- Scripts for Navbar -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> -->

  <script src="<?= base_url('bootstrap/js/modalstuff.js') ?>"></script>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
  <!-- <script src="https://code.jquery.com/jquery.min.js"></script> -->


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
                <a class="dropdown-item" href="#">Applicant Profiles</a>

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
      <h2> Applicant Profiles Summary </h2>
    </div>
  </div>

  <!-- All New Profiles Requests -->
  <div>
    <div class="card">
      <div class="card-header">
        <!-- Message comes here -->
      </div>
      <div class="card-body">
        <h3 class="card-title">Profile Requests</h3>
        <form action="<?php echo site_url('/AdminApplicantProfiles/verify') ?>" method="POST">
          <div class="form-inline">
            <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Selected User ID: </label>
            <input name="account_id" id="account_id" type="text" readonly placeholder="Select Row" class="form-control my-1 mr-sm-2" />
            <button class="btn btn-success my-1 acceptbtn_admin" type="submit" id="auser" name="auser">Accept</button>
            <button class="btn btn-danger my-1 rejectbtn_admin" type="submit" id="ruser" name="ruser">Reject</button>
          </div>
          <br>
          <div class="table-responsive">
            <!-- Profile Requests Table -->
            <table id="unverified_profile_tbl" class="table table-hover" style="width:100% !important">

              <thead style="background-color:#007BFF;color:#FFFFFF">
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Address</th>
                  <th>Email</th>
                  <th>Contact No</th>
                  <th>Dob</th>
                  <th>Job Title</th>
                  <th>Username</th>

                </tr>
              </thead>
              <tbody>
                <?php
                $JobSeeker = new \App\Models\jobSeekerModel();
                $UserAccount = new \App\Models\userAccountModel();
                $query = $JobSeeker->query("Select * From job_seeker"); // To get all Applicant
                foreach ($query->getResult() as $row) {
                  $useraccountid = $row->user_account_id;
                  $query_useraccount = $UserAccount->query("Select * from user_account where id = $useraccountid and status = 0");
                  foreach ($query_useraccount->getResult() as $row2) {
                    $username = $row2->username;
                    $password = $row2->password;
                ?>
                    <tr>
                      <td><?php echo $row->user_account_id; ?></td>
                      <td><?php echo $row->name; ?></td>
                      <td><?php echo $row->address; ?></td>
                      <td><?php echo $row->email; ?></td>
                      <td><?php echo $row->contactNo; ?></td>
                      <td><?php echo $row->dob; ?></td>
                      <td><?php echo $row->currentJobTitle; ?></td>
                      <td><?php echo $username; ?></td>

                    </tr>
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


    <!-- Accepted Profiles -->
    <div class="card">
      <div class="card-header">
        <!-- Message comes here -->
      </div>
      <div class="card-body">
        <h3 class="card-title">Accepted Profiles</h3>
        <form action="<?php echo site_url('/AdminApplicantProfiles/verify') ?>" method="POST">
          <div class="form-inline">
            <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Selected User ID: </label>
            <input name="account_id1" id="account_id1" type="text" readonly placeholder="Select Row" class="form-control my-1 mr-sm-2" />
            <button class="btn btn-danger my-1 rejectbtn_admin" type="submit" id="duser" name="duser">Delete Profile</button>
          </div>
          <br>
          <div class="table-responsive">
            <!-- Accepted Profiles Table -->
            <table id="verified_profile_tbl" class="table table-hover" style="width:100% !important">

              <thead style="background-color:#007BFF;color:#FFFFFF">
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Address</th>
                  <th>Email</th>
                  <th>Contact No</th>
                  <th>Dob</th>
                  <th>Job Title</th>
                  <th>Username</th>

                </tr>
              </thead>
              <tbody>
                <?php
                $JobSeeker = new \App\Models\jobSeekerModel();
                $UserAccount = new \App\Models\userAccountModel();
                $query = $JobSeeker->query("Select * From job_seeker"); // To get all Applicant
                foreach ($query->getResult() as $row) {
                  $useraccountid = $row->user_account_id;
                  $query_useraccount = $UserAccount->query("Select * from user_account where id = $useraccountid and status = 1");
                  foreach ($query_useraccount->getResult() as $row2) {
                    $username = $row2->username;
                    $password = $row2->password;
                ?>
                    <tr>
                      <td><?php echo $row->user_account_id; ?></td>
                      <td><?php echo $row->name; ?></td>
                      <td><?php echo $row->address; ?></td>
                      <td><?php echo $row->email; ?></td>
                      <td><?php echo $row->contactNo; ?></td>
                      <td><?php echo $row->dob; ?></td>
                      <td><?php echo $row->currentJobTitle; ?></td>
                      <td><?php echo $username; ?></td>

                    </tr>
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
          <!-- Rejected profiles table -->
          <table class="table" style="width:100% !important">

            <thead style="background-color:#007BFF;color:#FFFFFF">
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Address</th>
                <th>Email</th>
                <th>Contact No</th>
                <th>Dob</th>
                <th>Job Title</th>
                <th>Username</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $JobSeeker = new \App\Models\jobSeekerModel();
              $UserAccount = new \App\Models\userAccountModel();
              $query = $JobSeeker->query("Select * From job_seeker"); // To get all Applicant
              foreach ($query->getResult() as $row) {
                $useraccountid = $row->user_account_id;
                $query_useraccount = $UserAccount->query("Select * from user_account where id = $useraccountid and status = 2");
                foreach ($query_useraccount->getResult() as $row2) {
                  $username = $row2->username;
                  $password = $row2->password;
              ?>
                  <tr>
                    <td><?php echo $row->user_account_id; ?></td>
                    <td><?php echo $row->name; ?></td>
                    <td><?php echo $row->address; ?></td>
                    <td><?php echo $row->email; ?></td>
                    <td><?php echo $row->contactNo; ?></td>
                    <td><?php echo $row->dob; ?></td>
                    <td><?php echo $row->currentJobTitle; ?></td>
                    <td><?php echo $username; ?></td>

                  </tr>
                <?php
                }
                ?>
              <?php
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Deleted Profiles -->
    <div class="card">
      <div class="card-header">
        <!-- Message comes here -->
      </div>
      <div class="card-body">
        <h3 class="card-title">Deleted Profiles</h3>

        <br>
        <div class="table-responsive">
          <!-- Deleted Profles Table -->
          <table class="table" style="width:100% !important">

            <thead style="background-color:#007BFF;color:#FFFFFF">
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Address</th>
                <th>Email</th>
                <th>Contact No</th>
                <th>Dob</th>
                <th>Job Title</th>
                <th>Username</th>

              </tr>
            </thead>
            <tbody>
              <?php
              $JobSeeker = new \App\Models\jobSeekerModel();
              $UserAccount = new \App\Models\userAccountModel();
              $query = $JobSeeker->query("Select * From job_seeker"); // To get all Applicant
              foreach ($query->getResult() as $row) {
                $useraccountid = $row->user_account_id;
                $query_useraccount = $UserAccount->query("Select * from user_account where id = $useraccountid and status = 3");
                foreach ($query_useraccount->getResult() as $row2) {
                  $username = $row2->username;
                  $password = $row2->password;
              ?>
                  <tr>
                    <td><?php echo $row->user_account_id; ?></td>
                    <td><?php echo $row->name; ?></td>
                    <td><?php echo $row->address; ?></td>
                    <td><?php echo $row->email; ?></td>
                    <td><?php echo $row->contactNo; ?></td>
                    <td><?php echo $row->dob; ?></td>
                    <td><?php echo $row->currentJobTitle; ?></td>
                    <td><?php echo $username; ?></td>

                  </tr>
                <?php
                }
                ?>
              <?php
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>



    <div class="card">
      <div class="card-header">
        <!-- Message comes here -->
      </div>
      <div class="card-body">
        <h3 class="card-title">Reported Profiles</h3>
        <div class="form-inline">
          <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Selected User ID: </label>
          <input name="account_id3" id="account_id3" type="text" readonly placeholder="Select Row" class="form-control my-1 mr-sm-2" />
          <button class="btn btn-success my-1 acceptbtn_admin" type="button" id="viewReportsbtn" name="viewReportsbtn" data-target="#showReportModal" onclick="GetAllReportedIssues()">Show Complaints</button>
          <input name="account_id4" id="account_id4" type="text" readonly placeholder="Select Row" class="form-control my-1 mr-sm-2 d-none" />
          <!-- <button class="btn btn-danger my-1 rejectbtn_admin" type="submit" id="ruser" name="ruser">Reject</button> -->
        </div>
        <br>
        <div class="table-responsive">
          <!-- Profile Requests Table -->
          <table id="reported_profile_tbl" class="table table-hover" style="width:100% !important">

            <thead style="background-color:#007BFF;color:#FFFFFF">
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Address</th>
                <th>Email</th>
                <th>Contact No</th>
                <th>Dob</th>
                <th>Job Title</th>
                <th>Username</th>
                <th>Status</th>
                <th class="d-none">CV_DIR</th>
              </tr>
            </thead>
            <tbody>
              <?php

              $db = db_connect();
              $reportedProfileQuery = $db->query(
                "SELECT DISTINCT
                  user_account.id as UserID,
                  job_seeker.name as Name,
                  job_seeker.address as Address,
                  job_seeker.email as Email,
                  job_seeker.contactNo as ContactNo,
                  job_seeker.dob as DOB,
                  job_seeker.currentJobTitle as JobTitle,
                  job_seeker.cv_file_dir as CV,
                  user_account.status as Account_Status,
                  user_account.username as Username  
                  from job_seeker
                  join user_account
                  on user_account.id = job_seeker.user_account_id
                  where user_account.status = 4 or user_account.status =5
                  ORDER by user_account.status ASC
                  "
              );

              foreach ($reportedProfileQuery->getResult() as $profData) {
                $UserID = $profData->UserID;
                $Name = $profData->Name;
                $Address = $profData->Address;
                $Email = $profData->Email;
                $ContactNo = $profData->ContactNo;
                $DOB = $profData->DOB;
                $JobTitle = $profData->JobTitle;
                $CV = $profData->CV;
                $Account_Status = $profData->Account_Status;
                $Username = $profData->Username;

                if ($Account_Status == 4) {
                  $Account_Status = "Pending";
                } else {
                  $Account_Status = "Deactivated";
                }
              ?>
                <tr>
                  <td><?php echo $UserID; ?></td>
                  <td><?php echo $Name; ?></td>
                  <td><?php echo $Address; ?></td>
                  <td><?php echo $Email; ?></td>
                  <td><?php echo $ContactNo; ?></td>
                  <td><?php echo $DOB; ?></td>
                  <td><?php echo $JobTitle; ?></td>
                  <td><?php echo $Username; ?></td>
                  <td><?php echo $Account_Status; ?></td>
                  <td class="d-none"><?php echo $CV; ?></td>

                </tr>
              <?php
              }
              ?>
              <?php
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="modal fade" id="showReportModal" tabindex="-1" role="dialog" aria-labelledby="showReportModalTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="showReportModalTitle">Reported Issues</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div id="reportBody" class="modal-body">
            <div id="loading_sending_invite" class="loader">
              <div class="loader-wheel"></div>
              <div>Loading...</div>
            </div>
            <div id="allcomp">

            </div>
            <div style="margin-top:35px; max-width:1200px; margin-left: auto; margin-right: auto; display: none;" id="report_failMsgFlash" class="alert alert-danger text-muted"> </div>
            <div style="margin-top:35px; max-width:1200px; margin-left: auto; margin-right: auto; display: none;" class="alert alert-success text-muted" id="report_successMsgFlash"> <?= session()->getFlashdata('success'); ?> </div>
          </div>
          <div id="footeridf" class="modal-footer">
            <a href="#" target="_blank" id="btnviewcvs" class="btn btn-info" role="button">View CV</a>
            <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
            <button id="btndeactiveacc" type="button" class="btn btn-danger" onclick="DeactivateAccount()">Deactivate Account</button>
          </div>
        </div>
      </div>
    </div>



    <script src="<?= base_url('bootstrap/js/adminapplicantprofiles.js') ?>"></script>

    <script>
      $('#showReportModal').on('hidden.bs.modal', function() {
        //remove the backdrop
        $('.modal-backdrop').remove();
      });

      function GetAllReportedIssues() {

        $applicant_uid = document.getElementById("account_id3").value;

        if ($applicant_uid != "") {
          $('#showReportModal').modal('toggle');
          console.log("Have Data");

          $.ajax({
            url: '<?php echo base_url('AdminApplicantProfiles/GetAllReports'); ?>',
            type: "post",
            dataType: 'json',
            data: {
              applicant_uid: $applicant_uid,
            },
            beforeSend: function() {
              $('#loading_sending_invite').show();
              $('#allcomp').hide();
              $('#footeridf').hide();
              // document.getElementById("submit_invitation").style.display = "none";
              // document.getElementById("loading_sending_invite").classList.remove("d-none");
              console.log('Loading');
            },
            success: function(result) {
              // document.getElementById("cvlinkss").inn = document.getElementById("account_id4").value;
              var allComp = "";
              //document.getElementById("loading_sending_invite").classList.add("d-none");
              //document.getElementById("loading_sending_invite").style.display = "block !important";
              // document.getElementById("exampleModal").modal('hide');
              console.log("Complaint 1: " + result.length);
              for ($i = 0; $i < result.length; $i++) {
                allComp = allComp + ($i + 1) + ") " + result[$i] + "<br>";
              }
              document.getElementById("allcomp").innerHTML = allComp;
              // $res = result.result;
              // if ($res == '1') {
              //   console.log("Report has been sent");
              //   document.getElementById("report_successMsgFlash").style.display = "block";
              //   document.getElementById("report_successMsgFlash").innerHTML = "Your report is successfully submitted!";
              // } else if ($res == '2') {
              //   console.log("Failed to Send report");
              //   document.getElementById("report_failMsgFlash").style.display = "block";
              //   document.getElementById("report_failMsgFlash").innerHTML = "Something went wrong. Try Again later!";
              // }
              // document.documentElement.scrollTop = 0;
            },
            complete: function() {
              $('#loading_sending_invite').hide();
              $('#allcomp').show();
              $('#footeridf').show();
              var base_url = window.location.origin;
              var fullurl = base_url + "/cvfiles/" + document.getElementById("account_id4").value;
              //document.getElementById("cvlinkss").innerHTML = fullurl;

              document.getElementById("btnviewcvs").href = fullurl;

              //document.getElementById("loading_sending_invite").classList.add("d-none");
              setTimeout(() => {
                // document.getElementById("submit_invitation").style.display = "block";
                // $('#reportModal').modal('hide');
                // location.reload();
              }, 3000);
              // location.reload();
              console.log('Completed');
            }

          });
        } else {
          alert("Please select a Profile!");
          console.log("No data");
        }
      }

      function DeactivateAccount() {
        $applicant_uid = document.getElementById("account_id3").value;

        $.ajax({
          url: '<?php echo base_url('AdminApplicantProfiles/DeactivateAccount'); ?>',
          type: "post",
          dataType: 'json',
          data: {
            applicant_uid: $applicant_uid,
          },
          beforeSend: function() {
            $('#loading_sending_invite').show();
            $('#allcomp').hide();
            $('#footeridf').hide();
            // document.getElementById("submit_invitation").style.display = "none";
            // document.getElementById("loading_sending_invite").classList.remove("d-none");
            console.log('Loading');
          },
          success: function(result) {
            // document.getElementById("cvlinkss").inn = document.getElementById("account_id4").value;
            var allComp = "";
            //document.getElementById("loading_sending_invite").classList.add("d-none");
            //document.getElementById("loading_sending_invite").style.display = "block !important";
            // document.getElementById("exampleModal").modal('hide');
            $res = result.result;
            if ($res == '1') {
              document.getElementById("report_successMsgFlash").style.display = "block";
              document.getElementById("report_successMsgFlash").innerHTML = "User account successfully deactivated!";
            } else if ($res == '2') {
              document.getElementById("report_failMsgFlash").style.display = "block";
              document.getElementById("report_failMsgFlash").innerHTML = "Something went wrong. Try Again later!";
            }
            // document.documentElement.scrollTop = 0;
          },
          complete: function() {
            $('#loading_sending_invite').hide();
            $('#allcomp').show();
            $('#footeridf').show();
            var base_url = window.location.origin;
            var fullurl = base_url + "/cvfiles/" + document.getElementById("account_id4").value;
            //document.getElementById("cvlinkss").innerHTML = fullurl;

            document.getElementById("btnviewcvs").href = fullurl;

            //document.getElementById("loading_sending_invite").classList.add("d-none");
            setTimeout(() => {
              // document.getElementById("submit_invitation").style.display = "block";
              $('#showReportModal').modal('hide');
              location.reload();
            }, 3000);
            // location.reload();
            console.log('Completed');
            // $('#showReportModal').modal('hide');
          }

        });
      }

      function ReportApplicant() {
        $jobSeekerId = document.getElementById("r_applicant_id").value;

        $reportCategory = document.getElementById("report_category").value;

        if ($reportCategory == "Other") {
          $reportCategory = document.getElementById("r_message").value;
        }

        $.ajax({
          url: '<?php echo base_url('MyJobsEmployer/ReportApplicant'); ?>',
          type: "post",
          dataType: 'json',
          data: {
            applicantID: $jobSeekerId,
            reportCat: $reportCategory
          },
          beforeSend: function() {
            // document.getElementById("submit_invitation").style.display = "none";
            // document.getElementById("loading_sending_invite").classList.remove("d-none");
            console.log('Loading');
          },
          success: function(result) {
            // document.getElementById("loading_sending_invite").classList.add("d-none");
            // document.getElementById("loading_sending_invite").style.display = "block !important";
            // document.getElementById("exampleModal").modal('hide');

            $res = result.result;
            if ($res == '1') {
              console.log("Report has been sent");
              document.getElementById("report_successMsgFlash").style.display = "block";
              document.getElementById("report_successMsgFlash").innerHTML = "Your report is successfully submitted!";
            } else if ($res == '2') {
              console.log("Failed to Send report");
              document.getElementById("report_failMsgFlash").style.display = "block";
              document.getElementById("report_failMsgFlash").innerHTML = "Something went wrong. Try Again later!";
            }
            // document.documentElement.scrollTop = 0;
          },
          complete: function() {
            // document.getElementById("loading_sending_invite").classList.add("d-none");
            setTimeout(() => {
              // document.getElementById("submit_invitation").style.display = "block";
              $('#reportModal').modal('hide');
              location.reload();
            }, 3000);
            // location.reload();
            console.log('Completed');
          }

        });
      }
    </script>
</body>

</html>