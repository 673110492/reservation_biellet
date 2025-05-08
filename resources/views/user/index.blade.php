@extends('layouts.app')

@section('content')
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="bg-white shadow dark:bg-gray-800 sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-gray-100">
                    Liste des utilisateurs
                </h3>
            </div>

            <div class="border-t border-gray-200 dark:border-gray-600">
                <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($users as $user)
                        <li class="flex items-center justify-between px-4 py-3 text-sm">
                            <div class="flex items-center space-x-3">
                                <span class="font-medium text-gray-900 dark:text-gray-200">{{ $user->name }}</span>
                                <span class="text-gray-500 dark:text-gray-400">{{ $user->email }}</span>
                            </div>
                            <div class="flex space-x-3">
                                <a href="{{ route('user.show', $user->id) }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-300">Voir</a>
                                <a href="{{ route('user.edit', $user->id) }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-300">Modifier</a>
                                <form action="{{ route('user.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300">Supprimer</button>
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
