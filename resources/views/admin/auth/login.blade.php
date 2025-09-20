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
                        'navy': '#1E2233',
                        'royal': '#2D3B61',
                        'gold': '#B4976B',
                        'champagne': '#D6C4A4',
                        'ivory': '#F2EFEA'
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #1E2233 0%, #2D3B61 50%, #1E2233 100%);
        }

        .glass-morphism {
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            background: rgba(30, 34, 51, 0.8);
            border: 1px solid rgba(180, 151, 107, 0.2);
        }

        .floating-particles {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        .particle {
            position: absolute;
            background: rgba(180, 151, 107, 0.3);
            border-radius: 50%;
            animation: float 15s infinite linear;
        }

        @keyframes float {
            0% { transform: translateY(100vh) rotate(0deg); opacity: 0; }
            10% { opacity: 1; }
            90% { opacity: 1; }
            100% { transform: translateY(-100px) rotate(360deg); opacity: 0; }
        }

        .input-glow:focus {
            box-shadow: 0 0 0 2px rgba(180, 151, 107, 0.3), 0 0 20px rgba(180, 151, 107, 0.2);
        }

        .login-card {
            position: relative;
            overflow: hidden;
        }

        .login-card::before {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            background: linear-gradient(45deg, #B4976B, #D6C4A4, #B4976B, #D6C4A4);
            background-size: 400% 400%;
            border-radius: 18px;
            z-index: -1;
            animation: borderGlow 4s ease-in-out infinite;
        }

        @keyframes borderGlow {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }

        .btn-shimmer {
            background: linear-gradient(45deg, #B4976B, #D6C4A4, #B4976B);
            background-size: 200% 200%;
            animation: shimmer 2s ease-in-out infinite;
            position: relative;
            overflow: hidden;
        }

        .btn-shimmer::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.6s;
        }

        .btn-shimmer:hover::before {
            left: 100%;
        }

        @keyframes shimmer {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }

        .logo-pulse {
            animation: logoPulse 3s ease-in-out infinite;
        }

        @keyframes logoPulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .text-shadow {
            text-shadow: 2px 2px 4px rgba(30, 34, 51, 0.8);
        }

        .icon-float {
            animation: iconFloat 3s ease-in-out infinite;
        }

        @keyframes iconFloat {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-5px); }
        }

        .logo-section {
            background: linear-gradient(135deg, rgba(180, 151, 107, 0.1), rgba(214, 196, 164, 0.1));
            border-right: 1px solid rgba(180, 151, 107, 0.2);
        }

        @media (max-width: 768px) {
            .logo-section {
                border-right: none;
                border-bottom: 1px solid rgba(180, 151, 107, 0.2);
            }
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center relative overflow-hidden">
    <!-- Animated Background Particles -->
    <div class="floating-particles">
        <div class="particle" style="left: 10%; animation-delay: 0s; width: 4px; height: 4px;"></div>
        <div class="particle" style="left: 20%; animation-delay: 2s; width: 6px; height: 6px;"></div>
        <div class="particle" style="left: 30%; animation-delay: 4s; width: 3px; height: 3px;"></div>
        <div class="particle" style="left: 40%; animation-delay: 6s; width: 5px; height: 5px;"></div>
        <div class="particle" style="left: 50%; animation-delay: 8s; width: 4px; height: 4px;"></div>
        <div class="particle" style="left: 60%; animation-delay: 10s; width: 6px; height: 6px;"></div>
        <div class="particle" style="left: 70%; animation-delay: 12s; width: 3px; height: 3px;"></div>
        <div class="particle" style="left: 80%; animation-delay: 14s; width: 5px; height: 5px;"></div>
        <div class="particle" style="left: 90%; animation-delay: 1s; width: 4px; height: 4px;"></div>
    </div>

    <!-- Background Image + Enhanced Overlay -->
    <div class="absolute inset-0">
        <img src="https://images.pexels.com/photos/1366957/pexels-photo-1366957.jpeg?auto=compress&cs=tinysrgb&w=1920&h=1080&dpr=1"
             alt="background" class="w-full h-full object-cover opacity-20">
        <div class="absolute inset-0 bg-gradient-to-br from-navy/90 via-royal/80 to-navy/90"></div>
        <div class="absolute inset-0 bg-navy/30"></div>
    </div>

    <!-- Login Card -->
    <div class="login-card relative w-full max-w-4xl glass-morphism rounded-2xl shadow-2xl z-10 transform hover:scale-[1.02] transition-all duration-300">
        <div class="flex flex-col md:flex-row min-h-[500px]">
            <!-- Logo Section (Left Half) -->
            <div class="logo-section flex-1 flex flex-col items-center justify-center p-8 md:p-12">
                <div class="text-center">
                    <!-- Main Logo -->
                    <div class="logo-pulse mb-6">
                    <div class="w-24 h-24 mx-auto bg-gradient-to-br from-gold to-champagne rounded-full flex items-center justify-center shadow-2xl border-4 border-champagne/30 overflow-hidden">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-16 h-16 object-contain">
                    </div>
                </div>
                </div>
            </div>

            <!-- Login Form Section (Right Half) -->
            <div class="flex-1 p-8 md:p-12 flex flex-col justify-center">
                <div class="max-w-sm mx-auto w-full">
                    <!-- Header -->
                    <div class="text-center mb-8">
                        <h2 class="text-3xl font-bold text-ivory mb-2">Admin Login</h2>
                        <p class="text-champagne/80 text-sm">Enter your credentials to continue</p>
                    </div>

                    @if ($errors->any())
                        <div class="bg-red-500/20 border border-red-400/50 backdrop-blur-sm text-red-200 p-4 mb-6 rounded-lg relative overflow-hidden">
                            <div class="absolute inset-0 bg-red-500/10"></div>
                            <div class="relative flex items-center">
                                <i class="fas fa-exclamation-triangle text-red-300 mr-3"></i>
                                <p class="text-sm">{{ $errors->first() }}</p>
                            </div>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.login') }}">
                        @csrf
                        <div class="space-y-6">
                            <!-- Username Field -->
                            <div class="relative">
                                <label for="username" class="block text-sm font-semibold text-champagne mb-2">
                                    <i class="fas fa-user mr-2 text-gold"></i>Username
                                </label>
                                <div class="relative">
                                    <input id="username" name="username" type="text" autocomplete="username" required
                                        class="input-glow block w-full px-4 py-3 pl-12 bg-royal/30 text-ivory border border-gold/30 rounded-xl shadow-sm
                                        placeholder-champagne/50 focus:outline-none focus:border-gold/80 transition-all duration-300 backdrop-blur-sm">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <i class="fas fa-user text-gold/70"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Password Field -->
                            <div class="relative">
                                <label for="password" class="block text-sm font-semibold text-champagne mb-2">
                                    <i class="fas fa-lock mr-2 text-gold"></i>Password
                                </label>
                                <div class="relative">
                                    <input id="password" name="password" type="password" required
                                        class="input-glow block w-full px-4 py-3 pl-12 pr-12 bg-royal/30 text-ivory border border-gold/30 rounded-xl shadow-sm
                                        placeholder-champagne/50 focus:outline-none focus:border-gold/80 transition-all duration-300 backdrop-blur-sm">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <i class="fas fa-lock text-gold/70"></i>
                                    </div>
                                    <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-0 pr-4 flex items-center text-gold/70 hover:text-gold transition-colors">
                                        <i class="fas fa-eye" id="toggleIcon"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="pt-4">
                                <button type="submit"
                                    class="btn-shimmer w-full flex justify-center items-center py-4 px-6 rounded-xl shadow-lg text-sm font-bold
                                           text-navy transform hover:scale-105 focus:outline-none focus:ring-4 focus:ring-gold/30
                                           transition-all duration-300">
                                    <i class="fas fa-sign-in-alt mr-2"></i>
                                    Access Dashboard
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Additional Security Info -->
                    <div class="mt-8 pt-6 border-t border-champagne/20">
                        <div class="flex items-center justify-center space-x-4 text-xs text-champagne/60">
                            <div class="flex items-center">
                                <i class="fas fa-shield-alt text-green-400 mr-1"></i>
                                <span>SSL Secured</span>
                            </div>
                            <div class="w-1 h-1 bg-champagne/40 rounded-full"></div>
                            <div class="flex items-center">
                                <i class="fas fa-clock text-blue-400 mr-1"></i>
                                <span>Session Protected</span>
                            </div>
                        </div>
                    </div>

                    <!-- Copyright -->
                    <p class="text-center text-xs text-champagne/50 mt-6 font-light">
                        &copy; 2025 <span class="font-semibold text-gold">JAGOMUN</span>. All rights reserved.
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

        // Add some interactive effects
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('input');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.style.transform = 'translateY(-2px)';
                });
                input.addEventListener('blur', function() {
                    this.parentElement.style.transform = 'translateY(0px)';
                });
            });
        });
    </script>
</body>
</html>
