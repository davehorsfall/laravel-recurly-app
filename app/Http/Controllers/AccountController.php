<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AccountController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show()
    {
        $page_num = isset($_GET['page']) ? (int) $_GET['page'] : 0;
        $per_page = 5;

        $options = [
            'params' => [
              'state' => 'active',
            ]
          ];

        $client = new \Recurly\Client(env('RECURLY_PRIVATE_API_KEY'));

        try {
            //$account = $client->getAccount('code-'. Auth::id());
            $account = $client->getAccount('code-62');
            $active_subscriptions = $client->listAccountSubscriptions($account->getId(), $options);
            $active = ($active_subscriptions->getCount() > 0) ? $active_subscriptions->getFirst()->getPlan() : false;
            $subscriptions = $client->listAccountSubscriptions($account->getId());
        } catch (\Recurly\Errors\Validation $e) {
            $account = false;
            $active = false;
            $subscriptions = false;
        } catch (\Recurly\Errors\NotFound $e) {
            $account = false;
            $active = false;
            $subscriptions = false;
        } catch (\Recurly\RecurlyError $e) {
            $account = false;
            $active = false;
            $subscriptions = false;
        }

        return view('auth.account')->with('active', $active)->with('subscriptions', $subscriptions);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('auth.edit')->with('user', Auth::user());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if (!$user = User::find(Auth::user()->id)) {
            $request->session()->flash('error', 'There was a problem updating your account');
            return redirect(route('account.show'));
        }

        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email:rfc,dns|unique:users,email,' . $user->id,
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        if ($user->save()) {
            $request->session()->flash('success', 'Your account has been updated');
        } else {
            $request->session()->flash('error', 'There was a problem updating your account');
        }

        return redirect()->route('account.show');
    }  
}
