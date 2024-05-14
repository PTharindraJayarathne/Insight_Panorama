<?php

namespace App\Controllers;

class AdminHome extends BaseController
{
  public function index()
  {
    if (session()->get('user_id') == null) {
      return redirect()->to('Home/index')->with('fail', 'You must be logged in..');;
    }
    return view('AdminHome/index');
  }

  // Number of meetings conducted
  public function GenerateMeetingsConductedData()
  {
    $arr = array();
    $db = db_connect();

    $queryResult = $db->query(
      "SELECT CompanyID, CompanyName, count(CompanyID) as Count from
      (SELECT 
      company.id as CompanyID,
      company.name as CompanyName
      FROM scheduled_meetings
      join job_details on job_details.id = scheduled_meetings.job_details_id
      join employer on employer.id = job_details.employer_id
      join company on company.id = employer.company_id)tab1
      GROUP BY CompanyID
      LIMIT 5
      "
    );

    if ($queryResult) {
      foreach ($queryResult->getResult() as $row) {
        $companyID = $row->CompanyID;
        $companyName = $row->CompanyName;
        $count = $row->Count;


        $data = array(
          "CompanyID" => $companyID,
          "companyName" => $companyName,
          "count" => $count,
        );

        array_push($arr, $data);
      }

      $db->close();

      echo json_encode($arr);
    } else {
      echo json_encode(array("result" => 'Error'));
    }
  }

  // Top Job Roles Category Wise
  public function GenerateTopJobRolesData()
  {
    $arr = array();
    $db = db_connect();

    $queryResult = $db->query(
      "SELECT JobTitle, Category, COUNT(JobID) Applicants from
      (SELECT 
      job_details.id as JobID,
      job_details.jobtitle as JobTitle,
       job_details.jobCategory as Category
      FROM jobseeker_jobdetails
      join job_details on job_details.id = jobseeker_jobdetails.job_details_id
      )tab1
      GROUP BY JobID
      LIMIT 10      
      "
    );

    if ($queryResult) {
      foreach ($queryResult->getResult() as $row) {
        $jobTitle = $row->JobTitle;
        $Category = $row->Category;
        $Applicants = $row->Applicants;

        $data = array(
          "jobTitle" => $jobTitle,
          "category" => $Category,
          "applicants" => $Applicants,
        );

        array_push($arr, $data);
      }

      $db->close();

      echo json_encode($arr);
    } else {
      echo json_encode(array("result" => 'Error'));
    }
  }

  // Top Applicants who Applied for Jobs 
  public function GenerateTopApplicantsAppliedData()
  {
    $arr = array();
    $db = db_connect();

    $queryResult = $db->query(
      "SELECT ApplicantName, COUNT(ApplicantID) TimesApplied from
      (SELECT 
      jobseeker_jobdetails.job_seeker_id as ApplicantID,  
      job_seeker.name as ApplicantName
      from jobseeker_jobdetails
      join job_seeker on job_seeker.id = jobseeker_jobdetails.job_seeker_id)tab1
      GROUP BY ApplicantID
      LIMIT 5
      "
    );

    if ($queryResult) {
      foreach ($queryResult->getResult() as $row) {
        $applicantName = $row->ApplicantName;
        $timesApplied = $row->TimesApplied;

        $data = array(
          "applicantName" => $applicantName,
          "timesApplied" => $timesApplied,
        );

        array_push($arr, $data);
      }

      $db->close();

      echo json_encode($arr);
    } else {
      echo json_encode(array("result" => 'Error'));
    }
  }

