<x-admin-layout title="Usuarios | Simify"
                :breadcrumbs="[
      ['name' => 'Dashboard', 'href' => route('admin.dashboard')],
      ['name' => 'Usuarios', 'href' => route('admin.users.index')],
      ['name' => 'Editar'],
  ]">
    <x-wire-card>
        <form action="{{ route('admin.users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <x-wire-input
                    label="Nombre"
                    placeholder="Ingrese el nombre completo"
                    name="name"
                    value="{{ $user->name }}"
                />
            </div>

            <div class="mb-4">
                <x-wire-input
                    label="Email"
                    type="email"
                    placeholder="ejemplo@correo.com"
                    name="email"
                    value="{{ $user->email }}"
                />
            </div>

            <div class="mb-4">
                <x-wire-input
                    label="Nueva Contraseña (opcional)"
                    type="password"
                    placeholder="Dejar vacío para mantener la actual"
                    name="password"
                />
            </div>

            <div class="flex justify-end">
                <x-wire-button type="submit" primary>
                    Actualizar
                </x-wire-button>
            </div>
        </form>
    </x-wire-card>
</x-admin-layout>
