<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class AuthController extends Api
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()
            ->json(['data' => $user, 'access_token' => $token, 'token_type' => 'Bearer',]);
    }

    // public function login(Request $request)
    // {
    //     if (!Auth::attempt($request->only('email', 'password'))) {
    //         return response()
    //             ->json(['message' => 'Unauthorized'], 401);
    //     }

    //     $user = User::where('email', $request['email'])->firstOrFail();

    //     $token = $user->createToken('auth_token')->plainTextToken;

    //     return response()
    //         ->json(['message' => 'Hi ' . $user->name . ', welcome to home', 'access_token' => $token, 'token_type' => 'Bearer',]);
    // }

    // method for user logout and delete token
    public function logout()
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'You have successfully logged out and the token was successfully deleted'
        ];
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $response = Http::acceptJson()->post('https://api-gerbang2.itk.ac.id/api/siakad/login', [
            'email' => $request->email,
            'password' => $request->password
        ]);
        // return $response->json();
        if ($response->ok()) {
            $json = $response->json();
            $mahasiswa = $json['data'];

            if (array_key_exists("PE_Nip", $mahasiswa['biodata'])) {
                //dosen
                $mahasiswalogin = User::updateOrCreate(
                    [
                        'nim' => $mahasiswa['XNAMA']
                    ],
                    [
                        'nim' => $mahasiswa['XNAMA'],
                        'name' => $mahasiswa['USERDESC'],
                        'email' => $mahasiswa['biodata']['PE_Email'],
                        'role' => 'Dosen'
                    ]
                );
                $token = $mahasiswalogin->createToken('auth_token')->plainTextToken;
                return response()
                    ->json(['message' => 'Hi ' . $mahasiswa['USERDESC'] . ', welcome to home', 'access_token' => $token, 'token_type' => 'Bearer',]);
            } elseif (array_key_exists("MA_Nrp", $mahasiswa['biodata'])) {
                // mahasiswa
                $mahasiswalogin = User::updateOrCreate(
                    [
                        'nim' => $mahasiswa['XNAMA']
                    ],
                    [
                        'nim' => $mahasiswa['XNAMA'],
                        'name' => $mahasiswa['USERDESC'],
                        'email' => $mahasiswa['biodata']['MA_Email'],
                        'jurusan' => $mahasiswa['biodata']['nama_jurusan'],
                        'prodi' => $mahasiswa['biodata']['prodi']['Nama_Prodi'],
                        'angkatan' => $mahasiswa['biodata']['MA_Tahun_Masuk'],
                        'role' => 'Mahasiswa'
                    ]
                );
                $token = $mahasiswalogin->createToken('auth_token')->plainTextToken;
                return response()
                    ->json(['message' => 'Hi ' . $mahasiswa['USERDESC'] . ', welcome to home', 'access_token' => $token, 'token_type' => 'Bearer',]);
            }
        } else {
            if (!Auth::attempt($request->only('email', 'password'))) {
                return response()
                    ->json(['message' => 'Unauthorized'], 401);
            }

            $user = User::where('email', $request['email'])->firstOrFail();
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()
                ->json(['message' => 'Hi ' . $user->name . ', welcome to home', 'access_token' => $token, 'token_type' => 'Bearer',]);
        }
    }

    public function profile()
    {
        $data = Auth::user();

        return $this->successResponse($data);
    }
}
