<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-lg font-bold mb-6">{{ __('All Users') }}</h1>

                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        @foreach ($users as $user)
                        <a href="{{ route('chat.show', ['user' => $user->id]) }}">
                            <div class="flex p-4 border rounded-lg">
                                <div class="mr-4">
                                    @if ($user->icon)
                                    <img src="{{ asset('storage/icons/' . $user->icon) }}" alt="icon" class="w-10 h-10 rounded-full">
                                    @else
                                    <div class="w-10 h-10 rounded-full bg-gray-400"></div>
                                    @endif
                                </div>
                                <div>
                                    <p class="text-lg font-bold">{{ $user->name }}</p>
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>