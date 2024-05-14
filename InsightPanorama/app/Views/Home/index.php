<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" name="This is the login page of FutureSeekers.lk, Registered user can login here and new users can register themselves to the website by going to the Register page.">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?= base_url('bootstrap/css/bootstrap.min.css') ?>" />
  <link rel="stylesheet" href="<?= base_url('bootstrap/css/login_styles.css') ?>" />

  <title>Future Seekers.lk | login</title>
</head>

<body>
  <div class="container login-container">
    <div class="row">
      <div class="col-md-6 login-form-2">
        <img src="<?= base_url('Images/fslogo.webp') ?>" class="rounded mx-auto d-block imglogo" alt="Future Seekers LK Logo">
        <h3 class="display-4 customtitle">FutureSeekers</h3>
        <h3 class="display-4 custommessage">Welcome Back!</h3>


      </div>
      <div class="col-md-6 login-form-1">

        <form action="<?php echo site_url('/Home/login') ?>" method="POST">
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
            <button id="loginbtn" class="btn btn-primary btnlogin">Login</button><br>
          </div>
          <?php if (!empty(session()->getFlashdata('fail'))) : ?>
            <div class="alert alert-danger text-muted"> <?= session()->getFlashdata('fail'); ?> </div>
          <?php endif ?>

          <?php if (!empty(session()->getFlashdata('success'))) : ?>
            <div class="alert alert-success text-muted"> <?= session()->getFlashdata('success'); ?> </div>
          <?php endif ?>
          <div class="form-group">
            <div class="mb-2 text-muted">Are you an Employer? <a href="<?php echo site_url('RegisterEmployer/Index/') ?>">Register Now</a> </div>
            <div class="mb-2 text-muted">Are you an Applicant? <a href="<?php echo site_url('RegisterApplicant/Index') ?>"> Register Now </a> </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>

</html>