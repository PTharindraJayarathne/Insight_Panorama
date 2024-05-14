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
        // google.charts.setOnLoadCallback(drawChart);
        google.charts.setOnLoadCallback(GenerateMostPreferredJobCategoryReport);
        // google.charts.setOnLoadCallback(GenerateMostAppliedJobAdvertReport);
        google.charts.setOnLoadCallback(GetTiledReports);
        // google.charts.setOnLoadCallback(GenerateMostSharedJobs);
        google.charts.setOnLoadCallback(GenerateCategoryVsPostings);

        window.onload = function() {
            GenerateMostAppliedJobAdvertReport("Lifetime");
            GenerateMostSharedJobs("Lifetime");
        };


        function GenerateMostAppliedJobAdvertReport($selected_option) {
            $.ajax({
                url: '<?php echo base_url('MyJobsEmployer/GenerateMostAppliedJobAdvertReport'); ?>',
                type: "post",
                data: {
                    selected_val: $selected_option,
                },
                dataType: 'json',
                beforeSend: function() {
                    $('#loading_most_applied').show();
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
                        legend: {
                            position: "none"
                        },
                        // title: "Most Applied Job Adverts",
                        // width: 900,
                        height: 400,
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
                    if (result.length > 0) {
                        document.getElementById('most_applied').innerHTML = "";
                        var chart = new google.visualization.ColumnChart(document.getElementById('most_applied'));
                        chart.draw(gdata, options);
                    } else {
                        document.getElementById('most_applied').innerHTML = "No data"
                    }

                },
                complete: function() {
                    $('#loading_most_applied').hide();
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
                    $('#loading_most_preferred').show();
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
                    var chart = new google.visualization.PieChart(document.getElementById('most_preferred_jobs'));
                    chart.draw(gdata, options);
                },
                complete: function() {
                    $('#loading_most_preferred').hide();
                }

            });
        }


        function GenerateCategoryVsPostings() {
            $.ajax({
                url: '<?php echo base_url('MyJobsEmployer/JobPostingsVsCategory'); ?>',
                type: "post",
                dataType: 'json',
                beforeSend: function() {
                    $('#loading_cat_posting').show();
                },
                success: function(result) {

                    var gdata = new google.visualization.DataTable();
                    gdata.addColumn('string', 'Job Category');
                    gdata.addColumn('number', 'No of Applications');

                    $.each(result, function(index, value) {
                        gdata.addRow([String(value.category), Number(value.postings)]);
                    });

                    // Set chart options
                    var options = {
                        pieHole: 0.3,
                        // title: "Most Preferred Job Category",
                        width: 600,
                        height: 300,
                        bar: {
                            groupWidth: "40%"
                        },
                        // is3D: true, //Pie Charts
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
                    var chart = new google.visualization.PieChart(document.getElementById('cat_vs_postings'));
                    chart.draw(gdata, options);
                },
                complete: function() {
                    $('#loading_cat_posting').hide();
                }

            });
        }

        function GenerateMostAppliedToolTip(title, applicantCount, category, location) {
            return "<div class='p-2'><b>" + title + "</b>" + "<br> Applicants: <b>" + applicantCount + "</b><p> Category: <b>" + category + "</b><br>" + " Location: <b>" + location + "</b> </div>"
        }

        function GenerateMostSharedJobs($selected_value) {
            $.ajax({
                url: '<?php echo base_url('MyJobsEmployer/GenerateMostSharedJobAdverts'); ?>',
                type: "post",
                data: {
                    selected_val: $selected_value,
                },
                dataType: 'json',
                beforeSend: function() {
                    $('#loading_most_shared').hide();
                },
                success: function(result) {

                    var gdata = new google.visualization.DataTable();
                    gdata.addColumn('string', 'Job Category');
                    gdata.addColumn('number', 'No of Shares');

                    $.each(result, function(index, value) {
                        gdata.addRow([String(value.title), Number(value.applicantCount)]);
                    });

                    // Set chart options
                    var options = {
                        legend: {
                            position: "none"
                        },
                        // title: "Most Preferred Job Category",
                        // width: 1200,
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
                            title: "Job Title"
                        }, //Bar of Pie Charts
                        hAxis: {
                            format: '0',
                            title: "No. of Shares"
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
                        document.getElementById('most_shared_jobs').innerHTML = "";
                        var chart = new google.visualization.ColumnChart(document.getElementById('most_shared_jobs'));
                        chart.draw(gdata, options);
                    } else {
                        document.getElementById('most_shared_jobs').innerHTML = "No data";
                    }

                },
                complete: function() {
                    $('#loading_most_shared').hide();
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
                    var posts = result['noOfPosts'];
                    var applicantsApplied = result['noOfApplicantsApplied'];
                    var shortlistedApplicants = result['noOfShortlisted'];
                    var shared = result['sharedAdverts'];

                    document.getElementById("jobPostings").innerHTML = posts;
                    document.getElementById("applicantsApplied").innerHTML = applicantsApplied;
                    document.getElementById("shortlistedApplicants").innerHTML = shortlistedApplicants;
                    document.getElementById("sharedAdverts").innerHTML = shared;

                },
                complete: function() {

                }

            });
        }
    </script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" name="My Report Page for the employer to view and genrate real time reports">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url('bootstrap/css/bootstrap.min.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('bootstrap/css/applicant_home.css') ?>" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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
    <script src="https://code.jquery.com/jquery.min.js"></script>
    <title>Future Seekers.lk | My Reports</title>

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

    <div class="card">
        <div class="card-header">
            <h3> Dashboard </h3>
        </div>


        <div class=" flex-d flex-row justify-content-between ml-5 mr-5 mt-4">
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card-counter primary">
                        <i class="fa fa-code-fork"></i>
                        <span class="count-numbers" id="jobPostings"></span>
                        <span class="count-name">Job Postings</span>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card-counter danger">
                        <i class="fa fa-ticket"></i>
                        <span class="count-numbers" id="applicantsApplied"></span>
                        <span class="count-name">Applicants Applied</span>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card-counter success">
                        <i class="fa fa-database"></i>
                        <span class="count-numbers" id="shortlistedApplicants"></span>
                        <span class="count-name">Shortlisted Applicants</span>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card-counter info">
                        <i class="fa fa-users"></i>
                        <span class="count-numbers" id="sharedAdverts"></span>
                        <span class="count-name">Adverts Shared</span>
                    </div>
                </div>
            </div>

            <div class="row mb-4">
                <br>
                <div class="d-flex flex-row">

                    <div class="card mr-4 shadow bg-white rounded" style="width: 100%; height:500px;">
                        <div class="card-header bg-primary d-flex flex-row align-items-center" style="color: white;">
                            <div class="mr-auto"> Most Applied Job Adverts </div>
                            <select onchange="GenerateMostAppliedJobAdvertReport(this.value)" name="most_applied_filter" id="most_applied_filter" class="form-select form-control-sm form-select-lg col-md-3" style="font-size:15px !important" value="<?= set_value('most_applied_filter'); ?>">
                                <option value="Lifetime"> Lifetime</option>
                                <option value="Previous Month"> Previous Month </option>
                            </select>
                        </div>
                        <div class="card-body">
                            <div id="loading_most_applied" class="loader">
                                <div class="loader-wheel"></div>
                                <div>Building Chart...</div>
                            </div>
                            <div id="most_applied"></div>
                        </div>
                    </div>
                    <div class="card shadow bg-white rounded" style="width: 100%; height:500px">
                        <div class="card-header bg-primary d-flex flex-row align-items-center" style="color: white;">
                            <div class="mr-auto"> Most Shared Job Adverts </div>
                            <select onchange="GenerateMostSharedJobs(this.value)" name="most_shared_filter" id="most_shared_filter" class="form-select form-control-sm form-select-lg col-md-3" style="font-size:15px !important" value="<?= set_value('most_shared_filter'); ?>">
                                <option value="Lifetime"> Lifetime</option>
                                <option value="Previous Month"> Previous Month </option>

                            </select>
                        </div>
                        <div class="card-body">
                            <div id="loading_most_shared" class="loader">
                                <div class="loader-wheel"></div>
                                <div>Building Chart...</div>
                            </div>
                            <div id="most_shared_jobs"></div>
                        </div>
                    </div>

                </div>
                <br>


            </div>

            <div class="row mb-4">
                <br>
                <div class="d-flex flex-row">
                    <div class="card mr-4 shadow bg-white rounded" style="width: 50%; height:400px;">
                        <div class="card-header bg-primary" style="color: white;">
                            Most Preferred Job Category
                        </div>
                        <div class="card-body">
                            <div id="loading_most_preferred" class="loader">
                                <div class="loader-wheel"></div>
                                <div>Building Chart...</div>
                            </div>
                            <div id="most_preferred_jobs"></div>
                        </div>
                    </div>

                    <div class="card shadow bg-white rounded" style="width: 50%; height:400px">
                        <div class="card-header bg-primary" style="color: white;">
                            Job Category Vs Job Postings
                        </div>
                        <div class="card-body">
                            <div id="loading_cat_posting" class="loader">
                                <div class="loader-wheel"></div>
                                <div>Building Chart...</div>
                            </div>
                            <div id="cat_vs_postings"></div>
                        </div>
                    </div>




                </div>
                <br>


            </div>

        </div>


    </div>

</body>

</html>