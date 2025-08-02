<?php


namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use LdapRecord\Laravel\Facades\Ldap;
use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;




class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle the authentication attempt (LDAP + local fallback).
     */
    public function store(Request $request)
    {
        $credentials = $request->only(['username', 'password']);


        try {
            // 👇 Attempt manual LDAP bind
            $user = $this-> ldapAuthenticate($credentials);
            //dd($user);
            // ✅ Login the user to Laravel
            if ($user instanceof User) {
                Auth::login($user);
                $request->session()->regenerate();
                return redirect()->intended('/dashboard')->with('success', 'Logged in via LDAP');
            }

        } catch (ModelNotFoundException $e) {
            // ❌ LDAP failed — Try local DB auth
            if (Auth::attempt(['username' => $credentials['username'], 'password' => $credentials['password']])) {
                $request->session()->regenerate();
                return redirect()->intended('/dashboard')->with('success', 'Logged in via Local DB');
            }
        }

        // ❌ All failed
        return back()->withErrors([
            'username' => 'Invalid credentials or user not found.',
        ]);
    }

    public static function ldapAuthenticate($credentials)
{
    $url = env('LDAP_HOST');
    $ldap_port = env('ldap_port'); // Make sure it's capitalized to match .env
    $LDAP_BASE_DN = env('LDAP_BASE_DN');
    $uid = $credentials['username'];
    $password = $credentials['password'];

    $ldapconn = ldap_connect($url, $ldap_port);
    if (!$ldapconn) {
        throw new Exception("LDAP connection failed");
    }

    ldap_set_option($ldapconn, LDAP_OPT_REFERRALS, 0);
    ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);

    $bind_dn = "uid=$uid,ou=people,$LDAP_BASE_DN";
    $ldapbind = ldap_bind($ldapconn, $bind_dn, $password);

    if (!$ldapbind) {
        $error = ldap_error($ldapconn);
        Log::error("LDAP bind failed for $bind_dn: $error");
        throw new ModelNotFoundException("LDAP bind failed: $error");
    }

    $search = ldap_search($ldapconn, $LDAP_BASE_DN, "uid=$uid");
    $info = ldap_get_entries($ldapconn, $search);

    if ($info['count'] == 0) {
        throw new ModelNotFoundException("User not found in LDAP");
    }

    $entry = $info[0];
    $full_name = $entry['cn'][0] ?? $uid;
    $email = $entry['mail'][0] ?? $uid . '@unknown.local';

    // Create or update local user
    $user = User::where('username', $uid)->first();

    if (!$user) {
        $user = new User([
            'username' => $uid,
            'password' => Hash::make($password),
            'name' => $full_name,
            'email' => $email,
        ]);
        $user->save(); // ✅ Save new user
    } else {
        $user->update([
            'name' => $full_name,
            'email' => $email,
            'password' => Hash::make($password),
        ]);
    }

    return $user;
}



    /**
     * Destroy session and logout.
     */
    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
