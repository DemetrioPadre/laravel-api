@extends('layouts.app')
@section('title', empty($type->id) ? 'Creazione Nuovoa Categoria' : 'Modifica Categoria')


@section('content')
    <section>
        <div class="container ">
            <a href="{{ route('admin.types.index') }}" class="my-4 btn btn-primary"><i
                    class="fa-solid fa-circle-left fa-beat"></i>
                Torna alla Lista Delle Categorie</a>


            @if ($errors->any())
                <div class="alert alert-danger ">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <h1 class="mb-4">{{ empty($type->id) ? 'Creazione Nuova Categoria' : 'Modifica Categoria' }}</h1>
            <form action="{{ empty($type->id) ? route('admin.types.store') : route('admin.types.update', $type) }}"
                class="row g-3" method="POST">
                @if (!empty($type->id))
                    @method('PATCH')
                @endif

                @csrf
                <div class="col-1">
                    <label for="color">Colore</label>
                    <input class="form-control" type="color" name="color" id="color"
                        value="{{ old('title', $type->color) }}">
                </div>
                <div class="col-11">
                    <label for="label">Etichetta</label>
                    <input class="form-control" type="text" name="label" id="label"
                        value="{{ old('title', $type->label) }}">
                </div>




                <div class="col-12">
                    <button class="btn btn-success"> <i class="fa-solid fa-floppy-disk me-1">
                        </i>{{ empty($type->id) ? 'Salva' : 'Modifica' }}</button>
                </div>
            </form>

        </div>
    </section>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
