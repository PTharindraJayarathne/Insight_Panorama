<?php

namespace App\Models;

class sharedadvert extends \CodeIgniter\Model {
  protected $table = 'shared_advert';
  protected $primaryKey = 'id';
  protected $allowedFields = [
                              'job_details_id',
                              'sender_id',
                              'receiver_id',
                              'status',
                              'message'
                            ];
}


?>