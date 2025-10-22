@php
    //Arreglo de íconos
    $links = [
        [
            'name' => 'Dashboard',
            'icon' => 'fa-solid fa-gauge',
            'href' => route('admin.dashboard'),
            'active' => request() ->routeIs('admin.dashboard'),
        ],
        [
            'header'=> 'Gestión'
        ],
        [
            'name' => 'Roles y permisos',
            'icon' => 'fa-solid fa-shield-halved',
            'href' => route('admin.roles.index'),
            'active' => request()->routeIs('admin.roles.*')
        ],
    ];
@endphp

<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700" aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
        <ul class="space-y-2 font-medium">
            @foreach($links as $link)
                <li>
                    {{-- Revisa si existe definido una llave llamada 'header' --}}
                    @isset($link['header'])
                        <div class="px-2 py-2 text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            {{ $link['header'] }}
                        </div>
                        {{-- Si no existe, usa la etiqueta como estaba definida antes --}}
                    @else
                        {{--Revisa si existe un submenu--}}
                        @isset($link['submenu'])
                            <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-150 rounded-lg group hover:bg-gray-50 dark:text-white dark:hover:bg-gray-700" aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                            <span class="w-6 h-6 inline-flex justify-center items-center text-gray-600">
                                <i class="{{ $link['icon'] }}"></i>
                            </span>
                            <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">
                                {{ $link['name'] }}
                            </span>
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                                </svg>
                            </button>
                            <ul id="dropdown-example" class="hidden py-2 space-y-2">
                                @foreach ($link['submenu'] as $item)
                                    <li>
                                        <a href="{{ $item['href'] }}" class="flex items-center w-full p-2 text-gray-700 transition duration-150 rounded-lg pl-11 group hover:bg-gray-50 dark:text-white dark:hover:bg-gray-700">
                                            {{$item['name']}}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <a href="{{ $link['href'] }}" class="flex items-center p-2 transition duration-150 rounded-lg group {{ $link['active'] ? 'bg-blue-50 text-blue-700 border-l-4 border-blue-600 pl-1.5' : 'text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700' }}">
                                <span class="w-6 h-6 inline-flex justify-center items-center {{ $link['active'] ? 'text-blue-600' : 'text-gray-600' }}">
                                    <i class="{{ $link['icon'] }}"></i>
                                </span>
                                <span class="ms-3">
                                    {{$link['name']}}
                                </span>
                            </a>
                        @endisset
                    @endisset
                </li>
            @endforeach
        </ul>
    </div>
</aside>
