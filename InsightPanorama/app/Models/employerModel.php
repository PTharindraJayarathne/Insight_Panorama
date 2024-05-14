<?php

namespace App\Models;

use CodeIgniter\Model;

class employerModel extends Model {
  protected $table = 'employer';
  protected $primaryKey = 'id';
  protected $allowedFields = [
                              'company_id',
                              'user_account_id',
                              'name',
                              'contactNo',
                              'jobPosition',
                              'email'
  ];
}


?>