<?php

namespace App\Controllers;

class ManageAdmin extends BaseController
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

    return view('AdminManageAdmins/index');
  }

  public function CreateAdministrator()
  {
    $validation = $this->validate([
      'fullname' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Name is Required'
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
      return view('/AdminManageAdmins/index', ['validation' => $this->validator]);
    } else {
      //getting values from form
      $name = $this->request->getPost('fullname');
      $username = $this->request->getPost('username');
      $password = $this->request->getPost('password');


      $db = db_connect();
      $queryAddUserAccount = $db->query(
        "INSERT into user_account (username, password, status, type)
        VALUES ('$username', '$password', 0, 'admin') 
        "
      );

      if ($queryAddUserAccount) {
        $queryGetUID = $db->query(
          "SELECT user_account.id
          from user_account  
          where username = '$username'
          "
        );

        $UID = $queryGetUID->getRow()->id;

        $queryAddAdminDetails = $db->query(
          "INSERT into system_admin (user_account_id, name)
          VALUES($UID, '$name')
          "
        );
        if ($queryAddAdminDetails) {
          return redirect()->to('ManageAdmin')->with('success', 'Admin Registration Successful');
        } else {
          return redirect()->back()->with('fail', 'Please try again later..');
        }
      } else {
        return redirect()->back()->with('fail', 'Please try again later..');
      }
    }
  }

  public function RemoveAdmin() {
    $uid = $this->request->getPost('account_id');
    $db = db_connect();
    $db->query(
      "UPDATE user_account set status = 3 where id = $uid
      "
    );
    $db->close();
    return redirect()->to('ManageAdmin')->with('success2', 'Admin was successfully removed');
  }
}
