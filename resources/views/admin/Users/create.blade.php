<x-admin-layout title="Usuarios | Simify" :breadcrumbs="[
      ['name' => 'Dashboard', 'href' => route('admin.dashboard')],
      ['name' => 'Usuarios', 'href' => route('admin.users.index')],
      ['name' => 'Nuevo'],
]">
    <x-wire-card>
        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <x-wire-input
                    label="Nombre"
                    placeholder="Ingrese el nombre completo"
                    name="name"
                />
            </div>

            <div class="mb-4">
                <x-wire-input
                    label="Email"
                    type="email"
                    placeholder="ejemplo@correo.com"
                    name="email"
                />
            </div>

            <div class="mb-4">
                <x-wire-input
                    label="Contraseña"
                    type="password"
                    placeholder="********"
                    name="password"
                />
            </div>

            <div class="flex justify-end">
                <x-wire-button type="submit" primary>
                    Guardar
                </x-wire-button>
            </div>
        </form>
    </x-wire-card>
</x-admin-layout>
