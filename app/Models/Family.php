<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    use HasFactory;
    protected $primaryKey = "fl_id";
    protected $table = "family_list";
    protected $guarded = [];
    public $timestamps = false;

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'cst_id', 'cst_id');
    }
}
