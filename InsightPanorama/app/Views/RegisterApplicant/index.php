<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" name="This is the register page of FutureSeekers.lk, New users can register themselves to the site, Both employers and applicants can register here">
  <link rel="stylesheet" href="<?= base_url('bootstrap/css/bootstrap.min.css') ?>" />
  <link rel="stylesheet" href="<?= base_url('bootstrap/css/register_employerStyles.css') ?>" />

  <title>Future Seekers.lk | Register</title>
</head>

<body>

  <section class="testimonial py-5 regholder" id="testimonial">
    <div class="container">
      <div class="row ">
        <div class="col-md-4 py-5 text-white text-center leftholder">
          <div class="">
            <div class="card-body">
              <!-- Futureseekers logo in the registration page -->
              <img src="<?= base_url('Images/fslogo.webp') ?>" style="width:40%; padding-bottom:20px">
              <h2 class="py-3">Applicant Registration</h2>
              <p class="notepara">

                After Registration, Our Team will verify your profile within 24 hours and would send you a mail regarding your profile status.

              </p>
              <!-- Go Back to Login BTN -->
              <div class="form-row">
                <a class="btn btnlogin2" href="<?php echo site_url('Home/Index/') ?>">Back to Login</a>
              </div>
            </div>

          </div>
        </div>
        <div class="col-md-8 py-5 border regformholder">
          <h4 class="pb-4">Create New Account</h4>
           <!-- Error Message when trying to register -->
          <?php if (!empty(session()->getFlashdata('fail'))) : ?>
            <div style="margin-top:5px" class="alert alert-danger text-muted"> <?= session()->getFlashdata('fail'); ?> </div>
          <?php endif ?>
            <!-- Syccess Message after registering -->
          <?php if (!empty(session()->getFlashdata('success'))) : ?>
            <div style="margin-top:5px" class="alert alert-success text-muted"> <?= session()->getFlashdata('success'); ?> </div>
          <?php endif ?>
          <!-- Registration form begins here -->
          <form action="<?php echo site_url('/RegisterApplicant/createprofile') ?>" method="POST">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label>Full Name</label>
                <input class="form-control" type="text" placeholder="Eg. Alex Hunter" name="name" id="name" value="<?= set_value('name'); ?>">
                <small class="form-text text-danger"><?= isset($validation) ? show_validation_error($validation, 'name') : '' ?></small>
              </div>
              <div class="form-group col-md-6">
                <label>Address</label>
                <input class="form-control" type="text" placeholder="Eg. 25, Lake Avn" name="address" id="address" value="<?= set_value('address'); ?>">
                <small class="form-text text-danger"><?= isset($validation) ? show_validation_error($validation, 'address') : '' ?></small>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label>Email</label>
                <input class="form-control" type="email" placeholder="Eg. alex@gmail.com" name="email" id="email" value="<?= set_value('email'); ?>">
                <small class="form-text text-danger"><?= isset($validation) ? show_validation_error($validation, 'email') : '' ?></small>
              </div>
              <div class="form-group col-md-6">
                <label>Contact No</label>
                <input class="form-control" type="tel" placeholder="Eg. 0777445243" name="contactNo" id="contactNo" value="<?= set_value('contactNo'); ?>">
                <small class="form-text text-danger"><?= isset($validation) ? show_validation_error($validation, 'contactNo') : '' ?></small>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label>Date of Birth</label>
                <input class="form-control" type="date" placeholder="DOB" name="dob" id="dob" value="<?= set_value('dob'); ?>">
                <small class="form-text text-danger"><?= isset($validation) ? show_validation_error($validation, 'dob') : '' ?></small>
              </div>
              <div class="form-group col-md-6">
                <label>Current Job Title</label>
                <input class="form-control" type="text" placeholder="Eg. Java Developer" name="currentJobTitle" id="currentJobTitle" value="<?= set_value('currentJobTitle'); ?>">
                <small class="form-text text-danger"><?= isset($validation) ? show_validation_error($validation, 'currentJobTitle') : '' ?></small>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label>Username</label>
                <input class="form-control" type="text" placeholder="Eg. alex143" name="username" id="username" value="<?= set_value('username'); ?>">
                <small class="form-text text-danger"><?= isset($validation) ? show_validation_error($validation, 'username') : '' ?></small>
              </div>
              <div class="form-group col-md-6">
                <label>Password</label>
                <input class="form-control" type="password" placeholder="Enter your password" name="password" id="password" value="<?= set_value('password'); ?>">
                <small class="form-text text-danger"><?= isset($validation) ? show_validation_error($validation, 'password') : '' ?></small>
              </div>
            </div>
            <br>
            <div class="form-row">
              <button type="submit" class="btn btn-primary btnlogin">Register Now</button>
              <!-- <button id="loginbtn" class="btn btn-primary btnlogin">Register</button><br> -->
            </div>

          </form>
          <!-- Registration form ends here -->
        </div>
      </div>
    </div>
  </section>
</body>

</html>