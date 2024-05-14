<?php

namespace App\Controllers;

class EmployerHome extends BaseController
{
  public function __construct()
  {
    helper('form');
    helper(['url', 'Login_helper']);
  }
  public function index()
  {
    if (session()->get('user_id') == null || session()->get('user_type') == "applicant") {
      return redirect()->to('Home/index')->with('fail', 'You must be logged in..');;
    }
    $session = session();
    $session->regenerate();
    $user_id = session()->get('user_id');
    $UserAccount = new \App\Models\userAccountModel();
    $EmployerM = new \App\Models\employerModel();
    $CompanyM = new \App\Models\companyModel();
    $user_info = $UserAccount->where('id', $user_id)->first();

    $query_employer = $EmployerM->query("Select * from employer where user_account_id = $user_id");
    foreach ($query_employer->getResult() as $row) {
      $companyid = $row->company_id;
    }
    // echo $companyid;

    $query_company = $CompanyM->query("Select * from company where id = $companyid");
    foreach ($query_company->getResult() as $row2) {
      $companyemail = $row2->email;
    }
    // echo $companyname;
    if ($user_info['status'] == 0 || $companyemail == null) {
      return view('MyProfileEmployer/index');
    }

    return view('EmployerHome/index');
  }

  public function logout()
  {
    $session = session();
    $session->destroy();
    return redirect()->to('Home/index')->with('fail', 'You are Logged out');
  }
}
