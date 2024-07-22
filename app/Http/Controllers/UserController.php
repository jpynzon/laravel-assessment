<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function index()
    {
        Log::info('User index method called');
        try {
            $users = User::all();
            return response()->json($users);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve users'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getUserById($id)
    {
        try {
            $user = User::findOrFail($id);
            return response()->json(['data' => $user], Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'User not found'], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve user'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}