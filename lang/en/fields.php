<?php

use App\Enums\Users\Gender;

return array(
    // User & common column Fields
    'firstname' => 'First name',
    'lastname' => 'Last name',
    'firstname_lastname' => 'Full name',
    'email' => 'Email',
    'login' => 'Login',
    'password' => 'Password',
    'status' => 'Status',

    // Miscellaneous
    'action' => 'Actions',
    'name' => 'Name',
    'title' => 'Title',
    'category' => 'Category',

    'created_at' => 'Created at',
    'updated_at' => 'Updated at',

    'quote_authored' => ' wrote',
    'quote_at' => 'at',

    // Enumerations
    'gender' => array(
        Gender::MALE => 'Male',
        Gender::FEMALE => 'Female',
        Gender::OTHER => 'Other',
    ),

);
