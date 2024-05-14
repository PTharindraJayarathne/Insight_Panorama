<?php

namespace App\Controllers;

class RegisterEmployer extends BaseController
{
  public function __construct() {
    helper('form');
    helper(['url', 'Registration_helper']);
}

	public function index() {
    if(session()->get('user_id')!= null){
			if(session()->get('user_type') == "employer") {
				return redirect()->to('EmployerHome/index');
			}
			else if(session()->get('user_type') == "applicant") {
				return redirect()->to('ApplicantHome/index');
			}
			
		}
		return view('RegisterEmployer/index');
	}

  public function createProfile() {
    if(session()->get('user_id')!= null){
			if(session()->get('user_type') == "employer") {
				return redirect()->to('EmployerHome/index');
			}
			else if(session()->get('user_type') == "applicant") {
				return redirect()->to('ApplicantHome/index');
			}
			
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
      ] ,
      'jobPosition' => [
          'rules' => 'required',
          'errors' => [
              'required' => 'Job Position is Required'
        ]
      ] ,  
      'email' => [
          'rules' => 'required|valid_email|is_unique[employer.email]',
          'errors' => [
              'required' => 'Email is Required',
              'valid_email' => 'Must be a valid Email Address',
              'is_unique' => 'Email already exists',
        ]
      ] ,
      'cname' => [
          'rules' => 'required|is_unique[company.name]',
          'errors' => [
              'required' => 'Company Name is Required',
              'is_unique' => 'Company Name already Registered'
        ]
      ], 
      'username' => [
          'rules' => 'required|is_unique[user_account.username]',
          'errors' => [
              'required' => 'Username is required',
              'is_unique' => 'This username already exist'
        ]
      ],
      'password' => [
          'rules' => 'required',
          'errors' => [
              'required' => 'Password is Required'
        ] 
      ]
    ]);

    if (!$validation) {
      // echo "Validation Error";
      return view('/RegisterEmployer/index', ['validation' => $this->validator]);   
    }

    else {
      // echo "Validation Success";
      //getting values from form
    $name = $this->request->getPost('name');               //employer
    $contactNo = $this->request->getPost('contactNo');     //employer
    $jobPosition = $this->request->getPost('jobPosition');  //employer
    $email = $this->request->getPost('email');             //employer
    $cname = $this->request->getPost('cname');             //company
    $username = $this->request->getPost('username');       //useraccount
    $password = $this->request->getPost('password');       //useraccount

    //useraccount table info
    $valuesUser = [
                    'username' => $username,
                    'password' => $password,
                    'type' => "employer"
    ];
  
    $userAccountModel = new \App\Models\userAccountModel();
  
    //inserting info to db table
    $queryUser = $userAccountModel->insert($valuesUser);
    if(!$queryUser){
      // return redirect()->back()->with('fail', 'Please try again later..');
    }
    else{
      // return redirect()->to('Register')->with('success', 'User Registration Successful');
    }

    //company table info
    $valuesCom = [
      'name' => $cname
    ];

    $companyModel = new \App\Models\companyModel();
  
    //inserting info to db table
    $queryCom = $companyModel->insert($valuesCom);
    if(!$queryCom){
      // return redirect()->back()->with('fail', 'Please try again later..');
    }
    else{
      // echo $queryCom;
      // return redirect()->to('Register')->with('success', 'User Registration Successful');
    }

    //employer table info
    $valuesEmp = [
      'name' => $name,
      'contactNo' => $contactNo,
      'jobPosition' => $jobPosition,
      'email' => $email,
      'company_id' => $queryCom,
      'user_account_id' => $queryUser
    ];

    $employerModel = new \App\Models\employerModel();

    //inserting info to db table
    $queryEmp = $employerModel->insert($valuesEmp);
    if(!$queryEmp){
      return redirect()->back()->with('fail', 'Please try again later..');
    }
    else{
      return redirect()->to('RegisterEmployer')->with('success', 'User Registration Successful');
    }
    }
    
  }

}
