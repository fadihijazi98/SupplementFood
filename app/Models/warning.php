<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class warning extends Model
{
    use HasFactory;

    protected $table = 'warnings';
    protected $guarded = ['id'];

    public function supplement() {
        return $this->belongsTo(Supplement::class);
    }

}
