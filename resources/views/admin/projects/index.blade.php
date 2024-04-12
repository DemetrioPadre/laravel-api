@extends('layouts.app')
@section('title', 'Lista Progetti')

@section('content')
    <section>
        <div class="container ">

            <a href="{{ route('admin.project.create') }}" class="my-4 btn btn-primary"><i class="fa-solid fa-plus me-2"></i>
                Crea un Nuovo
                Progetto</a>
            <h1 class="mb-4">Lista progetti</h1>
            <table class="table mb-5">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Titolo</th>
                        <th>Categoria</th>
                        <th>Technologie</th>
                        <th>Slug </th>
                        <th>Estratto</th>
                        <th colspan="100%"></th>
                </thead>
                <tbody>
                    @forelse ($projects as $project)
                        <tr>
                            <td>{{ $project->id }}</td>
                            <td>{{ $project->title }}</td>
                            <td>{!! $project->type->getBadge() !!}</td>
                            <td>{{ $project->getTechnologiesToText() }}</td>
                            <td>{{ $project->slug }} </td>
                            <td>{{ $project->getAbstract(50) }}</td>
                            <td>
                                <a href="{{ route('admin.project.show', $project) }}" class="btn btn-primary"><i
                                        class="fa-solid fa-eye"></i>
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('admin.project.edit', $project) }}" class="btn btn-primary"><i
                                        class="fa-solid fa-pencil"></i>
                                </a>
                            </td>
                            <td>

                                <a class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#delete-project-{{ $project->id }}-modal"><i
                                        class="fa-solid fa-trash "></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="100%">
                                <i>Nessun Risultato</i>
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
            {{ $projects->links('pagination::bootstrap-5') }}

        </div>
    </section>
@endsection
@section('modal')
    <!-- Modal -->
    @foreach ($projects as $project)
        <div class="modal fade " id="delete-project-{{ $project->id }}-modal" data-bs-backdrop="static"
            data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">!!!ATTENZIONE!!!</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Sei arrivato ad un punto dove devi scegliere: o tieni {{ $project->title }} o lo cancelli!</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Torrabi</button>

                        <form action="{{ route('admin.project.destroy', $project) }} " method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">E se poi te ne penti?</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection



@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
