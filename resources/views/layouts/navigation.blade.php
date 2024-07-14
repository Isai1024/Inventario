<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Contenedor Principal de Navegación -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Barra de Navegación -->
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <!-- Enlace al Dashboard -->
                    <a href="{{ route('dashboard') }}">
                        <!-- Logo de la Aplicación -->
                        <x-application-logo class="block h-10 w-auto fill-current text-gray-600" />
                    </a>
                </div>

                <!-- Enlaces de Navegación (ocultos en pantallas pequeñas) -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <!-- Enlace al Dashboard -->
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <!-- Enlace a Productos -->
                    <x-nav-link :href="route('productos.index')" :active="request()->routeIs('productos.index')">
                        {{ __('Productos') }}
                    </x-nav-link>
                    <!-- Enlace a Categorías -->
                    <x-nav-link :href="route('categorias.index')" :active="request()->routeIs('categorias.index')">
                        {{ __('Categorías') }}
                    </x-nav-link>
                    <!-- Enlace a Clientes -->
                    <x-nav-link :href="route('clientes.index')" :active="request()->routeIs('clientes.index')">
                        {{ __('Clientes') }}
                    </x-nav-link>
                    <!-- Enlace a Ventas -->
                    <x-nav-link :href="route('ventas.index')" :active="request()->routeIs('ventas.index')">
                        {{ __('Ventas') }}
                    </x-nav-link>
                    <!-- Enlace a Inventarios -->
                    <x-nav-link :href="route('inventarios.index')" :active="request()->routeIs('inventarios.index')">
                        {{ __('Inventarios') }}
                    </x-nav-link>

                    <!-- Enlace a Cotizaciones -->
                    <x-nav-link :href="route('cotizaciones.index')" :active="request()->routeIs('cotizaciones.index')">
                        {{ __('Cotizaciones') }}
                    </x-nav-link>

                    <x-nav-link :href="route('formasdepago.index')" :active="request()->routeIs('formasdepago.index')">
                        {{ __('Formas de pago') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Dropdown de Configuración (visible en pantallas medianas y grandes) -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <!-- Dropdown con Alineación a la Derecha y Ancho 48 -->
                <x-dropdown align="right" width="48">
                    <!-- Gatillo del Dropdown -->
                    <x-slot name="trigger">
                        <!-- Botón del Dropdown -->
                        <button
                            class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                            <!-- Nombre del Usuario Autenticado -->
                            <div>{{ Auth::user()->name }}</div>
                            <!-- Icono de Flecha para el Dropdown -->
                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 9.293a1 1 0 011.414 0L10 12.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <!-- Contenido del Dropdown -->
                    <x-slot name="content">
                        <!-- Formulario de Cierre de Sesión -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <!-- Enlace para Cerrar Sesión -->
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger para Pantallas Pequeñas -->
            <div class="-mr-2 flex items-center sm:hidden">
                <!-- Botón para Abrir/Cerrar el Menú en Dispositivos Móviles -->
                <button @click="open = !open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <!-- Icono de Hamburger (visible cuando el menú está cerrado) -->
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <!-- Icono de Hamburger -->
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <!-- Icono de X (visible cuando el menú está abierto) -->
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Menú de Navegación Responsive -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <!-- Lista de Enlaces de Navegación -->
        <div class="pt-2 pb-3 space-y-1">
            <!-- Enlace al Dashboard -->
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <!-- Enlace a Productos -->
            <x-responsive-nav-link :href="route('productos.index')" :active="request()->routeIs('productos.index')">
                {{ __('Productos') }}
            </x-responsive-nav-link>
            <!-- Enlace a Categorías -->
            <x-responsive-nav-link :href="route('categorias.index')" :active="request()->routeIs('categorias.index')">
                {{ __('Categorías') }}
            </x-responsive-nav-link>
            <!-- Enlace a Clientes -->
            <x-responsive-nav-link :href="route('clientes.index')" :active="request()->routeIs('clientes.index')">
                {{ __('Clientes') }}
            </x-responsive-nav-link>
            <!-- Enlace a Inventarios -->
            <x-responsive-nav-link :href="route('inventarios.index')" :active="request()->routeIs('inventarios.index')">
                {{ __('Inventarios') }}
            </x-responsive-nav-link>
            <!-- Enlace a Cotizaciones -->
            <x-responsive-nav-link :href="route('cotizaciones.index')" :active="request()->routeIs('cotizaciones.index')">
                {{ __('Cotizaciones') }}
            </x-responsive-nav-link>

        </div>

        <!-- Opciones de Configuración Responsive -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <!-- Nombre del Usuario Autenticado -->
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <!-- Correo Electrónico del Usuario Autenticado -->
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Formulario de Cierre de Sesión -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <!-- Enlace para Cerrar Sesión -->
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
