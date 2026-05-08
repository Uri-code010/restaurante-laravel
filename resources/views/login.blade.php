<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login Restaurante</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="flex bg-white shadow-lg rounded-lg overflow-hidden w-3/4 max-w-4xl">
        
        <div class="w-1/2 bg-cover" style="background-image: url('https://th.bing.com/th/id/R.ec6bf82064d04642edacc92026c44f1c?rik=1iFxq0nAIXuesA&pid=ImgRaw&r=0')">
        </div>

        <!-- Formulario -->
        <div class="w-1/2 p-8">
            <h2 class="text-3xl font-bold text-yellow-600 text-center mb-6">Bienvenido al Restaurante</h2>
            <p class="text-gray-600 text-center mb-6">Inicia sesión para continuar</p>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Correo</label>
                    <input type="email" name="email" id="email"
                        class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-500"
                        placeholder="ejemplo@correo.com" required>
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
                    <input type="password" name="password" id="password"
                        class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-500"
                        placeholder="********" required>
                </div>

                <button type="submit"
                    class="w-full bg-yellow-500 text-white py-2 rounded hover:bg-yellow-600 transition duration-200">
                    Ingresar
                </button>
            </form>

            <!-- Enlace a registro -->
            <p class="text-center text-sm text-gray-600 mt-4">
                ¿No tienes cuenta?
                <a href="{{ route('register') }}" class="text-yellow-600 font-semibold hover:underline">
                    Regístrate aquí
                </a>
