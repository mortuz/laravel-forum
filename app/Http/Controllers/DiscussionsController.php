<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Session;
use App\Discussion;
use App\Reply;
use App\User;
use Notification;

class DiscussionsController extends Controller
{
    //

    public function create()
    {
        return view('discussion');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'channel_id' => 'required'
        ]);

        $discussion = Discussion::create([
            'title' => $request->title,
            'content' => $request->content,
            'channel_id' => $request->channel_id,
            'user_id' => Auth::id(),
            'slug' => str_slug($request->title)
        ]);

        Session::flash('success', 'Discussion successfully created.');

        return redirect()->route('discussion', ['slug' => $discussion->slug]);
    }

    public function show($slug)
    {
        $discussion = Discussion::where('slug', $slug)->first();

        $best_answer = $discussion->replies()->where('best_answer', 1)->first();

        return view('discussions.show')->with('discussion', $discussion)->with('best_answer', $best_answer);
    }

    public function reply($id)
    {
        $request = request();

        $this->validate($request, [
            'reply' => 'required',
        ]);

        $d = Discussion::find($id);

        $watchers = [];

        foreach ($d->watchers as $watcher) :
            array_push($watchers, User::find($watcher->user_id));
        endforeach;

        Notification::send($watchers, new \App\Notifications\NewReplyAdded($d));

        $reply = Reply::create([
            'content' => $request->reply,
            'discussion_id' => $id,
            'user_id' => Auth::id()
        ]);

        $reply->user->points += 25;
        $reply->user->save();

        Session::flash('success', 'Reply successfully posted.');
        return redirect()->back();
    }

    public function edit($slug)
    {
        return view('discussions.edit')->with('discussion', Discussion::where('slug', $slug)->first());
    }

    public function update($id)
    {
        $this->validate(request(), [
            'content' => 'required'
        ]);

        $d = Discussion::find($id);
        $d->content = request()->content;

        $d->save();

        Session::flash('success', 'Your question has been updated.');
        return redirect()->route('discussion', ['d' => $d->slug]);
    }
}
