<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class mMemberLevel extends Model
{
    use HasFactory;
    protected $table = 'm_member_level';
    protected $guarded = [];

    public function member() : HasMany {
        return $this->hasMany(Member::class, 'level_id', 'id');
    }
}
