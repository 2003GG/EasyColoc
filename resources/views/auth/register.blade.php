<x-guest-layout>
    {{-- Page header --}}
    <div class="mb-8">
        <a href="/"
            class="inline-flex items-center gap-2 text-2xl font-black tracking-tight"
            style="font-family:'Playfair Display',serif; color:#0a2e1a; text-decoration:none;">
            Coloc<span style="color:#22c55e">.</span>
        </a>
        <h2 class="mt-4 text-xl font-semibold" style="color:#0a2e1a;">Create your account</h2>
        <p class="mt-1 text-sm" style="color:#4a6355;">Find your perfect flatmate in minutes.</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Full Name')"
                class="!text-xs !font-medium !tracking-wide !uppercase"
                style="color:#0a2e1a;" />
            <x-text-input id="name"
                class="block mt-1.5 w-full !rounded-xl !border-[#bbf7d0] !bg-[#f0fdf4]
                       focus:!border-[#22c55e] focus:!ring-[#22c55e] focus:!ring-1
                       !text-[#0a2e1a] placeholder:!text-[#86efac]"
                type="text"
                name="name"
                :value="old('name')"
                placeholder="Sophie Martin"
                required
                autofocus
                autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email Address')"
                class="!text-xs !font-medium !tracking-wide !uppercase"
                style="color:#0a2e1a;" />
            <x-text-input id="email"
                class="block mt-1.5 w-full !rounded-xl !border-[#bbf7d0] !bg-[#f0fdf4]
                       focus:!border-[#22c55e] focus:!ring-[#22c55e] focus:!ring-1
                       !text-[#0a2e1a] placeholder:!text-[#86efac]"
                type="email"
                name="email"
                :value="old('email')"
                placeholder="you@example.com"
                required
                autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')"
                class="!text-xs !font-medium !tracking-wide !uppercase"
                style="color:#0a2e1a;" />
            <x-text-input id="password"
                class="block mt-1.5 w-full !rounded-xl !border-[#bbf7d0] !bg-[#f0fdf4]
                       focus:!border-[#22c55e] focus:!ring-[#22c55e] focus:!ring-1
                       !text-[#0a2e1a] placeholder:!text-[#86efac]"
                type="password"
                name="password"
                placeholder="••••••••"
                required
                autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')"
                class="!text-xs !font-medium !tracking-wide !uppercase"
                style="color:#0a2e1a;" />
            <x-text-input id="password_confirmation"
                class="block mt-1.5 w-full !rounded-xl !border-[#bbf7d0] !bg-[#f0fdf4]
                       focus:!border-[#22c55e] focus:!ring-[#22c55e] focus:!ring-1
                       !text-[#0a2e1a] placeholder:!text-[#86efac]"
                type="password"
                name="password_confirmation"
                placeholder="••••••••"
                required
                autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Submit -->
        <div class="mt-7">
            <button type="submit"
                class="w-full flex items-center justify-center gap-2 py-3 px-6 rounded-full
                       text-white text-sm font-medium tracking-wide transition-all duration-200
                       hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-offset-2"
                style="background:#16522e; box-shadow:0 4px 20px rgba(22,82,46,.25);
                       focus-ring-color:#22c55e;">
                {{ __('Create my account') }}
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </button>
        </div>

        <!-- Already registered -->
        <p class="mt-5 text-center text-sm" style="color:#4a6355;">
            Already have an account?
            <a href="{{ route('login') }}"
                class="font-medium ml-1 transition-colors duration-150"
                style="color:#16522e;"
                onmouseover="this.style.color='#0a2e1a'"
                onmouseout="this.style.color='#16522e'">
                {{ __('Log in') }} →
            </a>
        </p>

    </form>
</x-guest-layout>
