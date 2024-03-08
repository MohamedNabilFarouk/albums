<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\OrderRecommendation;
use App\Recommendation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;use Illuminate\Support\Facades\DB;
class DashboardController extends Controller
{
    //
    public function index(){
    
        return view('admin.dashboard');
    }
    
    public function loginadmin(Request $request)
    {
        $password= $request->input('password');
        if (Auth::attempt(['email' => $request->input('identify') , 'password'=> $password])) {
            return redirect(url('admin/dashboard'))->with('message','تم الدخول بنجاح');
        }
        return redirect()->route('login')->with(['error' => 'هناك خطا بالبيانات']);
    }

}
