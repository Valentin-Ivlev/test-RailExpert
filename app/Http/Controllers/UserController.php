<?php

namespace App\Http\Controllers;

use App\Decorators\BaseUser;
use App\Decorators\PhpSkillDecorator;
use App\Decorators\JsSkillDecorator;
use App\Decorators\GolangSkillDecorator;
use App\Decorators\JavaSkillDecorator;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all()->map(function ($user) {
            $skills = ['PHP', 'JS', 'Golang', 'Java'];
            shuffle($skills);
            $decoratedUser = new BaseUser($user);
            foreach (array_slice($skills, 0, rand(1, 4)) as $skill) {
                $skillClass = "App\\Decorators\\{$skill}SkillDecorator";
                $decoratedUser = new $skillClass($decoratedUser);
            }
            $user->description = $decoratedUser->getDescription();
            return $user;
        });

        return response()->json($users);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'regex:/^([0-9]{1,12}|[a-zA-Z]+)$/'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:6'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return response()->json($user, 201);
    }
}
