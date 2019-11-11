<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
	protected $fillable = ['survey_uuid','survey','error'];
    protected $casts = [
        'survey' => 'array',
    ];
}
