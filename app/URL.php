<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class URL extends Model
{
    //
    protected $table = 'url';
	protected $fillable = 
	[
		'url',
		'short_url',
		'svg',
		'user_id'
	];
}
