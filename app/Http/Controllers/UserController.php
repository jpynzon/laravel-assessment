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
            Log::info('Users retrieved', ['count' => $users->count()]);
            return response()->json($users);
        } catch (\Exception $e) {
            Log::error('Error in user index', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Failed to retrieve users'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getUserById($id)
    {
        try {
            $user = User::findOrFail($id);
            return response()->json(['data' => $user], Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            Log::error('User not found', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'User not found'], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            Log::error('Error retrieving user', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Failed to retrieve user'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return response()->json(['message' => 'User deleted successfully']);
        } catch (ModelNotFoundException $e) {
            Log::error('User not found', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'User not found'], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            Log::error('Error deleting user', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Failed to delete user'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}