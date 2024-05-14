<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>InsightPanorama LK</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  
  
  
  <link href="<?= base_url('assets/img/apple-touch-icon.png') ?>" rel="apple-touch-icon">
  
 
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  
  <link href="<?= base_url('assets/vendor/aos/aos.css') ?>" rel="stylesheet">
  <link  href="<?= base_url('assets/vendor/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
  <link  href="<?= base_url('assets/vendor/bootstrap-icons/bootstrap-icons.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/vendor/boxicons/css/boxicons.min.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/vendor/glightbox/css/glightbox.min.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/vendor/swiper/swiper-bundle.min.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/css/landingpagestyle.css') ?>" rel="stylesheet">
  
 
</head>

<body>


    </div>
  </header>

 
  <section id="hero" class="d-flex align-items-center">
    <div class="container" data-aos="zoom-out" data-aos-delay="100">
      <h1>Welcome to <span>InsightPanorama</span></h1>
      <h2>We help you with all your career needs</h2>
      <div class="d-flex">
        <a href="<?= site_url('Home/index') ?>" class="btn-get-started scrollto">Get Started</a>
      </div>
    </div>
  </section>
  <main id="main">

   
    <section id="featured-services" class="featured-services">
      <div class="container" data-aos="fade-up">

        <div class="row">
          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
              <div class="icon"><i class="bx bxl-dribbble"></i></div>
              <h4 class="title"><a href="">Easy to use</a></h4>
              <p class="description">InsightPanorama website is easy to use and you can always contact us to solve your problems</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="200">
              <div class="icon"><i class="bx bx-file"></i></div>
              <h4 class="title"><a href="">Safe and Reliable</a></h4>
              <p class="description">All your data will be safe and secure with us</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="300">
              <div class="icon"><i class="bx bx-tachometer"></i></div>
              <h4 class="title"><a href="">Fast</a></h4>
              <p class="description">InsightPanorama website will work 24/7 in a fast-paced manner.</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="400">
              <div class="icon"><i class="bx bx-world"></i></div>
              <h4 class="title"><a href="">Accessible Everywhere</a></h4>
              <p class="description">You can access the InsightPanorama website anytime, anywhere.</p>
            </div>
          </div>

        </div>

      </div>
    </section>
    <section id="about" class="about section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>About</h2>
          <h3>Find Out More <span>About Us</span></h3>
          <p>InsightPanorama is a job seeking website where you can view and apply for jobs in many companies.</p>
        </div>

        <div class="row">
          <div class="col-lg-6" data-aos="fade-right" data-aos-delay="100">
            <img src="<?= base_url('assets/img/about.jpg') ?>" class="img-fluid" alt="">
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0 content d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="100">
            <h3>Find out how InsightPanorama helps with finding your Dream Job.</h3>
            <p class="fst-italic">
            InsightPanorama has agreements with many companies where they will pay a subscription fee so they can post their advertisements. If 
              you want to post advertisements for your company.You can register now.
            </p>
            <ul>
              <li>
                <i class="bx bx-store-alt"></i>
                <div>
                  <h5>All your Job needs in one place</h5>
                  <p>Browse through hundreds of jobs from all over Sri Lanka</p>
                </div>
              </li>
              <li>
                <i class="bx bx-images"></i>
                <div>
                  <h5>Personalized for you</h5>
                  <p>You can use our personalization settings to find jobs in your favourite category</p>
                </div>
              </li>
            </ul>
            <p>
              Our staff is continuously working towards keeping a healthy environment in the site and bringing you quality job offers.
            </p>
          </div>
        </div>

      </div>
    </section>



    <section id="counts" class="counts">
      <div class="container" data-aos="fade-up">

        <div class="row">
          <?php 
          $UserAccount = new \App\Models\userAccountModel();
          $numberofemployees = 0;
          $query = $UserAccount->query("Select id from user_account where status = 1 and type = 'applicant'");
          foreach ($query->getResult() as $row) {
            $numberofemployees++;
          }
          echo  "<div class=\"col-lg-3 col-md-6\">
            <div class=\"count-box\">
              <i class=\"bi bi-emoji-smile\"></i>
         <span data-purecounter-start=\"0\" data-purecounter-end=$numberofemployees data-purecounter-duration=\"1\" class=\"purecounter\"></span>";
          ?>
              <p>Jobseekers</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 mt-5 mt-md-0">
            <div class="count-box">
              <?php
              $jobs = new \App\Models\jobDetailsModel();
              $numberofjobs = 0;
              $query2 = $jobs->query("Select id from job_details where status = 1");
              foreach ($query2->getResult() as $row2) {
                $numberofjobs++;
              }

        echo    "<i class=\"bi bi-journal-richtext\"></i>
              <span data-purecounter-start=\"0\" data-purecounter-end=$numberofjobs data-purecounter-duration=\"1\" class=\"purecounter\"></span>";
             ?>
              <p>Job Offers</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
            <div class="count-box">
              <i class="bi bi-headset"></i>
              <span data-purecounter-start="0" data-purecounter-end="24" data-purecounter-duration="1" class="purecounter"></span>
              <p>Hours Of Support</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
            <div class="count-box">
              <i class="bi bi-people"></i>
              <?php
              $employersM = new \App\Models\employerModel();
              $usersM = new \App\Models\userAccountModel();
              $companiesM = new \App\Models\companyModel();
              $companiesN = 0;
               $query3 = $usersM->query("Select * from user_account where status = 1 and type = 'employer'");
               foreach ($query3->getResult() as $row3){
                $uid = $row3->id;
                $query4 = $employersM->query("Select * from employer where user_account_id = $uid");
                foreach ($query4->getResult() as $row4){
                  $cid = $row4->company_id; 
                  $query5 = $companiesM->query("Select * from company where id = $cid");
                  foreach ($query5->getResult() as $row5){
                    $companiesN++;
                  }
                }
               }


          echo  "<span data-purecounter-start=\"0\" data-purecounter-end=$companiesN data-purecounter-duration=\"1\" class=\"purecounter\"></span>";
              ?>
              <p>Companies</p>
            </div>
          </div>

        </div>

      </div>
    </section>

    <section id="services" class="services">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Services</h2>
          <h3>Check our <span>Services</span></h3>
          <p>Ut possimus qui ut temporibus culpa velit eveniet modi omnis est adipisci expedita at voluptas atque vitae autem.</p>
        </div>

        <div class="row">
          <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
            <div class="icon-box">
              <div class="icon"><i class="bx bxl-dribbble"></i></div>
              <h4><a href="">Apply for Jobs</a></h4>
              <p>Browse through hundreds of jobs and apply for them</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="zoom-in" data-aos-delay="200">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-file"></i></div>
              <h4><a href="">Post Advertisements</a></h4>
              <p>Post Job adverts attract new employees for your company.</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0" data-aos="zoom-in" data-aos-delay="300">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-tachometer"></i></div>
              <h4><a href="">Keep you informed</a></h4>
              <p>You won't have to turn on website notofocations, we will contact you through your email to keep you informed.</p>
            </div>
          </div>


        </div>

      </div>
    </section>
    <section id="faq" class="faq section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>F.A.Q</h2>
          <h3>Frequently Asked <span>Questions</span></h3>
          <p>These are some of the frequently asked questions which our users have asked.</p>
        </div>

        <div class="row justify-content-center">
          <div class="col-xl-10">
            <ul class="faq-list">

              <li>
                <div data-bs-toggle="collapse" class="collapsed question" href="#faq1">Why can't i change my details after registering? <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
                <div id="faq1" class="collapse" data-bs-parent=".faq-list">
                  <p>
                    Our team is constantly trying to keep an healthy environment inside the website. You won't be able to edit your personal details until our team verifies your account.
                  </p>
                </div>
              </li>

              <li>
                <div data-bs-toggle="collapse" href="#faq2" class="collapsed question">How long does it take to verify my profile? <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
                <div id="faq2" class="collapse" data-bs-parent=".faq-list">
                  <p>
                    Your profile will be verified mostly within 1-3 hours. Maximum time for profile verification is 24 hours.
                  </p>
                </div>
              </li>

              <li>
                <div data-bs-toggle="collapse" href="#faq3" class="collapsed question">Why can't i log into my account? <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
                <div id="faq3" class="collapse" data-bs-parent=".faq-list">
                  <p>
                    If you are certain that your password is not wrong. Then the reason might be our team might have found suspicious activity
                    in your account and banned you.
                  </p>
                </div>
              </li>

              <li>
                <div data-bs-toggle="collapse" href="#faq4" class="collapsed question">Are my contact details shared with anyone?<i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
                <div id="faq4" class="collapse" data-bs-parent=".faq-list">
                  <p>
                    Your contact details and CV are shared with the employer if you applied for a job position.
                  </p>
                </div>
              </li>

              <li>
                <div data-bs-toggle="collapse" href="#faq5" class="collapsed question">Why didn't my job advertisement get published?<i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
                <div id="faq5" class="collapse" data-bs-parent=".faq-list">
                  <p>
                    If your advertisement had some invalid or wrong data when you submitted the form or if your advertisement pdf didn't have enough information. Your advertisement might get removed.
                  </p>
                </div>
              </li>

              <li>
                <div data-bs-toggle="collapse" href="#faq6" class="collapsed question">Can i retrieve my profile if i deleted my account?<i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
                <div id="faq6" class="collapse" data-bs-parent=".faq-list">
                  <p>
                    We don't recommend deleting your profile if you don't plan on using FutureSeekers website for a while. Our team might be able to re-activate
                    your profile if you emailed us with the same email which you used to register to our job portal and prove your identity.
                  </p>
                </div>
              </li>

            </ul>
          </div>
        </div>

      </div>
    </section>
    <section id="contact" class="contact">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Contact</h2>
          <h3><span>Contact Us</span></h3>
          <p>You can contact us to provide feedback or solve your problems.</p>
        </div>

        <div class="row" data-aos="fade-up" data-aos-delay="100">
          <div class="col-lg-6">
            <div class="info-box mb-4">
              <i class="bx bx-map"></i>
              <h3>Our Address</h3>
              <p>22/7, Cinnamon Garden, Colombo</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="info-box  mb-4">
              <i class="bx bx-envelope"></i>
              <h3>Email Us</h3>
              <p>insightpanoramanew@gmail.com</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="info-box  mb-4">
              <i class="bx bx-phone-call"></i>
              <h3>Call Us</h3>
              <p>+94713399187</p>
            </div>
          </div>

        </div>


      </div>
    </section>
  </main>

 

   

 


  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  
  <script src="<?= base_url('assets/vendor/purecounter/purecounter.js')?>"></script>
  <script src="<?= base_url('assets/vendor/aos/aos.js')?>"></script>
  <script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
  <script src="<?= base_url('assets/vendor/glightbox/js/glightbox.min.js')?>"></script>
  <script src="<?= base_url('assets/vendor/isotope-layout/isotope.pkgd.min.js')?>"></script>
  <script src="<?= base_url('assets/vendor/swiper/swiper-bundle.min.js')?>"></script>
  <script src="<?= base_url('assets/vendor/waypoints/noframework.waypoints.js')?>"></script>
  <script src= "<?= base_url('assets/vendor/php-email-form/validate.js') ?>"></script>

  
  <script src= "<?= base_url('assets/js/landingpagescript.js') ?>"></script>
  
</body>

</html>