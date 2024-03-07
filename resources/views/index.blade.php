@extends('layouts.layout')

@section('content')
    <nav class="bg-gray-800 shadow-lg">
        <div class="mx-auto px-4 sm:px-6 lg:px-6">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="hidden space-x-4 sm:-my-px sm:flex">
                        <a href="{{ route('posts.index') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white  py-2 rounded-md text-sm font-medium">Home</a>
                        <a href="{{ route('posts.create') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white  py-2 rounded-md text-sm font-medium">Create Post</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>


    <table class="min-w-full divide-y divide-gray-200 w-full">
        <thead class="bg-gray-100 ">
        <tr>
            <th scope="col" class="px-6 py-3 text-left text-xs text-gray-500 uppercase tracking-wider font-bold">#</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Body</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
        </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
        @forelse($posts as $key => $post)
            <tr >
                <td class="px-6 py-4 whitespace-nowrap font-bold">{{ $post['id'] }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $post['title'] }}</td>
                <td class="px-6 py-4 ">{{ $post['body'] }}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('posts.show', ['post' => $post['id']]) }}" class="px-3 py-1 bg-gray-500 text-white rounded hover:bg-indigo-700">Detail</a>
                        <form action="{{ route('posts.destroy', ['post' => $post['id']]) }}" method="POST" onsubmit="return confirm('Delete?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="px-6 py-4 text-sm text-gray-500 text-center">Posts not found</td>
            </tr>
        @endforelse
        </tbody>
    </table>
@endsection
