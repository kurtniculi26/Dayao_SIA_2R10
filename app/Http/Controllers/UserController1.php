<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Models\User;
    use Illuminate\Http\Response;

    class UserController extends Controller
    {
        private $request;

        public function __construct(Request $request)
        {
            $this->request = $request;
        }

        public function getUsers()
        {
            $users = User::all();
            return response()->json($users, 200);
        }

        public function index()
        {
            $users = User::all();
            return response()->json($users, 200);
        }

        public function add(Request $request)
        {
            $rules = [
                'username' => 'required|max:20',
                'password' => 'required|max:20',
            ];

            $this->validate($request, $rules);

            $user = User::create($request->all());

            return response()->json($user, 200);
        }
    
    }
