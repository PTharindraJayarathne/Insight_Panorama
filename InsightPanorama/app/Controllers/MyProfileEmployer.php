<?php

namespace App\Controllers;

class MyProfileEmployer extends BaseController
{
  public function __construct()
  {
    helper('form');
    helper(['url', 'Login_helper']);
  }
  
  public function index()
  {
    if(session()->get('user_id')== null || session()->get('user_type')== "applicant"){
      return redirect()->to('Home/index')->with('fail', 'You must be logged in..');;
    }
    return view('MyProfileEmployer/index');
   
  }

  
  public function editProfile()
  {

    if(session()->get('user_id')== null || session()->get('user_type')== "applicant"){
      return redirect()->to('Home/index')->with('fail', 'You must be logged in..');;
    }

    $validation = $this->validate([
      'name' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Name is Required'
        ]
      ],
      'contactNo' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Contact No is required'
        ]
      ],
      'jobPosition' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Job Position is Required'
        ]
      ],
      'email' => [
        'rules' => 'required|valid_email',
        'errors' => [
          'required' => 'Email is Required',
          'valid_email' => 'Must be a valid Email Address'
        ]
      ],
      'username' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Username is required'
        ]
      ],
      'password' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Password is Required'
        ]
      ],
      'cname' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Company Name is Required',
          'is_unique'=> 'This Company is already registered'
        ]
      ],
      'ccontactNo' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Company Contact No is Required'
        ]
      ],
      'cemail' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Company Email is Required'
        ]
      ],
       'logo' => [
         'rules' => 'max_size[logo, 5000]|ext_in[logo,jpg,png,jpeg]',
         'errors' => [
           'ext_in' => 'Invalid File format'
         ]
      ]
    ]);

    if (!$validation) {
      //echo "Validation Error";
      return view('/MyProfileEmployer/index', ['validation' => $this->validator]);
    }
    else {
      $name = $this->request->getPost('name');
      $contactNo = $this->request->getPost('contactNo');
      $jobPosition = $this->request->getPost('jobPosition');
      $email = $this->request->getPost('email');
      $username = $this->request->getPost('username');
      $password = $this->request->getPost('password');
      $cname = $this->request->getPost('cname');
      $ccontactNo = $this->request->getPost('ccontactNo');
      $cemail = $this->request->getPost('cemail');
      $imgfile = $this->request->getFile('logo');

      session();
      session()->regenerate();
      $user_id = session()->get('user_id');
      // echo $user_id;

     

      $logo_dir = $imgfile->getRandomName();
      if ($imgfile->isValid() && !$imgfile->hasMoved()) {
        $imgfile->move('logo/', $logo_dir);
      }
      
      
      $UserAccountM = new \App\Models\userAccountModel();
     
      $queryUser = $UserAccountM->query("Update user_account
                                          Set username = '$username',
                                              password = '$password'
                                          Where id = $user_id");
      if(!$queryUser) {
        //echo "fail";
      }
      $EmployerM = new \App\Models\employerModel();
      $CompanyM = new \App\Models\companyModel();
      $query_employer = $EmployerM->query("Select * from employer where user_account_id = $user_id");
      foreach ($query_employer->getResult() as $row) {
        $companyid = $row->company_id;
        
      }
      

      
     
      $queryCom = $CompanyM->query("Update company
                                    Set name = '$cname',
                                        contactNo = '$ccontactNo',
                                        email = '$cemail',
                                        logo_dir = '$logo_dir'
                                    Where id = '$companyid'");
      if(!$queryCom){
        //echo "fail";
      }

     
    
      $queryEmp = $EmployerM->query("Update employer
                                      Set name = '$name',
                                          contactNo = $contactNo,
                                          jobPosition = '$jobPosition',
                                          email = '$email'
                                      Where user_account_id = $user_id");
      if(!$queryEmp){
        return redirect()->back()->with('fail', 'Please try again later..');
      }
      else {
        return redirect()->to('MyProfileEmployer')->with('success', 'Changes made successfully');
      }

    }
    
  }

  public function deleteProfile()
  {
      session();
      session()->regenerate();
      $user_id = session()->get('user_id');

      $UserAccountM = new \App\Models\userAccountModel();
      $queryuser = $UserAccountM->query("Update user_account
                                          Set status = 3 
                                          where id = $user_id");
       return redirect()->to('Home/logout')->with('fail', 'Your Profile is deleted');;
      if (!$queryuser) {
        //echo "fail";
      

    }



  }
}
