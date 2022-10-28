<?php

namespace App\Http\Middleware;

use App\Models\Quiz;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthResource
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        // Check if route has quiz parameter
        if ($request->route('quiz')) {
            $quiz = Quiz::find($request->route('quiz')->id);

            // Check if quiz user_id is the same as the logged-in user.
            if ($quiz && $quiz->user_id != auth()->user()->id) {
                return redirect('/user/quiz');
            }
        }

        if ($request->route('user')) {

            $user = User::find($request->route('user')->id);

            // Check if quiz user_id is the same as the logged-in user.
            if ($user && $user->id != auth()->user()->id) {
                return redirect('/user');
            }
        }

        return $next($request);
    }
}
