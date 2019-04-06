<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Discussion;
use App\Channel;
use Illuminate\Pagination\Paginator;

class ForumController extends Controller
{
    public function index()
    {
        //$discussions = Discussion::orderBy('created_at', 'desc')->paginate(3);

        switch (request('filter')) {
            case 'me':
                $results = Discussion::where('user_id', Auth::id())->paginate(10);
                break;

            case 'solved':
                $answered = [];

                foreach (Discussion::all() as $d) {
                    if ($d->hasBestAnswer()) {
                        array_push($answered, $d);
                    }
                }
                $results = new Paginator($answered, 10);
                break;

            case 'unsolved':
                $unanswered = [];

                foreach (Discussion::all() as $d) {
                    if (!$d->hasBestAnswer()) {
                        array_push($unanswered, $d);
                    }
                }
                $results = new Paginator($unanswered, 10);
                break;

            default:
                $results = Discussion::orderBy('created_at', 'desc')->paginate(10);
                break;
        }

        return view('forum', ['discussions' => $results]);
    }
    public function channel($slug)
    {
        $channel = Channel::where('slug', $slug)->first();

        return view('channel', ['discussions' => $channel->discussions()->paginate(5)]);
    }
}
