<?php

namespace App\Http\Controllers;

use App\CatalogoEstado;
use App\Role;
use App\User;
use App\Session;
use Illuminate\Http\Request;
use App\Http\Requests;
use Validator, Input, Redirect;
use Response;
class UserController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $status = CatalogoEstado::all();
        $roles = Role::all();
        return view('user.index', ['users' => $users, 'status' => $status, 'roles' => $roles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6',
            'user' => 'required|max:255|unique:users',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        $users = $this->create($request->all());
        $users = User::with('roles', 'estados')->findOrFail($users->id);
        return Response::json(array(
            'datos' => $users,
            'response' => ['message' => 'El usuario ha sido registrado', 'title' => 'Éxito'],
        ));
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'last_name' => $data['last_name'],
            'user' => $data['user'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role' => $data['role'],
            'estado_id' => $data['estado_id'],
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return Response::json($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $user->name         = $request->name;
        $user->last_name    = $request->last_name;
        $user->user         = $request->user;
        $user->email        = $request->email;
        $user->password     = bcrypt($request->password);
        $user->role         = $request->role;
        $user->estado_id    = $request->estado_id;

        $user->save();
        $user = User::with('roles', 'estados')->findOrFail($user->id);
        return Response::json(array(
            'datos' => $user,
            'response' => ['message' => 'El usuario ha sido actualizado', 'title' => 'Aviso'],
        ));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
