<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ Auth::check() && Auth::user()->usertype == 'admin' ? 'Admin Dashboard' : 'User Dashboard' }}
        </h2>
    </x-slot>

    @section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @if(session('status'))
                        <div style="background: lightgreen;">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if(session('danger'))
                        <div style="background: red;">
                            {{ session('danger') }}
                        </div>
                    @endif

                    <h1 style="text-align:center; margin-bottom:20px;">
                        Posts Management
                    </h1>

                    <div style="overflow-x:auto;">
                        <table style="width:100%; border-collapse:collapse;">
                            <thead>
                                <tr style="background:#4CAF50; color:white;">
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Image</th>
                                    <th>Update</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($post as $posts)
                                <tr>
                                    <td>{{ $posts->id }}</td>
                                    <td>{{ $posts->title }}</td>
                                    <td>{{ Str::limit($posts->description, 100) }}</td>
                                    <td>
                                        <img src="{{ asset('img/'.$posts->image) }}" width="100">
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.posts.editpage', $posts->id) }}">
                                            Update
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.posts.deletepage', $posts->id) }}">
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>
    @endsection

</x-app-layout>