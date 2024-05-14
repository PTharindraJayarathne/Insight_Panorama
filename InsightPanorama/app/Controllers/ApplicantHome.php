<?php

namespace App\Controllers;

class ApplicantHome extends BaseController
{
  public function __construct()
  {
    helper('form');
    helper(['url', 'Login_helper']);
  }

  public function index()
  {
    if (session()->get('user_id') == null || session()->get('user_type') == "employer") {
      return redirect()->to('Home/index')->with('fail', 'You must be logged in..');;
    }
    $session = session();
    $session->regenerate();
    $user_id = session()->get('user_id');
    $UserAccount = new \App\Models\userAccountModel();
    $user_info = $UserAccount->where('id', $user_id)->first();
    if ($user_info['status'] == 0) {
      return view('MyProfileApplicant/index');
    }

    $jobtitle = $this->request->getPost('search_input');
    $jobCategory = $this->request->getPost('jobCategory');
    $location = $this->request->getPost('jobLocation');
    $experience = $this->request->getPost('experience');
    $minsalary = $this->request->getPost('minsalary');
    $maxsalary = $this->request->getPost('maxsalary');
    $compname = $this->request->getPost('company');

    // if (isset($jobtitle)) {
    //   $data = $this->viewAdvertisements($jobtitle);
    // } else {
    //   $data = $this->viewAdvertisements("");
    // }

    // $this->GetSearchQuery("JobTitle", $jobtitle, "no");

    // $data = $this->viewAdvertisements("");
    $str1 = $this->GetSearchQuery('jb.jobCategory', $jobCategory, 'yes');
    $str2 = $this->GetSearchQuery('jb.jobtitle', $jobtitle, 'no');
    $str3 = $this->GetSearchQuery('jb.location', $location, 'yes');
    $str4 = $this->GetSearchQuery('jb.experience', $experience, 'yes');
    $str5 = $this->GetSearchQuery('com.name', $compname, 'no');
    $str6 = $this->GetSalaryQuery("minsalary", $minsalary);
    $str7 = $this->GetSalaryQuery("maxsalary", $maxsalary);


    $finalStr = $str1 . $str2 . $str3 . $str4 . $str5 . $str6 . $str7;

    $data = $this->viewAdvertisements($finalStr);

    return view("ApplicantHome/index", $data);
  }

  private function viewAdvertisements($search_res)
  {
    $jobrecords = array();

    $db = db_connect();
    $query = $db->query(
      "SELECT
        jb.location as JobLocation,
        jb.id as AdvertID,
        jb.jobtitle as JobTitle,
        jb.closingDate as ClosingDate,
        jb.jobCategory as JobCategory,
        jb.typeOfEmployment as TypeofEmp,
        jb.experience as JobExp,
        jb.description as PDFName,
        com.logo_dir as CompLogo,
        com.name as CompanyName,
        com.contactNo as CompanyContact,
        com.email as CompanyEmail
        FROM job_details jb 
        join employer emp 
        on jb.employer_id = emp.id 
        join user_account useracc 
        on useracc.id = emp.user_account_id 
        join company com 
        on com.id = emp.company_id 
        where jb.status = '1' 
        and useracc.status = '1'  
        $search_res
        "
    );

    foreach ($query->getResult() as $row) {
      $logo = $row->CompLogo;
      $jobTitle = $row->JobTitle;
      $cDate = $row->ClosingDate;
      $companyName = $row->CompanyName;
      $jobCategory = $row->JobCategory;
      $typeofemployment = $row->TypeofEmp;
      $jobtime = $row->JobExp;
      $pdfname = $row->PDFName;
      $companyNo = $row->CompanyContact;
      $companyEmail = $row->CompanyEmail;
      $joblocation = $row->JobLocation;
      $jobId = $row->AdvertID;

      $jobDet = array(
        "logo" => $logo,
        "jobtitle" => $jobTitle,
        "cdate" => $cDate,
        "companyname" => $companyName,
        "jobcategory" => $jobCategory,
        "typeofemp" => $typeofemployment,
        "jobtime" => $jobtime,
        "pdfname" => $pdfname,
        "companyno" => $companyNo,
        "companyemail" => $companyEmail,
        "joblocation" => $joblocation,
        "jobid" => $jobId,
      );

      array_push($jobrecords, $jobDet);
    }

    $db->close();

    $user_id = session()->get('user_id');
    $recommededJobAdverts = $this->viewRecommendations($user_id);

    $data = [
      'title' => 'AllData',
      'jobRecords' => $jobrecords,
      'recommendedJobRecords' => $recommededJobAdverts
    ];

    return $data;
  }


