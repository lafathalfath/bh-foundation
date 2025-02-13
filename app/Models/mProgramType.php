<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class mProgramType extends Model
{
    use HasFactory;
    protected $table = 'm_program_type';
    protected $guarded = [];

    public function program() : HasMany {
        return $this->hasMany(Program::class, 'type_id', 'id');
    }
}
