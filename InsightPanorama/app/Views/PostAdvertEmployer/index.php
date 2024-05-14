<?php

use CodeIgniter\Session\Session;

// if(session()->get('user_id')== null){
//   return redirect()->to('http://localhost:8080/Home');
// }

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" name="">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" href="<?= base_url('bootstrap/css/bootstrap.min.css') ?>" />
  <link rel="stylesheet" href="<?= base_url('bootstrap/css/register_employerStyles.css') ?>" />
  <!-- CSS stylesheet for navigation bar -->
  <link rel="stylesheet" href="<?= base_url('bootstrap/css/navbar.css') ?>" />

  <!-- For the Font Library -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;300&family=Raleway:wght@300&display=swap" rel="stylesheet">

  <!-- Scripts for Navbar -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> -->

  <!--Styles for dropdown with search-->
  <link rel="stylesheet" href="<?= base_url('bootstrap/css/select2-bootstrap.css') ?>" />
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

  <!--Scripts for dropdown with search-->
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>



  <title>Future Seekers.lk | Post Job Adverts</title>
</head>

<body>

  <div class="header">
    <div class="menu-bar">
      <nav class="navbar navbar-expand-lg navbar-light ">
        <a class="navbar-brand" href=""><img class="websitelogo" src="<?= base_url('Images/logo4.webp') ?>"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="<?php echo site_url('EmployerHome/index') ?>">Jobs </a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                My Jobs
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="<?php echo site_url('MyJobsEmployer/index') ?>">Job Postings</a>
                <a class="dropdown-item" href="<?php echo site_url('MyJobsEmployer/MyReports') ?>">My Reports</a>

              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo site_url('PostAdvertEmployer/index') ?>">Post an Advert</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo site_url('MyProfileEmployer/index') ?>">My Profile</a>
            </li>
            <!-- Enter PHP code to check if the user is logged in or not in order to show login button -->

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

  <br />

  <div class="card" style="margin-left:20px;margin-right:20px">
    <div class="card-header bg-primary" style="color:white">
      Create an Advert
    </div>
    <div class="card-body">
      <h5 class="card-title">Enter Job Details</h5>
      <?php if (!empty(session()->getFlashdata('fail'))) : ?>
        <div style="margin-top:5px" id="failMsgFlash" class="alert alert-danger text-muted"> <?= session()->getFlashdata('fail'); ?> </div>
      <?php endif ?>

      <?php if (!empty(session()->getFlashdata('success'))) : ?>
        <div style="margin-top:5px" class="alert alert-success text-muted" id="successMsgFlash"> <?= session()->getFlashdata('success'); ?> </div>
      <?php endif ?>
      <form action="<?php echo site_url('/PostAdvertEmployer/PostAdvert') ?>" method="POST" enctype="multipart/form-data">

        <div class="form-column">
          <div class="form-group col-md-4">
            <label>Job Title</label>
            <input class="form-control" type="text" id="jobtitle" name="jobtitle" value="<?= set_value('jobtitle'); ?>">
            <small class="form-text text-danger"><?= isset($validation) ? show_validation_error($validation, 'jobtitle') : '' ?></small>
          </div>
          <div class="form-group col-md-4">
            <label>Job Category</label>
            <select style="width:200px" name="jobCategory" id="getCategory" value="<?= set_value('jobCategory'); ?>">
              <option value="IT">IT</option>
              <option value="Management">Management</option>
              <option value="Healthcare">Healthcare</option>
              <option value="Law">Law</option>
              <option value="Agriculture">Agriculture</option>
              <option value="Accounting">Accounting</option>
              <option value="Media">Media</option>
              <option value="Security">Security</option>
              <option value="Banking">Banking</option>
              <option value="Clothing">Clothing</option>
              <option value="Marketing">Marketing</option>
              <option value="Tourism">Tourism</option>
              <option value="HR">HR</option>
              <option value="Logistics">Logistics</option>
              <option value="Sports">Sports</option>
              <option value="Academic">Academic</option>
            </select>
            <small class="form-text text-danger"><?= isset($validation) ? show_validation_error($validation, 'jobCategory') : '' ?></small>
          </div>


          <div class="form-group col-md-4">
            <label>Job Location</label>
            <!-- <input class="form-control" type="text" name="jobCategory" value="<?= set_value('jobCategory'); ?>"> -->
            <select style="width:200px" name="jobLocation" id="getLocation" value="<?= set_value('jobLocation'); ?>">
              <option value="Jaffna">Jaffna</option>
              <option value="Kilinochchi">Kilinochchi</option>
              <option value="Mannar">Mannar</option>
              <option value="Mullaitivu">Mullaitivu</option>
              <option value="Vavuniya">Vavuniya</option>
              <option value="Puttalam">Puttalam</option>
              <option value="Kurunegala">Kurunegala</option>
              <option value="Gampaha">Gampaha</option>
              <option value="Colombo">Colombo</option>
              <option value="Kalutara">Kalutara</option>
              <option value="Anuradhapura">Anuradhapura</option>
              <option value="Polonnaruwa">Polonnaruwa</option>
              <option value="Matale">Matale</option>
              <option value="Kandy">Kandy</option>
              <option value=" Nuwara Eliya	"> Nuwara Eliya </option>
              <option value="Kegalle">Kegalle</option>
              <option value="Ratnapura">Ratnapura</option>
              <option value="Trincomalee">Trincomalee</option>
              <option value="Batticaloa">Batticaloa</option>
              <option value="Ampara">Ampara</option>
              <option value=" Badulla	Uva"> Badulla Uva</option>
              <option value="Monaragala">Monaragala</option>
              <option value="Hambantota">Hambantota</option>
              <option value="Matara">Matara</option>
              <option value="Galle">Galle</option>
            </select>
            <small class="form-text text-danger"><?= isset($validation) ? show_validation_error($validation, 'jobLocation') : '' ?></small>
          </div>


          <div class="form-group col-md-4">
            <label>Salary</label>
            <input class="form-control" type="number" name="salary" id="salary" value="<?= set_value('salary'); ?>" placeholder="Optional">
            <small class="form-text text-danger"><?= isset($validation) ? show_validation_error($validation, 'salary') : '' ?></small>
          </div>
          <div class="form-group col-md-4">
            <label>Closing date</label>
            <input class="form-control" type="datetime-local" name="closingDate" id="closingDate" max="2023-12-31T00:00" min="2020-12-31T00:00" <?= set_value('closingDate'); ?>">
            <small class="form-text text-danger"> <?= isset($validation) ? show_validation_error($validation, 'closingDate') : '' ?></small>
          </div>

          <div class="form-group col-md-4">

            <label for="experience">Experience in the Field:</label>
            <select name="experience" id="experience" class="form-select form-select-lg mb-3" style="font-size:15px !important" value="<?= set_value('experience'); ?>">

              <option value="Below 2 years">Below 2 years</option>
              <option value="2+ years">2+ years</option>
              <option value="5+ years">5+ years</option>
              <option value="10+ years">10+ years</option>

            </select>
            <small class="form-text text-danger"> <?= isset($validation) ? show_validation_error($validation, 'experience') : '' ?></small>
          </div>

          <div class="form-group col-md-4">

            <label for="typeOfEmployment">Type of employment:</label>
            <select name="typeOfEmployment" id="typeOfEmployment" class="form-select form-select-lg mb-3" style="font-size:15px !important" value="<?= set_value('typeOfEmployment'); ?>">

              <option value="Fulltime">Full-Time</option>
              <option value="Parttime">Part-Time</option>

            </select>
            <small class="form-text text-danger"> <?= isset($validation) ? show_validation_error($validation, 'typeofemployment') : '' ?></small>
          </div>
          <div class="form-group col-md-6">
            <label>Job Details as a PDF</label>
            <input class="form-control" type="file" id='description' name='description' value="<?= set_value('description'); ?>" />
            <small class="form-text text-danger"><?= isset($validation) ? show_validation_error($validation, 'description') : '' ?></small>
          </div>

        </div>




        <br>
        <div class="form-row">
          <button type="submit" id="submitBtn" class="btn btn-primary btnlogin">Publish Advert</button>
          <!-- <button id="loginbtn" class="btn btn-primary btnlogin">Register</button><br> -->
        </div>
      </form>


    </div>
    <script src="<?= base_url('bootstrap/js/postadvert.js') ?>"></script>
</body>

</html>