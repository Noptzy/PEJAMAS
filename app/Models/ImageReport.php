<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageReport extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function Report()
    {
        return $this->hasOne(Report::class, 'id', 'report_id');
    }
}
