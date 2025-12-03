<div class="flex items-center justify-center p-6 min-h-screen bg-white">
    <div class="mx-auto w-full max-w-sm space-y-6">
        <div class="text-center space-y-2">
            <h1 class="font-bold text-xl">Selamat datang di {{ config('app.name') }}.</h1>
            <p class="text-sm text-zinc-600 font-light">silahkan masuk ke akun administrator kamu
            </p>
        </div>
        <form class="space-y-6" wire:submit="auth">
            <x-input label="Alamat Email *" type="email" wire:model="email" placeholder="me@work-email.com" required />
            <x-password label="Password *" wire:model="password"
                placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;" required />
            <x-button type="submit" loading="auth" x-bind:disabled="!$wire.email || !$wire.password" class="w-full">
                <span class="font-semibold text-sm">Masuk</span>
            </x-button>
        </form>
    </div>
</div>
