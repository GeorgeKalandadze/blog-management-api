@extends('layouts.layout')
<div class="w-4/5 m-auto text-center">
    <div class="py-15 border-b border-gray-200">
        <h1 class="text-6xl">
            Create Post
        </h1>
    </div>
</div>

@section('content')
<div class="w-4/5 m-auto pt-20">
    <form  method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Title</label>
            <input type="text" name="title" id="title" value="{{ old('title', $post->title ?? '') }}" class="w-full px-3 py-2 border rounded-md text-gray-700 focus:outline-none focus:border-indigo-500" required>
        </div>

        <div class="mb-4">
            <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description</label>
            <textarea name="description" id="description" rows="5" class="w-full px-3 py-2 border rounded-md text-gray-700 focus:outline-none focus:border-indigo-500 resize-none" required>{{ old('description', $post->description ?? '') }}</textarea>
        </div>

        <div class="mb-4">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">submit</button>
        </div>
    </form>
</div>
@endsection
