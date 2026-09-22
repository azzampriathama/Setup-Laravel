<x-layouts.auth variant="pink" title="Masuk ke Akun Belia">
    <form method="POST" action="{{ route('login.store') }}" class="space-y-5">
        @csrf

        @if ($errors->any())
            <div class="rounded-lg bg-white/95 px-4 py-3 text-sm text-rose-700">
                {{ $errors->first() }}
            </div>
        @endif

        <div>
            <label for="login" class="sr-only">Nama Pengguna/Email</label>
            <div class="relative">
                <input id="login" name="login" type="text" value="{{ old('login') }}" required autofocus
                    placeholder="Nama Pengguna/Email"
                    class="w-full rounded-full border-0 bg-white py-3 pl-5 pr-12 text-sm text-slate-700 placeholder:text-slate-400 focus:outline-none focus-visible:ring-2 focus-visible:ring-white">
                <span class="pointer-events-none absolute right-4 top-1/2 -translate-y-1/2 text-belia-400">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="8" r="4" />
                        <path d="M4 21c0-4 4-6 8-6s8 2 8 6" />
                    </svg>
                </span>
            </div>
        </div>

        <div>
            <label for="password" class="sr-only">Kata Sandi</label>
            <div class="relative">
                <input id="password" name="password" type="password" required placeholder="Kata Sandi"
                    class="w-full rounded-full border-0 bg-white py-3 pl-5 pr-12 text-sm text-slate-700 placeholder:text-slate-400 focus:outline-none focus-visible:ring-2 focus-visible:ring-white">
                <span class="pointer-events-none absolute right-4 top-1/2 -translate-y-1/2 text-belia-400">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <rect x="4" y="10" width="16" height="10" rx="2" />
                        <path d="M8 10V7a4 4 0 0 1 8 0v3" />
                    </svg>
                </span>
            </div>
        </div>

        <div class="flex items-center justify-between text-xs text-white/90">
            <label class="flex items-center gap-2">
                <input type="checkbox" name="remember" value="1"
                    class="h-4 w-4 rounded border-white/60 bg-white/20 text-belia-600 focus:ring-white">
                Ingat saya
            </label>
            <a href="{{ route('admin.login') }}" class="hover:underline">Masuk sebagai admin?</a>
        </div>

        <button type="submit"
            class="w-full rounded-full bg-white py-3 text-sm font-semibold text-belia-600 shadow transition hover:bg-belia-50 focus:outline-none focus-visible:ring-2 focus-visible:ring-white">
            Masuk
        </button>

        <p class="text-center text-[11px] leading-relaxed text-white/80">
            Akun demo: <span class="font-semibold">user@belia.test</span> / <span class="font-semibold">user123</span>
        </p>
    </form>
</x-layouts.auth>
