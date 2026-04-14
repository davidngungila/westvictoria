<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    /**
     * Display settings dashboard.
     */
    public function dashboard()
    {
        $user = Auth::user();
        
        // Get system statistics
        $totalUsers = User::count();
        
        // Check if is_active column exists before using it
        try {
            $activeUsers = User::where('is_active', true)->count();
        } catch (\Illuminate\Database\QueryException $e) {
            // Fallback: assume all users are active if column doesn't exist
            $activeUsers = $totalUsers;
        }
        
        // Get database status (for demo purposes)
        $databaseSize = '2.4 GB';
        $databaseStatus = 'Growing slowly';
        
        // Get system settings (for demo purposes)
        $systemSettings = [
            'app_name' => 'West Victoria BMS',
            'version' => '1.0.0',
            'timezone' => 'Africa/Dar_es_Salaam',
            'currency' => 'TZS',
            'date_format' => 'Y-m-d',
            'time_format' => 'H:i',
        ];
        
        // Get user preferences with fallbacks
        $userPreferences = [
            'theme' => $user->preferences['theme'] ?? 'light',
            'language' => $user->preferences['language'] ?? 'en',
            'notifications' => $user->preferences['notifications'] ?? true,
            'auto_save' => $user->preferences['auto_save'] ?? true,
        ];
        
        return view('settings.dashboard', compact(
            'user',
            'totalUsers',
            'activeUsers',
            'databaseSize',
            'databaseStatus',
            'systemSettings',
            'userPreferences'
        ));
    }

    /**
     * Update user profile settings.
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'department' => 'nullable|string|max:255',
        ]);

        $user->update($validated);
        
        return back()->with('success', 'Profile updated successfully.');
    }

    /**
     * Update user preferences.
     */
    public function updatePreferences(Request $request)
    {
        $user = Auth::user();
        
        $validated = $request->validate([
            'theme' => 'required|in:light,dark',
            'language' => 'required|in:en,sw',
            'notifications' => 'boolean',
            'auto_save' => 'boolean',
        ]);

        // Update preferences in user model (assuming preferences is a JSON column)
        $preferences = array_merge($user->preferences ?? [], $validated);
        $user->update(['preferences' => $preferences]);
        
        return back()->with('success', 'Preferences updated successfully.');
    }

    /**
     * Update system settings.
     */
    public function updateSystem(Request $request)
    {
        $validated = $request->validate([
            'app_name' => 'required|string|max:255',
            'timezone' => 'required|string|max:255',
            'currency' => 'required|in:TZS,USD,EUR',
            'date_format' => 'required|in:Y-m-d,d/m/Y,m/d/Y',
            'time_format' => 'required|in:H:i,h:i A',
        ]);

        // In a real application, these would be stored in a settings table
        // For demo purposes, we'll use session or config
        session(['system_settings' => $validated]);
        
        return back()->with('success', 'System settings updated successfully.');
    }
}
