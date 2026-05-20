<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class KiemTraChucVu
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, $chuc_vu_bat_buoc): Response
    {
        $quyen_nguoi_dung = $request->input('role');

        if ($quyen_nguoi_dung !== $chuc_vu_bat_buoc) {
            abort(403, 'DAY 2 MIDDLEWARE: Ban khong phai ' . $chuc_vu_bat_buoc . ', Cam truy cap!');   
        }

        return $next($request);
    }
}
