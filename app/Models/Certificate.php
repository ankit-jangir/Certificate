<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'aadhar',
        'trainer_id',
        'qp_code',
        'grade',
        'issue_date',
        'qr_ref',
        'qr_code_path',
        'certificate_image_path',
    ];
    
}


