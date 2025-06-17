



<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema Web de Gestión de Correspondencia</title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>

<body class="bg-gray-100 font-sans antialiased min-h-screen flex flex-col relative">

    <!-- Fondo con el logo de Ingeniería Textil -->
    <div class="absolute inset-0 z-0 flex items-center justify-center pointer-events-none">
        <img src="<?php echo e(asset('/logo_textil.png')); ?>" alt="Logo Ingeniería Textil" class="w-1/3 opacity-10">
    </div>

    

    <!-- Header -->
    <header class="bg-white shadow-md z-10 relative">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

            <h1 class="text-xl font-bold text-gray-800">Sistema Web de Gestión de Correspondencia - Ingeniería Textil
                U.P.E.A.<img src="<?php echo e(asset('/sgc.jpg')); ?>" alt="Logo del Sistema" class="mx-auto w-24 h-auto mb-6"></h1>
            <a href="<?php echo e(route('login')); ?>"
                class="font-semibold text-blue-600 hover:text-blue-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Inicio
                de sesión</a>

            

        </div>
    </header>

    <!-- Hero Section -->
    <main class="flex-grow flex items-center justify-center relative z-10">
        <div class="text-center px-6">
            <h2 class="text-4xl font-extrabold text-gray-900 mb-4">Bienvenido al Sistema</h2>
            <p class="text-gray-600 mb-6 max-w-xl mx-auto leading-relaxed">
                Automatiza los procesos de registro, despacho, control y seguimiento de la correspondencia de la carrera
                de Ingeniería Textil de la U.P.E.A.
            </p>
            <a href="<?php echo e(route('tramite.buscar')); ?>"
                class="bg-blue-600 text-white px-6 py-3 rounded-lg shadow-md hover:bg-blue-700 transition-all">
                Seguimiento de trámites
            </a>


        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white mt-10 py-4 text-center text-sm text-gray-500 relative z-10">
        
        Diseño, producción, confección <br>
        Ingeniería Textil tu mejor elección
    </footer>

</body>

</html>
<?php /**PATH C:\xampp\htdocs\proyecto-grado\resources\views/welcome.blade.php ENDPATH**/ ?>