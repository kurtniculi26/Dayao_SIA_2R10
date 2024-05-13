<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\Response;


class UserController extends Controller
{
    use ApiResponser;
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function index()
    {
        $users = User::all();
        return $this->successResponse($users);
    }

    public function getUsers()
    {
        $users = User::all();
        return $this->successResponse($users);
    }

    public function show($id)
    {
        try {
            $user = User::findOrFail($id);
            // User found
            return $this->successResponse($user);
        } catch (ModelNotFoundException $e) {
            // No such user
            return $this->errorResponse('User not found', Response::HTTP_NOT_FOUND);
        }
    }

    public function add(Request $request)
    {
        $rules = [
            'username' => 'required|max:20',
            'password' => 'required|max:20',
            'gender' => 'required|in:Male,Female'
        ];

        $this->validate($request, $rules);

        $user = User::create($request->all());

        return $this->successResponse($user, Response::HTTP_CREATED);
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'username' => 'required|max:20',
            'password' => 'required|max:20',
            'gender' => 'required|in:Male,Female'
        ];

        $this->validate($request, $rules);
        $user = User::findOrFail($id);

        $user->fill($request->all());

        //if there are no changes
        if ($user->isClean()) {
            return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $user->save();
        return $this->successResponse($user);
    }
    
    public function delete($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return $this->successResponse('User deleted successfully');
        } catch (ModelNotFoundException $exception) {
            return $this->errorResponse('User ID does not exist', Response::HTTP_NOT_FOUND);
        }
    }
}
