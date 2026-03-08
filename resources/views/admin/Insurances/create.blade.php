<x-admin-layout
    title="Nueva Aseguradora | Simify"
    :breadcrumbs="[
        [
            'name' => 'Dashboard',
            'href' => route('admin.dashboard'),
        ],
        [
            'name' => 'Aseguradoras',
            'href' => route('admin.insurances.index'),
        ],
        [
            'name' => 'Nueva Aseguradora',
        ],
    ]"
>
    <div class="max-w-3xl mx-auto">
        {{-- Card principal --}}
        <div class="bg-white rounded-xl shadow-md p-6">

            {{-- Encabezado del card --}}
            <div class="mb-6">
                <h2 class="text-xl font-bold text-gray-800">Registrar Aseguradora</h2>
                <p class="mt-1 text-sm text-gray-500">
                    Complete los datos de la nueva aseguradora para agregarla al directorio.
                </p>
            </div>

            {{-- Formulario --}}
            <form action="{{ route('admin.insurances.store') }}" method="POST" novalidate>
                @csrf

                {{-- Campo: Nombre de la empresa --}}
                <div class="mb-5">
                    <label for="nombre_empresa"
                           class="block mb-2 text-sm font-medium {{ $errors->has('nombre_empresa') ? 'text-red-700' : 'text-gray-900' }}">
                        Nombre de la empresa <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="text"
                        id="nombre_empresa"
                        name="nombre_empresa"
                        value="{{ old('nombre_empresa') }}"
                        placeholder="Ej. AXA Seguros S.A. de C.V."
                        class="bg-gray-50 border text-sm rounded-lg block w-full p-2.5 focus:outline-none transition duration-150
                               {{ $errors->has('nombre_empresa')
                                   ? 'border-red-500 text-red-900 placeholder-red-300 focus:ring-red-500 focus:border-red-500'
                                   : 'border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500' }}"
                    >
                    @error('nombre_empresa')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Campo: Teléfono de contacto --}}
                <div class="mb-5">
                    <label for="telefono_contacto"
                           class="block mb-2 text-sm font-medium {{ $errors->has('telefono_contacto') ? 'text-red-700' : 'text-gray-900' }}">
                        Teléfono de contacto <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="tel"
                        id="telefono_contacto"
                        name="telefono_contacto"
                        value="{{ old('telefono_contacto') }}"
                        placeholder="Ej. 55 1234 5678"
                        class="bg-gray-50 border text-sm rounded-lg block w-full p-2.5 focus:outline-none transition duration-150
                               {{ $errors->has('telefono_contacto')
                                   ? 'border-red-500 text-red-900 placeholder-red-300 focus:ring-red-500 focus:border-red-500'
                                   : 'border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500' }}"
                    >
                    @error('telefono_contacto')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Campo: Notas adicionales --}}
                <div class="mb-6">
                    <label for="notas_adicionales"
                           class="block mb-2 text-sm font-medium {{ $errors->has('notas_adicionales') ? 'text-red-700' : 'text-gray-900' }}">
                        Notas adicionales
                    </label>
                    <textarea
                        id="notas_adicionales"
                        name="notas_adicionales"
                        rows="5"
                        placeholder="Información relevante: convenios, horarios de atención, contacto..."
                        class="bg-gray-50 border text-sm rounded-lg block w-full p-2.5 focus:outline-none transition duration-150
                               {{ $errors->has('notas_adicionales')
                                   ? 'border-red-500 text-red-900 placeholder-red-300 focus:ring-red-500 focus:border-red-500'
                                   : 'border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500' }}"
                    >{{ old('notas_adicionales') }}</textarea>
                    @error('notas_adicionales')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Footer del card: botones --}}
                <div class="flex justify-end gap-3">
                    <button type="button"
                            onclick="window.location='{{ route('admin.insurances.index') }}'"
                            class="py-2.5 px-5 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:ring-4 focus:ring-gray-100 transition duration-150">
                        Cancelar
                    </button>
                    <button type="submit"
                            class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 transition duration-150">
                        Guardar Aseguradora
                    </button>
                </div>

            </form>
        </div>
    </div>

</x-admin-layout>
