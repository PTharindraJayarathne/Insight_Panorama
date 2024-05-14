<?php

namespace App\Models;

class jobSeekerJobDetailsModel extends \CodeIgniter\Model {
  protected $table = 'jobseeker_jobdetails';
  protected $allowedFields = [
                              'job_seeker_id',
                              'job_details_id',
                              'dateTime',
                              'cv_name',
                              'is_scheduled'
                            ];
}


?>