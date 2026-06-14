<x-guest-layout>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Custom Style -->
    <style>
        .modern-input {
            border-radius: 14px !important;
            overflow: hidden;
            border: 1px solid #e5e7eb;
            background: #f9fafb;
            transition: all .25s ease;
            box-shadow: 0 2px 10px rgba(0,0,0,0.04);
        }

        .modern-input:hover {
            box-shadow: 0 4px 14px rgba(0,0,0,0.08);
            border-color: #d1d5db;
        }

        .modern-input:focus-within {
            border-color: #6366f1;
            box-shadow: 0 0 0 4px rgba(99,102,241,.10);
            background: #ffffff;
        }

        .modern-input .input-group-text {
            background: transparent;
            border: none;
            color: #6b7280;
            padding-left: 18px;
            padding-right: 0;
            font-size: 18px;
        }

        .modern-input .form-control {
            border: none !important;
            background: transparent !important;
            box-shadow: none !important;
            padding-top: 1.6rem;
            padding-bottom: .6rem;
            font-size: 15px;
            color: #111827;
        }

        .modern-input .form-floating label {
            color: #9ca3af;
        }

        .modern-input .form-control:focus {
            box-shadow: none;
        }
    </style>

    <!-- Session Status -->
    <x-auth-session-status 
        class="mb-4" 
        :status="session('status')" 
    />

    <!-- Title -->
    <div class="text-center mb-5">

        <h2 class="text-3xl font-extrabold text-gray-800">
            Form Login
        </h2>

        <div class="w-16 h-1 bg-indigo-600 mx-auto rounded-full mt-3"></div>

        <p class="mt-4 text-sm text-gray-500 leading-relaxed">
            Silakan login untuk mengakses <br>
            sistem inventory gudang
        </p>

    </div>

    <!-- Form -->
    <form method="POST" action="{{ route('login') }}">

        @csrf

        <!-- Email -->
        <div class="mb-4">

            <div class="input-group modern-input">

                <span class="input-group-text">
                    <i class="bi bi-envelope"></i>
                </span>

                <div class="form-floating flex-grow-1">

                    <input 
                        type="email"
                        class="form-control"
                        id="email"
                        name="email"
                        placeholder="Email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        autocomplete="username"
                    >

                    <label for="email">
                        Email
                    </label>

                </div>

            </div>

            <x-input-error 
                :messages="$errors->get('email')" 
                class="mt-2"
            />

        </div>

        <!-- Password -->
        <div class="mb-4">

            <div class="input-group modern-input">

                <span class="input-group-text">
                    <i class="bi bi-lock"></i>
                </span>

                <div class="form-floating flex-grow-1">

                    <input 
                        type="password"
                        class="form-control"
                        id="password"
                        name="password"
                        placeholder="Password"
                        required
                        autocomplete="current-password"
                    >

                    <label for="password">
                        Password
                    </label>

                </div>

            </div>

            <x-input-error 
                :messages="$errors->get('password')" 
                class="mt-2"
            />

        </div>

        <!-- Remember -->
        <div class="flex items-center justify-between">

            {{-- <label for="remember_me" class="inline-flex items-center">
                <input 
                    id="remember_me"
                    type="checkbox"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                    name="remember"
                >

                <span class="ml-2 text-sm text-gray-600">
                    Remember me
                </span>
            </label>

            <a href="#" class="text-sm text-indigo-600 hover:text-indigo-800 transition duration-300">
                Lupa password?
            </a> --}}

        </div>

        <!-- Login Button -->
        <div class="mt-2">

            <button 
                type="submit"
                style="
                    width:100%;
                    background:linear-gradient(to right,#4f46e5,#2563eb);
                    color:white;
                    padding:15px 20px;
                    border:none;
                    border-radius:14px;
                    font-weight:700;
                    font-size:16px;
                    letter-spacing:.3px;
                    cursor:pointer;
                    transition:all .3s ease;
                    box-shadow:0 10px 25px rgba(79,70,229,.35);
                "
                onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 15px 30px rgba(79,70,229,.45)'"
                onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 10px 25px rgba(79,70,229,.35)'"
            >
                Login
            </button>

        </div>

    </form>

</x-guest-layout>