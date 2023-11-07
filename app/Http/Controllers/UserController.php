<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    function index()
    {
        $users = User::all();

        return response()->json([
            'results' => $users
        ], 200);
    }
    function show($id)
    {
        $users = User::find($id);
        if (!$users) {
            return response()->json([
                'message' => 'User Not Found'
            ], 400);
        }

        return response()->json([
            'users' => $users
        ], 200);
    }
    function store(UserStoreRequest $request)
    {
        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password
            ]);

            return response()->json([
                'message' => "Kamu Berhasil Mendaftar"
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => "Ada Sesuatu Yang Salah!!"
            ], 500);
        }
    }
    public function update(UserStoreRequest $request, $id)
    {
        try {
            $users = User::find($id);
            if (!$users) {
                return response()->json([
                    'message' => 'User tidak ditemukan'
                ], 404);
            }

            $users->name = $request->name;
            $users->email = $request->email;
            $users->password = $request->password;

            // update/simpan user(perubahan)
            $users->save();

            return response()->json([
                'message' => "Akun berhasil diubah"
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => "Ada Sesuatu Yang Salah!!"
            ], 500);
        }
    }
    public function destroy($id)
    {
        $users = User::find($id);
        if (!$users) {
            return response()->json([
                'message' => 'Akun tidak ditemukan'
            ], 400);
        }

        // hapus user
        $users->delete();

        return response()->json([
            'message' => "Akun berhasil dihapus"
        ], 200);
    }
}
