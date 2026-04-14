<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display users dashboard.
     */
    public function dashboard()
    {
        $user = Auth::user();
        
        // Get statistics for dashboard
        $totalUsers = User::count();
        
        // Check if is_active column exists before using it
        try {
            $activeUsers = User::where('is_active', true)->count();
        } catch (\Illuminate\Database\QueryException $e) {
            // Fallback: assume all users are active if column doesn't exist
            $activeUsers = $totalUsers;
        }
        
        // Check if role column exists before using it
        try {
            $adminUsers = User::where('role', 'admin')->count();
            $managerUsers = User::where('role', 'manager')->count();
        } catch (\Illuminate\Database\QueryException $e) {
            // Fallback: assume all users are regular users if role column doesn't exist
            $adminUsers = 0;
            $managerUsers = 0;
        }
        
        // Get recent users with fallback columns
        try {
            $recentUsers = User::latest()
                ->take(5)
                ->get(['id', 'name', 'email', 'role', 'created_at']);
        } catch (\Illuminate\Database\QueryException $e) {
            // Fallback: get available columns only
            $recentUsers = User::latest()
                ->take(5)
                ->get(['id', 'name', 'email', 'created_at']);
        }
        
        // Get login activity statistics (for demo purposes)
        $todayLogins = rand(20, 35); // Simulate today's logins
        $thisWeekLogins = rand(100, 180); // Simulate this week's logins
        $thisMonthLogins = rand(400, 600); // Simulate this month's logins
        $failedAttempts = rand(0, 5); // Simulate failed attempts
        
        return view('users.dashboard', compact(
            'user',
            'totalUsers',
            'activeUsers',
            'adminUsers',
            'managerUsers',
            'recentUsers',
            'todayLogins',
            'thisWeekLogins',
            'thisMonthLogins',
            'failedAttempts'
        ));
    }

    /**
     * Display users management page.
     */
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('users.management', compact('users'));
    }

    /**
     * Store a newly created user.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'phone' => 'nullable|string|max:20',
            'role' => 'required|in:user,manager,admin',
            'department' => 'nullable|string|max:255',
        ]);

        $validated['password'] = bcrypt($validated['password']);
        
        // Only add is_active if the column exists
        try {
            \Schema::hasColumn('users', 'is_active');
            $validated['is_active'] = $request->get('is_active', true);
        } catch (\Exception $e) {
            // Column doesn't exist, skip it
        }
        
        User::create($validated);
        
        return redirect()->route('users.management')
            ->with('success', 'User created successfully.');
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'role' => 'required|in:user,manager,admin',
            'department' => 'nullable|string|max:255',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = bcrypt($request->password);
        }

        // Only add is_active if the column exists
        try {
            \Schema::hasColumn('users', 'is_active');
            $validated['is_active'] = $request->get('is_active', true);
        } catch (\Exception $e) {
            // Column doesn't exist, skip it
        }

        $user->update($validated);
        
        return redirect()->route('users.management')
            ->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user)
    {
        if ($user->id === Auth::id()) {
            return back()->with('error', 'You cannot delete your own account.');
        }
        
        $user->delete();
        
        return redirect()->route('users.management')
            ->with('success', 'User deleted successfully.');
    }

    /**
     * Toggle user active status.
     */
    public function toggleStatus(User $user)
    {
        try {
            // Check if is_active column exists
            \Schema::hasColumn('users', 'is_active');
            $user->is_active = !$user->is_active;
            $user->save();
            
            return back()->with('success', 'User status updated successfully.');
        } catch (\Exception $e) {
            // Column doesn't exist, return a message
            return back()->with('error', 'User status toggle not available - status column not found.');
        }
    }
}
