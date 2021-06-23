<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class ownerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
      if(Auth::user()->level == "2"){
          /*
          silahkan modifikasi pada bagian ini
          apa yang ingin kamu lakukan jika rolenya tidak sesuai
          */
          return $next($request);
      } else if (Auth::user()->level == "4"){
        return $next($request);
      }
      return redirect()->back();
    }
}
