<?php

namespace App\Models;

class jobDetailsModel extends \CodeIgniter\Model {
  protected $table = 'job_details';
  protected $primaryKey = 'id';
  protected $allowedFields = [
                              'employer_id',
                              'jobCategory',
                              'salary',
                              'closingDate',
                              'experience',
                              'typeOfEmployment',
                              'description',
                              'dateTime',
                              'status',
                              'jobtitle',
                              'location'
                            ];
}


?>