<?php

use CodeIgniter\Session\Session;



?>

<!DOCTYPE html>
<html lang="en">

<head>

  <!--Load the AJAX API-->
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    // Load the Visualization API and the corechart package.
    google.charts.load('current', {
      'packages': ['corechart']
    });
    google.charts.load('current', {
      'packages': ['bar']
    });


    // Set a callback to run when the Google Visualization API is loaded.
    google.charts.setOnLoadCallback(drawChart);
    google.charts.setOnLoadCallback(GenerateMostPreferredJobCategoryReport);
    google.charts.setOnLoadCallback(GenerateMostAppliedJobAdvertReport);

    // Callback that creates and populates a data table,
    // instantiates the pie chart, passes in the data and
    // draws it.
    function drawChart() {

      // Create the data table.
      // var data = new google.visualization.DataTable();
      // data.addColumn('string', 'Topping');
      // data.addColumn('number', 'Slices');
      // data.addRows([
      //   ['Mushrooms', 6],
      //   ['Onions', 1],
      //   ['Olives', 1],
      //   ['Zucchini', 1],
      //   ['Pepperoni', 2]
      // ]);

      // // Set chart options
      // var options = {
      //   'title': 'How Much Pizza I Ate Last Night',
      //   'width': 400,
      //   'height': 300
      // };

      // // Instantiate and draw our chart, passing in some options.
      // var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
      // chart.draw(data, options);

      $.ajax({
        url: '<?php echo base_url('MyJobsEmployer/GenerateReports'); ?>',
        type: "post",
        dataType: 'json',
        // data: {
        //   jobID: jobID,
        //   recepientEmail: recepientEmail,
        //   notes: notes
        // },
        beforeSend: function() {

        },
        success: function(result) {

          // console.log(result.result);

          var gdata = new google.visualization.DataTable();
          gdata.addColumn('string', 'Job Category');
          gdata.addColumn('number', 'No of Applications');

          //console.log(result.name);
          $.each(result, function(index, value) {
            // console.log(value.jobCategory);
            // console.log(value.categoryCount);
            // console.log("--------------------------");
            gdata.addRow([String(value.jobCategory), Number(value.categoryCount)]);
          });



          // Set chart options
          var options = {
            'title': 'Job Category vs Job Applications',
            'width': 400,
            'height': 300,
            is3D: true, //Pie Charts
            colors: ['#54C492', '#f96302'], //Bar of Pie Charts
            animation: {
              duration: 2000,
              easing: 'out',
              startup: true
            },
          };

          // Instantiate and draw our chart, passing in some options.
          var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
          chart.draw(gdata, options);

          // console.log(JSON.stringify(result));
          // console.log("Complaint 1: " + result.length);
          // for ($i = 0; $i < result.length; $i++) {
          //   allComp = allComp + ($i + 1) + ") " + result[$i] + "<br>";
          // }
          // document.getElementById("allcomp").innerHTML = allComp;
        },
        complete: function() {

        }

      });

    }


    function GenerateMostAppliedJobAdvertReport() {
      $.ajax({
        url: '<?php echo base_url('MyJobsEmployer/GenerateMostAppliedJobAdvertReport'); ?>',
        type: "post",
        dataType: 'json',
        beforeSend: function() {

        },
        success: function(result) {
          var gdata = new google.visualization.DataTable();
          gdata.addColumn('string', 'Job Title');
          gdata.addColumn('number', 'No. of Applicants');
          gdata.addColumn({
            'type': 'string',
            'role': 'tooltip',
            'p': {
              'html': true
            }
          });

          $.each(result, function(index, value) {
            gdata.addRow([String(value.title), Number(value.applicantCount), GenerateMostAppliedToolTip(value.title, value.applicantCount, value.category, value.location), ]);
          });

          // Set chart options
          var options = {
            tooltip: {
              isHtml: true
            },
            // title: "Most Applied Job Adverts",
            width: 1000,
            height: 400,
            bar: {
              groupWidth: "40%"
            },
            is3D: true, //Pie Charts
            // colors: ['#54C492', '#f96302'], //Bar of Pie Charts
            animation: {
              duration: 2000,
              easing: 'out',
              startup: true
            },
            vAxis: {
              format: '0',
              title: "No: of Applicants"
            }, //Bar of Pie Charts
            hAxis: {
              title: "Job Category"
            }, //Bar of Pie Charts
            colorAxis: {
              colors: ['#54C492', '#cc0000']
            }, //Geo Charts
            datalessRegionColor: '#dedede', //Geo Charts
            defaultColor: '#dedede' //Geo Charts,

          };

          // Instantiate and draw our chart, passing in some options.
          // var chart = new google.visualization.ColumnChart(document.getElementById('top_x_div'));
          var chart = new google.visualization.ColumnChart(document.getElementById('most_applied'));
          chart.draw(gdata, options);
        },
        complete: function() {

        }

      });
    }

    function GenerateMostAppliedToolTip(title, applicantCount, category, location) {
      return "<div class='p-2'><b>" + title + "</b>" + "<br> Applicants: <b>" + applicantCount + "</b><p> Category: <b>" + category + "</b><br>" + " Location: <b>" + location + "</b> </div>"
    }

    function GenerateMostPreferredJobCategoryReport() {
      $.ajax({
        url: '<?php echo base_url('MyJobsEmployer/GenerateMostPreferredJobCategoryReport'); ?>',
        type: "post",
        dataType: 'json',
        beforeSend: function() {

        },
        success: function(result) {

          var gdata = new google.visualization.DataTable();
          gdata.addColumn('string', 'Job Category');
          gdata.addColumn('number', 'No of Applications');

          $.each(result, function(index, value) {
            gdata.addRow([String(value.category), Number(value.applicantCount)]);
          });

          // Set chart options
          var options = {
            title: "Most Preferred Job Category",
            width: 600,
            height: 400,
            bar: {
              groupWidth: "40%"
            },
            is3D: true, //Pie Charts
            colors: ['#54C492', '#f96302'], //Bar of Pie Charts
            animation: {
              duration: 2000,
              easing: 'out',
              startup: true
            },
            vAxis: {
              title: "No: of Applicants"
            }, //Bar of Pie Charts
            hAxis: {
              title: "Job Category"
            }, //Bar of Pie Charts
            colorAxis: {
              colors: ['#54C492', '#cc0000']
            }, //Geo Charts
            datalessRegionColor: '#dedede', //Geo Charts
            defaultColor: '#dedede' //Geo Charts,

          };

          // Instantiate and draw our chart, passing in some options.
          // var chart = new google.visualization.ColumnChart(document.getElementById('top_x_div'));
          var chart = new google.visualization.PieChart(document.getElementById('most_preferred_jobs'));
          chart.draw(gdata, options);
        },
        complete: function() {

        }

      });
    }

    function GetTiledReports() {
      $.ajax({
        url: '<?php echo base_url('MyJobsEmployer/GetTiledReports'); ?>',
        type: "post",
        dataType: 'json',
        beforeSend: function() {

        },
        success: function(result) {

        },
        complete: function() {

        }

      });
    }
  </script>

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" name="This is the applicant portal page of FutureSeekers.lk, Applicant can use this page to view and edit their profile, view job adverts and apply for  jobs here">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?= base_url('bootstrap/css/bootstrap.min.css') ?>" />
  <link rel="stylesheet" href="<?= base_url('bootstrap/css/applicant_home.css') ?>" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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
  <script src="<?= base_url('bootstrap/js/modalstuff.js') ?>"></script>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/jquery.min.js"></script>
  <title>Future Seekers.lk | My Jobs</title>
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
            <!-- <li class="nav-item">
              <a class="nav-link" href="<?php echo site_url('MyJobsEmployer/index') ?>">My Jobs</a>
            </li> -->
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
  <?php if (!empty(session()->getFlashdata('fail'))) : ?>
    <div style="margin-top:35px; width:1200px; margin-left: auto; margin-right: auto;" id="failMsgFlash" class="alert alert-danger text-muted"> <?= session()->getFlashdata('fail'); ?> </div>
  <?php endif ?>

  <?php if (!empty(session()->getFlashdata('success'))) : ?>
    <div style="margin-top:35px; max-width:1200px; margin-left: auto; margin-right: auto;" class="alert alert-success text-muted" id="successMsgFlash"> <?= session()->getFlashdata('success'); ?> </div>
  <?php endif ?>

  <div class="shadow-lg mb-5 bg-white rounded card" style="margin-left:auto;margin-right:auto; width:1200px">
    <div class="card-header bg-primary" style="color:white">
      My Job Adverts
    </div>
    <div class="card-body" style="padding-left: 0px !important; padding-right: 0px; padding-bottom: 5px !important;">
      <?php
      $session = session();
      $session->regenerate();
      $user_id = session()->get('user_id');

      $JobAdvert = new \App\Models\jobDetailsModel();
      $Employer = new \App\Models\employerModel();
      $UserAccount = new \App\Models\userAccountModel();
      $Company = new \App\Models\companyModel();
      $checkJob = 0;


      $query2 = $Employer->query("select * from employer where user_account_id = $user_id");
      foreach ($query2->getResult() as $row2) {
        $companyId = $row2->company_id;
        $employerId = $row2->id;
        $employerEmail = $row2->email;

        $query3 = $Company->query("select * from company where id = $companyId");
        foreach ($query3->getResult() as $row3) {
          $companyName = $row3->name;
          $companyNo = $row3->contactNo;
          $companyEmail = $row3->email;
          $logo = $row3->logo_dir;

          $query4 = $JobAdvert->query("Select * from job_details where status = 1 and employer_id = $employerId");
          foreach ($query4->getResult() as $row4) {
            $jobId = $row4->id;
            $jobTitle = $row4->jobtitle;
            $jobCategory = $row4->jobCategory;
            $pDate = $row4->dateTime;
            $cDate = $row4->closingDate;
            $employerId = $row4->employer_id;
            $pdfname = $row4->description;
            $typeofemployment = $row4->typeOfEmployment;
            $jobtime = $row4->experience;
            $joblocation = $row4->location;

            $checkJob = 1;

            echo "<div class=\"ratt \" >
                <div class=\"jobs_img_container\" style=\"width: 100px\">
                    <img class=\"jobs_img\" src='" . base_url() . "/logo/" . $logo . "'>
                </div>
        
                <div style=\"flex-grow: 8\">
        
                    <div style=\"border: none !important\" class=\"list-group-item flex-column align-items-start\">
        
                        <div class=\"d-flex w-100 justify-content-between\">
        
                            <h5 class=\"mb-1\" >$jobTitle</h5>
        
                            <!-- <small> $cDate </small> -->
        
                        </div>
        
                        <p class=\"mb-1 company_name\">$companyName</p>
        
                        <div class=\"flex-container2\" style=\"margin-top: 10px !important;\">
        
                            <div class=\" mb-1 cat_container badge badge-primary badge-pill\">
        
                                <small \">$jobCategory</small>
        
                            </div>
              
                            <div class=\" mb-1 cat_container2 badge badge-light badge-pill border border-primary\">
        
                            <div class=\"img_and_element_holder\">
                                <span> <img class=\"span_img2\" src='" . base_url() . "/images/typeofemployment.webp" . "'></span><small style=\"font-size:13px \">$typeofemployment</small>
                            </div>
                            </div>
                            <div class=\" mb-1 cat_container2 badge badge-light badge-pill border border-secondary\">
        
                                <div class=\"img_and_element_holder\">
                                    <span> <img class=\"span_img2\" src='" . base_url() . "/images/clock_timer.webp" . "'></span><small style=\"font-size:13px \">$cDate</small>
                                </div>
                            </div>

                            <div class=\" mb-1 cat_container2 badge  badge-pill border border-secondary\" style=\"background-color:#c9c8cf !important; color:black !important \">
        
                            <div class=\"img_and_element_holder\">
                                <span> <img class=\"span_img2\" src='" . base_url() . "/images/performance.webp" . "'></span><small style=\"font-size:13px \">$jobtime</small>
                            </div>
                            </div>
        
                        
        
                                <div class=\" mb-1 cat_container2 badge badge-light badge-pill border border-secondary\">
                                <div class=\"img_and_element_holder\">
                                    <a href='" . base_url() . "/ApplicantHome/downloadPdf/$pdfname" . "'>
                                
                                        <span> <img class=\"span_img2\" src='" . base_url() . "/images/download.webp" . "' <small style=\"font-size:13px\">Download Advert</small> </span>
        
                                    </a>
                                    </div>
        
                                </div>
        
                           
        
                            <!-- <small> Closing Date: 2021-06-07 03:55</small> -->
        
                        </div>
        
         
        
                        <div class=\"flex-container2\" style=\"margin-top: 10px !important;\">
        
                            <div style=\"margin-right:20px !important\">
        
                                <span> <img class=\"span_img\" src='" . base_url() . "/images/contact.webp" . "'></span><small style=\"font-size: 14px\"> $companyNo</small>
        
                            </div>
        
                            <div style=\"margin-right:20px !important\">
        
                                <span> <img style=\"width: 13px\" class=\"span_img\" src='" . base_url() . "/images/email.webp" . "'></span><small style=\"font-size: 14px\"> $companyEmail</small>
        
                            </div>

                            <div style=\"margin-right:20px !important\">
        
                                <span> <img style=\"width: 13px\" class=\"span_img\" src='" . base_url() . "/images/location.webp" . "'></span><small style=\"font-size: 14px\"> $joblocation</small>
        
                            </div>
        
                           
                        </div>
        
         
        
                    </div>
        
                </div>
        
         
        
                <div style=\"width: 200px\">
        
         
        
                    <div class=\"job_option_holder\">
        
                        <a href='" . base_url() . "/MyJobsEmployer/showapplicants/$jobId" . "' class=\"btn btn-primary btn-sm\" >Show Applicants</a>
                         
                        <p></p>
                        
                        <a href='" . base_url() . "/adverts/$pdfname" . "' target='_blank' class=\"btn btn-secondary btn-sm\">View Advert</a>
     
        
                    </div>
        
                </div>
        
            </div>

            <hr class=\"my-4 bg-primary\">
            ";
          }
        }
      }

      if ($checkJob == 0) {
        echo "<b><p style=\"text-align:center;\">Looks Like You haven't Posted any Advertisements</p></b>";
      }

      ?>

    </div>
  </div>


</body>

</html>