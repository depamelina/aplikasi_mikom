<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleModel extends Model
{
    use HasFactory;
    public $table = "schedule";
    protected $fillable = ['id', 'username', 'date', 'time', 'in_date', 'out_date'];
}