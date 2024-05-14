<?php

namespace App\Controllers;

class AdminEmployerProfiles extends BaseController
{
  public function index()
  {
    if(session()->get('user_id')== null){
      return redirect()->to('Home/index')->with('fail', 'You must be logged in..');;
    }
    return view('AdminEmployerProfiles/index');
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
      return redirect()->to("//AdminEmployerProfiles/index")->with('info', 'Changes Made Succesfully');
    }
    //To Reject User--Changing Status to 2    
    if (isset($_POST['ruser'])) {
      $useraccountid = $this->request->getPost('account_id');
      echo $useraccountid;
      $UserAccount = new \App\Models\userAccountModel();
      $query = $UserAccount->query("update user_account set status = 2 where id = $useraccountid");
      return redirect()->to("//AdminEmployerProfiles/index")->with('info', 'Changes Made Succesfully');
    }
    //To Delete User--Changing Status to 3  
    if (isset($_POST['duser'])) {
      $useraccountid = $this->request->getPost('account_id1');
      echo $useraccountid;
      $UserAccount = new \App\Models\userAccountModel();
      $query = $UserAccount->query("update user_account set status = 3 where id = $useraccountid");
      return redirect()->to("//AdminEmployerProfiles/index")->with('info', 'Changes Made Succesfully');
    }
  }
}
