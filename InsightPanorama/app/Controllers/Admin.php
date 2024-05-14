<?php

namespace App\Controllers;

class Admin extends BaseController
{

  public function __construct()
  {
    helper('form');
    helper(['url', 'Login_helper']);
  }

  public function index()
  {
    if(session()->get('admin_id')!= null){
      return redirect()->to('AdminHome/index');
    }
    return view('Admin/index');
  }

  public function login()
  {
    if(session()->get('admin_id')!= null){
      return redirect()->to('AdminHome/index');
    }
    $validation = $this->validate([
      'username' => [
        'rules' => 'required|is_not_unique[user_account.username]',
        'errors' => [
          'required' => 'Username is required',
          'is_not_unique' => 'This username does not exist'
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
      return view('/Admin/index', ['validation' => $this->validator]);
    } else {
      $username = $this->request->getPost('username');
      $password = $this->request->getPost('password');

      $userAccountModel = new \App\Models\userAccountModel();
      $user_info = $userAccountModel->where('username', $username)->first();

      if ($user_info != null && $user_info['password'] == $password && $user_info['type'] == "admin") {
    
    
        session()->set('admin_id', $user_info['id']);

        return redirect()->to("/AdminHome/index")->with('info', 'Login Successful');
      } else {
        session()->setFlashdata('fail', 'Incorrect Password!');
        return redirect()->to('/Admin/index')->withInput();
      
      }
    }
  }
  public function logout()
	{
    if (session()->has('admin_id')) {
      session()->remove('admin_id');
      return redirect()->to('/Admin/index')->with('fail','Logged out');
    }
	}
}