  private function viewRecommendations($user_id)
  {
    $recommendedjobrecords = array();
    $db = db_connect();

    $getApplicantID = $db->query(
      "SELECT job_seeker.id from user_account
      join job_seeker on user_account.id = job_seeker.user_account_id
      where user_account.id = $user_id
      "
    );

    $jobseeker_id = $getApplicantID->getRow()->id;

    $recommendedCategory = $db->query(
      "SELECT
      jb.location as JobLocation,
      jb.id as AdvertID,
      jb.jobtitle as JobTitle,
      jb.closingDate as ClosingDate,
      jb.jobCategory as JobCategory,
      jb.typeOfEmployment as TypeofEmp,
      jb.experience as JobExp,
      jb.description as PDFName,
      com.logo_dir as CompLogo,
      com.name as CompanyName,
      com.contactNo as CompanyContact,
      com.email as CompanyEmail
      FROM job_details jb 
      join employer emp 
      on jb.employer_id = emp.id 
      join user_account useracc 
      on useracc.id = emp.user_account_id 
      join company com 
      on com.id = emp.company_id 
      where jb.status = '1' 
      and useracc.status = '1' 
      and jb.jobCategory 
      IN (select distinct Category from
(
SELECT
jd.jobCategory as Category,
COUNT(distinct jj.job_details_id) as No_of_Applys
FROM jobseeker_jobdetails jj
join job_details jd 
ON jj.job_details_id = jd.id
where jj.job_seeker_id = $jobseeker_id
group by jd.jobCategory
order by COUNT(distinct jj.job_details_id) desc
)tab1) limit 5
      "
    );

    foreach ($recommendedCategory->getResult() as $row) {
      $logo = $row->CompLogo;
      $jobTitle = $row->JobTitle;
      $cDate = $row->ClosingDate;
      $companyName = $row->CompanyName;
      $jobCategory = $row->JobCategory;
      $typeofemployment = $row->TypeofEmp;
      $jobtime = $row->JobExp;
      $pdfname = $row->PDFName;
      $companyNo = $row->CompanyContact;
      $companyEmail = $row->CompanyEmail;
      $joblocation = $row->JobLocation;
      $jobId = $row->AdvertID;

      $jobDet = array(
        "logo" => $logo,
        "jobtitle" => $jobTitle,
        "cdate" => $cDate,
        "companyname" => $companyName,
        "jobcategory" => $jobCategory,
        "typeofemp" => $typeofemployment,
        "jobtime" => $jobtime,
        "pdfname" => $pdfname,
        "companyno" => $companyNo,
        "companyemail" => $companyEmail,
        "joblocation" => $joblocation,
        "jobid" => $jobId,
      );

      array_push($recommendedjobrecords, $jobDet);
    }
    $db->close();

    return $recommendedjobrecords;
  }


  public function downloadPdf($data)
  {
    // echo $data;

    header("Content-type: application/pdf");
    header("Content-Disposition: attachment;filename=$data");
    header("Content-Transfer-Encoding: binary");
    header('Pragma: no-cache');
    header('Expires: 0');
    set_time_limit(0);
    ob_clean();
    flush();
    readfile('adverts/' . $data);
  }


  public function logout()
  {
    $session = session();
    $session->destroy();
    return redirect()->to('Home/index')->with('fail', 'You are Logged out');
  }



