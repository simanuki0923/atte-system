<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Attendance extends Model
{
    use HasFactory;

    protected $table = 'attendances'; // Adjusted table name

    protected $fillable = ['user_id', 'clock_in', 'clock_out'];

    public function user()
    {
      return $this->belongsTo(User::class);
    }
}
