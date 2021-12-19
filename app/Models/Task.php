<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;


        /**
         * Get the user that owns the Task
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        public function user(): BelongsTo
        {
            return $this->belongsTo('App\Models\User');
        }
    
}
