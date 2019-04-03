<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \App\Http\Controllers\Controller;
use App\User;

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
        $this->middleware(['auth']);
    }

    public function index()
    {
        $users = User::orderBy('first_name', 'asc')
                    ->orderBy('last_name', 'asc')
                    ->paginate(10);

        return view('users.index')->with(compact('users'));
    }

    public function create()
    {
        $user = new User;

        return view('users.create')->with(compact('user'));
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

            return redirect()->route('users.index')->with([
                'message' => [
                    'content' => "Usuário inserido.",
                    'class' => 'success'
                ]
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function show(User $user)
    {
        return view('users.show')->with(compact('user'));
    }

    public function edit(User $user)
    {
        return view('users.edit')->with(compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $this->rules['email'] .= ',' . $user->id;

        $this->validate($request, $this->rules);

        try {
            DB::beginTransaction();

            $user->update($request->all());

            DB::commit();

            return redirect()->route('users.index')->with([
                'message' => [
                    'content' => "Informações do usuário atualizadas.",
                ]
            ]);
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

            return redirect()->route('users.index')->with([
                'message' => [
                    'content' => "Usuário deletado.",
                ]
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
}
