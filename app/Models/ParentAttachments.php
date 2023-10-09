<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentAttachments extends Model
{
    use HasFactory;

    public $fillable =[
        'file_name',
        'parent_id'
    ];
}
