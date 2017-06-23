<?php

namespace App;

 

class Ad extends Model
{
    
   
    public function by()
    {
    	$this->user_id = $user ->id;

    }

    public function user()
    {
         return $this->belongsTo(User::class);
    }
}
