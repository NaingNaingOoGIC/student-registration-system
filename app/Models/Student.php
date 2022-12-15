<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use EloquentFilter\Filterable;

class Student extends Model
{
    use HasFactory;
    use Filterable;
    protected $guarded = [];
    public $timestamps = false;
}
