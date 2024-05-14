<?php

namespace App\Models;

class jobSeekerModel extends \CodeIgniter\Model {
  protected $table = 'job_seeker';
  protected $primaryKey = 'id';
  protected $allowedFields = [
                              'user_account_id',
                              'name',
                              'address',
                              'email',
                              'contactNo',
                              'dob',
                              'currentJobTitle',
                              'cv_file_dir'
                            ];
}


?>