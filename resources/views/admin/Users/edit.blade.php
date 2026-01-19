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
            <div class="space-y-4">
                <div class="grid lg:grid-cols-2 gap-4">
                    <x-wire-input
                        label="Nombre"
                        placeholder="Ingrese el nombre completo"
                        name="name"
                        autocomplete="name"
                        required :value="old('name', $user->name)"
                    />

                    <x-wire-input
                        label="Email"
                        type="email"
                        placeholder="usuario@dominio.com"
                        name="email"
                        autocomplete="email"
                        inputmode="email"
                        required :value="old('email', $user->email)"
                    />

                    <x-wire-input
                        label="Contraseña"
                        type="password"
                        placeholder="********"
                        autocomplete="new-password"
                        inputmode="password"
                        name="password"
                        :value="old('password')"
                    />

                    <x-wire-input
                        name="password_confirmation"
                        type="password"
                        label="Confirmar contraseña"
                        placeholder="********"
                        inputmode="password"
                        :value="old('password_confirmation')"
                    />

                    <x-wire-input
                        label="Número de ID"
                        placeholder="Ingrese su número de ID"
                        name="id_number"
                        autocomplete="off"
                        inputmode="numeric"
                        required :value="old('id_number', $user->id_number)"
                    />

                    <x-wire-phone
                        label="Telefono (Opcional)"
                        placeholder="Ingrese un número de celular"
                        name="phone"
                        autocomplete="tel"
                        inputmode="tel"
                        required :value="old('phone', $user->phone)"
                    />
                </div>

                <x-wire-input
                    label="Dirección (Opcional)"
                    placeholder="Ingrese una dirección de domicilio"
                    name="address"
                    autocomplete="street-address"
                    required :value="old('address', $user->address)"
                />

                <x-wire-native-select name="role_id" label="Rol" required>
                    <option value="">Seleccione un rol</option>
                    @foreach ($roles as $role)
                        <option value="{{$role->id}}" @selected(old('role_id', $user->roles->first()->id) == $role->id)>
                            {{$role->name}}
                        </option>
                    @endforeach
                </x-wire-native-select>
            </div>

            <p class="text-sm text-gray-500">
                Define los permisos y accesos del usuario.
            </p>

            <div class="flex justify-end">
                <x-wire-button type="submit" primary>
                    Actualizar
                </x-wire-button>
            </div>
        </form>
    </x-wire-card>
</x-admin-layout>
