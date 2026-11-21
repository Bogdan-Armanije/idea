<x-layout>
    <x-form title="Edit an account" description="Need to make a tweak?">
        <form action="/profile" method="post" class="mt-10">
            @csrf
            @method('PATCH')

            <x-form.field name="name" label="Name" :value="$user->name"></x-form.field>
            <x-form.field name="email" label="Email" type="email" :value="$user->email"></x-form.field>
            <x-form.field name="password" label="New Password" type="password" ></x-form.field>



            <button type="submit" data-test="update-profile-button" class="btn mt-2 h-10 w-full">Update Account</button>
        </form>
    </x-form>
</x-layout>
