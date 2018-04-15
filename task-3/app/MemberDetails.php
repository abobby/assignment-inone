<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MemberDetails extends Model
{
    protected $table = 'member_details';
    
    protected $fillable = [
        'user_id',
        'birth_date',
        'country',
        'about_you',
    ];
    
    protected $hidden = [];
    
    public function members()
    {
        return $this->belongsTo('App\Members', 'user_id');
    }
}
