<x-admin-layout
    title="Aseguradoras | Simify"
    :breadcrumbs="[
        [
            'name' => 'Dashboard',
            'href' => route('admin.dashboard'),
        ],
        [
            'name' => 'Aseguradoras',
        ],
    ]"
>
    {{-- Header: título + botón de acción --}}
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Aseguradoras</h1>
        <a href="{{ route('admin.insurances.create') }}"
           class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 transition duration-150">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
            </svg>
            Nueva Aseguradora
        </a>
    </div>

    {{-- Alert de éxito (Flowbite, verde, dismissible con Alpine.js) --}}
    @if (session('success'))
        <div x-data="{ show: true }" x-show="show"
             class="flex items-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 border border-green-300"
             role="alert">
            <svg class="shrink-0 inline w-4 h-4 me-3" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <span class="font-medium">{{ session('success') }}</span>
            <button @click="show = false" type="button"
                    class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8">
                <span class="sr-only">Cerrar</span>
                <svg class="w-3 h-3" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                          stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
            </button>
        </div>
    @endif

    {{-- Tabla de aseguradoras --}}
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 w-12">#</th>
                    <th scope="col" class="px-6 py-3">Nombre de la Empresa</th>
                    <th scope="col" class="px-6 py-3">Teléfono de Contacto</th>
                    <th scope="col" class="px-6 py-3">Fecha de Registro</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($insurances as $insurance)
                    <tr class="bg-white border-b hover:bg-gray-50 transition duration-150">
                        <td class="px-6 py-4 font-medium text-gray-900">
                            {{ $insurances->firstItem() + $loop->index }}
                        </td>
                        <td class="px-6 py-4 font-semibold text-gray-800">
                            {{ $insurance->nombre_empresa }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $insurance->telefono_contacto }}
                        </td>
                        <td class="px-6 py-4 text-gray-500">
                            {{ $insurance->fecha_registro }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-10 text-center text-gray-400">
                            <div class="flex flex-col items-center gap-2">
                                <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor"
                                     stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25Z"/>
                                </svg>
                                <span class="text-sm">No hay aseguradoras registradas.</span>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Paginación --}}
    @if ($insurances->hasPages())
        <div class="mt-4">
            {{ $insurances->links() }}
        </div>
    @endif

</x-admin-layout>
