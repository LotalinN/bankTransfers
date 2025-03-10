<?php


namespace App\Http\Controllers;

use App\Http\Requests\BlockUserRequest;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::with('bankAccounts')->get();

        return response()->json([
            'users' => $users,
        ]);
    }

        // Блокировка пользователя
    public function block($id, BlockUserRequest $request)
    {
        $user = User::findOrFail($id);
        $user->update(['is_blocked' => true]);

        return response()->json([
            'message' => 'User blocked',
        ]);
    }

    // Разблокировка пользователя
    public function unblock($id, BlockUserRequest $request)
    {
        $user = User::findOrFail($id);
        $user->update(['is_blocked' => false]);

        return response()->json([
            'message' => 'User unblocked',
        ]);
    }
}
