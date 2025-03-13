<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function index() {
        return User::select(
            'id',
            'name',
            'company',
            'email',
            'phone',
            'created_at',
            'updated_at'
        )->orderBy('updated_at DESC')->get();
    }

    public function show($id) {

        return User::select(
            'id',
            'name',
            'company',
            'email',
            'phone',
            'created_at',
            'updated_at'
        )->where('id', '=', $id)->firstOrFail();

    }
    public function update(Request $request, $id) {
        $user = User::findOrFail($id);
    
        $validator = Validator::make($request->all(), [
            'name'  => 'required|string|max:255',
            'company'   => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:users,email,'.$id,
            'phone' => 'nullable|string',
        ]);
    
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
    
        $user->update([
            'name'    => $request->name,
            'company' => $request->company,
            'email'   => $request->email,
            'phone'   => $request->phone,
        ]);
    
        return response()->json(['data' => $user]);
    }

    public function trash(Request $request, $id) {
        $user = User::findOrFail($id);
        $user->delete(); 
        return response()->json([
            'success' => true,
            'message' => 'Usuário excluído permanentemente.'
        ]);


    }
    
    public function store(Request $request) {

        $validator = Validator::make($request->all(), [
            'name'      => 'required|string|max:255',
            'company'   => 'required|string|max:255',
            'email'     => 'required|string|max:255|unique:users',
            'phone'     => 'nullable|string',
            'password'  => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::create([
            'name'      => $request->name,
            'company'   => $request->company,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'phone'     => $request->phone,
        ]);

        $user->createToken('auth_token')->plainTextToken;



        return response()->json([
            'data' => $user
        ]);

    }

}
