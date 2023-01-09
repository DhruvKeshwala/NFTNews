<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use App\Models\Tournaments;
use App\Models\Matches;
use App\Models\Players;
use App\Models\Team;
use Hash;
use DB;

class AuthController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        return view('auth.login');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function registration()
    {
        return view('auth.registration');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('siteadmin/news')
                ->withSuccess('You have Successfully loggedin');
        }

        return redirect("siteadmin/login")->with('error', 'Oppes! You have entered invalid credentials');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postRegistration(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $data = $request->all();
        $check = $this->create($data);

        return redirect("dashboard")->withSuccess('Great! You have Successfully loggedin');
    }

    public function changePassword()
    {
        return view('changePassword');
    }

    public function save_changePassword(Request $request)
    {

        //validation
        $request->validate([
            'newPassword' => 'required',
            'confirmPassword' => 'required',
        ]);

        $request->only([
            'newPassword',
            'confirmPassword',
        ]);

        $data['newPassword'] = $request->newPassword;
        $data['confirmPassword'] = $request->confrimPassword;

        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->newPassword)
        ]);

        // $result = Auth::create($data);
        return json_encode(['success' => 1, 'message' => 'Password Changed Successfully']);
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function dashboard()
    {
        return view('dashboard');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function logout()
    {
        Session::flush();
        Auth::logout();

        return Redirect('siteadmin/login');
    }

    public function updateSettings()
    {
        $settings = DB::table('settings')->where('id', 1)->first();
        return view('updateSettings', compact('settings'));
    }

    public function updateAdminSettings(Request $request)
    {
        //validation
        $request->validate([
            'facebook' => 'required',
            'twitter' => 'required',
            'instagram' => 'required',
            'linkedin' => 'required',
            'youtube' => 'required',
            'email' => 'required',
        ]);

        $request->only([
            'facebook',
            'twitter',
            'instagram',
            'linkedin',
            'youtube',
            'email',
        ]);

        $data = [
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'instagram' => $request->instagram,
            'linkedin' => $request->linkedin,
            'youtube' => $request->youtube,
            'email' => $request->email
        ];

        #Update settings
        DB::table('settings')->where('id', 1)->update($data);
        return json_encode(['success' => 1, 'message' => 'Settings Updated Successfully']);
    }
}