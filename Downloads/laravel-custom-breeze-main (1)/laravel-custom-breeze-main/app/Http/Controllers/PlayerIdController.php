<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PlayerId;
use Illuminate\Http\JsonResponse;

class PlayerIdController extends Controller
{
    /**
     * Store a new Player ID for the authenticated user.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'player_id' => 'required|string|max:255'
        ]);

        $user = $this->authenticateUser();
        \Log::info('Authenticated user: ', ['user' => $user]);
        if (!$user) {
            return response()->json(['error' => 'User not authenticated.'], 401);
        }

        try {
            $playerId = PlayerId::query()->firstOrNew(['player_id' => $validated['player_id']]);
            $playerId->user_id = $user->id;
            $playerId->save();

            return response()->json(['success' => true, 'message' => 'Player ID saved successfully.'], 200);
        } catch (\Exception $e) {
            \Log::error('Error saving Player ID: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while saving the Player ID.'], 500);
        }
    }

    /**
     * Remove a Player ID for the authenticated user.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'player_id' => 'required|string|max:255'
        ]);

        $user = $this->authenticateUser();
        \Log::info('Authenticated user: ', ['user' => $user]);
        if (!$user) {
            return response()->json(['error' => 'User not authenticated.'], 401);
        }

        try {
            $deleted = PlayerId::where('user_id', $user->id)
                ->where('player_id', $validated['player_id'])
                ->delete();

            if ($deleted) {
                return response()->json(['success' => true, 'message' => 'Player ID deleted successfully.'], 200);
            } else {
                return response()->json(['success' => false, 'message' => 'Player ID not found.'], 404);
            }
        } catch (\Exception $e) {
            \Log::error('Error deleting Player ID: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while deleting the Player ID.'], 500);
        }
    }

    private function authenticateUser()
    {
        if (!Auth::check()) {
            return null;
        }

        return Auth::user();
    }
}
