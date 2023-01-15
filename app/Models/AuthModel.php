<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuthModel extends Model
{
    use HasFactory;
    public $table = "users";
    protected $fillable = ['username', 'password', 'fullname', 'level', 'foto','id_divisi', 'color1', 'color2', 'gradient'];
}