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
              <!-- Image on page -->
              <img src="<?= base_url('Images/fslogo.webp') ?>" style="width:40%; padding-bottom:20px">
              <h2 class="py-3">Employer Registration</h2>
              <p class="notepara">
                After Registration, You're required to pay a fee of Rs 1,000 and send the reciept via email to futureseekers@gamil.com.<br>
                Our Team will verify your profile within 24 hours and would send you a mail.

              </p>
              <!-- Go Back to Login BTN -->
              <div class="form-row">
              <a class="btn btnlogin2"href="<?php echo site_url('Home/Index/') ?>">Back to Login</a>
            </div>
            </div>
           
          </div>
        </div>
        <div class="col-md-8 py-5 border regformholder">
          <h4 class="pb-4">Create New Account</h4>
          <?php if (!empty(session()->getFlashdata('fail'))) : ?>
            <div style="margin-top:5px" class="alert alert-danger text-muted"> <?= session()->getFlashdata('fail'); ?> </div>
          <?php endif ?>

          <?php if (!empty(session()->getFlashdata('success'))) : ?>
            <div style="margin-top:5px" class="alert alert-success text-muted"> <?= session()->getFlashdata('success'); ?> </div>
          <?php endif ?>
            <!-- form begins here -->
          <form  action="<?php echo site_url('/RegisterEmployer/createProfile') ?>" method="POST">
            <div class="form-row">
              <div class="form-group col">
                <label>Full Name</label>
                <input class="form-control" type="text" placeholder="Eg. Alex Hunter" name="name" id="name" value="<?= set_value('name'); ?>">
                <small class="form-text text-danger"><?= isset($validation) ? show_validation_error($validation, 'name') : '' ?></small>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label>Current Job Position</label>
                <input class="form-control" type="text" placeholder="Eg. HR Executive" name="jobPosition" id="jobPosition" value="<?= set_value('jobPosition'); ?>">
                <small class="form-text text-danger"><?= isset($validation) ? show_validation_error($validation, 'jobPosition') : '' ?></small>
              </div>
              <div class="form-group col-md-6">
                <label>Email</label>
                <input class="form-control" type="email" placeholder="Eg. alex@gmail.com" name="email" id="email" value="<?= set_value('email'); ?>">
                <small class="form-text text-danger"><?= isset($validation) ? show_validation_error($validation, 'email') : '' ?></small>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label>Contact No</label>
                <input class="form-control" type="tel" placeholder="Eg. 0777118657" name="contactNo" id="contactNo" value="<?= set_value('contactNo'); ?>">
                <small class="form-text text-danger"><?= isset($validation) ? show_validation_error($validation, 'contactNo') : '' ?></small>
              </div>
              <div class="form-group col-md-6">
                <label>Company Name</label>
                <input class="form-control" type="text" placeholder="Eg. Techland Ltd" name="cname" id="cname" value="<?= set_value('cname'); ?>">
                <small class="form-text text-danger"><?= isset($validation) ? show_validation_error($validation, 'cname') : '' ?></small>
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
                <input class="form-control" type="password" placeholder="Enter password" name="password" id="password" value="<?= set_value('password'); ?>">
                <small class="form-text text-danger"><?= isset($validation) ? show_validation_error($validation, 'password') : '' ?></small>
              </div>
            </div>
            <br>
            <div class="form-row">
              <button type="submit" class="btn btn-primary btnlogin">Register Now</button>     
              <!-- <button id="loginbtn" class="btn btn-primary btnlogin">Register</button><br> -->
            </div>
            
          </form>
          <!-- form ends here -->
        </div>
      </div>
    </div>
  </section>















  <!-- 

    <h1 id="header">Future Seekers LK</h1>
  <div class="pagepanel">
    <div class="grid">
      <div class="formpanel"> 
        <h2>Create a New Account</h2>
        <form>
        </form>
        <div id="GroupName1Div">
            <h3>Employer Details</h3>
            <?php if (!empty(session()->getFlashdata('success'))) : ?>
              <div> <?= session()->getFlashdata('success'); ?> </div>
            <?php endif ?>
            <form action="<?php echo site_url('/RegisterEmployer/createProfile') ?>" method="POST">
              
              <input type="text" placeholder="Full Name" name="name" id="name" value="<?= set_value('name'); ?>"><br>
              <small><?= isset($validation) ? show_validation_error($validation, 'name') : '' ?></small><br>

              <input type="tel" placeholder="Contact No" name="contactNo" id="contactNo" value="<?= set_value('contactNo'); ?>"><br>
              <small><?= isset($validation) ? show_validation_error($validation, 'contactNo') : '' ?></small><br>
              
              <input type="text" placeholder="Job Position" name="jobPosition" id="jobPosition" value="<?= set_value('jobPosition'); ?>"><br>
              <small><?= isset($validation) ? show_validation_error($validation, 'jobPosition') : '' ?></small><br>

              <input type="email" placeholder="Email" name="email" id="email" value="<?= set_value('email'); ?>"><br>
              <small><?= isset($validation) ? show_validation_error($validation, 'email') : '' ?></small><br>

              <input type="text" placeholder="Company Name" name="cname" id="cname" value="<?= set_value('cname'); ?>"><br>
              <small><?= isset($validation) ? show_validation_error($validation, 'cname') : '' ?></small><br>

              <input type="text" placeholder="Username" name="username" id="username" value="<?= set_value('username'); ?>"><br>
              <small><?= isset($validation) ? show_validation_error($validation, 'username') : '' ?></small><br>

              <input type="password" placeholder="Password" name="password" id="password" value="<?= set_value('password'); ?>"><br>
              <small><?= isset($validation) ? show_validation_error($validation, 'password') : '' ?></small><br>

              <button type="submit">Register Now</button>
            </form>
        </div>
      </div>
      <div class="note">
        <div class="companynote">
          <p>
            Note - Company<br>
            After Registration, You're required to pay a fee of Rs 1,000 and send the reciept via email to futureseekerslk.com<br>
            Our Team will verify your profile within 24 hours and would send you a mail.
          </p>
        </div>
      </div>
    </div>
  </div>

    <?php

    ?> -->

</body>

</html>