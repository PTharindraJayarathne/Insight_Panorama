<?php

namespace App\Models;

class systemAdminModel extends \CodeIgniter\Model {
  protected $table = 'system_admin';
  protected $primaryKey = 'id';
  protected $allowedFields = [
                              'user_account_id',
                              'name'
                            ];
}


?>