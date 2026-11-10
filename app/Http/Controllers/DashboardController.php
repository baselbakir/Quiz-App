<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // هنا يمكن إضافة منطق لجلب البيانات التي ترغب في عرضها في الـ Dashboard
        return view('dashboard');  // اسم العرض (الـ View) الذي سيظهر
    }
}
