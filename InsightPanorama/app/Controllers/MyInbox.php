<?php

namespace App\Controllers;

class MyInbox extends BaseController
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

    $jobAdverts = $this->ViewJobAdverts($user_id);

    return view("ApplicantMyInbox/index", $jobAdverts);
  }

  private function ViewJobAdverts($user_id)
  {
    $jobrecords = array();
    $db = db_connect();

    $query = $db->query(
      "SELECT 
      job_details.location as JobLocation,
          job_details.id as AdvertID,
          job_details.jobtitle as JobTitle,
          job_details.closingDate as ClosingDate,
          job_details.jobCategory as JobCategory,
          job_details.typeOfEmployment as TypeofEmp,
          job_details.experience as JobExp,
          job_details.description as PDFName,
          company.logo_dir as CompLogo,
          company.name as CompanyName,
          company.contactNo as CompanyContact,
          company.email as CompanyEmail,
          jobseeker_jobdetails.is_scheduled as IsShortlisted,
          scheduled_meetings.meeting_link as MeetingLink,
          scheduled_meetings.meeting_type as MeetingType,
          scheduled_meetings.notes as AdditionalNotes,
          scheduled_meetings.datetime as InterviewDate
      FROM job_seeker
      join user_account ON job_seeker.user_account_id = user_account.id
      join jobseeker_jobdetails on jobseeker_jobdetails.job_seeker_id = job_seeker.id
      join job_details on job_details.id = jobseeker_jobdetails.job_details_id
      join employer on employer.id = job_details.employer_id
      join company on company.id = employer.company_id
      left join scheduled_meetings on scheduled_meetings.job_details_id = job_details.id and scheduled_meetings.job_seeker_id = job_seeker.id
      where user_account.id = $user_id
      order by is_scheduled desc
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
      $is_shortlisted = $row->IsShortlisted;

      if ($is_shortlisted == 'Yes') {
        $interview_invitation = $this->GenerateInvitation($row);
      } else {
        $interview_invitation = "";
      }


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
        "is_shortlisted" => $is_shortlisted,
        "invitation" => $interview_invitation
      );

      array_push($jobrecords, $jobDet);
    }

    $queryCountStatus = $db->query(
      "SELECT COUNT(status) unreadcount
      FROM shared_advert
      WHERE shared_advert.status = 0        
      "
    );

    $countUnread = $queryCountStatus->getRow()->unreadcount;

    $db->close();


    $sharedJobs = $this->ShowNotifications();

    $data = [
      'title' => 'AllData',
      'jobRecords' => $jobrecords,
      'sharedJobs' => $sharedJobs,
      'unreadCount' => $countUnread
    ];

    return $data;
  }


  private function GenerateInvitation($row)
  {
    $jobTitle = $row->JobTitle;
    $companyName = $row->CompanyName;
    $companyNo = $row->CompanyContact;
    $companyEmail = $row->CompanyEmail;
    $meetingLink = $row->MeetingLink;
    $meetingType = $row->MeetingType;
    $additional_notes = $row->AdditionalNotes;
    $interview_date = $row->InterviewDate;

    $timestamp = strtotime($interview_date);
    $date = date('d, M Y', $timestamp);
    $time = date('H:i a', $timestamp);

    $interview_invitation = "You have been selected by <b>$companyName</b> for an Interview for the position of <b>$jobTitle</b>.
    You are required to attend a <b>$meetingType</b> on the <b>$date</b> at </b>$time</b>.";

    if ($meetingType == "Virtual Interview") {
      $temp = "<br><br>You can join the meeting by clicking <a href='$meetingLink' target='_blank'>here</a>";
      $interview_invitation = $interview_invitation . $temp;
    }

    if ($additional_notes == NULL || $additional_notes == "") {
      $additional_notes = "";
    } else {
      $temp2 = "<br><br> <b> Notes: $additional_notes</b>";
      $interview_invitation = $interview_invitation . $temp2;
    }

    return $interview_invitation;
  }


  public function logout()
  {
    $session = session();
    $session->destroy();
    return redirect()->to('Home/index')->with('fail', 'You are Logged out');
  }

  public function ShowNotifications()
  {

    $notificationRecords = array();

    $user_id = session()->get('user_id');

    $db = db_connect();

    $queryNotifications = $db->query(
      "SELECT 
      job_details.id as AdvertID,
      job_details.jobtitle as JobTitle,
      job_details.description as PDFName,
      company.name as CompanyName,
      shared_advert.sender_id as SenderID,
      shared_advert.status as NotificationStatus,
      shared_advert.id as SharedAdID
      from user_account
      join job_seeker on job_seeker.user_account_id = user_account.id
      join shared_advert on shared_advert.receiver_id = job_seeker.id
      join job_details on job_details.id = shared_advert.job_details_id
      join employer on employer.id = job_details.employer_id
      join company on company.id = employer.company_id
      where user_account.id = $user_id
      "
    );

    foreach ($queryNotifications->getResult() as $row) {
      $advert_id = $row->AdvertID;
      $jobTitle = $row->JobTitle;
      $pdfname = $row->PDFName;
      $companyName = $row->CompanyName;
      $senderID = $row->SenderID;
      $noti_status = $row->NotificationStatus;
      $sharedaddid = $row->SharedAdID;

      $querySenderDetails = $db->query(
        "SELECT job_seeker.name from job_seeker
        where job_seeker.id = $senderID
        "
      );

      
      $senderName = $querySenderDetails->getRow()->name;
 
      if ($noti_status == 0) {
        $jobDet = array(
          "advert_id" => $advert_id,
          "jobtitle" => $jobTitle,
          "pdfname" => $pdfname,
          "companyName" => $companyName,
          "senderName" => $senderName,
          "status" => $noti_status,
          "shared_id" => $sharedaddid,
        );
  
        array_push($notificationRecords, $jobDet);
      }
    }



    $db->close();

    $notificationData = [
      'title' => 'AllSharedData',
      'sharedJobs' => $notificationRecords
    ];

    return $notificationData;
  }

  public function RemoveNotification()
  {
    $shared_id = $_POST['shareID'];
    $db = db_connect();
    $db->query(
      "UPDATE shared_advert
       set shared_advert.status = 1
       where shared_advert.id = $shared_id 
      "
    );
    $db->close();
  }
}
