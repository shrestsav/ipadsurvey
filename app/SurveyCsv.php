<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SurveyCsv extends Model
{
    protected $fillable = [
    	'survey_uuid',
		'ipad_udid',
		'section_group',
		'section',
		'question',
		'answer'
	];
}
