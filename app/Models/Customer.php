<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $primaryKey = "cst_id";
    protected $table = "customer";
    protected $guarded = [];
    public $timestamps = false;

    public function nationality()
    {
        return $this->belongsTo(Nationality::class, 'nationality_id', 'nationality_id');
    }

    public function families()
    {
        return $this->hasMany(Family::class, 'cst_id', 'cst_id');
    }
}
