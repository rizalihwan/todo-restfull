<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    public function store()
    {
        $this->validate(request(), [
            'name' => 'required|min:3',
            'username' => 'required|min:3|unique:users,username',
            'password' => ['required', Password::min(8)->letters()->mixedCase()->numbers()->symbols()],
        ]);
        $user = User::create([
            'name' => request('name'),
            'username' => request('username'),
            'password' => bcrypt(request('password'))
        ]);
        return new UserResource($user);
    }
}
