<x-app-layout>
    <x-slot name="header">
        {{ __('Meu Perfil') }}
    </x-slot>

    <div>
        <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8 space-y-12">

            @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                <div class="bg-white p-2 rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    @livewire('profile.update-profile-information-form')
                </div>
            @endif

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                <div class="bg-white p-2 rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    @livewire('profile.update-password-form')
                </div>
            @endif

            @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                <div class="bg-white p-2 rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    @livewire('profile.two-factor-authentication-form')
                </div>
            @endif

            <div class="bg-white p-2 rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                @livewire('profile.logout-other-browser-sessions-form')
            </div>

            @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                <div class="bg-red-50 p-2 rounded-2xl shadow-sm border border-red-100 overflow-hidden">
                    @livewire('profile.delete-user-form')
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
