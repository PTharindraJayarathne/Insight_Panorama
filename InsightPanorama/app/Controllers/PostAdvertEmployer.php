<?php

namespace App\Controllers;

class PostAdvertEmployer extends BaseController
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
    return view('PostAdvertEmployer/index');
  }

  public function PostAdvert()
  {
    if(session()->get('user_id') == null){
      return redirect()->to('Home/index')->with('fail', 'You must be logged in..');;
     
    }

    session();
    session()->regenerate();
    $user_id = session()->get('user_id');
    $userM = new \App\Models\userAccountModel();
    $EmployerM = new \App\Models\employerModel();
    $CompanyM = new \App\Models\companyModel();
    $employer_info = $EmployerM->where('user_account_id', $user_id)->first();
    
    $query_user = $userM->query("Select * from user_account where id = $user_id");
    foreach ($query_user->getResult() as $row6) {
      $user_status = $row6->status;
          if($user_status == 0 || $user_status == 2 || $user_status == 3){
          return redirect()->back()->with('fail', 'You profile is still being verified by our team. Try again later.');}
        
      }




    $query_employer = $EmployerM->query("Select * from employer where user_account_id = $user_id");
    foreach ($query_employer->getResult() as $row) {
      $company_id = $row->company_id;
      $emp_id = $row->id;
      $company_query = $CompanyM->query("Select * from company where id = $company_id");
        foreach($company_query->getResult() as $row2){
          $imgname = $row2->logo_dir; 
          $companyemail = $row2->email;
          $companyContact = $row2->contactNo;
          if($imgname == null || $companyemail == null || $companyContact == null){
          return redirect()->back()->with('fail', 'Please provide your Company Details before posting a Job Advertisement');}
        }
      }


     $validation = $this->validate([
      'jobtitle' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Job Title is Required'
        ]
      ],
      'jobCategory' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Job Title is Required'
        ]
      ],
      'closingDate' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Closing date is Required',0
        ]
      ],
      'experience' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Experience is required'
        ]
      ],
      'typeOfEmployment' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'A type of employment is Required'
        ]
      ],
      'description' => [
        'rules' => 'uploaded[description]|max_size[description, 5000]|ext_in[description,pdf]',
        'errors' => [
          'uploaded' => 'A pdf is Required',
          'max_size' => 'File size too large',
          'ext_in' => 'Invalid file format'
        ]
      ],
     ]);

    if (!$validation) {

      return view('/PostAdvertEmployer/index', ['validation' => $this->validator]);

    } else {

     


      $employer_id = $emp_id;
      $jobTitle = $this->request->getPost('jobtitle');
      $jobCategory = $this->request->getPost('jobCategory');
      $jobLocation = $this->request->getPost('jobLocation');
      $salary = $this->request->getPost('salary');
      $closingdate = $this->request->getPost('closingDate');
      $experience = $this->request->getPost('experience');
      $typeOfEmployment = $this->request->getPost('typeOfEmployment');
      $description = $this->request->getFile('description');
      $pdfname = $description->getRandomName();
       if ($description->isValid() && !$description->hasMoved()) {
              
               $description->move('adverts/', $pdfname);}
     
       
       $status = 0;

       $valuesAdvert = [
         'jobtitle' => $jobTitle,
        'employer_id'=> $employer_id,
        'jobCategory'=> $jobCategory,
        'location' => $jobLocation,
        'salary' => $salary,
        'closingDate'=> $closingdate,
        'experience'=> $experience,
        'typeOfEmployment' => $typeOfEmployment,
        'description'=> $pdfname,
       
        'status' => $status
];

         $newAdvert = new \App\Models\jobDetailsModel();

         $queryEmp = $newAdvert->insert($valuesAdvert);
         if(!$queryEmp){
      return redirect()->back()->with('fail', 'Please try again later..');
    }
    else{
      return redirect()->to('PostAdvertEmployer')->with('success', 'Advertisement is queued for verification');
    }


      }








}

  public function logout()
  {
    $session = session();
    $session->destroy();
    return redirect()->to('Home/index')->with('fail', 'You are Logged out');
  }
}
