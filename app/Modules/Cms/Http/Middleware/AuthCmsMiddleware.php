<?php

namespace App\Modules\Cms\Http\Middleware;

use App\Common\Untils\Regular;
use Illuminate\Http\Request;
use Closure;

class AuthCmsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->guard(Regular::PREFIX_CMS)->check()) {
            return redirect('cms/login');
        }
        return $next($request);
    }
}
