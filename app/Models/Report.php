<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class Report extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function ImageReport()
    {
        return $this->belongsToMany(ImageReport::class, 'id', 'report_id');
    }

    protected static function booted()
    {
        static::deleting(function ($data) {
            if ($data->ImageReport->report_id) {
                if ($data->ImageReport->report_id && File::exists(public_path('assets/images/reports/' . $data->title))) {
                    File::delete(public_path('assets/images/reports/' . $data->title));
                }
                $data->ImageReport()->delete();
            }
        });
    }
}
