<x-layout>
    <form action="/login" method="POST" class="space-y-6">
        @csrf
        
        <fieldset class="fieldset border-base-500 rounded-box w-xs border p-4 mx-auto">
            <legend class="fieldset-legend bg-base-400 text-4xl">Login</legend>

            <label class="label">Email</label>
            <input type="email" name="email" class="input" placeholder="Email" value="{{ old('email') }}" required />
            <x-form.error name="email" />

            <label class="label">Password</label>
            <input type="password" name="password" class="input" placeholder="Password" required />
            <x-form.error name="password" />
            
            <button type="submit" class="btn btn-neutral mt-4">Login</button>
        </fieldset>
    </form>
</x-layout>