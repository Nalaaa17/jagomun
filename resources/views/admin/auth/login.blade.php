<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - JAGOMUN</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary-blue': '#3B82F6',
                        'light-blue': '#60A5FA',
                        'sky-blue': '#0EA5E9',
                        'ice-blue': '#E0F2FE',
                        'royal-blue': '#1E40AF',
                        'soft-gray': '#F8FAFC',
                        'medium-gray': '#64748B'
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #ffffff 0%, #E0F2FE 50%, #BFDBFE 100%);
            min-height: 100vh;
        }

        .glass-morphism {
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            background: rgba(255, 255, 255, 0.95);
            border: 1px solid rgba(59, 130, 246, 0.1);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1);
        }

        .floating-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            pointer-events: none;
        }

        .shape {
            position: absolute;
            border-radius: 50%;
            animation: float 20s infinite linear;
        }

        .shape.circle {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.1), rgba(96, 165, 250, 0.15));
        }

        .shape.triangle {
            width: 0;
            height: 0;
            border-radius: 0;
            border-left: 15px solid transparent;
            border-right: 15px solid transparent;
            border-bottom: 26px solid rgba(14, 165, 233, 0.1);
        }

        @keyframes float {
            0% {
                transform: translateY(100vh) rotate(0deg) scale(0.5);
                opacity: 0;
            }
            10% {
                opacity: 1;
                transform: translateY(90vh) rotate(36deg) scale(1);
            }
            90% {
                opacity: 1;
                transform: translateY(-10vh) rotate(324deg) scale(1);
            }
            100% {
                transform: translateY(-20vh) rotate(360deg) scale(0.5);
                opacity: 0;
            }
        }

        .input-focus {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .input-focus:focus {
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1), 0 4px 14px 0 rgba(59, 130, 246, 0.15);
            transform: translateY(-1px);
        }

        .login-card {
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .login-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 32px 64px -12px rgba(0, 0, 0, 0.15);
        }

        .btn-gradient {
            background: linear-gradient(135deg, #3B82F6 0%, #1E40AF 100%);
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .btn-gradient::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.5s;
        }

        .btn-gradient:hover::before {
            left: 100%;
        }

        .btn-gradient:hover {
            background: linear-gradient(135deg, #2563EB 0%, #1D4ED8 100%);
            transform: translateY(-1px);
            box-shadow: 0 10px 25px -5px rgba(59, 130, 246, 0.4);
        }

        .logo-container {
            background: linear-gradient(135deg, #3B82F6, #60A5FA);
            animation: logoGlow 3s ease-in-out infinite alternate;
        }

        @keyframes logoGlow {
            0% { box-shadow: 0 0 20px rgba(59, 130, 246, 0.4); }
            100% { box-shadow: 0 0 30px rgba(59, 130, 246, 0.6); }
        }

        .brand-text {
            background: linear-gradient(135deg, #1E40AF, #3B82F6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: textShine 2s ease-in-out infinite alternate;
        }

        @keyframes textShine {
            0% { filter: brightness(1); }
            100% { filter: brightness(1.2); }
        }

        .form-section {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.9), rgba(248, 250, 252, 0.9));
        }

        .logo-section {
            background: linear-gradient(135deg, #E0F2FE, #BFDBFE);
            border-right: 1px solid rgba(59, 130, 246, 0.1);
        }

        .security-badge {
            background: linear-gradient(135deg, rgba(34, 197, 94, 0.1), rgba(59, 130, 246, 0.1));
            border: 1px solid rgba(59, 130, 246, 0.2);
        }

        .decorative-pattern {
            background-image:
                radial-gradient(circle at 20% 50%, rgba(59, 130, 246, 0.05) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(96, 165, 250, 0.05) 0%, transparent 50%),
                radial-gradient(circle at 40% 80%, rgba(14, 165, 233, 0.05) 0%, transparent 50%);
        }

        @media (max-width: 768px) {
            .logo-section {
                border-right: none;
                border-bottom: 1px solid rgba(59, 130, 246, 0.1);
            }
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center relative overflow-hidden">
    <!-- Animated Background Shapes -->
    <div class="floating-shapes">
        <div class="shape circle" style="left: 10%; width: 40px; height: 40px; animation-delay: 0s;"></div>
        <div class="shape circle" style="left: 85%; width: 60px; height: 60px; animation-delay: 3s;"></div>
        <div class="shape circle" style="left: 45%; width: 30px; height: 30px; animation-delay: 6s;"></div>
        <div class="shape triangle" style="left: 25%; animation-delay: 2s;"></div>
        <div class="shape triangle" style="left: 70%; animation-delay: 8s;"></div>
        <div class="shape circle" style="left: 60%; width: 45px; height: 45px; animation-delay: 4s;"></div>
        <div class="shape triangle" style="left: 15%; animation-delay: 10s;"></div>
        <div class="shape circle" style="left: 90%; width: 35px; height: 35px; animation-delay: 7s;"></div>
    </div>

    <!-- Background Pattern -->
    <div class="decorative-pattern absolute inset-0 opacity-40"></div>

    <!-- Main Login Card -->
    <div class="login-card relative w-full max-w-4xl glass-morphism rounded-3xl z-10">
        <div class="flex flex-col md:flex-row min-h-[600px]">
            <!-- Logo Section (Left Half) -->
            <div class="logo-section flex-1 flex flex-col items-center justify-center p-8 md:p-12 rounded-l-3xl">
                <div class="text-center">
                    <!-- Main Logo -->
                    <div class="mb-8">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-40 h-40 mx-auto object-contain">
                    </div>

                    <!-- Brand Name -->
                    <h1 class="brand-text text-4xl font-bold mb-4">JAGOMUN</h1>
                    <p class="text-primary-blue/80 text-lg font-medium">Administrative Portal</p>
                </div>
            </div>

            <!-- Login Form Section (Right Half) -->
            <div class="form-section flex-1 p-8 md:p-12 flex flex-col justify-center rounded-r-3xl">
                <div class="max-w-sm mx-auto w-full">
                    <!-- Header -->
                    <div class="text-center mb-8">
                        <h2 class="text-3xl font-bold text-gray-800 mb-2">Welcome Back</h2>
                        <p class="text-medium-gray text-sm">Please sign in to your admin account</p>
                    </div>

                    @if ($errors->any())
                        <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-6 rounded-lg">
                            <div class="flex items-center">
                                <i class="fas fa-exclamation-circle text-red-400 mr-3"></i>
                                <p class="text-sm text-red-700">{{ $errors->first() }}</p>
                            </div>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.login') }}" class="space-y-6">
                        @csrf

                        <!-- Username Field -->
                        <div class="space-y-2">
                            <label for="username" class="block text-sm font-semibold text-gray-700">
                                <i class="fas fa-user mr-2 text-primary-blue"></i>Username
                            </label>
                            <div class="relative">
                                <input id="username" name="username" type="text" autocomplete="username" required
                                    class="input-focus block w-full px-4 py-4 pl-12 bg-white text-gray-800 border-2 border-gray-200 rounded-xl shadow-sm
                                    placeholder-gray-400 focus:outline-none focus:border-primary-blue transition-all duration-300">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <i class="fas fa-user text-primary-blue/60"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Password Field -->
                        <div class="space-y-2">
                            <label for="password" class="block text-sm font-semibold text-gray-700">
                                <i class="fas fa-lock mr-2 text-primary-blue"></i>Password
                            </label>
                            <div class="relative">
                                <input id="password" name="password" type="password" required
                                    class="input-focus block w-full px-4 py-4 pl-12 pr-12 bg-white text-gray-800 border-2 border-gray-200 rounded-xl shadow-sm
                                    placeholder-gray-400 focus:outline-none focus:border-primary-blue transition-all duration-300">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <i class="fas fa-lock text-primary-blue/60"></i>
                                </div>
                                <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-0 pr-4 flex items-center text-primary-blue/60 hover:text-primary-blue transition-colors">
                                    <i class="fas fa-eye" id="toggleIcon"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-4">
                            <button type="submit"
                                class="btn-gradient w-full flex justify-center items-center py-4 px-6 rounded-xl shadow-lg text-sm font-bold
                                       text-white focus:outline-none focus:ring-4 focus:ring-primary-blue/20 transition-all duration-300">
                                <i class="fas fa-sign-in-alt mr-2"></i>
                                Access Dashboard
                            </button>
                        </div>
                    </form>

                    <!-- Security Badges -->
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <div class="flex items-center justify-center space-x-6 text-xs">
                            <div class="security-badge px-3 py-2 rounded-full flex items-center">
                                <i class="fas fa-shield-alt text-green-500 mr-2"></i>
                                <span class="text-gray-600 font-medium">SSL Protected</span>
                            </div>
                            <div class="security-badge px-3 py-2 rounded-full flex items-center">
                                <i class="fas fa-lock text-primary-blue mr-2"></i>
                                <span class="text-gray-600 font-medium">2FA Ready</span>
                            </div>
                        </div>
                    </div>

                    <!-- Copyright -->
                    <p class="text-center text-xs text-gray-500 mt-6 font-light">
                        &copy; 2025 <span class="font-semibold text-primary-blue">JAGOMUN</span>. All rights reserved.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordField = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }

        // Enhanced interactive effects
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('input');
            const labels = document.querySelectorAll('label');

            inputs.forEach((input, index) => {
                input.addEventListener('focus', function() {
                    this.parentElement.parentElement.style.transform = 'translateY(-2px)';
                    if (labels[index]) {
                        labels[index].style.color = '#3B82F6';
                    }
                });

                input.addEventListener('blur', function() {
                    this.parentElement.parentElement.style.transform = 'translateY(0px)';
                    if (labels[index] && !this.value) {
                        labels[index].style.color = '#374151';
                    }
                });
            });

            // Add subtle animations on page load
            const card = document.querySelector('.login-card');
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';

            setTimeout(() => {
                card.style.transition = 'all 0.8s cubic-bezier(0.4, 0, 0.2, 1)';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0px)';
            }, 100);
        });
    </script>
</body>
</html>
