<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Carbon\Carbon;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'clock_in', 'clock_out'];

    public function user()
    {
      return $this->belongsTo(User::class);
    }

    public function work()
    {
        return $this->hasOne(Work::class);
    }
}
