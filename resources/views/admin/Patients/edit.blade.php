{{-- Lógica de PHP para manejar errores y controlar la pestaña activa --}}

@php
    // Si hay errores de validación, determinar la pestaña activa en función del campo con error
    $errorGroups = [
        'antecedentes' => ['allergies', 'chronic_conditions', 'surgical_history', 'family_history'],
        'informacion-general' => ['blood_type_id', 'observations'],
        'contacto-emergencia' => ['emergency_contact_name', 'emergency_contact_phone', 'emergency_contact_relationship'],
    ];

    $initialTab = 'datos-personales'; // Pestaña por defecto

    // Si hay errores, revisar cada grupo de campos para determinar la pestaña activa
    foreach($errorGroups as $tabName => $fields) {
        if ($errors->hasAny($fields)) {
          $initialTab = $tabName;
          break; // Detener el ciclo una vez que se encuentra la primera pestaña con errores
        }
    }
@endphp

<x-admin-layout title="Pacientes | Simify"
                :breadcrumbs="[
    [
      'name' => 'Dashboard',
      'href' => route('admin.dashboard')
    ],
    [
      'name' => 'Pacientes',
      'href' => route('admin.patients.index')
    ],
    [
      'name' => 'Editar'
    ],
]">
    <form action="{{ route('admin.patients.update', $patient) }}" method="POST">
        @csrf
        @method('PUT')
        {{-- Encabezado con foto y acciones --}}
        <x-wire-card class="mb-8">
            <div class="lg:flex lg:justify-between lg:items-center">
                <div class="flex items-center gap-3">
                    <img src="{{$patient->user->profile_photo_url}}" alt="{{$patient->user->name}}"
                        class="h-20 w-20 rounded-full object-cover object-center">
                    <div>
                        <p class="text-2xl font-bold text-gray-900">{{$patient->user->name}}</p>
                    </div>
                </div>
                <div class="flex space-x-3 mt-6 lg:mt-0">
                    <x-wire-button outline gray href="{{route('admin.patients.index')}}">Volver</x-wire-button>
                    <x-wire-button type="submit">
                        <i class="fa-solid fa-check"></i>
                        Guardar cambios
                    </x-wire-button>
                </div>
            </div>
        </x-wire-card>
        {{-- Tabs de Navegación --}}
        <x-wire-card>
            <div x-data="{tab: 'datos-personales'}">
                {{-- Menú de Pestañas --}}
                <div class="border-b border-gray-200">
                    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center text-gray-500">
                        {{-- Tab 1: Datos Personales --}}
                        <li class="me-2">
                            <a href="#" x-on:click="tab = 'datos-personales'"
                               :class="{
                                    'text-blue-600 border-blue-600 active': tab === 'datos-personales',
                                    'border-transparent hover:text-blue-600 hover:border-blue-600': tab !== 'datos-personales'
                            }"
                               class="inline-flex items-center justify-center p-4 border-b-2 rounded-t-lg group transition-colors duration-200"
                               :aria-current="tab === 'datos-personales' ? 'page' : undefined">
                                <i class="fa-solid fa-user me-2"></i>
                                Datos personales
                            </a>
                        </li>
                        {{-- Tab 2: Antecedentes --}}
                        @php $hasError = $errors->hasAny($errorGroups['antecedentes']); @endphp
                        <li class="me-2">
                            <a href="#" x-on:click="tab = 'antecedentes'"
                               :class="{
                                    'text-blue-600 border-blue-600': tab === 'antecedentes' && !{{ $hasError ? 'true' : 'false' }},
                                    'text-red-600 border-red-600': {{ $hasError ? 'true' : 'false' }},
                                    'border-transparent hover:text-blue-600 hover:border-gray-300': tab !== 'antecedentes' && !{{ $hasError ? 'true' : 'false' }}
                                }"
                               class="inline-flex items-center justify-center p-4 border-b-2 rounded-t-lg group transition-colors duration-200"
                               :aria-current="tab === 'antecedentes' ? 'page' : undefined">
                                <i class="fa-solid fa-file-lines me-2"></i>
                                Antecedentes
                            </a>
                        </li>
                        {{-- Tab 3: Información General --}}
                        @php $hasError = $errors->hasAny($errorGroups['informacion-general']); @endphp
                        <li class="me-2">
                            <a href="#" x-on:click="tab = 'informacion-general'"
                               :class="{
                                    'text-blue-600 border-blue-600': tab === 'informacion-general' && !{{ $hasError ? 'true' : 'false' }},
                                    'text-red-600 border-red-600': {{ $hasError ? 'true' : 'false' }},
                                    'border-transparent hover:text-blue-600 hover:border-gray-300': tab !== 'informacion-general' && !{{ $hasError ? 'true' : 'false' }}
                                }"
                               class="inline-flex items-center justify-center p-4 border-b-2 rounded-t-lg group transition-colors duration-200"
                               :aria-current="tab === 'informacion-general' ? 'page' : undefined">
                                <i class="fa-solid fa-info me-2"></i>
                                Informacion general
                            </a>
                        </li>
                        {{-- Tab 4: Contacto de emergencia --}}
                        @php $hasError = $errors->hasAny($errorGroups['contacto-emergencia']); @endphp
                        <li class="me-2">
                            <a href="#" x-on:click="tab = 'contacto-emergencia'"
                               :class="{
                                    'text-blue-600 border-blue-600': tab === 'contacto-emergencia' && !{{ $hasError ? 'true' : 'false' }},
                                    'text-red-600 border-red-600': {{ $hasError ? 'true' : 'false' }},
                                    'border-transparent hover:text-blue-600 hover:border-gray-300': tab !== 'contacto-emergencia' && !{{ $hasError ? 'true' : 'false' }}
                                }"
                               class="inline-flex items-center justify-center p-4 border-b-2 rounded-t-lg group transition-colors duration-200"
                               :aria-current="tab === 'contacto-emergencia' ? 'page' : undefined">
                                <i class="fa-solid fa-heart me-2"></i>
                                Contacto de emergencia
                            </a>
                        </li>
                    </ul>
                </div>
                {{-- Contenido de los Tabs --}}
                <div class="px-4 mt-4">
                    {{-- Contenido de Tab 1: Datos personales --}}
                    <div x-show="tab === 'datos-personales'">
                        <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-6 rounded-r-lg shadow-sm">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                                {{-- Lado izquierdo: Información --}}
                                <div class="flex items-start">
                                    <div class="flex-shrink-0">
                                        <i class="fa-solid fa-user-gear text-blue-500 text-xl mt-1"></i>
                                    </div>
                                    <di class="ml-3">
                                        <h3 class="text-sm font-bold text-blue-800">
                                            Edición de cuenta de usuario
                                        </h3>
                                        <div class="mt-1 text-sm text-blue-600">
                                            <p>La <strong>información de acceso</strong> (Nombre, Email y contraseña)
                                                debe gestionarse desde la cuenta de usuario asociada.</p>
                                        </div>
                                    </di>
                                </div>
                                {{-- Lado derecho: Botón de acción --}}
                                <div class="flex-shrink-0">
                                    <x-wire-button primary sm href="{{route('admin.patients.edit', $patient->user)}}" target="_blank">
                                        Editar usuario
                                        <i class="fa-solid fa-arrow-up-right-from-square ms-2"></i>
                                    </x-wire-button>
                                </div>
                            </div>
                        </div>
                        <div class="grid lg:grid-cols-2 gap-4">
                            <div>
                                <span class="text-gray-500 font-semibold">Télefono:</span>
                                <span class="text-gray-900 text-sm ml-1">{{$patient->user->phone}}</span>
                            </div>
                            <div>
                                <span class="text-gray-500 font-semibold">Email:</span>
                                <span class="text-gray-900 text-sm ml-1">{{$patient->user->email}}</span>
                            </div>
                            <div>
                                <span class="text-gray-500 font-semibold">Dirección:</span>
                                <span class="text-gray-900 text-sm ml-1">{{$patient->user->address}}</span>
                            </div>
                        </div>
                    </div>
                    {{-- Contenido de Tab 2: Antedecentes --}}
                    <div x-show="tab === 'antecedentes'" style="display: none;">
                        <div class="grid lg:grid-cols-2 gap-4">
                            <div>
                                <x-wire-textarea label="Alergias conocidas" name="allergies">
                                    {{old('allergies', $patient->allergies)}}
                                </x-wire-textarea>
                            </div>
                            <div>
                                <x-wire-textarea label="Enfermedades crónicas" name="chronic_conditions">
                                    {{old('chronic_conditions', $patient->chronic_conditions)}}
                                </x-wire-textarea>
                            </div>
                            <div>
                                <x-wire-textarea label="Antecedentes quirúrgicos" name="surgical_history">
                                    {{old('surgical_history', $patient->surgical_history)}}
                                </x-wire-textarea>
                            </div>
                            <div>
                                <x-wire-textarea label="Antecedentes familiares" name="family_history">
                                    {{old('family_history', $patient->family_history)}}
                                </x-wire-textarea>
                            </div>
                        </div>
                    </div>
                    {{-- Contenido de Tab 3: Información general --}}
                    <div x-show="tab === 'informacion-general'" style="display: none;">
                        <x-wire-native-select label="Tipo de sangre" class="mb-4" name="blood_type_id">
                            <option value="">Selecciona un tipo de sangre</option>
                            @foreach($bloodTypes as $bloodType)
                                <option value="{{$bloodType->id}}" @selected(old('blood_type_id', $patient->blood_type_id) == $bloodType->id)>
                                    {{$bloodType->name}}
                                </option>
                            @endforeach
                        </x-wire-native-select>
                        <x-wire-textarea label="Observaciones" name="observations">
                            {{old('observations', $patient->observations)}}
                        </x-wire-textarea>
                    </div>
                    {{-- Contenido de Tab 4: Contacto de emergencia --}}
                    <div x-show="tab === 'contacto-emergencia'" style="display: none;">
                        <div class="space-y-4">
                            <x-wire-input label="Nombre de contacto" name="emergency_contact_name"
                            value="{{old('emergency_contact_name', $patient->emergency_contact_name)}}"/>
                            <x-wire-phone label="Télefono de contacto" name="emergency_contact_phone" mask="(###) ###-####" placeholder="(999) 000-0000"
                            value="{{old('emergency_contact_phone', $patient->emergency_contact_phone)}}"/>
                            <x-wire-input label="Relación con el contacto" name="emergency_contact_relationship" placeholder="Familiar, amigo, etc."
                            value="{{old('emergency_contact_relationship', $patient->emergency_contact_relationship)}}"/>
                        </div>
                    </div>
                </div>
            </div>
        </x-wire-card>
    </form>
</x-admin-layout>
