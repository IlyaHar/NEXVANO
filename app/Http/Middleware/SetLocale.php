<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
class SetLocale { public function handle(Request $request, Closure $next) { $locale=session('locale','uk'); app()->setLocale(in_array($locale,['uk','es'],true)?$locale:'uk'); return $next($request); } }
