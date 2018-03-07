<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Attachments extends Model
{
  protected $fillable = [
      'url'
  ];
  //
	public function bids() {
		return $this->belongsTo(Bids::class);
	}
}
