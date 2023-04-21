<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Error;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class AuthController extends Controller
{
    public function dashboard()
    {
        $curr_date = Carbon::now()->format('Y-m-d');
        $attendance = Attendance::where('user_id', Auth::user()->id)
            ->where('date', $curr_date)
            ->first();
        // dd($attendance);
        return view('admin.dashboard', compact('attendance'));
    }

    public function register()
    {
        return view('admin.register');
    }

    public function registerStore(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'mobile' => 'required',
            'password' => 'required',
        ]);

        try {
            $user_pic = '';

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'password' => Hash::make($request->password),
                'image' => $user_pic,
            ]);
            if ($user) {
                $user->assignRole('staff');
                return redirect(url('/login'))->with('success', 'User registerd successfully');
            } else {
                return redirect()->back()->with('error', 'User not register successfully');
            }
        } catch (Exception $ex) {
            $url = URL::current();
            Error::create(['url' => $url, 'message' => $ex->getMessage()]);
            return redirect()->back()->with('error', 'Server Error');
        }
    }


    public function index()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {


        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        try {
            if (Auth::attempt($request->only('email', 'password'))) {
                $password = $request->password;
                return redirect(route('admin.dashboard'))->with('success', 'Login Successfully !');
            } else {
                return redirect()->back()->with('error', 'Invalid Email/Password');
            }
        } catch (Exception $ex) {

            $url = URL::current();
            Error::create(['url' => $url, 'message' => $ex->getMessage()]);
            return redirect()->back()->with('error', 'Server Error');
        }
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect()->route('login')->with('success', 'Logout Successfully !');
    }

    public function attendance(Request $request)
    {
        // dd($request->all(), now()->format('H:i:s'), Auth::user()->id);
        try {

            $date = Attendance::where('user_id', Auth::user()->id)->latest()->first();

            if ($date == '') {
                $attendance = Attendance::create([
                    'user_id' => Auth::id(),
                    'clock_in' => now()->format('H:i:s'),
                    'date' => $request->date,
                ]);
                if (isset($attendance)) {
                    return redirect()->route('admin.dashboard')->with('success', 'Your Attendance Clock In Successfully!');
                } else {
                    return redirect()->back()->with('error', 'Your Attendance Not Clock In Successfully!');
                }
            } else {
                if ($request->date == $date->date) {
                    if ($date->clock_out != null) {
                        return redirect()->back()->with('success', 'Your Attendance Alredy Clock Out and Not for Today Clock In Successfully!');
                    } else {
                        $attendance = Attendance::find($date->id)->update([
                            'clock_out' => now()->format('H:i:s'),
                            'date' => $request->date,
                        ]);
                        if (isset($attendance)) {
                            return redirect()->back()->with('success', 'Your Attendance Clock Out Successfully!');
                        } else {
                            return redirect()->back()->with('error', 'Your Attendance Not Clock Out Successfully!');
                        }
                    }
                } else {
                    $attendance = Attendance::create([
                        'user_id' => Auth::user()->id,
                        'clock_in' => now()->format('H:i:s'),
                        'date' => $request->date,
                    ]);
                    if (isset($attendance)) {
                        return redirect()->back()->with('success', 'Your Attendance Clock In Successfully!');
                    } else {
                        return redirect()->back()->with('error', 'Your Attendance Not Clock In Successfully!');
                    }
                }
            }
        } catch (Exception $ex) {

            $url = URL::current();
            Error::create(['url' => $url, 'message' => $ex->getMessage()]);
            return redirect()->back()->with('error', 'Server Error');
        }
    }
}
