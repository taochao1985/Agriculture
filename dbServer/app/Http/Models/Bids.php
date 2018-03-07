<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Bids extends Model
{
    protected $fillable = [
        'name', 'cate_id', 'user_id', 'description', 'start_date', 'start_time', 'end_date', 'end_time'
    ];
    //
	public function attachments() {
		return $this->hasMany(Attachments::class);
	}

    public function addAttachment($url){
        $this->attachments()->create(['url' => $url]);
    }
		
		public function user(){
        return $this->belongsTo(User::class);
    }
}
