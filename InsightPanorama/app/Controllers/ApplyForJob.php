<?php

namespace App\Controllers;

use mysqli;

class ApplyForJob extends BaseController
{
  public function __construct()
  {
    helper('form');
    helper(['url', 'Login_helper']);
  }
  public function index($jobid)
  {

   
    $job_detail_id = $jobid;

    if (session()->get('user_id') == null || session()->get('user_type') == "employer" || session()->get('user_type') == "admin") {
      return redirect()->to('Home/index')->with('fail', 'You must be logged in..');;
    }
    $session = session();
    $session->regenerate();
    $user_id = session()->get('user_id');

    
    $jobdetailM = new \App\Models\jobDetailsModel();

    $query_jdetail = $jobdetailM->query("Select * from job_details where id = $jobid");
    foreach ($query_jdetail->getResult() as $row4) {
      $emp_id = $row4->employer_id;
      $jobtitle = $row4->jobtitle;
   
    } 

     $employerM = new \App\Models\employerModel();

     $query_employer = $employerM->query("Select * from employer where id = $emp_id");
     foreach ($query_employer->getResult() as $row3) {
       $employer_email = $row3->email;
     } 


    






    $jobseekerM = new \App\Models\jobSeekerModel();
    



    $query_jobseeker = $jobseekerM->query("Select * from job_seeker where user_account_id = $user_id");
    foreach ($query_jobseeker->getResult() as $row) {
      $jobseeker_id = $row->id;
      $jobseeker_name = $row->name;
      $jobseeker_contact = $row->contactNo;
      $jobseeker_cv = $row->cv_file_dir;
      $jobseeker_email = $row->email;
    }



    $values = [
      'job_seeker_id' => $jobseeker_id,
      'job_details_id' => $jobid,
      'cv_name' => $jobseeker_cv
    ];

    if($jobseeker_cv == null){
      return redirect()->to('ApplicantHome')->with('fail', 'Please update your profile details by providing your CV');
    }


    $jobdetailsM = new \App\Models\jobSeekerJobDetailsModel();
    $query_check = $jobdetailsM->query("Select * from jobseeker_jobdetails where job_seeker_id = $jobseeker_id and job_details_id = $jobid");
    $doesntexist = true;
    foreach ($query_check->getResult() as $row2) {
      if (isset($row2)) {
        $doesntexist = false;
      }
    }
    if ($doesntexist == true) {
      $queryEmp = $jobdetailsM->insert($values);
      if ($queryEmp) {
        return redirect()->back()->with('fail', 'Please try again later..');
      } else { //sending an email to the relevant employer
        $to = $employer_email;

        $subject = "$jobseeker_name has applied for $jobtitle Posititon";

        $message = "<p>$jobseeker_name has applied for the $jobtitle Position (Job Reference Number $jobid).</p>
                    <br>
                    <P>You can Contact this person by using the following details and their CV is attached with this e-mail</P>
                    <ul>
                    <li>Email: $jobseeker_email</li>
                    <li>Phone number: $jobseeker_contact</li>
                    </ul>  ";
        
        $filepath = "cvfiles/$jobseeker_cv";

        $email = \config\Services::email();

        $email->setTo($to);

       
        $email->setFrom('futureseekersnew@gmail.com', 'FutureSeekers');

        $email->setSubject($subject);

        $email->setMessage($message);

        $email->attach($filepath);

        if ($email->send()) {

         

        } else {

          $error = $email->printDebugger(['headers']);

          print_r($error);
        }


        return redirect()->to('ApplicantHome')->with('success', 'You have successfully applied for this job. The Employer will receive a notification shortly.');
      }
    } else {
      return redirect()->to('ApplicantHome')->with('fail', 'You have already applied for this position');
    }
   







  }



  public function logout()
  {
    $session = session();
    $session->destroy();
    return redirect()->to('Home/index')->with('fail', 'You are Logged out');
  }
}
