<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Program extends Model
{
    use HasFactory;
    protected $table = 'program';
    protected $guarded = [];

    public function type() : BelongsTo {
        return $this->belongsTo(mProgramType::class, 'type_id', 'id');
    }

    public function category() : BelongsToMany {
        return $this->belongsToMany(mCategory::class, 'p_category_program', 'program_id', 'category_id');
    }
}
