@extends('layouts.app')
@section('title', empty($project->id) ? 'Creazione Nuovo Progetto' : 'Modifica Progetto')

@section('content')
    <section>
        <div class="container ">

            <a href="{{ route('admin.project.index') }}" class="my-4 btn btn-primary"><i
                    class="fa-solid fa-circle-left fa-beat"></i>
                Torna alla Lista Dei Progetti</a>

            @if ($errors->any())
                <div class="alert alert-danger ">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <h1 class="mb-4">{{ empty($project->id) ? 'Creazione Nuovo Progetto' : 'Modifica Progetto' }}</h1>

            <form action="{{ empty($project->id) ? route('admin.project.store') : route('admin.project.update', $project) }}"
                class="row g-3" method="POST" enctype="multipart/form-data">
                @if (!empty($project->id))
                    @method('PATCH')
                @endif

                @csrf
                <div class="col-6">
                    <div class="row">
                        <div class="col-12">
                            <label class="form-label" for="title">Titolo</label>
                            <input class="form-control " id="title" name="title" type="text"
                                value=" {{ old('title') ?? $project['title'] }}  ">
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label" for="type_id">Categria</label>
                                <select name="type_id" id="type_id" class="form-select">
                                    <option value="type_id">Seleziona una categoria</option>


                                    @foreach ($types as $type)
                                        <option {{ $type->id == old('type_id', $project->type_id) ? 'selected' : '' }}
                                            value="{{ $type->id }}">
                                            {{ $type->label }}</option>
                                        {{-- <option {{ $type->id == $project['type']->id ? 'selected' : '' }} value="{{ $type->id }}">
                                {{ $type->label }}</option> --}}
                                    @endforeach

                                </select>

                                @error('type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                    </div>


                    <div class="col-12">
                        <div class="mb-3">
                            <label for="image" class="form-label">Immagine Progetto</label>
                            <input @class(['form-control', 'is-invalid' => $errors->has('image')]) type="file" name="image" id="image">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            @if (!empty('$project->image'))
                                <div class="preview-image-container">
                                    <div class="delete-image-button">X</div>

                                    <img src="{{ asset('storage/' . $project->image) }}" alt="">
                                </div>
                            @endif
                        </div>
                    </div>




                </div>
                <div class="col-6">
                    @foreach ($technologies as $technology)
                        <div>
                            <input
                                {{ in_array($technology->id, old('technologies', $project->technologies->pluck('id')->toArray())) ? 'checked' : '' }}
                                class="form-check-input" type="checkbox" name="technologies[]"
                                id="technologies-{{ $technology->id }}" value="{{ $technology->id }}">
                            <label class="form-check-label"
                                for="technologies-{{ $technology->id }}">{{ $technology->label }}</label>
                        </div>
                    @endforeach

                </div>


                <div class="col-12">
                    <label class="form-label" for="content">Contenuto</label>
                    <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" type="text"
                        placeholder="Scrivi qua il Contenuto">  {{ old('content') ?? $project['content'] }}</textarea>
                    @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12"> <button class="btn btn-success"> <i
                            class="fa-solid fa-floppy-disk me-1"></i>{{ empty($project->id) ? 'Salva' : 'Modifica' }}</button>
                </div>

            </form>
            @if (!empty($project->image) && !empty($project->id))
                <form action="{{ route('admin.projects.destroy-img', $project) }}" class="d-none" id="delete-image-form">
                    @csrf
                    @method('DELETE')
                </form>
            @endif
        </div>
    </section>

@endsection


@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('js')
    @if (!empty($project->image) && !empty($project->id))
        <script>
            const deleteImageButton = document.querySelector('.delete-image-button');
            const deleteImageForm = document.querySelector('#delete-image-form');

            deleteImageButton.addEventListener('click', () => {
                deleteImageForm.submit();

            })
        </script>
    @endif




@endsection
