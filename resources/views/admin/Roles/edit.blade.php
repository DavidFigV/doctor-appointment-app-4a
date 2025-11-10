<x-admin-layout title="Roles | Simify"
                :breadcrumbs="[
    [
      'name' => 'Dashboard',
      'href' => route('admin.dashboard')
    ],
    [
      'name' => 'Roles',
      'href' => route('admin.roles.index')
    ],
    [
      'name' => 'Editar'
    ],
]">
    <form action="{{ route('admin.roles.update', $role) }}" method="POST">
        @csrf
        @method('PUT')
        <x-wire-input label="Nombre" name="name" placeholder="Nombre del rol" value="{{old('name', $role->name)}}"></x-wire-input>
        <div class="flex justify-end mt-2">
            <x-wire-button type="submit" blue>
                Actualizar
            </x-wire-button>
        </div>
    </form>
</x-admin-layout>
