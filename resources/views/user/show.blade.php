@extends('layouts.app')

@section('content')
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="bg-white shadow dark:bg-gray-800 sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-gray-100">
                    Détails de l'utilisateur
                </h3>
            </div>

            <div class="border-t border-gray-200 dark:border-gray-600">
                <div class="px-4 py-5 sm:px-6">
                    <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">Nom</h4>
                    <p class="text-lg text-gray-900 dark:text-gray-100">{{ $user->name }}</p>
                </div>

                <div class="px-4 py-5 sm:px-6">
                    <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">Email</h4>
                    <p class="text-lg text-gray-900 dark:text-gray-100">{{ $user->email }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
