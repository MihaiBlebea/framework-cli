<?php

namespace App\Models;

use Framework\Models\Model;

class User extends Model
{
    protected $table = 'exemple_table';
    public $tableKey = "id";
    public $id;
    public $regdate;
    public $first_name;
    public $last_name;

}
