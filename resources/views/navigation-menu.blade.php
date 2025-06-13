<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">

                    @guest
                        <x-nav-link href="{{ route('tramite.buscar') }}" :active="request()->routeIs('tramite.buscar')">
                            {{-- {{ __('Buscar') }} --}}
                        </x-nav-link>
                    @endguest
                    {{-- Solo muestra el dashboard si hay un usuario logueado, o redirige a la página de bienvenida --}}
                    @auth
                        <a href="{{ route('dashboard') }}">
                            <x-application-mark class="block h-9 w-auto" />
                        </a>
                    @else
                        <a href="{{ url('/') }}"> {{-- O la ruta que quieras para usuarios no autenticados --}}
                            <x-application-mark class="block h-9 w-auto" />
                        </a>
                    @endauth
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    {{-- Estos enlaces deben ser visibles solo para usuarios autenticados --}}
                    @auth
                        <x-nav-link href="{{ route('correspondencia.index') }}" :active="request()->routeIs('correspondencia.index')">
                            {{ __('Listado de trámites') }}
                        </x-nav-link>

                        <x-nav-link href="{{ route('tramites.formularioInterno') }}" :active="request()->routeIs('tramites.formularioInterno')">
                            {{ __('Búsqueda por código') }}
                        </x-nav-link>
                        <x-nav-link href="{{ route('tramites.buscarPorReferenciaForm') }}" :active="request()->routeIs('tramites.buscarPorReferenciaForm')">
                            {{ __('Buscar por referencia') }}
                        </x-nav-link>
                        <x-nav-link href="{{ route('correspondencia.registrar') }}" :active="request()->routeIs('correspondencia.registrar')">
                            {{ __('Nuevo trámite') }}
                        </x-nav-link>
                        <x-nav-link :href="route('bandeja.entrada')" :active="request()->routeIs('bandeja.entrada')">
                            {{ __('Mis Trámites') }}
                        </x-nav-link>
                        {{-- <x-nav-link href="{{ route('alertas.verificar') }}" :active="request()->routeIs('alertas.verificar')">
                            {{ __('Alertas') }}
                        </x-nav-link> --}}
                        <x-nav-link href="{{ route('reportes.menu') }}" :active="request()->routeIs('reportes.*')">
                            📊 Reportes
                        </x-nav-link>
                        <x-nav-link href="{{ route('tramites.recibidos') }}" :active="request()->routeIs('tramites.recibidos')">
                            {{ __('Trámites recibidos') }}
                        </x-nav-link>
                        <x-nav-link href="{{ route('tramites.pendientes') }}" :active="request()->routeIs('tramites.pendientes')">
                            {{ __('Trámites pendientes') }}
                        </x-nav-link>
                        <x-nav-link href="{{ route('tramites.despachados') }}" :active="request()->routeIs('tramites.despachados')">
                            {{ __('Trámites archivados') }}
                        </x-nav-link>

                        @if (auth()->user()->hasRole('superadmin'))
                            <x-nav-link href="{{ route('usuarios.index') }}" :active="request()->routeIs('usuarios.*')">
                                {{ __('Administrar Usuarios') }}
                            </x-nav-link>
                            <x-nav-link href="{{ route('roles.index') }}" :active="request()->routeIs('roles.*')">
                                {{ __('Administrar Roles') }}
                            </x-nav-link>
                        @endif
                        @can('ver_permisos')
                           
                            <x-nav-link :href="route('permisos.index')" :active="request()->routeIs('permisos.*')">
                                {{ __('Administrar Permisos') }}
                            </x-nav-link>
                        @endcan
                    @endauth
                    @if (auth()->check() && auth()->user()->hasRole('superadmin'))
                        <form method="POST" action="{{ route('logout') }}" class="ms-4">
                            @csrf
                            <button type="submit"
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-red-600 bg-white hover:text-red-800 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                {{ __('Cerrar sesión') }}
                            </button>
                        </form>
                    @endif
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="ms-3 relative">
                        @auth {{-- Solo si está autenticado --}}
                            <x-dropdown align="right" width="60">
                                <x-slot name="trigger">
                                    <span class="inline-flex rounded-md">
                                        <button type="button"
                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                            {{ Auth::user()->currentTeam->name }}

                                            <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                            </svg>
                                        </button>
                                    </span>
                                </x-slot>

                                <x-slot name="content">
                                    <div class="w-60">
                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                            {{ __('Manage Team') }}
                                        </div>

                                        <x-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                            {{ __('Team Settings') }}
                                        </x-dropdown-link>

                                        @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                            <x-dropdown-link href="{{ route('teams.create') }}">
                                                {{ __('Create New Team') }}
                                            </x-dropdown-link>
                                        @endcan

                                        @if (Auth::user()->allTeams()->count() > 1)
                                            <div class="border-t border-gray-200"></div>

                                            <div class="block px-4 py-2 text-xs text-gray-400">
                                                {{ __('Switch Teams') }}
                                            </div>

                                            @foreach (Auth::user()->allTeams() as $team)
                                                <x-switchable-team :team="$team" />
                                            @endforeach
                                        @endif
                                    </div>
                                </x-slot>
                            </x-dropdown>
                        @endauth
                    </div>
                @endif

                <div class="ms-3 relative">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @if (Auth::check()) {{-- Aquí está la clave para evitar el error --}}
                                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                    <button
                                        class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                        <img class="h-8 w-8 rounded-full object-cover"
                                            src="{{ Auth::user()->profile_photo_url }}"
                                            alt="{{ Auth::user()->name }}" />
                                    </button>
                                @else
                                    <span class="inline-flex rounded-md">
                                        <button type="button"
                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                            {{ Auth::user()->name }}

                                            <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                            </svg>
                                        </button>
                                    </span>
                                @endif
                            @else
                                {{-- Este es el botón para la búsqueda pública cuando no hay usuario logueado --}}
                                <a href="{{ route('tramites.formulario') }}"
                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-blue-600 bg-white hover:text-blue-800 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                    Buscar Trámite
                                </a>
                            @endif
                        </x-slot>

                        <x-slot name="content">
                            @auth {{-- El contenido del dropdown también debe ser condicional --}}
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    {{ __('Manage Account') }}
                                </div>

                                <x-dropdown-link href="{{ route('profile.show') }}">
                                    {{ __('Profile') }}
                                </x-dropdown-link>

                                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                    <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                        {{ __('API Tokens') }}
                                    </x-dropdown-link>
                                @endif

                                <div class="border-t border-gray-200"></div>

                                @if (Auth::check())
                                    {{-- Opciones del perfil, tokens, etc. --}}
                                    <div class="border-t border-gray-200"></div>

                                    {{-- Este botón siempre aparecerá para cualquier usuario logueado --}}
                                    <form method="POST" action="{{ route('logout') }}" x-data>
                                        @csrf
                                        <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                            {{ __('Cerrar sesión') }}
                                        </x-dropdown-link>
                                    </form>
                                @endif

                                {{-- <form method="POST" action="{{ route('logout') }}" x-data>
                                    @csrf

                                    <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form> --}}
                            @endauth
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">

              @guest
                        <x-responsive-nav-link href="{{ route('tramite.buscar') }}" :active="request()->routeIs('tramite.buscar')">
                            {{-- {{ __('Buscar') }} --}}
                        </x-responsive-nav-link>
                    @endguest
            {{-- Estos enlaces también deben ser condicionales --}}
            @auth
                        <x-responsive-nav-link href="{{ route('correspondencia.index') }}" :active="request()->routeIs('correspondencia.index')">
                            {{ __('Listado de trámites') }}
                        </x-responsive-nav-link>

                        <x-responsive-nav-link href="{{ route('tramites.formularioInterno') }}" :active="request()->routeIs('tramites.formularioInterno')">
                            {{ __('Búsqueda por código') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link href="{{ route('tramites.buscarPorReferenciaForm') }}" :active="request()->routeIs('tramites.buscarPorReferenciaForm')">
                            {{ __('Buscar por referencia') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link href="{{ route('correspondencia.registrar') }}" :active="request()->routeIs('correspondencia.registrar')">
                            {{ __('Nuevo trámite') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link :href="route('bandeja.entrada')" :active="request()->routeIs('bandeja.entrada')">
                            {{ __('Mis Trámites') }}
                        </x-responsive-nav-link>
                      
                        <x-responsive-nav-link href="{{ route('reportes.menu') }}" :active="request()->routeIs('reportes.*')">
                            📊 Reportes
                        </x-responsive-nav-link>
                        <x-responsive-nav-link href="{{ route('tramites.recibidos') }}" :active="request()->routeIs('tramites.recibidos')">
                            {{ __('Trámites recibidos') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link href="{{ route('tramites.pendientes') }}" :active="request()->routeIs('tramites.pendientes')">
                            {{ __('Trámites pendientes') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link href="{{ route('tramites.despachados') }}" :active="request()->routeIs('tramites.despachados')">
                            {{ __('Trámites archivados') }}
                        </x-responsive-nav-link>

                        @if (auth()->user()->hasRole('superadmin'))
                            <x-responsive-nav-link href="{{ route('usuarios.index') }}" :active="request()->routeIs('usuarios.*')">
                                {{ __('Administrar Usuarios') }}
                            </x-responsive-nav-link>
                            <x-responsive-nav-link href="{{ route('roles.index') }}" :active="request()->routeIs('roles.*')">
                                {{ __('Administrar Roles') }}
                            </x-responsive-nav-link>
                        @endif
                        @can('ver_permisos')
                           
                            <x-responsive-nav-link :href="route('permisos.index')" :active="request()->routeIs('permisos.*')">
                                {{ __('Administrar Permisos') }}
                            </x-responsive-nav-link>
                        @endcan
                    @endauth
                    @if (auth()->check() && auth()->user()->hasRole('superadmin'))
                        <form method="POST" action="{{ route('logout') }}" class="ms-4">
                            @csrf
                            <button type="submit"
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-red-600 bg-white hover:text-red-800 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                {{ __('Cerrar sesión') }}
                            </button>
                        </form>
                    @endif
        </div>

        <div class="pt-4 pb-1 border-t border-gray-200">
            @auth {{-- Todo el bloque de opciones del usuario solo si está autenticado --}}
                <div class="flex items-center px-4">
                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                        <div class="shrink-0 me-3">
                            <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}"
                                alt="{{ Auth::user()->name }}" />
                        </div>
                    @endif

                    <div>
                        <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                        <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                    </div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                        <x-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                            {{ __('API Tokens') }}
                        </x-responsive-nav-link>
                    @endif

                    <div class="border-t border-gray-200"></div>

                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf

                        <x-responsive-nav-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>

                    @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                        <div class="border-t border-gray-200"></div>

                        <div class="block px-4 py-2 text-xs text-gray-400">
                            {{ __('Manage Team') }}
                        </div>

                        <x-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}"
                            :active="request()->routeIs('teams.show')">
                            {{ __('Team Settings') }}
                        </x-responsive-nav-link>

                        @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                            <x-responsive-nav-link href="{{ route('teams.create') }}" :active="request()->routeIs('teams.create')">
                                {{ __('Create New Team') }}
                            </x-responsive-nav-link>
                        @endcan

                        @if (Auth::user()->allTeams()->count() > 1)
                            <div class="border-t border-gray-200"></div>

                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Switch Teams') }}
                            </div>

                            @foreach (Auth::user()->allTeams() as $team)
                                <x-switchable-team :team="$team" component="responsive-nav-link" />
                            @endforeach
                        @endif
                    @endif
                </div>
            @endauth
        </div>
    </div>
</nav>
