<x-admin-layout title="Usuarios | Simify" :breadcrumbs="[
      ['name' => 'Dashboard', 'href' => route('admin.dashboard')],
      ['name' => 'Usuarios'],
]">
    <x-slot name="action">
        <x-wire-button blue href="{{route('admin.users.create')}}">
            <i class="fa-solid fa-plus"></i>
            Nuevo
        </x-wire-button>
    </x-slot>

    <x-wire-card>
        <p class="text-gray-600">Aquí se mostrará la tabla de usuarios.</p>
        @livewire('admin.datatables.user-table')
    </x-wire-card>
</x-admin-layout>
