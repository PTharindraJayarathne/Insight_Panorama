<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" name="">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  <title>Future Seekers.lk | My Profile</title>
</head>

<body>

  <form action="<?php echo site_url('/PostAdvertEmployer/PostAdvert') ?>" method="POST" enctype="multipart/form-data">

        <div class="form-column">
          <div class="form-group col-md-4">
            <label>Job Title</label>
            <input class="form-control" type="text" name="jobtitle" value="<?= set_value('jobtitle'); ?>">
            <small class="form-text text-danger"><?= isset($validation) ? show_validation_error($validation, 'jobtitle') : '' ?></small>
          </div>

          <div class="form-group col-md-4">

            <label for="experience">Experience in the Field:</label>
            <select name="experience" class="form-select form-select-lg mb-3"  style = "font-size:15px !important" value="<?= set_value('experience'); ?>">

              <option value="Below 2">Below 2 years</option>
              <option value="2+">2+ years</option>
              <option value="5+">5+ years</option>
              <option value="10+">10+ years</option>

            </select>
            <small class="form-text text-danger"> <?= isset($validation) ? show_validation_error($validation, 'experience') : '' ?></small>
          </div>

          <div class="form-group col-md-4">

            <label for="typeOfEmployment">Type of employment:</label>
            <select name="typeOfEmployment" class="form-select form-select-lg mb-3"  style = "font-size:15px !important"value="<?= set_value('typeOfEmployment'); ?>">

              <option value="Fulltime">Full-Time</option>
              <option value="Parttime">Part-Time</option>

            </select>
            <small class="form-text text-danger"> <?= isset($validation) ? show_validation_error($validation, 'typeofemployment') : '' ?></small>
          </div>
          <div class="form-group col-md-6">
            <label>Job Details as a PDF</label>
            <input class="form-control" type="file" name='description' value="<?= set_value('description'); ?>" />
            <small class="form-text text-danger"><?= isset($validation) ? show_validation_error($validation, 'description') : '' ?></small>
          </div>

        </div>




        <br>
        <div class="form-row">
          <button type="submit" class="btn btn-primary btnlogin">Save Changes</button>
         
        </div>
      </form>
</body>
</html>

