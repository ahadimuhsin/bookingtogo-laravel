<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nationality extends Model
{
    use HasFactory;
    protected $primaryKey = "nationality_id";
    protected $table = "nationality";
    protected $guarded = [];
    public $timestamps = false;
}
