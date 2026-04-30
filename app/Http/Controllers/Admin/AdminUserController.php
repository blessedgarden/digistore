<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        // Фильтр по роли
        if ($request->role) {
            $query->where('role', $request->role);
        }

        // Поиск по имени или email
        if ($request->search) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
        }

        $users = $query->latest()
            ->withCount('orders')
            ->paginate(20);

        return view('admin.users.index', compact('users'));
    }

    public function makeAdmin(User $user)
    {
        if ($user->role === 'admin') {
            return back()->with('error', 'Пользователь уже администратор');
        }

        $user->update(['role' => 'admin']);

        return back()->with('success', 'Пользователь назначен администратором');
    }

    public function removeAdmin(User $user)
    {
        if ($user->role === 'user') {
            return back()->with('error', 'Пользователь не администратор');
        }

        $user->update(['role' => 'user']);

        return back()->with('success', 'Привилегии администратора отозваны');
    }

    public function destroy(User $user)
    {
        // Не позволяем удалить самого себя
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Вы не можете удалить себя');
        }

        $user->delete();

        return back()->with('success', 'Пользователь удален');
    }
}