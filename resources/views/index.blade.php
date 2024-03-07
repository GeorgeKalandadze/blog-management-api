@extends('layouts.layout')

@section('content')
    <div class="flex items-center justify-center mb-8">
        <h1 class="text-3xl font-semibold">List Post</h1>
    </div>
    <hr class="mb-8" />

    <table class="min-w-full divide-y divide-gray-200 w-full">
        <thead class="bg-gray-100 ">
        <tr>
            <th scope="col" class="px-6 py-3 text-left text-xs text-gray-500 uppercase tracking-wider font-bold">#</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
        </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
        @php
            $dummyPosts = [
                [
                    'id'=> 1,
                    'title' => 'Post Title 1',
                    'description' => 'Description for Post 1',
                ],
                [

                    'id'=> 2,
                    'title' => 'Post Title 2',
                    'description' => 'Description for Post 2',
                ],
                [
                    'id'=> 3,
                    'title' => 'Post Title 3',
                    'description' => 'Description for Post 3',
                ]
            ];
        @endphp
        @forelse($dummyPosts as $key => $post)
            <tr >
                <td class="px-6 py-4 whitespace-nowrap font-bold">{{ $key + 1 }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $post['title'] }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $post['description'] }}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('posts.show', ['post' => $post['id']]) }}" class="px-3 py-1 bg-gray-500 text-white rounded hover:bg-indigo-700">Detail</a>
                        <a href="{{ route('posts.create') }}" class="px-3 py-1 bg-indigo-600 text-white rounded hover:bg-indigo-700">Create</a>
                        <a href="{{ route('posts.edit', ['post' =>$post['id']]) }}" class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">Edit</a>
                        <form action="#" method="POST" onsubmit="return confirm('Delete?')">
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
