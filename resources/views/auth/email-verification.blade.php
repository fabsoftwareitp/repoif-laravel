<x-layout
    pageTitle="Verificação de e-mail - RepoIF"
    pageRobots="noindex, nofollow"
>
    <div class="container email-verification">
        <main class="email-verification__container">
            <h1 class="form__title">Verificação de e-mail</h1>

            <p class="email-verification__text">Obrigado por se cadastrar! Antes de começar, você poderia verificar seu e-mail institucional clicando no link que enviamos para ele? Se você não recebeu, podemos enviar outro.</p>

            @if (session('status') === 'verification-link-sent')
                <p class="email-verification__message">Um novo link de verificação foi enviado para o seu e-mail institucional.</p>
            @endif

            <div class="email-verification__action">
                <x-form
                    class="form--no-style"
                    action="{{ route('verification.send') }}"
                >
                    <x-button
                        class="button--full-width"
                        text="Reenviar"
                        :icon="asset('img/icons/email-icon.svg')"
                    ></x-button>
                </x-form>
            </div>
        </main>
    </div>
</x-layout>
