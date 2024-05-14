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
    <link rel="stylesheet" href="<?= base_url('bootstrap/css/employerviewprofiles.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('bootstrap/css/register_employerStyles.css') ?>" />

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
    <script src="https://code.jquery.com/jquery.min.js"></script>
    <!--Styles for dropdown with search-->
    <link rel="stylesheet" href="<?= base_url('bootstrap/css/select2-bootstrap.css') ?>" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!--Scripts for dropdown with search-->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <title>Future Seekers.lk | My Inbox</title>

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
                            <a class="nav-link" href="">My Inbox</a>
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
            Applied Jobs
        </div>
        <form action="<?php echo site_url('/ApplicantHome/index') ?>" method="POST">
            <div class="card ml-4 mr-4 mt-4">
                <div class="card">
                    <h6 class="card-header">
                        <button type="button" class="btn btn-success" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Notifications 
                            <span class="badge badge-light"> <?= count($sharedJobs['sharedJobs']) ?></span>
                        </button>
                    </h6>

                    <div class="card-body ">
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">

                            <?php
                            if (count($sharedJobs['sharedJobs']) <= 0) {
                                echo "You have no notifications available";
                            } else {

                                for ($i = 0; $i < count($sharedJobs['sharedJobs']); $i++) {
                                    if ($sharedJobs['sharedJobs'][$i]['status'] == 0) {

                            ?>
                                        <div class="p-2">
                                            <div class="d-flex flex-row align-items-center mb-1">
                                                <img class="mr-2" src="<?= base_url('/images/notification.png') ?>" style="width: 20px;">
                                                <a target='_blank' href="<?= base_url() . '/adverts/' . $sharedJobs['sharedJobs'][$i]['pdfname'] ?>">
                                                    <h5 class="card-title text-center mb-0" style="font-size: 1.1em;"> <b> <?= $sharedJobs['sharedJobs'][$i]['senderName'] ?> </b> has shared a Job Advertisement!</h5>
                                                </a>
                                                <!-- <img class="ml-2" src="<?= base_url('/images/close.png') ?>" style="width: 15px;"> -->
                                            </div>

                                            <p class="card-text company_name mb-1" style="font-size: 0.9em;"> <?= $sharedJobs['sharedJobs'][$i]['jobtitle'] ?> : <?= $sharedJobs['sharedJobs'][$i]['companyName'] ?></p>
                                            <button type="button" class="btn btn-primary btn-sm rounded-pill pl-3 pr-3" style="font-size: 0.7em;" onclick="ApplyJob(<?= $sharedJobs['sharedJobs'][$i]['advert_id'] ?>)"> Apply</button>
                                            <button type="button" class="btn btn-danger btn-sm rounded-pill pl-3 pr-3 ml-2" style="font-size: 0.7em;" onclick="RemoveNotification(<?= $sharedJobs['sharedJobs'][$i]['shared_id'] ?>)"> Remove</button>
                                        </div>
                                        <br>
                            <?php
                                    }
                                }
                                // var_dump($sharedJobs);
                            }
                            ?>



                        </div>
                    </div>
                </div>
            </div>
        </form>




        <div class="card-body" style="padding-left: 0px !important; padding-right: 0px; padding-bottom: 5px !important;">

            <?php

            if (count($jobRecords) <= 0) {

            ?>

                <div style="margin-top:35px; max-width:400px !important; margin-left: auto; margin-right: auto; display: block; text-align: center;" id="failMsgFlash2" class="alert alert-danger text-muted"> Looks Like you haven't Applied for any Jobs! </div>
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

                                <div class="d-flex w-100 justify-content-between">

                                    <h5 class="mb-1"> <?= $jobRecords[$i]['jobtitle'] ?> </h5>

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
                                <?php
                                if ($jobRecords[$i]['is_shortlisted'] == 'Yes') {
                                ?>
                                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#message<?php echo $jobRecords[$i]['jobid']; ?>"> View Invitation</button>
                                    <div id="message<?php echo $jobRecords[$i]['jobid']; ?>" class="modal fade" role="dialog">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">Interview Notice</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <h5> Congrats! </h5>
                                                    <?= $jobRecords[$i]['invitation'] ?>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>



                                <?php
                                if ($jobRecords[$i]['is_shortlisted'] == 'Yes') {
                                ?>
                                    <div class=" mb-1 mt-3 cat_container badge bg-success text-white badge-pill">
                                        <small> Status: Shortlisted </small>
                                    </div>
                                <?php
                                } else if ($jobRecords[$i]['is_shortlisted'] == 'No') {
                                ?>
                                    <div class=" mb-1 mt-3 cat_container badge bg-dark text-white badge-pill">
                                        <small> Status: Pending </small>
                                    </div>
                                <?php

                                }
                                ?>


                            </div>

                        </div>

                    </div>

                </div>

                <div id="invite_div" class="d-none">
                    <?php
                    echo $jobRecords[$i]['invitation'];
                    ?>


                </div>

            <?php
            }

            ?>

        </div>

    </div>





    <script>
        function RemoveNotification($share_id) {
            console.log("Shared id is " + $share_id);
            $.ajax({
                url: '<?php echo base_url('MyInbox/RemoveNotification'); ?>',
                type: "post",
                dataType: 'json',
                data: {
                    shareID: $share_id,
                },
                beforeSend: function() {

                    console.log('Loading');
                },
                success: function(result) {
                    location.reload();
                },
                complete: function() {
                    location.reload();
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