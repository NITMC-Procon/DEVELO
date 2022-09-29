<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RecordIPAdress
{
    public function handle(Request $request,Closure $next)
    {
        $ipAddres = $request->ip();
        $path = $request->path();
        print("<p>IP:".$ipAddres.",path:".$path."</p>");
        return $next($request);
    }
}