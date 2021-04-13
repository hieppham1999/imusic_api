<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Create') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-3 gap-3 bg-gray-100">
                        <div class="col-span-2">
                            <form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                                @if (session('success'))
                                    <div class="alert alert-success text-green-400 text-center">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                <div class="grid grid-cols-3 gap-3 m-5">
                                    <div class="my-2 col-span-3 ">
                                        <label for="Name" class="form-label">Name</label>
                                        <input type="text" class="form-control md:w-full border-gray-300" name="name" id="name" placeholder="Enter name here...">
                                    </div>
                                    <div class="my-2 col-span-3">
                                        <label for="Artist" class="form-label">Email</label>
                                        <input type="text" class="form-control md:w-full border-gray-300" name="email" id="email" placeholder="ex: abcdef@xyz.com">
                                    </div>
                                    <div class="my-2">
                                        <label for="Role" class="form-label">Role</label>
                                        <select class="form-control md:w-full border-gray-300" name="role" id="role">
                                            <option value="admin">Admin</option>
                                            <option value="user">User</option>
                                        </select>
                                    </div>
                                    <div class="my-2 col-span-3">
                                        <label for="Password" class="form-label">Password</label>
                                        <input type="password" class="form-control md:w-full border-gray-300" name="password" id="password" placeholder="">
                                    </div>
                                    <div class="my-2 col-span-3">
                                        <label for="ConfirmPassword" class="form-label">Confirm Password</label>
                                        <input type="password" class="form-control md:w-full border-gray-300" name="password_confirmation" id="password_confirmation" placeholder="">
                                    </div>
 
                                </div>
                                <div class="my-2 col-span-3 text-center ">
                                    <button type="submit" class="bg-gradient-to-r from-green-400 to-blue-500 text-white rounded-full py-2 px-10">Create</button>
                                </div>
                            </form>
                        </div>
                        <div class="m-5">Instruction</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