  public function GetSearchQuery($db_column, $inputfield, $isdropdown)
  {
    $tocheck = "";
    // $tocheck = null;
    $resultquery = "";
    if ($isdropdown == "yes") {
      $tocheck = "Select All";
    }
    if ($inputfield == $tocheck || $inputfield == "") {
      $resultquery = " and " . $db_column . " like '%%' ";
    } else {
      if ($isdropdown == "yes") {
        $resultquery = " and " . $db_column . " = '" . $inputfield . "' ";
      } else {
        $resultquery = " and " . $db_column . " like '%" . $inputfield . "%' ";
      }
    }
    return $resultquery;
  }


  public function GetSalaryQuery($col, $inputfield)
  {
    $resultquery = "";
    if ($col == "minsalary" && $inputfield != "") {
      $resultquery = " and jb.salary >= $inputfield";
    } else if ($col == "maxsalary" && $inputfield != "") {
      $resultquery = " and jb.salary <= $inputfield";
    } else {
      $resultquery = "";
    }
    return $resultquery;
  }

  public function ApplyForJob()
  {
    $jobid = $_POST['jobID'];

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

    if ($jobseeker_cv == null) {
      echo json_encode(array("result" => '3'));
      //return redirect()->to('ApplicantHome')->with('fail', 'Please update your profile details by providing your CV');
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
        echo json_encode(array("result" => '4'));
        // return redirect()->back()->with('fail', 'Please try again later..');
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

        echo json_encode(array("result" => '1'));
        // return redirect()->to('ApplicantHome')->with('success', 'You have successfully applied for this job. The Employer will receive a notification shortly.');
      }
    } else {
      echo json_encode(array("result" => '2'));
      // return redirect()->to('ApplicantHome')->with('fail', 'You have already applied for this position');
    }


    // testing 
  }

  public function ShareJobAdvertisement()
  {
    $user_id = session()->get('user_id');
    $jobid = $_POST['jobID'];
    $to_email = $_POST['recepientEmail'];
    $notes = $_POST['notes'];

    $db = db_connect();


    $queryReceiverData = $db->query(
      "SELECT job_seeker.id FROM job_seeker
      where job_seeker.email = '$to_email'
      "
    );

    if ($queryReceiverData->getNumRows() == 0) {
      echo json_encode(array("result" => '2')); // This user does not exist in the system
    } else {
      $queryJobDetails = $db->query(
        "SELECT
      jb.location as JobLocation,
             jb.id as AdvertID,
             jb.jobtitle as JobTitle,
             jb.closingDate as ClosingDate,
             jb.jobCategory as JobCategory,
             jb.typeOfEmployment as TypeofEmp,
             jb.experience as JobExp,
             jb.description as PDFName,
             com.logo_dir as CompLogo,
             com.name as CompanyName,
             com.contactNo as CompanyContact,
             com.email as CompanyEmail
     
     FROM job_details jb
     join employer on employer.id = jb.employer_id
     join company com on com.id = employer.company_id
     where jb.id = $jobid
      "
      );

      $querySenderDetails = $db->query(
        "SELECT job_seeker.name, job_seeker.id FROM user_account
      join job_seeker on job_seeker.user_account_id = user_account.id
      where user_account.id = $user_id
      "
      );

      $a_id = $queryJobDetails->getRow()->AdvertID;
      $s_id = $querySenderDetails->getRow()->id;
      $r_id = $queryReceiverData->getRow()->id;
      $queryAddtoSharedTable = $db->query(
        "INSERT INTO shared_advert (job_details_id, sender_id, receiver_id, status, message)
      VALUES ($a_id, $s_id, $r_id, 0, '$notes');
      "
      );

      // $sharedAdvertsModel = new \App\Models\sharedadvert();
      // $addSharedAdvert = $sharedAdvertsModel->insert($valuesSharedAdvert);
      echo json_encode(array("result" => '1')); // Exists in the system
    }


    $db->close();
  }
}