  // Top Companies who posted Jobs on the site
  public function GenerateTopCompaniesPostedData()
  {
    $arr = array();
    $db = db_connect();

    $queryResult = $db->query(
      "SELECT CompanyName, COUNT(CompanyID) JobsPosted from
      (SELECT 
      company.id as CompanyID, 
      company.name as CompanyName
      FROM jobseeker_jobdetails
      JOIN job_details on job_details.id = jobseeker_jobdetails.job_details_id
      JOIN employer on employer.id = job_details.employer_id
      join company on company.id = employer.company_id)tab1
      GROUP BY CompanyID
      LIMIT 5
      "
    );

    if ($queryResult) {
      foreach ($queryResult->getResult() as $row) {
        $CompanyName = $row->CompanyName;
        $JobsPosted = $row->JobsPosted;

        $data = array(
          "CompanyName" => $CompanyName,
          "JobsPosted" => $JobsPosted,
        );

        array_push($arr, $data);
      }

      $db->close();

      echo json_encode($arr);
    } else {
      echo json_encode(array("result" => 'Error'));
    }
  }

  // To get Applicants Registered Count (Inclusive of all)
  public function GetAllApplicantsData()
  {
    $arr = array();
    $applicant_total_count = 0;
    $other_count = 0;
    $db = db_connect();

    $queryResult = $db->query(
      "SELECT AccStatus, COUNT(AccStatus) Applicants FROM
      (SELECT user_account.status as AccStatus
      FROM user_account
      where type = 'applicant')tab1
      GROUP BY AccStatus      
        "
    );

    if ($queryResult) {
      foreach ($queryResult->getResult() as $row) {
        $AccStatus = $row->AccStatus; // 1
        $Applicants = $row->Applicants; // 3

        $applicant_total_count = $applicant_total_count + $Applicants;

        $Status = $this->ConstructStatusData($AccStatus);

        if ($Status != '') {
          $other_count = $other_count + $Applicants;
          $data = array(
            "statusType" => $Status,
            "applicants" => $Applicants,
          );
          array_push($arr, $data);
        }
      }

      $db->close();

      $other = $applicant_total_count - $other_count;

      $data = array(
        "statusType" => 'Other',
        "applicants" => $other,
      );

      array_push($arr, $data);

      echo json_encode($arr);
    } else {
      echo json_encode(array("result" => 'Error'));
    }
  }

  // To get Companied Registered Count (inclusive of all) 
  public function GetAllCompaniesData()
  {
    $arr = array();
    $companies_total_count = 0;
    $other_count = 0;
    $db = db_connect();

    $queryResult = $db->query(
      "SELECT AccStatus, COUNT(AccStatus) Companies FROM
      (SELECT user_account.status as AccStatus
      FROM user_account
      where type = 'employer')tab1
      GROUP BY AccStatus    
        "
    );

    if ($queryResult) {
      foreach ($queryResult->getResult() as $row) {
        $AccStatus = $row->AccStatus; // 1
        $Companies = $row->Companies; // 3

        $companies_total_count = $companies_total_count + $Companies;

        $Status = $this->ConstructStatusData($AccStatus);

        if ($Status != '') {
          $other_count = $other_count + $Companies;
          $data = array(
            "statusType" => $Status,
            "companies" => $Companies,
          );
          array_push($arr, $data);
        }
      }

      $db->close();

      $other = $companies_total_count - $other_count;

      $data = array(
        "statusType" => 'Other',
        "companies" => $other,
      );

      array_push($arr, $data);

      echo json_encode($arr);
    } else {
      echo json_encode(array("result" => 'Error'));
    }
  }

  // To Get Job Postings Count (Accepted and Rejected)
  public function GetAllJobPostingsData()
  {
    $arr = array();
    $postings_total_count = 0;
    $other_count = 0;
    $db = db_connect();

    $queryResult = $db->query(
      "SELECT AdvertStatus, COUNT(AdvertStatus) AdvertCount FROM
      (SELECT 
      job_details.status as AdvertStatus
      FROM job_details)tab1
      GROUP BY AdvertStatus 
        "
    );

    if ($queryResult) {
      foreach ($queryResult->getResult() as $row) {
        $AdvertStatus = $row->AdvertStatus; // 1
        $AdvertCount = $row->AdvertCount; // 3

        $postings_total_count = $postings_total_count + $AdvertCount;

        $Status = $this->ConstructStatusData($AdvertStatus);

        if ($Status != '') {
          $other_count = $other_count + $AdvertCount;
          $data = array(
            "statusType" => $Status,
            "adverts" => $AdvertCount,
          );
          array_push($arr, $data);
        }
      }

      $db->close();

      $other = $postings_total_count - $other_count;

      $data = array(
        "statusType" => 'Other',
        "adverts" => $other,
      );

      array_push($arr, $data);

      echo json_encode($arr);
    } else {
      echo json_encode(array("result" => 'Error'));
    }
  }

