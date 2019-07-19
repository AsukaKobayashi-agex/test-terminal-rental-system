<?php

namespace Rental\Http\Middleware;

use Closure;

class UserAuthed
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /*
         * 未ログインなら、ログインフォームにリダイレクト
         */
        if (!\Auth::guard('user')->check()) {
            return redirect('/login/');
        }

        return $next($request);
    }
}
