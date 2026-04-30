@extends('layouts.admin')

@section('title', 'Управление пользователями — DigiStore')

@section('content')
<div class="min-h-screen bg-dark">
    <!-- Header -->
    <section class="bg-darkLight border-b border-primary/20 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-bold flex items-center space-x-3">
                <i class="fas fa-users text-primary"></i>
                <span>Пользователи</span>
            </h1>
            <p class="text-gray-400 mt-2">Всего пользователей: <span class="text-primary font-bold">{{ $users->total() }}</span></p>
        </div>
    </section>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Filters -->
        <div class="card p-6 mb-8">
            <form action="{{ route('admin.users.index') }}" method="GET" class="flex gap-4 flex-wrap">
                <input type="text" name="search" placeholder="Поиск по имени или email..." 
                       value="{{ request('search') }}" class="flex-1 min-w-48">

                <select name="role" class="min-w-48">
                    <option value="">Все роли</option>
                    <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>Пользователь</option>
                    <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Администратор</option>
                </select>

                <button type="submit" class="btn-primary">
                    <i class="fas fa-search mr-1"></i> Поиск
                </button>
            </form>
        </div>

        <!-- Users Table -->
        <div class="card overflow-hidden">
            @if ($users->count() > 0)
                <table class="w-full">
                    <thead>
                        <tr>
                            <th>Пользователь</th>
                            <th>Email</th>
                            <th>Роль</th>
                            <th>Заказов</th>
                            <th>Дата регистрации</th>
                            <th>Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 bg-primary/20 rounded-full flex items-center justify-center flex-shrink-0">
                                            <i class="fas fa-user text-primary text-sm"></i>
                                        </div>
                                        <div class="font-semibold">{{ $user->name }}</div>
                                    </div>
                                </td>
                                <td class="text-gray-400">{{ $user->email }}</td>
                                <td>
                                    <span class="px-3 py-1 rounded-full text-sm font-semibold
                                        {{ $user->role === 'admin' ? 'bg-primary/30 text-primary' : 'bg-gray-600/30 text-gray-400' }}">
                                        <i class="fas fa-{{ $user->role === 'admin' ? 'crown' : 'user' }} mr-1"></i>
                                        {{ $user->role === 'admin' ? 'Админ' : 'Юзер' }}
                                    </span>
                                </td>
                                <td class="text-primary font-bold">{{ $user->orders_count }}</td>
                                <td class="text-gray-400 text-sm">{{ $user->created_at->format('d.m.Y') }}</td>
                                <td>
                                    <div class="flex gap-2">
                                        @if ($user->role === 'user')
                                            <form action="{{ route('admin.users.makeAdmin', $user) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" class="text-primary hover:text-primary/70 text-xs" title="Сделать админом">
                                                    <i class="fas fa-crown"></i>
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('admin.users.removeAdmin', $user) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" class="text-yellow-400 hover:text-yellow-300 text-xs" title="Убрать права админа">
                                                    <i class="fas fa-user"></i>
                                                </button>
                                            </form>
                                        @endif

                                        @if ($user->id !== auth()->id())
                                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline"
                                                  onsubmit="return confirm('Вы уверены?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-400 hover:text-red-300 text-xs">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="p-6 border-t border-primary/20">
                    {{ $users->links() }}
                </div>
            @else
                <div class="p-12 text-center">
                    <i class="fas fa-inbox text-gray-600 text-4xl mb-4"></i>
                    <p class="text-gray-400">Пользователей не найдено</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection