<?php

namespace App\Models;

use CodeIgniter\Model;

class Users extends Model
{
    protected $table = 'users'; // Specify the table name

    protected $primaryKey = 'user_id'; // Specify the primary key

    protected $allowedFields = [
        'first_name',
        'last_name',
        'other_name',
        'username',
        'email',
        'phone_number',
        'registration_number',
        'gender',
        'password_hash',
        'activation_key',
        'role_id',
        'student_type',
        'profile_picture',
        'bio',
        'payment_status',
        'amount_paid',
        'payment_confirmation_code',
        'status',
        'state_id',
        'country_id',
        'address',
        'created_at',
        'updated_at',
        'last_login_date' 
    ];

    protected $useTimestamps = true; // Enable automatic timestamps

    protected $createdField = 'created_at'; // Specify the created_at field

    protected $updatedField = 'updated_at'; // Specify the updated_at field

    protected $validationRules = []; // Validation rules

    protected $validationMessages = []; // Validation messages

    protected $skipValidation = false; // Skip validation by default
}
