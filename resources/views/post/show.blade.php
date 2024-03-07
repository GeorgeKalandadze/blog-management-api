<!DOCTYPE html>
@extends('layouts.layout')

@section('content')
    <div class="max-w-2xl mx-auto py-8">
        <h1 class="text-3xl font-bold mb-4">{{ $post['title'] }}</h1>
        <p class="text-gray-600 text-sm mb-4">Published on </p>
        <p class="text-lg">{{ $post['body'] }}</p>
    </div>
@endsection
