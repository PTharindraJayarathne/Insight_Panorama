<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" name="This is the applicant portal page of FutureSeekers.lk, Applicant can use this page to view and edit their profile, view job adverts and apply for  jobs here">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url('bootstrap/css/bootstrap.min.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('bootstrap/css/applicant_home.css') ?>" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- CSS stylesheet for navigation bar -->
    <link rel="stylesheet" href="<?= base_url('bootstrap/css/navbar.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('bootstrap/css/register_employerStyles.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('bootstrap/css/employerviewprofiles.css') ?>" />

    <!-- For the Font Library -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;300&family=Raleway:wght@300&display=swap" rel="stylesheet">

    <!-- Scripts for Navbar -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="<?= base_url('bootstrap/js/modalstuff.js') ?>"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
    <!-- <script src="https://code.jquery.com/jquery.min.js"></script> -->
    <!--Styles for dropdown with search-->
    <link rel="stylesheet" href="<?= base_url('bootstrap/css/select2-bootstrap.css') ?>" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!--Scripts for dropdown with search-->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <title>Future Seekers.lk | Applicant Portal</title>

    <style>

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
                            <a class="nav-link" href="<?php echo site_url('ApplicantHome/index') ?>">Home </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo site_url('MyInbox/index') ?>">My Inbox</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo site_url('MyProfileApplicant/index') ?>">My Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="">About Us</a>
                        </li>
                        <!-- Enter PHP code to check if the user is logged in or not in order to show login button -->
                        <!-- <li class="nav-item">
                            <a class="nav-link btn btn btn-primary logoutbtn" href="#">Sign in / Register</a>
                        </li> -->
                        <li class="nav-item">
                            <!-- For blue button: btn btn-primary -->
                            <a class="nav-link btn btn-danger logoutbtn" href="<?php echo site_url('Home/logout') ?>">Log out</a>
                        </li>
                        <!-- <li class="nav-item mobile_logout">
                            <a class="nav-link mobileloginbtn" href="#">Sign in / Register</a>
                        </li>      -->
                        <li class="nav-item mobile_logout">
                            <a class="nav-link mobilelogoutbtn" href="<?php echo site_url('Home/logout') ?>">Log out</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
    <br />
    <!-- <h2 class="card-header">New Job Advertisements</h2> -->

    <div style="margin-top:35px; width:1200px; margin-left: auto; margin-right: auto; display: none;" id="failMsgFlash" class="alert alert-danger text-muted"> You have already Applied for this Job </div>

    <div style="margin-top:35px; max-width:1200px; margin-left: auto; margin-right: auto; display: none;" class="alert alert-success text-muted" id="successMsgFlash"> <?= session()->getFlashdata('success'); ?> Successfully Applied </div>
    <div class="shadow-lg mb-5 bg-white rounded card" style="margin-left:auto;margin-right:auto; width:1200px">
        <div class="card-header bg-primary" style="color:white">
            Job Adverts
        </div>
        <form action="<?php echo site_url('/ApplicantHome/index') ?>" method="POST">
            <div class="card ml-4 mr-4 mt-4">
                <div class="card">
                    <h6 class="card-header">
                        Search your dream Job!
                    </h6>
                    <div class="card-body">
                        <div class="input-group">
                            <input name="search_input" type="search" class="form-control rounded" placeholder="Search for a Job Position" aria-label="Search" aria-describedby="search-addon" value="<?= set_value('search_input'); ?>" />

                            <button type="submit" class="btn btn-outline-primary">Search</button>

                        </div>

                        <a href="#" class="btn btn-primary btn-sm collapsed mt-3" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">Advanced Search</a>
                        <a href="<?php echo site_url('/ApplicantHome/index') ?>" class="btn btn-danger btn-sm collapsed mt-3 ml-2">Clear Filters</a>
                        <span class="badge badge-primary float-right mt-3"> <?php echo count($jobRecords) ?> Jobs Found </span>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                            <div class="card-body mt-3 p-0">



                                <div class="form-row">
                                    <div class="form-group col-md-4 m-0">
                                        <label>Company</label>
                                        <input class="form-control form-control-sm" type="text" id="company" name="company" value="<?= set_value('company'); ?>">
                                        <small class="form-text text-danger"><?= isset($validation) ? show_validation_error($validation, 'company') : '' ?></small>
                                    </div>
                                    <div class="form-group col-md-4 m-0">
                                        <label for="experience">Experience in the Field:</label>
                                        <select name="experience" id="experience" class="form-select form-control-sm form-select-lg mb-3" style="font-size:15px !important" value="<?= set_value('experience'); ?>">
                                            <option value="Select All">Select All</option>
                                            <option value="Below 2 years" <?php echo set_select('experience', 'Below 2 years', (!empty($data) && $data == "Below 2 years" ? TRUE : FALSE)); ?>>Below 2 years</option>
                                            <option value="2+ years" <?php echo set_select('experience', '2+ years', (!empty($data) && $data == "2+ years" ? TRUE : FALSE)); ?>>2+ years</option>
                                            <option value="5+ years" <?php echo set_select('experience', '5+ years', (!empty($data) && $data == "5+ years" ? TRUE : FALSE)); ?>>5+ years</option>
                                            <option value="10+ years" <?php echo set_select('experience', '10+ years', (!empty($data) && $data == "10+ years" ? TRUE : FALSE)); ?>>10+ years</option>

                                        </select>
                                    </div>

                                </div>


                                <div class="form-row">

                                    <div class="form-group col-md-4 m-0">
                                        <label>Min Salary</label>
                                        <input class="form-control form-control-sm" type="number" name="minsalary" id="minsalary" value="<?= set_value('minsalary'); ?>">
                                        <small class="form-text text-danger"><?= isset($validation) ? show_validation_error($validation, 'minsalary') : '' ?></small>
                                    </div>

                                    <div class="form-group col-md-4 m-0">
                                        <label>Max Salary</label>
                                        <input class="form-control form-control-sm" type="number" name="maxsalary" id="maxsalary" value="<?= set_value('maxsalary'); ?>">
                                        <small class="form-text text-danger"><?= isset($validation) ? show_validation_error($validation, 'maxsalary') : '' ?></small>
                                    </div>

                                </div>

                                <div class="form-row">

                                    <div class="form-group col-md-4 mt-2">
                                        <label>Job Category</label>
                                        <select style="width: 100%;" name="jobCategory" id="getCategory" value="<?= set_value('jobCategory'); ?>">
                                            <option value="Select All">Select All</option>
                                            <option value="IT" <?php echo set_select('jobCategory', 'IT', (!empty($data) && $data == "IT" ? TRUE : FALSE)); ?>>IT</option>
                                            <option value="Management" <?php echo set_select('jobCategory', 'Management', (!empty($data) && $data == "Management" ? TRUE : FALSE)); ?>>Management</option>
                                            <option value="Healthcare" <?php echo set_select('jobCategory', 'Healthcare', (!empty($data) && $data == "Healthcare" ? TRUE : FALSE)); ?>>Healthcare</option>
                                            <option value="Law" <?php echo set_select('jobCategory', 'Law', (!empty($data) && $data == "Law" ? TRUE : FALSE)); ?>>Law</option>
                                            <option value="Agriculture" <?php echo set_select('jobCategory', 'Agriculture', (!empty($data) && $data == "Agriculture" ? TRUE : FALSE)); ?>>Agriculture</option>
                                            <option value="Accounting" <?php echo set_select('jobCategory', 'Accounting', (!empty($data) && $data == "Accounting" ? TRUE : FALSE)); ?>>Accounting</option>
                                            <option value="Media" <?php echo set_select('jobCategory', 'Media', (!empty($data) && $data == "Media" ? TRUE : FALSE)); ?>>Media</option>
                                            <option value="Security" <?php echo set_select('jobCategory', 'Security', (!empty($data) && $data == "Security" ? TRUE : FALSE)); ?>>Security</option>
                                            <option value="Banking" <?php echo set_select('jobCategory', 'Banking', (!empty($data) && $data == "Banking" ? TRUE : FALSE)); ?>>Banking</option>
                                            <option value="Clothing" <?php echo set_select('jobCategory', 'Clothing', (!empty($data) && $data == "ClothingT" ? TRUE : FALSE)); ?>>Clothing</option>
                                            <option value="Marketing" <?php echo set_select('jobCategory', 'Marketing', (!empty($data) && $data == "Marketing" ? TRUE : FALSE)); ?>>Marketing</option>
                                            <option value="Tourism" <?php echo set_select('jobCategory', 'Tourism', (!empty($data) && $data == "Tourism" ? TRUE : FALSE)); ?>>Tourism</option>
                                            <option value="HR" <?php echo set_select('jobCategory', 'HR', (!empty($data) && $data == "HR" ? TRUE : FALSE)); ?>>HR</option>
                                            <option value="Logistics" <?php echo set_select('jobCategory', 'Logistics', (!empty($data) && $data == "Logistics" ? TRUE : FALSE)); ?>>Logistics</option>
                                            <option value="Sports" <?php echo set_select('jobCategory', 'Sports', (!empty($data) && $data == "Sports" ? TRUE : FALSE)); ?>>Sports</option>
                                            <option value="Academic" <?php echo set_select('jobCategory', 'Academic', (!empty($data) && $data == "Academic" ? TRUE : FALSE)); ?>>Academic</option>
                                        </select>
                                        <small class="form-text text-danger"><?= isset($validation) ? show_validation_error($validation, 'jobCategory') : '' ?></small>
                                    </div>




                                    <div class="form-group col-md-4  mt-2">
                                        <label>Job Location</label>
                                        <!-- <input class="form-control" type="text" name="jobCategory" value="<?= set_value('jobCategory'); ?>"> -->
                                        <select style="width:100%" name="jobLocation" id="getLocation" value="<?= set_value('jobLocation'); ?>">
                                            <option value="Select All">Select All</option>
                                            <option value="Jaffna" <?php echo set_select('jobLocation', 'Jaffna', (!empty($data) && $data == "Jaffna" ? TRUE : FALSE)); ?>>Jaffna</option>
                                            <option value="Kilinochchi" <?php echo set_select('jobLocation', 'Kilinochchi', (!empty($data) && $data == "Kilinochchi" ? TRUE : FALSE)); ?>>Kilinochchi</option>
                                            <option value="Mannar" <?php echo set_select('jobLocation', 'Mannar', (!empty($data) && $data == "Mannar" ? TRUE : FALSE)); ?>>Mannar</option>
                                            <option value="Mullaitivu" <?php echo set_select('jobLocation', 'Mullaitivu', (!empty($data) && $data == "Mullaitivu" ? TRUE : FALSE)); ?>>Mullaitivu</option>
                                            <option value="Vavuniya" <?php echo set_select('jobLocation', 'Vavuniya', (!empty($data) && $data == "Vavuniya" ? TRUE : FALSE)); ?>>Vavuniya</option>
                                            <option value="Puttalam" <?php echo set_select('jobLocation', 'Puttalam', (!empty($data) && $data == "Puttalam" ? TRUE : FALSE)); ?>>Puttalam</option>
                                            <option value="Kurunegala" <?php echo set_select('jobLocation', 'Kurunegala', (!empty($data) && $data == "Kurunegala" ? TRUE : FALSE)); ?>>Kurunegala</option>
                                            <option value="Gampaha" <?php echo set_select('jobLocation', 'Gampaha', (!empty($data) && $data == "Gampaha" ? TRUE : FALSE)); ?>>Gampaha</option>
                                            <option value="Colombo" <?php echo set_select('jobLocation', 'Colombo', (!empty($data) && $data == "Colombo" ? TRUE : FALSE)); ?>>Colombo</option>
                                            <option value="Kalutara" <?php echo set_select('jobLocation', 'Kalutara', (!empty($data) && $data == "Kalutara" ? TRUE : FALSE)); ?>>Kalutara</option>
                                            <option value="Anuradhapura" <?php echo set_select('jobLocation', 'Anuradhapura', (!empty($data) && $data == "Anuradhapura" ? TRUE : FALSE)); ?>>Anuradhapura</option>
                                            <option value="Polonnaruwa" <?php echo set_select('jobLocation', 'Polonnaruwa', (!empty($data) && $data == "Polonnaruwa" ? TRUE : FALSE)); ?>>Polonnaruwa</option>
                                            <option value="Matale" <?php echo set_select('jobLocation', 'Matale', (!empty($data) && $data == "Matale" ? TRUE : FALSE)); ?>>Matale</option>
                                            <option value="Kandy" <?php echo set_select('jobLocation', 'Kandy', (!empty($data) && $data == "Kandy" ? TRUE : FALSE)); ?>>Kandy</option>
                                            <option value=" Nuwara Eliya" <?php echo set_select('jobLocation', 'Nuwara Eliya', (!empty($data) && $data == "Nuwara Eliya" ? TRUE : FALSE)); ?>> Nuwara Eliya </option>
                                            <option value="Kegalle" <?php echo set_select('jobLocation', 'Kegalle', (!empty($data) && $data == "Kegalle" ? TRUE : FALSE)); ?>>Kegalle</option>
                                            <option value="Ratnapura" <?php echo set_select('jobLocation', 'Ratnapura', (!empty($data) && $data == "Ratnapura" ? TRUE : FALSE)); ?>>Ratnapura</option>
                                            <option value="Trincomalee" <?php echo set_select('jobLocation', 'Trincomalee', (!empty($data) && $data == "Trincomalee" ? TRUE : FALSE)); ?>>Trincomalee</option>
                                            <option value="Batticaloa" <?php echo set_select('jobLocation', 'Batticaloa', (!empty($data) && $data == "Batticaloa" ? TRUE : FALSE)); ?>>Batticaloa</option>
                                            <option value="Ampara" <?php echo set_select('jobLocation', 'Ampara', (!empty($data) && $data == "Ampara" ? TRUE : FALSE)); ?>>Ampara</option>
                                            <option value=" Badulla	Uva" <?php echo set_select('jobLocation', 'Badulla	Uva', (!empty($data) && $data == "Badulla	Uva" ? TRUE : FALSE)); ?>> Badulla Uva</option>
                                            <option value="Monaragala" <?php echo set_select('jobLocation', 'Monaragala', (!empty($data) && $data == "Monaragala" ? TRUE : FALSE)); ?>>Monaragala</option>
                                            <option value="Hambantota" <?php echo set_select('jobLocation', 'Hambantota', (!empty($data) && $data == "Hambantota" ? TRUE : FALSE)); ?>>Hambantota</option>
                                            <option value="Matara" <?php echo set_select('jobLocation', 'Matara', (!empty($data) && $data == "Matara" ? TRUE : FALSE)); ?>>Matara</option>
                                            <option value="Galle" <?php echo set_select('jobLocation', 'Galle', (!empty($data) && $data == "Galle" ? TRUE : FALSE)); ?>>Galle</option>
                                        </select>
                                        <small class="form-text text-danger"><?= isset($validation) ? show_validation_error($validation, 'jobLocation') : '' ?></small>
                                    </div>

                                </div>

                            </div>

                            <button type="submit" class="btn btn-success btn-sm mt-3">Apply Filter</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>



        <div class="card ml-4 mr-4 mt-4">
            <div class="card">
                <h6 class="card-header">

                    <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#collapseRecommendations" aria-expanded="false" aria-controls="collapseRecommendations">
                        Jobs that may interest you <span class="badge badge-light"> <?= count($recommendedJobRecords) ?></span>
                    </button>
                </h6>
                <div class="card-body bg-light">

                    <div id="collapseRecommendations" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                        <div class="card-body p-0">

                            <?php
                            if (count($recommendedJobRecords) <= 0) {
                            ?>
                                You have no recommendations
                            <?php
                            } else {
                            ?>
                                <?php
                                for ($i = 0; $i < count($recommendedJobRecords); $i++) {
                                ?>

                                    <div class="card-body" style="padding-left: 0px !important; padding-right: 0px; padding-bottom: 5px !important">

                                        <div class="ratt">
                                            <div class="jobs_img_container" style="width: 100px">
                                                <?php echo " <img class=\"jobs_img\" src='" . base_url() . "/logo/" . $recommendedJobRecords[$i]["logo"] . "'>" ?>
                                            </div>


                                            <div style="flex-grow: 8">

                                                <div style="border: none !important" class="list-group-item flex-column align-items-start">

                                                    <div class="d-flex w-100 justify-content-start">

                                                        <h5 class="mb-1"> <?= $recommendedJobRecords[$i]['jobtitle'] ?> </h5>

                                                        <a class="ml-3" href="#" data-toggle="modal" data-target="#shareModal" data-whatever="@fat" onclick="ShareAdvertisement_OpenModal(<?= htmlentities(json_encode($recommendedJobRecords[$i])) ?>)"> <img src="<?= base_url('/images/share.png') ?>" style="height: 20px; width: 20px;"> </img> </a>
                                                    </div>

                                                    <p class="mb-1 company_name"> <?= $recommendedJobRecords[$i]['companyname'] ?> </p>

                                                    <div class="flex-container2" style="margin-top: 10px !important;">

                                                        <div class=" mb-1 cat_container badge badge-primary badge-pill">

                                                            <small> <?= $recommendedJobRecords[$i]['jobcategory'] ?> </small>

                                                        </div>

                                                        <div class=" mb-1 cat_container2 badge badge-light badge-pill border border-primary">
                                                            <div class="img_and_element_holder">
                                                                <span> <img class="span_img2" src="<?= base_url('/images/typeofemployment.webp') ?>"> </span> <small style="font-size:13px "> <?= $recommendedJobRecords[$i]['typeofemp'] ?> </small>
                                                            </div>
                                                        </div>
                                                        <div class=" mb-1 cat_container2 badge badge-light badge-pill border border-secondary">

                                                            <div class="img_and_element_holder">
                                                                <span> <img class="span_img2" src="<?= base_url('/images/clock_timer.webp') ?>"> </span> <small style="font-size:13px "> <?= $recommendedJobRecords[$i]['cdate'] ?> </small>
                                                            </div>
                                                        </div>
                                                        <div class=" mb-1 cat_container2 badge  badge-pill border border-secondary" style="background-color:#c9c8cf !important; color:black !important ">

                                                            <div class="img_and_element_holder">

                                                                <span> <img class="span_img2" src="<?= base_url('/images/performance.webp') ?>"> </span><small style="font-size:13px "> <?= $recommendedJobRecords[$i]['jobtime'] ?> </small>
                                                            </div>
                                                        </div>



                                                        <div class=" mb-1 cat_container2 badge badge-light badge-pill border border-secondary">
                                                            <div class="img_and_element_holder">
                                                                <?php echo " <a href='" . base_url() . "/ApplicantHome/downloadPdf/" . $recommendedJobRecords[$i]['pdfname'] . "'>" ?>
                                                                <span> <img class="span_img2" src="<?= base_url('/images/download.webp') ?>"> <small style="font-size:13px">Download Advert</small> </span>
                                                                </a>
                                                            </div>

                                                        </div>

                                                    </div>



                                                    <div class="flex-container2" style="margin-top: 10px !important;">

                                                        <div style="margin-right:20px !important">

                                                            <span> <img class="span_img" src="<?= base_url('/images/contact.webp') ?>"> </span> <small style="font-size: 14px"> <?= $recommendedJobRecords[$i]['companyno'] ?> </small>

                                                        </div>

                                                        <div style="margin-right:20px !important">

                                                            <span> <img class="span_img" src="<?= base_url('/images/email.webp') ?>"></span><small style="font-size: 14px"> <?= $recommendedJobRecords[$i]['companyemail'] ?> </small>

                                                        </div>
                                                        <div style="margin-right:20px !important">

                                                            <span> <img class="span_img" src="<?= base_url('/images/location.webp') ?>"> </span><small style="font-size: 14px"> <?= $recommendedJobRecords[$i]['joblocation'] ?> </small>

                                                        </div>


                                                    </div>



                                                </div>

                                            </div>



                                            <div style="width: 200px">



                                                <div class="job_option_holder">
                                                    <button class="btn btn-primary btn-sm" onclick="ApplyJob(<?= $recommendedJobRecords[$i]['jobid'] ?>)"> Apply Now</button>

                                                    <p></p>
                                                    <?php echo " <a class=\"btn btn-secondary btn-sm\" target='_blank' href='" . base_url() . "/adverts/" . $recommendedJobRecords[$i]['pdfname'] . "'> View Advert </a>" ?>
                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                <?php
                                }
                                ?>
                            <?php
                            }
                            ?>

                        </div>

                    </div>
                </div>
            </div>
        </div>




        <div class="card-body" style="padding-left: 0px !important; padding-right: 0px; padding-bottom: 5px !important;">

            <?php

            if (count($jobRecords) <= 0) {

            ?>

                <div style="margin-top:35px; max-width:400px !important; margin-left: auto; margin-right: auto; display: block; text-align: center;" id="failMsgFlash2" class="alert alert-danger text-muted"> No Jobs Available! </div>
            <?php
            }

            ?>

            <?php
            for ($i = 0; $i < count($jobRecords); $i++) {
            ?>

                <div class="card-body" style="padding-left: 0px !important; padding-right: 0px; padding-bottom: 5px !important;">

                    <div class="ratt ">
                        <div class="jobs_img_container" style="width: 100px">
                            <?php echo " <img class=\"jobs_img\" src='" . base_url() . "/logo/" . $jobRecords[$i]["logo"] . "'>" ?>
                        </div>


                        <div style="flex-grow: 8">

                            <div style="border: none !important" class="list-group-item flex-column align-items-start">

                                <div class="d-flex w-100 justify-content-start">

                                    <h5 class="mb-1"> <?= $jobRecords[$i]['jobtitle'] ?> </h5>

                                    <a class="ml-3" href="#" data-toggle="modal" data-target="#shareModal" data-whatever="@fat" onclick="ShareAdvertisement_OpenModal(<?= htmlentities(json_encode($jobRecords[$i])) ?>)"> <img src="<?= base_url('/images/share.png') ?>" style="height: 20px; width: 20px;"> </img> </a>
                                </div>

                                <p class="mb-1 company_name"> <?= $jobRecords[$i]['companyname'] ?> </p>

                                <div class="flex-container2" style="margin-top: 10px !important;">

                                    <div class=" mb-1 cat_container badge badge-primary badge-pill">

                                        <small> <?= $jobRecords[$i]['jobcategory'] ?> </small>

                                    </div>

                                    <div class=" mb-1 cat_container2 badge badge-light badge-pill border border-primary">
                                        <div class="img_and_element_holder">
                                            <span> <img class="span_img2" src="<?= base_url('/images/typeofemployment.webp') ?>"> </span> <small style="font-size:13px "> <?= $jobRecords[$i]['typeofemp'] ?> </small>
                                        </div>
                                    </div>
                                    <div class=" mb-1 cat_container2 badge badge-light badge-pill border border-secondary">

                                        <div class="img_and_element_holder">
                                            <span> <img class="span_img2" src="<?= base_url('/images/clock_timer.webp') ?>"> </span> <small style="font-size:13px "> <?= $jobRecords[$i]['cdate'] ?> </small>
                                        </div>
                                    </div>
                                    <div class=" mb-1 cat_container2 badge  badge-pill border border-secondary" style="background-color:#c9c8cf !important; color:black !important ">

                                        <div class="img_and_element_holder">

                                            <span> <img class="span_img2" src="<?= base_url('/images/performance.webp') ?>"> </span><small style="font-size:13px "> <?= $jobRecords[$i]['jobtime'] ?> </small>
                                        </div>
                                    </div>



                                    <div class=" mb-1 cat_container2 badge badge-light badge-pill border border-secondary">
                                        <div class="img_and_element_holder">
                                            <?php echo " <a href='" . base_url() . "/ApplicantHome/downloadPdf/" . $jobRecords[$i]['pdfname'] . "'>" ?>
                                            <span> <img class="span_img2" src="<?= base_url('/images/download.webp') ?>"> <small style="font-size:13px">Download Advert</small> </span>
                                            </a>
                                        </div>

                                    </div>

                                </div>



                                <div class="flex-container2" style="margin-top: 10px !important;">

                                    <div style="margin-right:20px !important">

                                        <span> <img class="span_img" src="<?= base_url('/images/contact.webp') ?>"> </span> <small style="font-size: 14px"> <?= $jobRecords[$i]['companyno'] ?> </small>

                                    </div>

                                    <div style="margin-right:20px !important">

                                        <span> <img class="span_img" src="<?= base_url('/images/email.webp') ?>"></span><small style="font-size: 14px"> <?= $jobRecords[$i]['companyemail'] ?> </small>

                                    </div>
                                    <div style="margin-right:20px !important">

                                        <span> <img class="span_img" src="<?= base_url('/images/location.webp') ?>"> </span><small style="font-size: 14px"> <?= $jobRecords[$i]['joblocation'] ?> </small>

                                    </div>


                                </div>



                            </div>

                        </div>



                        <div style="width: 200px">



                            <div class="job_option_holder">
                                <button class="btn btn-primary btn-sm" onclick="ApplyJob(<?= $jobRecords[$i]['jobid'] ?>)"> Apply Now</button>

                                <p></p>
                                <?php echo " <a class=\"btn btn-secondary btn-sm\" target='_blank' href='" . base_url() . "/adverts/" . $jobRecords[$i]['pdfname'] . "'> View Advert </a>" ?>
                            </div>

                        </div>

                    </div>

                </div>

            <?php
            }

            ?>

        </div>
        <div class="modal fade" id="shareModal" tabindex="-1" role="dialog" aria-labelledby="shareModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="shareModal">Share Advertisement</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="s_jobid" class="col-form-label">Job ID:</label>
                                <input id="s_jobid" type="text" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label for="recipientEmail" class="col-form-label">Recipient Email Address:</label>
                                <input id="recipientEmail" type="text" placeholder="e.g alexhunter@gmail.com" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="recipientNotes" class="col-form-label">Message:</label>
                                <textarea id="recipientNotes" class="form-control" placeholder="Optional"></textarea>
                            </div>
                        </form>
                    </div>
                    <div id="loading_sending_invite" class="loader d-none">
                        <div class="loader-wheel"></div>
                        <div class="loader-text"></div>
                    </div>
                    <div style=" max-width:1200px; margin-left: auto; margin-right: auto; display: none;" id="failMsgFlash2" class="alert alert-danger text-muted"> </div>
                    <div style=" max-width:1200px; margin-left: auto; margin-right: auto; display: none;" class="alert alert-success text-muted" id="successMsgFlash2"> <?= session()->getFlashdata('success'); ?> </div>
                    <div class="modal-footer">

                        <button id="closesharebtn" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button id="shareaddbtn" type="button" class="btn btn-primary" onclick="ShareAdvertisement()">Share Advertisement</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        $('#shareModal').on('hidden.bs.modal', function() {
            //remove the backdrop
            $('.modal-backdrop').remove();
        });

        function ShareAdvertisement_OpenModal(row) {
            document.getElementById("s_jobid").value = row["jobid"];
        }

        function ShareAdvertisement() {
            var jobID = document.getElementById("s_jobid").value;
            var recepientEmail = document.getElementById("recipientEmail").value;
            var notes = document.getElementById("recipientNotes").value;
            $.ajax({
                url: '<?php echo base_url('ApplicantHome/ShareJobAdvertisement'); ?>',
                type: "post",
                dataType: 'json',
                data: {
                    jobID: jobID,
                    recepientEmail: recepientEmail,
                    notes: notes
                },
                beforeSend: function() {
                    document.getElementById("shareaddbtn").style.display = "none";
                    document.getElementById("closesharebtn").style.display = "none";
                    document.getElementById("loading_sending_invite").classList.remove("d-none");
                    console.log('Loading');
                },
                success: function(result) {
                    document.getElementById("loading_sending_invite").classList.add("d-none");
                    $res = result.result;
                    if ($res == '1') {
                        document.getElementById("successMsgFlash2").style.display = "block";
                        document.getElementById("successMsgFlash2").innerHTML = "Advertisement Shared Successfully!";
                    } else {
                        document.getElementById("failMsgFlash2").style.display = "block";
                        document.getElementById("failMsgFlash2").innerHTML = "This Applicant does not exist in the system!";
                    }
                },
                complete: function() {
                    document.getElementById("loading_sending_invite").classList.add("d-none");
                    setTimeout(() => {
                        document.getElementById("shareaddbtn").style.display = "block";
                        document.getElementById("closesharebtn").style.display = "block";
                        $('#shareModal').modal('hide');
                        location.reload();
                    }, 3000);
                    // location.reload();
                    console.log('Completed');
                }

            });
        }

        function ApplyJob($jobid) {
            document.getElementById("successMsgFlash").style.display = "none";
            document.getElementById("failMsgFlash").style.display = "none";
            $.ajax({
                url: '<?php echo base_url('ApplicantHome/ApplyForJob'); ?>',
                type: "post",
                dataType: 'json',
                data: {
                    jobID: $jobid,
                },
                beforeSend: function() {

                    console.log('Loading');
                },
                success: function(result) {
                    $res = result.result;
                    if ($res == '1') {
                        document.getElementById("successMsgFlash").style.display = "block";
                        document.getElementById("successMsgFlash").innerHTML = "You have successfully applied for this job. The Employer will receive a notification shortly.";
                    } else if ($res == '2') {
                        document.getElementById("failMsgFlash").style.display = "block";
                        document.getElementById("failMsgFlash").innerHTML = "You have already applied for this position";
                    } else if ($res == '3') {
                        document.getElementById("failMsgFlash").style.display = "block";
                        document.getElementById("failMsgFlash").innerHTML = "Please update your profile details by providing your CV";
                    } else if ($res == '4') {
                        document.getElementById("failMsgFlash").style.display = "block";
                        document.getElementById("failMsgFlash").innerHTML = "Something went wrong. Please try again later..";
                    }
                    document.documentElement.scrollTop = 0;
                },
                complete: function() {
                    console.log('Completed');
                }
            });
        }



        // For Search Bar
        const searchFocus = document.getElementById('search-focus');
        const keys = [{
                keyCode: 'AltLeft',
                isTriggered: false
            },
            {
                keyCode: 'ControlLeft',
                isTriggered: false
            },
        ];

        window.addEventListener('keydown', (e) => {
            keys.forEach((obj) => {
                if (obj.keyCode === e.code) {
                    obj.isTriggered = true;
                }
            });

            const shortcutTriggered = keys.filter((obj) => obj.isTriggered).length === keys.length;

            if (shortcutTriggered) {
                searchFocus.focus();
            }
        });

        window.addEventListener('keyup', (e) => {
            keys.forEach((obj) => {
                if (obj.keyCode === e.code) {
                    obj.isTriggered = false;
                }
            });
        });
    </script>
    <script src="<?= base_url('bootstrap/js/postadvert.js') ?>"></script>
</body>

</html>