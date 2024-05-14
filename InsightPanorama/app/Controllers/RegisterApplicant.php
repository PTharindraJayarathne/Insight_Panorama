<?php

namespace App\Controllers;

class RegisterApplicant extends BaseController
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
		return view('RegisterApplicant/index');
	}

  public function createprofile() {
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
      ] ,
      'address' => [
        'rules' => 'required',
        'errors' => [
            'required' => 'Address is Required'
        ]
      ] ,
      'email' => [
        'rules' => 'required|valid_email|is_unique[job_seeker.email]',
        'errors' => [
            'required' => 'Email is Required',
            'valid_email' => 'Must be a valid Email Address',
            'is_unique' => 'Email already exists',
        ]
      ] ,
      'contactNo' => [
        'rules' => 'required',
        'errors' => [
            'required' => 'Contact No is required'
        ]
      ] ,
      'dob' => [
        'rules' => 'required',
        'errors' => [
            'required' => 'Date of Birth is Required'
        ]
      ] ,
      'currentJobTitle' => [
        'rules' => 'required',
        'errors' => [
            'required' => 'Job Position is Required'
        ]
      ] ,
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
      return view('/RegisterApplicant/index', ['validation' => $this->validator]);   
    } else {
      //getting values from form
      $name = $this->request->getPost('name');                    //jobseeker
      $address = $this->request->getPost('address');              //jobseeker
      $email = $this->request->getPost('email');                  //jobseeker
      $contactNo = $this->request->getPost('contactNo');          //jobseeker
      $dob = $this->request->getPost('dob');                      //jobseeker
      $currentJobTitle = $this->request->getPost('currentJobTitle');  //jobseeker
      $username = $this->request->getPost('username');            //useraccount
      $password = $this->request->getPost('password');            //useraccount

      //useraccount table info
      $valuesUser = [
                      'username' => $username,
                      'password' => $password,
                      'type' => "applicant"
        ];

      $userAccountModel = new \App\Models\userAccountModel();
    
      //inserting info to db table
      $queryUser = $userAccountModel->insert($valuesUser);
      if(!$queryUser){
        // return redirect()->back()->with('fail', 'Please try again later..');
      } else {
        // return redirect()->to('Register')->with('success', 'User Registration Successful');
      }

      //jobseeker table info
      $valuesSeeker = [
                        'name' => $name,
                        'address' => $address,
                        'email' => $email,
                        'contactNo' => $contactNo,
                        'dob' => $dob,
                        'currentJobTitle' => $currentJobTitle,
                        'user_account_id' => $queryUser
                      ];

      $jobSeekerModel = new \App\Models\jobSeekerModel();

      //inserting info to db table
      $querySeeker = $jobSeekerModel->insert($valuesSeeker);
      if(!$querySeeker){
        return redirect()->back()->with('fail', 'Please try again later..');
      }
      else{
        return redirect()->to('RegisterApplicant')->with('success', 'User Registration Successful');
      }
    }

  
  }

}
