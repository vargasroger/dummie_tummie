<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\UserResource;
use App\User;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Response;

class UserController extends Controller
{
    protected $rules = [
        'first_name' => 'required|string|min:3|max:100',
        'last_name' => 'required|string|min:3|max:100',
        'email' => 'required|email|unique:users,email',
        'password' => 'required'
    ];

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        return view('users.index');
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
        unset($user->password);

        return view('users.edit')->with(compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $this->rules['email'] .= ',' . $user->id;
        unset($this->rules['password']);

        $this->validate($request, $this->rules);

        try {
            DB::beginTransaction();

            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;

            if ($request->has('password')) {
                $user->password = bcrypt($request->password);
            }

            $user->save();

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

    /**
     * Get users for the data table.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function getUsersForDataTable(Request $request)
    {
        $users = User::all();

        return Response::json([
            'columns' => [
                [
                    'label' => trans('validation.attributes.name'),
                    'field' => 'full_name',
                    'filterOptions' => [
                        'enabled' => true, // enable filter for this column
                        'placeholder' => trans('strings.general.search_placeholder'),
                        'trigger' => 'enter',
                    ],
                ],
                [
                    'label' => trans('validation.attributes.email'),
                    'field' => 'email',
                ],
                [
                    'label' => trans('labels.user.profile.created_at'),
                    'field' => 'created_at',
                    'type' => 'date',
                    'dateInputFormat' => 'YYYY-MM-DDTHH:mm:ss',
                    'dateOutputFormat' => 'DD/MM/YY HH:mm ZZ',
                ],
            ],
            'data' => UserResource::collection($users)
        ]);
    }

    public function getTableTranslateArray()
    {
        return Response::json([
            'no_results' => trans('strings.search.no_results'),
            'pagination' => [
                'next' => trans('pagination.next'),
                'prev' => trans('pagination.previous'),
                'of' => trans('pagination.of'),
                'rows_pages' => trans('pagination.rows_page'),
            ]
        ]);
    }

    public function dataGrafico()
    {
        $labels = $values = [];

        $data = DB::table("users")
            ->select(DB::raw("CONCAT(YEAR(created_at), LPAD(MONTH(created_at), 2,'0')) as 'month', COUNT(*) as total_month"))
            ->groupBy(DB::raw("CONCAT(YEAR(created_at), LPAD(MONTH(created_at), 2,'0'))"))
            ->get();
        foreach($data AS $row) {
            $labels[] = Carbon::createFromFormat('Ym', $row->month)->format('m/y');
            $values[] = $row->total_month;
        }

        return [
            'labels' =>$labels,
            'datasets' => [
                [
                    'label' => trans('strings.chart.new_accounts'),
                    'data' => $values,
                ]
            ]
        ];
    }

}
