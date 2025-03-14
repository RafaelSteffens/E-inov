<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Phone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function index(){
        return User::select(
            'id',
            'name',
            'company',
            'email',
            'created_at',
            'updated_at'
        )
        ->with(['phones' => function ($query) {
            $query->select('id', 'user_id', 'number');
        }])
        ->orderBy('updated_at', 'DESC')
        ->get();
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
        )
        ->with(['phones' => function ($query) {
            $query->select('id', 'user_id', 'number');
        }])
        ->where('id', '=', $id)->firstOrFail();
    }

    public function salveUser(Request $request) {
        $validator = Validator::make($request->all(), [
            'name'      => 'required|string|max:255',
            'company'   => 'required|string|max:255',
            'email'     => 'required|string|email|max:255|unique:users',
            'password'  => 'required|string|min:8',
            'phones'    => 'required|array|min:1',
            'phones.*'  => 'required|string|max:20',
        ]);
    
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::create([
            'name'      => $request->name,
            'company'   => $request->company,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
        ]);
  
        foreach ($request->phones as $phoneNumber) {
            $phones = Phone::create([
                'number' => $phoneNumber,
                'user_id'  => $user->id
            ]);
        }
    
        $token = $user->createToken('auth_token')->plainTextToken;
    
        return response()->json([
            'user'  => $user,
            'token' => $token,
        ], 201);
    }

    public function update(Request $request, $id) {
        $user = User::findOrFail($id);
    
        $validator = Validator::make($request->all(), [
            'name'    => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'email'   => 'required|string|max:255|unique:users,email,'.$id,
            'phones'  => 'required|array|min:1',
            'phones.*' => 'required|string|max:20',
        ]);
    
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
    
        $user->update([
            'name'    => $request->name,
            'company' => $request->company,
            'email'   => $request->email,
        ]);

        $user->phones()->delete();

        foreach ($request->phones as $phoneNumber) {
            $user->phones()->create([
                'number' => $phoneNumber,
            ]);
        }
    
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
    

}
