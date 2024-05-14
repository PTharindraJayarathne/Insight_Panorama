<?php

namespace App\Controllers;

class AdminApplicantProfiles extends BaseController
{
  public function index()
  {
    if(session()->get('user_id')== null){
      return redirect()->to('Home/index')->with('fail', 'You must be logged in..');;
    }
    return view('AdminApplicantProfiles/index');
  }
  public function verify()
  {
    if(session()->get('user_id')== null){
      return redirect()->to('Home/index')->with('fail', 'You must be logged in..');;
    }
    //To Accept User--Changing Status to 1
    if (isset($_POST['auser'])) {
      $useraccountid = $this->request->getPost('account_id');
      echo $useraccountid;
      $UserAccount = new \App\Models\userAccountModel();
      $query = $UserAccount->query("update user_account set status = 1 where id = $useraccountid");
      return redirect()->to("//AdminApplicantProfiles/index")->with('info', 'Changes Made Succesfully');
    }
    //To Reject User--Changing Status to 2    
    if (isset($_POST['ruser'])) {
      $useraccountid = $this->request->getPost('account_id');
      echo $useraccountid;
      $UserAccount = new \App\Models\userAccountModel();
      $query = $UserAccount->query("update user_account set status = 2 where id = $useraccountid");
      return redirect()->to("//AdminApplicantProfiles/index")->with('info', 'Changes Made Succesfully');
    }
    //To Delete User--Changing Status to 2    
    if (isset($_POST['duser'])) {
      $useraccountid = $this->request->getPost('account_id1');
      echo $useraccountid;
      $UserAccount = new \App\Models\userAccountModel();
      $query = $UserAccount->query("update user_account set status = 3 where id = $useraccountid");
      return redirect()->to("//AdminApplicantProfiles/index")->with('info', 'Changes Made Succesfully');
    }
  }


  public function GetAllReports() {
    $applicant_id = $_POST['applicant_uid'];
    $complaintsArray = array();
    $db = db_connect();
    $queryReports = $db->query(
      "SELECT reported_accounts.remarks FROM `reported_accounts`
      WHERE user_account_id = $applicant_id
      "
    );

    foreach ($queryReports->getResult() as $row) {
      $complaint = $row->remarks;
      array_push($complaintsArray, $complaint);
    }

    $db->close();

    $db->close();
    echo json_encode($complaintsArray);
  }

  public function DeactivateAccount() {
    $applicant_uid = $_POST['applicant_uid'];

    $db = db_connect();
    $deactivateAccount = $db->query(
      "UPDATE job_seeker
      join user_account on user_account.id = job_seeker.user_account_id
      set user_account.status = 5
      where user_account.id = $applicant_uid
      "
    );

    if($deactivateAccount) {
      echo json_encode( array("result" => '1'));
    }
    else {
      echo json_encode( array("result" => '2'));
    }
  }
}
