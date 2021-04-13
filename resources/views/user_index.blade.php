<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-grey border-b border-gray-200">
                    User_index page!
                    <a href=" {{ route('users.create')}} ">
                        <div class="bg-green-400 text-white rounded-full py-1 w-20 text-center">
                            Create
                        </div>
                    </a>
                    <table class="table-auto md:w-full">
                        <thead>
                          <tr class="text-left">
                            <th>id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                @if ($loop->odd)
                                    <tr class="leading-7">
                                @elseif ($loop->even)
                                    <tr class="bg-blue-200 leading-7">
                                @endif
                                        <td>{{ $user->user_id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->role }}</td>
                                    </tr>
                            @endforeach
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>