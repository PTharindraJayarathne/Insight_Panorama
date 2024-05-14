<!DOCTYPE html>
<html lang="en">

<head>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    // Load the Visualization API and the corechart package.
    google.charts.load('current', {
      'packages': ['corechart']
    });
    google.charts.load('current', {
      'packages': ['bar']
    });
    google.charts.load('current', {
      'packages': ['table']
    });

    // Calls the following functions on load
    window.onload = function() {
      GenerateMeetingsConductedData();
      GenerateAgeSummaryData();
      GenerateTopApplicantsAppliedData();
      GenerateTopCompaniesPostedData();
      GenerateTopJobRolesData();
      GetAllApplicantsData();
      GetAllCompaniesData();
      GetAllJobPostingsData();
      GetAllInterviewCount();
    };

    function GenerateAgeToolTip(cat, applicants) {
      return "<b>" + cat + "</b><br>" + "No. of Applicants: <b>" + applicants + "</b>";
    }

    function GenerateMeetingsConductedData() {
      $.ajax({
        url: '<?php echo base_url('AdminHome/GenerateMeetingsConductedData'); ?>',
        type: "post",
        dataType: 'json',
        beforeSend: function() {
          $('#loading_interview_tbl').show();
          $('#test_tbl').hide();
        },
        success: function(result) {

          $('#test_tbl tbody').empty(); // To remove the existing rows

          $(result).each(function(index, item) {
            $('#test_tbl tbody').append(
              '<tr><td>' + item.CompanyID +
              '</td><td>' + item.companyName +
              '</td><td>' + item.count +
              '</td></tr>'
            )
          });

        },
        complete: function() {
          $('#loading_interview_tbl').hide();
          $('#test_tbl').show();
        }

      });
    }


    function GenerateAgeSummaryData() {
      $.ajax({
        url: '<?php echo base_url('AdminHome/GenerateAgeSummaryData'); ?>',
        type: "post",
        dataType: 'json',
        beforeSend: function() {
          $('#loading_age_data').show();
        },
        success: function(result) {

          var gdata = new google.visualization.DataTable();
          gdata.addColumn('string', 'Age Category');
          gdata.addColumn('number', 'No of Applicants');
          // gdata.addColumn({
          //   type: 'string',
          //   role: 'tooltip'
          // });

          $.each(result, function(index, value) {
            gdata.addRow([String(value.ageGroup), Number(value.noOfApplicants)]);
          });

          // Set chart options
          var options = {
            // title: "Most Preferred Job Category",
            width: 600,
            height: 300,
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
          var chart = new google.visualization.PieChart(document.getElementById('applicant_age_data'));
          chart.draw(gdata, options);
        },
        complete: function() {
          $('#loading_age_data').hide();
        }

      });
    }

    function GenerateTopApplicantsAppliedData() {
      $.ajax({
        url: '<?php echo base_url('AdminHome/GenerateTopApplicantsAppliedData'); ?>',
        type: "post",
        dataType: 'json',
        beforeSend: function() {
          $('#loading_top_applicants').show();
        },
        success: function(result) {
          var gdata = new google.visualization.DataTable();
          gdata.addColumn('string', 'Applicant');
          gdata.addColumn('number', 'Times Applied');

          $.each(result, function(index, value) {
            gdata.addRow([String(value.applicantName), Number(value.timesApplied)]);
          });

          // Set chart options
          var options = {
            legend: {
              position: "none"
            },
            // title: "Most Applied Job Adverts",
            // width: 900,
            height: 500,
            bar: {
              groupWidth: "40%"
            },
            colors: ['green'],
            is3D: true, //Pie Charts
            // colors: ['#54C492', '#f96302'], //Bar of Pie Charts
            animation: {
              duration: 2000,
              easing: 'out',
              startup: true
            },
            vAxis: {
              format: '0',
              title: "Times Applied"
            }, //Bar of Pie Charts
            hAxis: {
              title: "Applicant Name"
            }, //Bar of Pie Charts
            colorAxis: {
              colors: ['#54C492', '#cc0000']
            }, //Geo Charts
            datalessRegionColor: '#dedede', //Geo Charts
            defaultColor: '#dedede' //Geo Charts,

          };

          // Instantiate and draw our chart, passing in some options.
          // var chart = new google.visualization.ColumnChart(document.getElementById('top_x_div'));
          if (result.length > 0) {
            $('#top_applicants').html("");
            var chart = new google.visualization.ColumnChart(document.getElementById('top_applicants'));
            chart.draw(gdata, options);
          } else {
            $('#top_applicants').html("No Data");
          }

        },
        complete: function() {
          $('#loading_top_applicants').hide();
        }

      });
    }

    function GenerateTopCompaniesPostedData() {
      $.ajax({
        url: '<?php echo base_url('AdminHome/GenerateTopCompaniesPostedData'); ?>',
        type: "post",
        dataType: 'json',
        beforeSend: function() {
          $('#loading_top_companies').show();
        },
        success: function(result) {
          var gdata = new google.visualization.DataTable();
          gdata.addColumn('string', 'Companies');
          gdata.addColumn('number', 'Jobs Posted');

          $.each(result, function(index, value) {
            gdata.addRow([String(value.CompanyName), Number(value.JobsPosted)]);
          });

          // Set chart options
          var options = {
            legend: {
              position: "none"
            },
            // title: "Most Applied Job Adverts",
            // width: 900,
            height: 500,
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
              title: "Jobs Posted"
            }, //Bar of Pie Charts
            hAxis: {
              title: "Company Name"
            }, //Bar of Pie Charts
            colorAxis: {
              colors: ['#54C492', '#cc0000']
            }, //Geo Charts
            datalessRegionColor: '#dedede', //Geo Charts
            defaultColor: '#dedede' //Geo Charts,

          };

          // Instantiate and draw our chart, passing in some options.
          // var chart = new google.visualization.ColumnChart(document.getElementById('top_x_div'));
          if (result.length > 0) {
            $('#top_companies').html("");
            var chart = new google.visualization.ColumnChart(document.getElementById('top_companies'));
            chart.draw(gdata, options);
          } else {
            $('#top_companies').html("No Data");
            // document.getElementById('most_applied').innerHTML = "No data"
          }

        },
        complete: function() {
          $('#loading_top_companies').hide();
        }

      });
    }

    function GenerateTopJobRolesData() {
      $.ajax({
        url: '<?php echo base_url('AdminHome/GenerateTopJobRolesData'); ?>',
        type: "post",
        dataType: 'json',
        beforeSend: function() {
          $('#loading_top_jobs').show();
        },
        success: function(result) {
          var gdata = new google.visualization.DataTable();
          gdata.addColumn('string', 'Job Title');
          gdata.addColumn('number', 'Applicants Applied');
          gdata.addColumn({
            'type': 'string',
            'role': 'tooltip',
            'p': {
              'html': true
            }
          });

          $.each(result, function(index, value) {
            gdata.addRow([String(value.jobTitle), Number(value.applicants), GenerateTopJobsToolTip(value.jobTitle, value.applicants, value.category)]);
          });

          // Set chart options
          var options = {
            tooltip: {
              isHtml: true
            },
            legend: {
              position: "none"
            },
            // title: "Most Applied Job Adverts",
            // width: 900,
            height: 500,
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
              title: "Times Viewed"
            }, //Bar of Pie Charts
            hAxis: {
              title: "Advertisement"
            }, //Bar of Pie Charts
            colorAxis: {
              colors: ['#54C492', '#cc0000']
            }, //Geo Charts
            datalessRegionColor: '#dedede', //Geo Charts
            defaultColor: '#dedede' //Geo Charts,

          };

          // Instantiate and draw our chart, passing in some options.
          // var chart = new google.visualization.ColumnChart(document.getElementById('top_x_div'));
          if (result.length > 0) {
            $('#top_jobs').html("");
            var chart = new google.visualization.ColumnChart(document.getElementById('top_jobs'));
            chart.draw(gdata, options);
          } else {
            $('#top_jobs').html("No Data");
            // document.getElementById('most_applied').innerHTML = "No data"
          }

        },
        complete: function() {
          $('#loading_top_jobs').hide();
        }

      });

      function GenerateTopJobsToolTip(title, applicants, category) {
        return "<div class='p-2'><b>" + title + "</b>" + "<br> Applicants: <b>" + applicants + "</b><p> Category: <b>" + category + "</b><br></div>";
      }
    }


    function GetAllApplicantsData() {
      $.ajax({
        url: '<?php echo base_url('AdminHome/GetAllApplicantsData'); ?>',
        type: "post",
        dataType: 'json',
        beforeSend: function() {
          // $('#loading_most_preferred').show();
        },
        success: function(result) {
          var total = 0;

          $.each(result, function(index, value) {
            total = total + Number(value.applicants);

            if (value.statusType == "Approved") {
              accepted = value.applicants;
              $("#applicant_accept").html("Accepted : " + value.applicants);
            } else if (value.statusType == "Rejected") {
              $("#applicant_reject").html("Rejected : " + value.applicants);
            } else if (value.statusType == "Other") {
              $("#applicant_other").html("Other: " + value.applicants);
            }

          });

          $("#applicant_total").html("Total : " + total);

        },
        complete: function() {
          // $('#loading_most_preferred').hide();
        }

      });
    }

    function GetAllCompaniesData() {
      $.ajax({
        url: '<?php echo base_url('AdminHome/GetAllCompaniesData'); ?>',
        type: "post",
        dataType: 'json',
        beforeSend: function() {
          // $('#loading_most_preferred').show();
        },
        success: function(result) {
          var total = 0;

          $.each(result, function(index, value) {
            total = total + Number(value.companies);

            if (value.statusType == "Approved") {
              accepted = value.companies;
              $("#comp_accept").html("Accepted : " + value.companies);
            } else if (value.statusType == "Rejected") {
              $("#comp_reject").html("Rejected : " + value.companies);
            } else if (value.statusType == "Other") {
              $("#comp_other").html("Other: " + value.companies);
            }

          });

          $("#comp_total").html("Total : " + total);

        },
        complete: function() {
          // $('#loading_most_preferred').hide();
        }

      });
    }

    function GetAllJobPostingsData() {
      $.ajax({
        url: '<?php echo base_url('AdminHome/GetAllJobPostingsData'); ?>',
        type: "post",
        dataType: 'json',
        beforeSend: function() {
          // $('#loading_most_preferred').show();
        },
        success: function(result) {
          var total = 0;

          $.each(result, function(index, value) {
            total = total + Number(value.adverts);

            if (value.statusType == "Approved") {
              accepted = value.adverts;
              $("#ad_accept").html("Accepted : " + value.adverts);
            } else if (value.statusType == "Rejected") {
              $("#ad_reject").html("Rejected : " + value.adverts);
            } else if (value.statusType == "Other") {
              $("#ad_other").html("Other: " + value.adverts);
            }

          });

          $("#ad_total").html("Total : " + total);

        },
        complete: function() {
          // $('#loading_most_preferred').hide();
        }

      });
    }

    function GetAllInterviewCount() {
      $.ajax({
        url: '<?php echo base_url('AdminHome/GetAllInterviewCount'); ?>',
        type: "post",
        dataType: 'json',
        beforeSend: function() {
          // $('#loading_most_preferred').show();
        },
        success: function(result) {

          $.each(result, function(index, value) {
            $("#interview_total").html("Total : " + value.interviews);
          });



        },
        complete: function() {
          // $('#loading_most_preferred').hide();
        }

      });
    }
  </script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" name="This is the admin portal page of FutureSeekers.lk, Admins can control the profiles, job adverts and web page from here">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?= base_url('bootstrap/css/bootstrap.min.css') ?>" />
  <link rel="stylesheet" href="<?= base_url('bootstrap/css/login_styles.css') ?>" />

  <!-- CSS stylesheet for navigation bar -->
  <link rel="stylesheet" href="<?= base_url('bootstrap/css/navbar.css') ?>" />
  <link rel="stylesheet" href="<?= base_url('bootstrap/css/employerviewprofiles.css') ?>" />

  <!-- For the Font Library -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;300&family=Raleway:wght@300&display=swap" rel="stylesheet">

  <!-- Scripts for Navbar -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/jquery.min.js"></script>



  <title>Future Seekers.lk | Admin Portal</title>

  <style>
    .card-counter {
      box-shadow: 2px 2px 10px #DADADA;
      margin: 5px;
      padding: 20px 10px;
      background-color: #fff;
      height: 100px;
      border-radius: 5px;
      transition: .3s linear all;
    }

    .card-counter:hover {
      box-shadow: 4px 4px 20px #DADADA;
      transition: .3s linear all;
    }

    .card-counter.primary {
      background-color: #007bff;
      color: #FFF;
    }

    .card-counter.danger {
      background-color: #ef5350;
      color: #FFF;
    }

    .card-counter.success {
      background-color: #66bb6a;
      color: #FFF;
    }

    .card-counter.info {
      background-color: #26c6da;
      color: #FFF;
    }

    .card-counter i {
      font-size: 5em;
      opacity: 0.2;
    }

    .card-counter .count-numbers {
      position: absolute;
      right: 35px;
      top: 20px;
      font-size: 32px;
      display: block;
    }

    .card-counter .count-name {
      position: absolute;
      right: 35px;
      top: 65px;
      font-style: italic;
      text-transform: capitalize;
      opacity: 0.5;
      display: block;
      font-size: 18px;
    }
  </style>
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
              <a class="nav-link" href="#">Dashboard </a>
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
      <h3> Dashboard </h3>
    </div>

    <div class="d-flex flex-row ml-4 mt-4 mr-4 ">

      <div class="card shadow-lg p-3 mb-3 bg-white rounded mr-5" style="border-radius: 20px !important;">
        <div class="card-header bg-primary d-flex flex-row align-items-center" style="color: white; border-radius: 20px !important">
          <div class="mr-auto"> Applicants Registered </div>
        </div>
        <div class="card-body pt-3 pb-2">
          <div class="card-text" id="applicant_total"></div>
          <div class="card-text" id="applicant_accept"></div>
          <div class="card-text" id="applicant_reject"></div>
          <div class="card-text" id="applicant_other"></div>
        </div>
      </div>

      <div class="card shadow-lg p-3 mb-3 bg-white rounded mr-5" style="border-radius: 20px !important;">
        <div class="card-header bg-primary d-flex flex-row align-items-center" style="color: white; border-radius: 20px !important">
          <div class="mr-auto"> Companies Registered </div>
        </div>
        <div class="card-body pt-3 pb-2">
          <div class="card-text" id="comp_total"></div>
          <div class="card-text" id="comp_accept"></div>
          <div class="card-text" id="comp_reject"></div>
          <div class="card-text" id="comp_other"></div>
        </div>
      </div>

      <div class="card shadow-lg p-3 mb-3 bg-white rounded mr-5" style="border-radius: 20px !important;">
        <div class="card-header bg-primary d-flex flex-row align-items-center" style="color: white; border-radius: 20px !important">
          <div class="mr-auto"> Advertisements Posted </div>
        </div>
        <div class="card-body pt-3 pb-2">
          <div class="card-text" id="ad_total"></div>
          <div class="card-text" id="ad_accept"></div>
          <div class="card-text" id="ad_reject"></div>
          <div class="card-text" id="ad_other"></div>
        </div>
      </div>

      <div class="card shadow-lg p-3 mb-3 bg-white rounded mr-5" style="border-radius: 20px !important;">
        <div class="card-header bg-primary d-flex flex-row align-items-center" style="color: white; border-radius: 20px !important">
          <div class="mr-auto"> Interviews Conducted </div>
        </div>
        <div class="card-body pt-3 pb-2">
          <div class="card-text" id="interview_total"></div>

        </div>
      </div>



    </div>


    <div class="d-flex flex-row">
      <div class="card shadow bg-white rounded m-4" style="width: 100%;">
        <div class="card-header bg-primary d-flex flex-row align-items-center" style="color: white;">
          <div class="mr-auto"> Top Applicants Interaction </div>
        </div>
        <div id="loading_top_applicants" class="loader p-4">
          <div class="loader-wheel"></div>
        </div>
        <div id="top_applicants"></div>
      </div>

      <div class="card shadow bg-white rounded m-4" style="width: 100%;">
        <div class="card-header bg-primary d-flex flex-row align-items-center" style="color: white;">
          <div class="mr-auto"> Top Companies Interaction </div>
        </div>
        <div id="loading_top_companies" class="loader p-4">
          <div class="loader-wheel"></div>
        </div>
        <div id="top_companies"></div>
      </div>
      <!-- <div class="p-2" style="width: 60%;">Flex item 2</div> -->
    </div>

    <div class="d-flex flex-row">
      <div class="card shadow bg-white rounded m-4" style="width: 100%;">
        <div class="card-header bg-primary d-flex flex-row align-items-center" style="color: white;">
          <div class="mr-auto"> Interviews Conducted by Companies </div>
        </div>

        <div class="table-responsive p-4">
          <div id="loading_interview_tbl" class="loader">
            <div class="loader-wheel"></div>
          </div>
          <table class="table table-hover shadow bg-white rounded" id="test_tbl">
            <thead class="thead-dark">
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Company Name</th>
                <th scope="col">Interviews Conducted</th>
              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>
        </div>
      </div>

      <div class="card shadow bg-white rounded m-4" style="width: 100%;">
        <div class="card-header bg-primary d-flex flex-row align-items-center" style="color: white;">
          <div class="mr-auto "> Applicants Age Data </div>
        </div>
        <div id="loading_age_data" class="loader p-4">
          <div class="loader-wheel"></div>
        </div>
        <div id="applicant_age_data" class="mt-auto mb-auto"></div>
      </div>
      <!-- <div class="p-2" style="width: 60%;">Flex item 2</div> -->
    </div>

    <div class="d-flex flex-row">
      <div class="card shadow bg-white rounded m-4" style="width: 100%;">
        <div class="card-header bg-primary d-flex flex-row align-items-center" style="color: white;">
          <div class="mr-auto"> Most Viewed Job Advertisements </div>
        </div>
        <div id="loading_top_jobs" class="loader p-4">
          <div class="loader-wheel"></div>
        </div>
        <div id="top_jobs"></div>
      </div>

    </div>

  </div>

</body>

</html>