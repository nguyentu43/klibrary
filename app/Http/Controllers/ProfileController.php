<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\User;

class ProfileController extends Controller
{
    public function edit(Request $request)
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'old_password' => ['min:8', 'nullable', function($attribute, $value, $fail) use($user, $request) {
                if($request->filled('old_password') && !Hash::check($value, $user->password))
                {
                    $fail(__('app.user.same_old_password', ['attribute' => $attribute]));
                }
            }],
            'password' => [ Rule::requiredIf($request->filled('old_password')), 'nullable', 'min:8', 'confirmed'],
            'email_approved_list' => [ function($attribute, $value, $fail){
                if(!empty($value))
                {
                    $list = explode(PHP_EOL, $value);
                    foreach($list as $email)
                    {
                        if(!preg_match('/^.+@.+\..+$/', $email))
                            $fail(__('validation.email', [ 'attribute' => $attribute ]));
                    }
                }
            } ]
        ]);

        $data = $request->all();
        foreach($data as $key => $value)
        {
            if(empty($value))
                unset($data[$key]);
        }

        if($request->filled('password')){
            $data['password']= Hash::make($data['password']);
        }

        if(!empty($data['email_approved_list']))
            $data['email_approved_list'] = explode(PHP_EOL, $data['email_approved_list']);

        if($user->update($data))
            return redirect()->route('home')->with('message', __('app.user.messages.update', ['user' => $user->name]));
        return abort(403);
    }
}
