<?php

namespace App\Controllers;

class MyJobsEmployer extends BaseController
{
  public function __construct()
  {
    helper('form');
    helper(['url', 'Login_helper']);
  }
  public function index()
  {

    return view('MyJobsEmployer/index');
  }

  public function showapplicants($jobID)
  {

    $jobM = new \App\Models\jobDetailsModel();
    $id = $jobID;
    $jobdata = $jobM->find($id);


    $data = [
      'jobid' => $jobID,
      'jobdata' => $jobdata
    ];
    return view('EmployerViewApplicants/index.php', $data);
  }

  public function downloadPdf($jcvname)
  {
    // echo $data;

    header("Content-type: application/pdf");
    header("Content-Disposition: attachment;filename=$jcvname");
    header("Content-Transfer-Encoding: binary");
    header('Pragma: no-cache');
    header('Expires: 0');
    set_time_limit(0);
    ob_clean();
    flush();
    readfile('cvfiles/' . $jcvname);
  }

  public function scheduleInterview()
  {
    // sleep(5);
    $jobid = $_POST['jobid'];
    $applicantid = $_POST['applicantid'];
    $applicantname = $_POST['applicantname'];
    $applicantemail = $_POST['applicantemail'];
    $interviewtype = $_POST['interviewtype'];
    $datetimelocal = $_POST['datetimelocal'];
    $invitationlink = $_POST['invitationlink'];
    $additionalmessage = $_POST['additionalmessage'];

    $db = db_connect();
    $queryCheckRow = $db->query(
      "
      SELECT * FROM scheduled_meetings where job_details_id = $jobid and job_seeker_id = $applicantid
      "
    );
    if ($queryCheckRow->getNumRows() > 0) {
      echo json_encode(array("result" => '2'));
    } else {
      $scheduleData = [
        'job_details_id' => $jobid,
        'job_seeker_id' => $applicantid,
        'meeting_link' => $invitationlink,
        'meeting_type' => $interviewtype,
        'notes' => $additionalmessage,
        'status' => 'Pending',
        'datetime' => $datetimelocal,
      ];

      $emailData = [
        'job_id' => $jobid,
        'applicant_id' => $applicantid,
        'applicant_email' => $applicantemail,
        'applicant_name' => $applicantname,
        'interview_type' => $interviewtype,
        'meetingtime' => $datetimelocal,
        'invitationlink' => $invitationlink,
        'notes' => $additionalmessage
      ];

      $scheduleModel = new \App\Models\scheduledmeetingsmodel();
      $queryAddSchedule = $scheduleModel->insert($scheduleData);

      if ($queryAddSchedule) {
        $jobdetails_jobseeker = new \App\Models\jobSeekerJobDetailsModel();
        $queryUpdateIsScheduled = $jobdetails_jobseeker->query("Update jobseeker_jobdetails
                                        Set is_scheduled = 'Yes'
                                        Where job_seeker_id = $applicantid and job_details_id = $jobid");
        if ($queryUpdateIsScheduled) {
          $this->SendEmailToApplicant($emailData);
        } else {
          echo json_encode(array("result" => '3'));
        }
      } else {
        echo json_encode(array("result" => '3'));
      }
    }
  }


  private function SendEmailToApplicant($emailData)
  {
    $jobid = $emailData['job_id'];
    $applicantid = $emailData['applicant_id'];
    $applicantname = $emailData['applicant_name'];
    $applicantemail = $emailData['applicant_email'];
    $interviewtype = $emailData['interview_type'];
    $meetingtime = $emailData['meetingtime'];
    $invitationlink = $emailData['invitationlink'];
    $notes = $emailData['notes'];

    $timestamp = strtotime($meetingtime);
    $date = date('d, M Y', $timestamp);
    $time = date('H:i a', $timestamp);

    $db = db_connect();
    $query = $db->query(
      "SELECT
      JobDetails.jobtitle as JobTitle,
      Company.name as CompanyName,
      Company.contactNo as CompanyContact,
      Company.email as CompanyEmail,

      Employer.name as EmployerName,
      Employer.contactNo as EmployerContact,
      Employer.email as EmployerEmail

      FROM job_details JobDetails
      join employer Employer 
      on Employer.id = JobDetails.employer_id
      join company Company 
      on Company.id = Employer.company_id
      where JobDetails.id = $jobid
      "
    );

    $rowData = $query->getRow();



    $to = "$applicantemail";

    $subject = "Congratulations! You have been selected for an Interview by $rowData->CompanyName for the position of $rowData->JobTitle";

    if ($interviewtype == "Virtual Interview") {
      $is_virtual =  "<p style='color:black;'>You can join the meeting by clicking <a href='$invitationlink' target='_blank'>here</a></p>";
    } else {
      $is_virtual = "";
    }
    if ($notes == NULL || $notes == "") {
      $notes = "";
    } else {
      $notes = "<p style='color:black;'><b> Note: $notes</b></p>";
    }

    $message = "<p>Dear $applicantname, </p>
                                                 <p style='color:black;'>You have been selected by <b> $rowData->CompanyName </b> for an Interview for the position of <b> $rowData->JobTitle. </b> </p> 
                                                 You are required to attend a <b> $interviewtype </b> on the <b> $date at $time </b>.
                                                 $is_virtual
                                                 $notes
                                                 <p style='color:black;'><b> For More Information, contact the company: </b></p>
                                                 <ul style='color:black;'>
                                                 <li> <b> Company Name: </b> $rowData->CompanyName</li>
                                                 <li> <b>Company Contact No:  </b> $rowData->CompanyContact</li>
                                                 <li> <b>Company Email:  </b> $rowData->CompanyEmail </li>
                                                 <li> <b>Employer Name: </b> $rowData->EmployerName </li>
                                                 <li> <b>Employer Contact No: </b> $rowData->EmployerContact </li>
                                                 <li> <b>Employer Email: </b> $rowData->EmployerEmail </li>
                                                 </ul> 

                                                 <br>
                                                 <p style='color:black;'> <b> Thank You, </b></p>
                                                 <p style='color:black;'> FutureSeekers Team </p>

                                                 <p style='font-family:'Segoe UI',Tahoma,sans-serif;margin:0px 0px 0px 5px;color:#666;font-size:10px'>
                                                 This message was sent from an unmonitored email address. Please do not reply to this message.
                                             </p>
                                                 ";



    // $filepath = "cvfiles/$jobseeker_cv";

    $email = \config\Services::email();

    $email->setTo($to);

    $email->setFrom('futureseekersnew@gmail.com', 'FutureSeekers');

    $email->setSubject($subject);

    $email->setMessage($message);

    // $email->attach($filepath);

    if ($email->send()) {
      echo json_encode(array("result" => '1'));
    } else {

      $error = $email->printDebugger(['headers']);

      print_r($error);
    }
    // echo json_encode(array("result" => '1'));
  }

  public function logout()
  {
    $session = session();
    $session->destroy();
    return redirect()->to('Home/index')->with('fail', 'You are Logged out');
  }

  public function MyReports() {
    return view('EmployerMyReports/index');
  }


  public function ReportApplicant()
  {
    $sender_userID = session()->get('user_id');
    $applicantID = $_POST['applicantID'];
    $reportContent = $_POST['reportCat'];

    $db = db_connect();
    $changeStatusQuery = $db->query(
      "UPDATE job_seeker
      join user_account on user_account.id = job_seeker.user_account_id
      set user_account.status = 4
      where job_seeker.id = $applicantID
      "
    );

    $getApplicantID = $db->query(
      "SELECT user_account.id from user_account
      join job_seeker on job_seeker.user_account_id = user_account.id
      where job_seeker.id = $applicantID      
      "
    );

    $getApplicantID = $getApplicantID->getRow()->id;

    if ($changeStatusQuery) {
      $addComplaint = $db->query(
        "INSERT INTO reported_accounts (user_account_id, reported_user_id, remarks)
        VALUES ($getApplicantID, $sender_userID, '$reportContent');
        "
      );
      echo json_encode(array("result" => '1'));
    } else {
      echo json_encode(array("result" => '2'));
    }


    $db->close();
  }


  public function GenerateReports()
  {
    $job_seekersArray = array();
    $db = db_connect();
    $query_jobs = $db->query(
      "SELECT jobCategory,COUNT(jobCategory) as catcount FROM job_details group by jobCategory
      "
    );

    foreach ($query_jobs->getResult() as $row) {
      $jobCategory = $row->jobCategory;
      $categoryCount = $row->catcount;

      $jobSeeker = array(
        "jobCategory" => $jobCategory,
        "categoryCount" => $categoryCount
      );

      array_push($job_seekersArray, $jobSeeker);
    }


    $db->close();

    echo json_encode($job_seekersArray);
  }

  public function GenerateMostAppliedJobAdvertReport()
  {
    // sleep(3);
    $uid = session()->get('user_id');
    $most_applied_adverts = array();
    $db = db_connect();

    $datatimepara = $this->ConstructDateTimeParameter($_POST['selected_val']);
    $queryResult = $db->query(
      "SELECT Title, JobID, Category, location, COUNT(JobID) Applicant_Count
      FROM
      (
      SELECT  
          job_details.jobtitle as Title, 
          job_details.id as JobID,
          job_details.jobCategory as Category,
          job_details.location as Location
          FROM jobseeker_jobdetails 
      join job_details on job_details.id = jobseeker_jobdetails.job_details_id
      join employer on job_details.employer_id = employer.id
      join user_account on user_account.id = employer.user_account_id
      where user_account.id = $uid $datatimepara)
      tab1
      GROUP by Title
      LIMIT 5
      "
    );

    if ($queryResult) {
      foreach ($queryResult->getResult() as $row) {
        $title = $row->Title;
        $applicantCount = $row->Applicant_Count;
        $jobid = $row->JobID;
        $category = $row->Category;
        $location = $row->Location;

        $jobAdvert = array(
          "title" => $title,
          "applicantCount" => $applicantCount,
          "jobid" => $jobid,
          "category" => $category,
          "location" => $location
        );

        array_push($most_applied_adverts, $jobAdvert);
      }

      $db->close();

      echo json_encode($most_applied_adverts);
    } else {
      echo json_encode(array("result" => 'Error'));
    }


  }

  private function ConstructDateTimeParameter($selected_val) {
    if($selected_val == "Previous Month") {
      $para = "and jobseeker_jobdetails.dateTime > CURRENT_DATE()-60 and jobseeker_jobdetails.dateTime < CURRENT_DATE()-30";
    }
    else {
      $para = "";
    }
    return $para;
  }

  public function GenerateMostPreferredJobCategoryReport()
  {
    $uid = session()->get('user_id');
    $most_preferred_categories = array();
    $db = db_connect();
    $queryResult = $db->query(
      "SELECT Category, COUNT(id) Applicant_Count
      FROM
      (
      SELECT  job_details.jobCategory as Category, job_details.id  FROM jobseeker_jobdetails 
      join job_details on job_details.id = jobseeker_jobdetails.job_details_id
      join employer on job_details.employer_id = employer.id
      join user_account on user_account.id = employer.user_account_id
      where user_account.id = $uid)
      tab1
      GROUP by Category
      LIMIT 5
      "
    );

    if ($queryResult) {
      foreach ($queryResult->getResult() as $row) {
        $category = $row->Category;
        $applicantCount = $row->Applicant_Count;

        $jobCategory = array(
          "category" => $category,
          "applicantCount" => $applicantCount
        );

        array_push($most_preferred_categories, $jobCategory);
      }

      $db->close();

      echo json_encode($most_preferred_categories);
    } else {
      echo json_encode(array("result" => 'Error'));
    }


  }

  public function GenerateMostSharedJobAdverts()
  {
    $uid = session()->get('user_id');
    $most_shared_jobs = array();
    $db = db_connect();

    $para = $this->ConstructParamaterforSharedJobs($_POST['selected_val']);
    $queryResult = $db->query(
      "SELECT jobtitle, count(id) applicant_count from
      (SELECT
      job_details.jobtitle,
      job_details.id
      FROM shared_advert
      join job_details on shared_advert.job_details_id = job_details.id
      join employer on employer.id = job_details.employer_id
      join user_account on user_account.id = employer.user_account_id
      where user_account.id = $uid $para)tab1
      GROUP by id
      "
    );

    if ($queryResult) {
      foreach ($queryResult->getResult() as $row) {
        $jobTitle = $row->jobtitle;
        $applicantCount = $row->applicant_count;

        $jobs = array(
          "title" => $jobTitle,
          "applicantCount" => $applicantCount
        );

        array_push($most_shared_jobs, $jobs);
      }

      $db->close();

      echo json_encode($most_shared_jobs);
    } else {
      echo json_encode(array("result" => 'Error'));
    }

  }

  private function ConstructParamaterforSharedJobs($selected_val) {
    if($selected_val == "Previous Month") {
      $para = "and shared_advert.datetime > CURRENT_DATE()-60 and shared_advert.datetime < CURRENT_DATE()-30";
    }
    else {
      $para = "";
    }
    return $para;
  }


  public function JobPostingsVsCategory()
  {
    $uid = session()->get('user_id');
    $all_cat_jobs = array();
    $db = db_connect();
    $queryResult = $db->query(
      "SELECT jobCategory, count(jobCategory) Postings from
      (SELECT job_details.jobCategory FROM job_details
      join employer on employer.id = job_details.employer_id
      join user_account on user_account.id = employer.user_account_id
      where user_account.id = $uid)tab1
      group by jobCategory
      "
    );

    if ($queryResult) {
      foreach ($queryResult->getResult() as $row) {
        $category = $row->jobCategory;
        $postings = $row->Postings;

        $jobs = array(
          "category" => $category,
          "postings" => $postings
        );

        array_push($all_cat_jobs, $jobs);
      }

      $db->close();

      echo json_encode($all_cat_jobs);
    } else {
      echo json_encode(array("result" => 'Error'));
    }


  }

  public function GetTiledReports()
  {
    $uid = session()->get('user_id');
    $db = db_connect();
    $queryNoOfPosts = $db->query(
      "SELECT COUNT(Job_ID) No_of_Posts from
      (SELECT job_details.id as Job_ID from job_details 
      JOIN employer on employer.id = job_details.employer_id
      join user_account on user_account.id = employer.user_account_id
      where user_account.id = $uid and job_details.status = 1)
      tab1
      "
    );

    $queryNoApplicantsApplied = $db->query(
      "SELECT COUNT(*) No_of_Applicants_Applied from 
      (SELECT jobseeker_jobdetails.job_seeker_id, jobseeker_jobdetails.job_details_id from jobseeker_jobdetails
      join job_details on job_details.id = jobseeker_jobdetails.job_details_id
      join employer on employer.id = job_details.employer_id
      join user_account on user_account.id = employer.user_account_id
      where user_account.id = $uid)tab1
      "
    );

    $queryNoShortListedApplicants = $db->query(
      "SELECT COUNT(*) No_of_Shortlisted_Applicants from (
        SELECT jobseeker_jobdetails.job_seeker_id, jobseeker_jobdetails.job_details_id from jobseeker_jobdetails
        join job_details on job_details.id = jobseeker_jobdetails.job_details_id
        join employer on employer.id = job_details.employer_id
        join user_account on user_account.id = employer.user_account_id
        where user_account.id = $uid and jobseeker_jobdetails.is_scheduled='Yes')tab1
      "
    );

    $queryNoOfSharedAdverts = $db->query(
      "SELECT count(id) Shared_Adverts from 
      (SELECT shared_advert.id FROM shared_advert
      join job_details on shared_advert.job_details_id = job_details.id
      join employer on employer.id = job_details.employer_id
      join user_account on user_account.id = employer.user_account_id
      where user_account.id = $uid)tab1
      "
    );

    $db->close();

    if ($queryNoOfPosts && $queryNoApplicantsApplied && $queryNoShortListedApplicants && $queryNoOfSharedAdverts) {
      $noOfPosts = $queryNoOfPosts->getRow()->No_of_Posts;
      $noOfApplicantsApplied = $queryNoApplicantsApplied->getRow()->No_of_Applicants_Applied;
      $noOfShortListedApplicants = $queryNoShortListedApplicants->getRow()->No_of_Shortlisted_Applicants;
      $noOfSharedAdverts = $queryNoOfSharedAdverts->getRow()->Shared_Adverts;

      $tiledReportArray = array(
        "noOfPosts" => $noOfPosts,
        "noOfApplicantsApplied" => $noOfApplicantsApplied,
        "noOfShortlisted" => $noOfShortListedApplicants,
        "sharedAdverts" => $noOfSharedAdverts
      );

      echo json_encode($tiledReportArray);
    } else {
      echo json_encode(array("result" => 'Error'));
    }

  }
}
