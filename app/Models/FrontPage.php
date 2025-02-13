<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FrontPage extends Model
{
    use HasFactory;
    protected $table = 'front_page';
    protected $guarded = [];
}
