<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \App\Http\Controllers\Controller;
use App\User;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserCollection;

class UserController extends Controller
{
    protected $rules = [
        'first_name' => 'required|string|min:3|max:100',
        'last_name' => 'required|string|min:3|max:100',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6'
    ];

    public function __construct()
    {
        // $this->middleware(['api']);
    }

    public function index()
    {
        $users = User::orderBy('first_name', 'asc')
                    ->orderBy('last_name', 'asc')
                    ->paginate(10);

        return new UserCollection($users);
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->rules);

        try {
            DB::beginTransaction();

            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);

            DB::commit();

            return new UserResource($user);
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function show(User $user)
    {
        return new UserResource($user);
    }

    public function update(Request $request, User $user)
    {
        $this->rules['email'] .= ',' . $user->id;

        $this->validate($request, $this->rules);

        try {
            DB::beginTransaction();

            $user->update($request->all());

            DB::commit();

            return new UserResource($user);
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function destroy(User $user)
    {
        try {
            DB::beginTransaction();

            $user->delete();

            DB::commit();

            return new UserResource($user);
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
}
