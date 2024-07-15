<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\User;
use App\Models\PlayerId;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function index()
    {
        $users = User::get();

        return view('users.index', compact('users'));
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function import()
    {
        Excel::import(new UsersImport,request()->file('file'));

        return back();
    }

    /**
     * Update the OneSignal Player ID for the authenticated user.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateOneSignalPlayerId(Request $request): JsonResponse
    {
        $user = Auth::user();
        $playerId = $request->input('onesignal_player_id');

        // Validate player ID
        $request->validate([
            'onesignal_player_id' => 'required|string',
        ]);

        // Check if the Player ID already exists for this user
        $existingPlayerId = PlayerId::where('user_id', $user->id)
            ->where('player_id', $playerId)
            ->first();

        if (!$existingPlayerId) {
            // Create a new Player ID record
            try {
                PlayerId::create([
                    'user_id' => $user->id,
                    'player_id' => $playerId,
                ]);
            } catch (\Exception $e) {
                Log::error('Failed to create Player ID: ' . $e->getMessage());
                return response()->json(['success' => false, 'message' => 'Failed to update Player ID'], 500);
            }
        }

        return response()->json(['success' => true]);
    }
}
