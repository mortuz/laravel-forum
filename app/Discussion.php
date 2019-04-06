<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Discussion extends Model
{
    protected $fillable = [ 'title', 'slug', 'content', 'user_id', 'channel_id'];

    public function channel()
    {
        return $this->belongsTo('App\Channel');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function replies()
    {
        return $this->hasMany('App\Reply');
    }

    public function likes()
    {
        return $this->hasMany('App\Like');
    }

    public function watchers()
    {
        return $this->hasMany('App\Watcher');
    }

    public function is_being_watched_by_user()
    {
        $id = Auth::id();

        $watchers_ids = [];

        foreach ($this->watchers as $w) {
            array_push($watchers_ids, $w->user_id);
        }

        return in_array($id, $watchers_ids);
    }

    public function hasBestAnswer()
    {
        $result = false;

        // dd($this->replies());
        foreach ($this->replies as $reply) {
            if ($reply->best_answer == 1) {
                $result = true;
                break;
            }
        }
        return $result;
    }
}
