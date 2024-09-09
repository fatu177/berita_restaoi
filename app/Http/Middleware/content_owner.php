<?php

namespace App\Http\Middleware;

use App\Models\post;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class content_owner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if ($request->user()->id == post::findorfail($request->id)->user_id) {
            return $next($request);
        } else {
            return response()->json(
                ['message' => 'You are not the owner of this post'],
                403
            );
        }
    }
}
