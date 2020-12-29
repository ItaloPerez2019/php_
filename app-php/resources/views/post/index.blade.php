@extends('layouts.app')


@section('content')

<div class="flex justify-center">
    <div class="w-8/12 bg-white p-6 rounded-lg">
        <form action="{{ route('posts') }}" method="post">

    @csrf
    <div class="mb-4">
        <label for="body" class="sr-only">Body</label>
        <textarea name="body" id="body" cols="30" rows="4" class="bg-gray-100
        border-2 w-full p-4 rounded-lg @error('body') border-red-500 @enderror"
        placeholder="Post something"></textarea>

    @error('body')
    <div class="text-red-500 mt-2 text-sm">
        {{ $message}}
    </div>
    @enderror

    </div>
    <div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded font-medium">Post</button>
    </div>
        </form>
<table style="width: 100%">
    <tr>
        <th>ID</th>
        <th>User ID</th>
        <th>Body</th>
        <th>Date</th>

    </tr>
        @foreach($posts as $key => $data)
            <tr>
                <th>{{$data->id}}</th>
                <th>{{$data->user_id}}</th>
                <th>{{$data->body}}</th>
                <th>{{$data->created_at}}</th>
            </tr>
        @endforeach
</table>
    </div>
</div>


@endsection
