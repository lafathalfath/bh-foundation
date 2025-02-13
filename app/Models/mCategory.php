<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class mCategory extends Model
{
    use HasFactory;
    protected $table = 'm_category';
    protected $guarded = [];

    public function program() : BelongsToMany {
        return $this->belongsToMany(Program::class, 'p_category_program', 'category_id', 'program_id');
    }
}