  // To get all Interviews Conducted
  public function GetAllInterviewCount()
  {
    $arr = array();
    $db = db_connect();

    $queryResult = $db->query(
      "SELECT COUNT(id) Interviews FROM
      (SELECT 
      scheduled_meetings.id 
      FROM scheduled_meetings)tab1
      "
    );

    if ($queryResult) {
      $interviews = $queryResult->getRow()->Interviews;
      $data = array(
        "interviews" => $interviews,
      );
      array_push($arr, $data);

      $db->close();

      echo json_encode($arr);
    } else {
      echo json_encode(array("result" => 'Error'));
    }
  }

  public function GenerateAgeSummaryData()
  {
    $arr = array();
    $db = db_connect();

    $queryResult = $db->query(
      "SELECT 'Below 20' as age_group, COUNT(user_account_id) as no_of_applicants from job_seeker
      where (FLOOR(DATEDIFF(NOW(),job_seeker.dob)/365.25)) <20
      UNION
      select 'Above 20 and Below 30' as age_group, COUNT(user_account_id) as no_of_applcants from job_seeker
      where (FLOOR(DATEDIFF(NOW(),job_seeker.dob)/365.25)) >=20 and FLOOR(DATEDIFF(NOW(),job_seeker.dob)/365.25) <30
      UNION
      select 'Above 30 and Below 40' as age_group, COUNT(user_account_id) as no_of_applcants from job_seeker
      where (FLOOR(DATEDIFF(NOW(),job_seeker.dob)/365.25)) >=30 and FLOOR(DATEDIFF(NOW(),job_seeker.dob)/365.25) <40
      UNION
      select 'Above 40 and Below 50' as age_group, COUNT(user_account_id) as no_of_applcants from job_seeker
      where (FLOOR(DATEDIFF(NOW(),job_seeker.dob)/365.25)) >=40 and FLOOR(DATEDIFF(NOW(),job_seeker.dob)/365.25) <50
      UNION
      select 'Above 50' as age_group, COUNT(user_account_id) as no_of_applcants from job_seeker
      where (FLOOR(DATEDIFF(NOW(),job_seeker.dob)/365.25)) >=50
      "
    );

    if ($queryResult) {
      foreach ($queryResult->getResult() as $row) {
        $ageGroup = $row->age_group;
        $noOfApplicants = $row->no_of_applicants;


        if ($noOfApplicants > 0) {
          $data = array(
            "ageGroup" => $ageGroup,
            "noOfApplicants" => $noOfApplicants,
          );

          array_push($arr, $data);
        }
      }

      $db->close();

      echo json_encode($arr);
    } else {
      echo json_encode(array("result" => 'Error'));
    }
  }

  private function ConstructStatusData($AccStatus)
  {
    $Status = '';
    // if ($AccStatus == 0) {
    //   $Status = 'Pending';
    // } else if ($AccStatus == 1) {
    //   $Status = 'Approved';
    // } else if ($AccStatus == 2) {
    //   $Status = 'Rejected';
    // } else if ($AccStatus == 5) {
    //   $Status = 'Deactivated';
    // }

    if ($AccStatus == 1) {
      $Status = 'Approved';
    } else if ($AccStatus == 2) {
      $Status = 'Rejected';
    }

    return $Status;
  }
}
