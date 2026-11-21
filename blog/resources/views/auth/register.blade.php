<x-layout>
    <x-form title="Register an account" description="Start tracking your ideas today.">
        <form action="/register" method="post" class="mt-10">
            @csrf

            <x-form.field name="name" label="Name"></x-form.field>
            <x-form.field name="email" label="Email" type="email"></x-form.field>
            <x-form.field name="password" label="Password" type="password"></x-form.field>



            <button type="submit" class="btn mt-2 h-10 w-full">Create Account</button>
        </form>
        <a href="/login" class="text-primary underline">Sign in</a>
    </x-form>

</x-layout>
