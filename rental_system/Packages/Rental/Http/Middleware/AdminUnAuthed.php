<?php

namespace Rental\Http\Middleware;

use Closure;

class AdminUnAuthed
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
         * ログイン中なら、トップにリダイレクト
         */
        if (\Auth::guard('admin')->check()) {
            return redirect('/admin/index_all/');
        }

        return $next($request);
    }
}
