<?php

namespace App\Models;

class scheduledmeetingsmodel extends \CodeIgniter\Model {
  protected $table = 'scheduled_meetings';
  protected $primaryKey = 'id';
  protected $allowedFields = [
                              'job_details_id',
                              'job_seeker_id',
                              'meeting_link',
                              'meeting_type',
                              'notes',
                              'status',
                              'datetime',
                              'created_datetime',
                            ];
}


?>