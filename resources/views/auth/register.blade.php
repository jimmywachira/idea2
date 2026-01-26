<x-layout>
    <x-form title="Reg an account" description="Join us today and unlock a world of possibilities!">
        <form action="/register" method="POST" class="space-y-6">
            @csrf
            <fieldset class="fieldset bg-base-200 border-base-300 rounded-box w-xs border p-4 mx-auto">
                <legend class="fieldset-legend bg-base-400 text-2xl">Register</legend>

                <x-form.field name="name" label="Name" />
                <x-form.field name="email" label="Email" type="email" />
                <x-form.field name="password" label="Password" type="password" />

                <button type="submit" class="btn btn-neutral mt-4">Register</button>
            </fieldset>
        </form>
    </x-form>
</x-layout>