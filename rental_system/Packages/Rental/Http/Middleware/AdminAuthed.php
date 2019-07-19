<?php

namespace Rental\Http\Middleware;

use Closure;

class AdminAuthed
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
        if (!\Auth::guard('admin')->check()) {
            return redirect('/admin/login/');
        }

        return $next($request);
    }
}
