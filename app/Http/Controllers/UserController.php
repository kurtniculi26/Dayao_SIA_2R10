<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\Response;

class UserController extends Controller
{
    private $request;

    public function __construct(Request $request) {
        $this->request = $request;
    }
    public function index(){
        $users = User::all();
        return response()->json($users, 200);
    }
    public function getUsers(){
        $users = User::all();
        return response()->json($users, 200);
    }
    public function add(Request $request){
        $rules = [
            'username' => 'required|max:20',
            'password' => 'required|max:20',
        ];

        $this->validate($request, $rules);

        $user = User::create($request->all());

        return response()->json($user, 200);
    }
    public function update(Request $request, $id) {
        $user = User::findOrFail($id);

        // Keep the original created_at timestamp
        $originalCreatedAt = $user->created_at;

        $user->update($request->all());

        // Restore the original created_at timestamp
        $user->created_at = $originalCreatedAt;

        // Update the updated_at timestamp
        $user->touch();

        return response()->json($user, 200);
    }
    public function partialUpdate(Request $request, $id){
        $user = User::findOrFail($id);

        // Keep the original created_at timestamp
        $originalCreatedAt = $user->created_at;

        // Update only the specified fields
        $user->update($request->only(['username', 'password']));

        // Restore the original created_at timestamp
        $user->created_at = $originalCreatedAt;

        // Save the changes
        $user->save();

        return response()->json($user, 200);
    }
    public function headUser($id) {
        $user = User::find($id);

        if ($user) {
            // User found
            return response()->json(['message' => 'User found'], 200);
        } else {
            // No such user
            return response()->json(['message' => 'No such user'], 404);
        }
    }
    public function delete($id) {
        $user = User::find($id);

        if ($user) {
            // User found, display message
            $user->delete();
            return response()->json(['message' => 'User has been successfully deleted'], 200);
        } else {
            // No such user, return a 404 response
            return response()->json(['message' => 'No such user'], 404);
        }

        // Proceed with deletion after displaying the message
    }

    public function options(){
        // You can customize the response headers here if needed

        return response('', 200);
    }
    public function show($id) {
        $user = User::findOrFail($id);

        return response()->json($user, 200);
    }
}
