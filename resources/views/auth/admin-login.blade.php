<x-layouts.auth variant="plum" title="Masuk Sebagai Admin">
    <form method="POST" action="{{ route('admin.login.store') }}" class="space-y-5">
        @csrf

        @if ($errors->any())
            <div class="rounded-lg bg-white/95 px-4 py-3 text-sm text-rose-700">
                {{ $errors->first() }}
            </div>
        @endif

        <div>
            <label for="login" class="sr-only">ID Admin / Email</label>
            <div class="relative">
                <input id="login" name="login" type="text" value="{{ old('login') }}" required autofocus
                    placeholder="ID Admin / Email"
                    class="w-full rounded-full border-0 bg-white py-3 pl-5 pr-12 text-sm text-slate-700 placeholder:text-slate-400 focus:outline-none focus-visible:ring-2 focus-visible:ring-white">
                <span class="pointer-events-none absolute right-4 top-1/2 -translate-y-1/2 text-admin-500">
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
                <span class="pointer-events-none absolute right-4 top-1/2 -translate-y-1/2 text-admin-500">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <rect x="4" y="10" width="16" height="10" rx="2" />
                        <path d="M8 10V7a4 4 0 0 1 8 0v3" />
                    </svg>
                </span>
            </div>
        </div>

        <a href="{{ route('login') }}" class="block text-right text-xs text-white/90 hover:underline">
            Masuk sebagai pembeli?
        </a>

        <button type="submit"
            class="w-full rounded-full bg-admin-900/80 py-3 text-sm font-semibold text-white shadow ring-1 ring-white/40 transition hover:bg-admin-900 focus:outline-none focus-visible:ring-2 focus-visible:ring-white">
            Masuk (Admin)
        </button>

        <p class="text-center text-[11px] leading-relaxed text-white/80">
            Akun demo: <span class="font-semibold">admin@belia.test</span> / <span class="font-semibold">admin123</span>
        </p>
    </form>
</x-layouts.auth>
