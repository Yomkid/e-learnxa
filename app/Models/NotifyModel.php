<?php

namespace App\Models;
use CodeIgniter\Model;

class NotifyModel extends Model
{
    protected $table = 'notify_list';
    protected $primaryKey = 'id';
    protected $allowedFields = ['email'];
}
