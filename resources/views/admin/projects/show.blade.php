@extends('layouts.app')
@section('title', 'Lista Progetti')

@section('content')
    <section>
        <div class="container ">

            <a href="{{ route('admin.project.index') }}" class="my-4 btn btn-primary"><i
                    class="fa-solid fa-circle-left fa-beat"></i>
                Torna alla Lista Dei Progetti</a>
            <h1 class="mb-4">Vedi Nuovo Progetto</h1>

            <p>{{ $project->title }}</p>
            <p>Categoria: {!! $project->type->getBadge() !!}</p>
            <p>{{ $project->content }}</p>
            <p>{{ $project->getTechnologiesToText() }}</p>

            @if (!empty($project->image))
                <img src="{{ asset('storage/' . $project->image) }}" alt="">
            @endif

        </div>
    </section>

@endsection


@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
