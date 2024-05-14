<?php

namespace App\Models;

class companyModel extends \CodeIgniter\Model {
  protected $table = 'company';
  protected $primaryKey = 'id';
  protected $allowedFields = [
                              'name',
                              'logo_dir',
                              'contactNo',
                              'email'
                            ];
}


?>