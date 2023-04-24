<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(["data" => User::get()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $param = $request->all();
            $i = 1;
            if (gettype($param['score']) === 'integer') {
                if ($param['score'] < 10) {
                    $param['score']++;
                }
            } else {
                switch ($param['score']) {
                    case 'A':
                        $param['score'] = 10;
                        break;
                    case 'B':
                        $param['score'] = 9;
                        break;
                    case 'C':
                        $param['score'] = 8;
                        break;
                    case 'D':
                        $param['score'] = 7;
                        break;
                    case 'E':
                        $param['score'] = 6;
                        break;
                    default:
                        $param['score'] = 5;
                        break;
                }
            }

            $user = new User;
            $user->name = $param['name'];
            $user->score = $param['score'];
            $user->email = $param['email'];
            $user->password = '123456789';
            $user->save();

            return response()->json([
                'data' => true,
                'message' => 'insert success',
            ]);
        } catch (\Exception $ex) {
            return [
                'data' => null,
                'message' => 'insert fail',
            ];
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return [
            'data' => User::find($id),
            'message' => 'success',
        ];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);

        if ($user) {
            $user->update($request->all());
            $user->save();

            return [
                'data' => true,
                'message' => "updated",
            ];
        }
        return [
            'data' => null,
            'message' => "data not found",
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::findOrFail($id)->delete();

        return response()->json(["message" => "deleted"]);
    }
}
