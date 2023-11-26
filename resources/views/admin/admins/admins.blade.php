<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('admin/admins.title') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @foreach ($admins as $admin)
                    <div class="mt-4">
                        <p><b>{{ __('admin/admins.id') }}:</b> {{ $admin->id }}</p>
                        <p><b>{{ __('admin/admins.name') }}:</b> {{ $admin->name }}</p>
                        <p><b>{{ __('admin/admins.surname') }}:</b> {{ $admin->surname }}</p>
                        <p><b>{{ __('admin/admins.phone') }}:</b> {{ $admin->phone }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
