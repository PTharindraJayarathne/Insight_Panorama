<?php

namespace App\Models;

class userAccountModel extends \CodeIgniter\Model {
  protected $table = 'user_account';
  protected $primaryKey = 'id';
  protected $allowedFields = [
                              'username',
                              'password',
                              'status',
                              'type'
                            ];
}


?>