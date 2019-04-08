<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogSessions extends Model
{

    protected $fillable = [
        'ip',
        'user_agent',
        'user_id',
    ];

    /**
     *
     * The user for this session
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {

        return $this->belongsTo('App\User');
    }

}
