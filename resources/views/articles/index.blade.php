@extends('layouts.app')

@section('content')

    <form action='{{ route("create.article") }}' method='POST'> 
        @csrf
        <label>Title: </label>
        <input type='text' name='title'/> 
        <label>Article: </label>
        <textarea name='body'></textarea> 
        <button type='submit'>Submit</button>
    </form>
    
    <h1>{{$title}}</h1>
    <ul>
    @foreach($articles as $article)
        <li>

            <form action='{{ route("update.article", ["id"=> $article->id]) }}' method='POST'>
                @csrf
                @method('PUT')
                <input value='{{$article->title}}' name='title'/>
                <textarea name='body'>{{$article->body}}</textarea> 
                <button type='submit'>Finish Edit</button>
            </form>
            <!-- <h2> {{$article->title}} </h2>
            <p> {{$article->body}} </p> -->

            <form action='{{ route("delete.article", ["id"=> $article->id]) }}' method='POST'>
                @csrf
                @method('DELETE')

                <button type='submit'>Delete</button>
            </form>

        </li>
    @endforeach
    </ul>

@endsection