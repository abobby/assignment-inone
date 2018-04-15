<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Members extends Model
{
    protected $table = 'members';
    
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'status'
    ];
    
    protected $hidden = [];
    
    public function MemberDetails()
    {
        return $this->hasOne('App\MemberDetails', 'user_id');
    }
}
