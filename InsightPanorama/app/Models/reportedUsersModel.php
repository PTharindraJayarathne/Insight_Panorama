<?php

namespace App\Models;

class reportedUsersModel extends \CodeIgniter\Model {
  protected $table = 'reported_accounts';
  protected $primaryKey = 'id';
  protected $allowedFields = [
                              'user_account_id',
                              'reported_user_id',
                              'remarks'
                            ];
}


?>