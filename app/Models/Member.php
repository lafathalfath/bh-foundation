<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Member extends Model
{
    use HasFactory;
    protected $table = 'member';
    protected $guarded = [];

    public function level() : BelongsTo {
        return $this->belongsTo(mMemberLevel::class, 'level_id', 'id');
    }
}
