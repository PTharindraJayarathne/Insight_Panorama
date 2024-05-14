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
  <link rel="stylesheet" href="<?= base_url('bootstrap/css/login_styles.css') ?>" />

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
              <a class="nav-link" href="#">Manage Admins</a>
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

  <!-- <div class="card">
    <div class="card-header">
      <h2> Job Postings Summary </h2>
    </div>
  </div> -->


  <div class="card ml-auto mr-auto mt-5 shadow mb-5 bg-white rounded" style="max-width: 400px;">
    <div class="card-header bg-primary" style="color: white">
      Add New Administrator Details
    </div>
    <div class="card-body">
      <form action="<?php echo site_url('/ManageAdmin/CreateAdministrator') ?>" method="POST">
        <div class="form-group">
          <label class="medium mb-1">Full Name</label>
          <input id="fullname" class="form-control" name="fullname" type="text" placeholder="Enter Fullname" value="<?= set_value('fullname'); ?>" />
          <small class="form-text text-danger"><?= isset($validation) ? show_validation_error($validation, 'fullname') : '' ?></small>
        </div>
        <div class="form-group">
          <label class="medium mb-1">Username</label>
          <input id="username" class="form-control" name="username" type="text" placeholder="Enter Username" value="<?= set_value('username'); ?>" />
          <small class="form-text text-danger"><?= isset($validation) ? show_validation_error($validation, 'username') : '' ?></small>
        </div>
        <div class="form-group"><label class="medium mb-1">Password</label>
          <input id="password" class="form-control" name="password" type="password" placeholder="Enter Password" value="<?= set_value('password'); ?>" />
          <small class="form-text text-danger"><?= isset($validation) ? show_validation_error($validation, 'password') : '' ?></small>
        </div>
        <div class="form-group">
          <button id="createbtn" class="btn btn-primary btnlogin">Create Administrator</button><br>
        </div>
        <?php if (!empty(session()->getFlashdata('fail'))) : ?>
          <div class="alert alert-danger text-muted"> <?= session()->getFlashdata('fail'); ?> </div>
        <?php endif ?>

        <?php if (!empty(session()->getFlashdata('success'))) : ?>
          <div class="alert alert-success text-muted"> <?= session()->getFlashdata('success'); ?> </div>
        <?php endif ?>

      </form>
    </div>
  </div>



  <div class="card">
    <div class="card-header">
      <!-- Message comes here -->
    </div>
    <div class="card-body">
      <h3 class="card-title">Manage Admins</h3>
      <?php if (!empty(session()->getFlashdata('success2'))) : ?>
        <div class="alert alert-success text-muted"> <?= session()->getFlashdata('success2'); ?> </div>
      <?php endif ?>
      <form action="<?php echo site_url('/ManageAdmin/RemoveAdmin') ?>" method="POST">
        <div class="form-inline">
          <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Selected User ID: </label>
          <input name="account_id" id="account_id" type="text" readonly placeholder="Select Row" class="form-control my-1 mr-sm-2" />
          <button class="btn btn-danger my-1 rejectbtn_admin" type="submit" id="ruser" name="ruser">Remove Admin</button>
        </div>
        <br>
        <div class="table-responsive">
          <!-- Profile Requests Table -->
          <table id="unverified_profile_tbl" class="table table-hover" style="width:100% !important">

            <thead style="background-color:#007BFF;color:#FFFFFF">
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Username</th>

              </tr>
            </thead>
            <tbody>
              <?php
              $db = db_connect();
              $queryAdmin = $db->query(
                "SELECT
                user_account.id,
                system_admin.name,
                user_account.username
                FROM user_account
                join system_admin on system_admin.user_account_id = user_account.id
                where user_account.status != 3 and user_account.id != 1
                "
              );

              $db->close();
              foreach ($queryAdmin->getResult() as $row) {

              ?>
                <tr>
                  <td><?php echo $row->id; ?></td>
                  <td><?php echo $row->name; ?></td>
                  <td><?php echo $row->username; ?></td>
                </tr>
              <?php
              }
              ?>
            </tbody>
          </table>
        </div>
      </form>
    </div>
  </div>


  <script src="<?= base_url('bootstrap/js/adminapplicantprofiles.js') ?>"></script>

</body>

</html>