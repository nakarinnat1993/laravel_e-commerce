<?php

namespace App\Http\Middleware;

use Closure;
use App\Category;

class VerifyCategory
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
        if(Category::all()->count()==0){
            session()->flash('error', 'Add category before adding product');
            return redirect('/admin/createCategory');
        }else{
            return $next($request);

        }
    }
}
