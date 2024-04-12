@extends('layouts.app')

@section('title', 'Lista Categorie')
@section('content')

    <section>
        <div class="container ">
            <a href="{{ route('admin.types.create') }}" class="my-4 btn btn-primary"><i class="fa-solid fa-plus me-2"></i>
                Crea una Nuova
                Categoria</a>
            <h1 class="mb-4">Lista categorie</h1>
            <table class="table mb-5">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Etichetta</th>
                        <th>Colore</th>
                        <th>Badge </th>
                        <th colspan="100%"></th>
                </thead>
                <tbody>
                    @forelse ($types as $type)
                        <tr>
                            <td>{{ $type->id }}</td>
                            <td>{{ $type->label }}</td>
                            <td>{{ $type->color }}</td>
                            <td>{!! $type->getBadge() !!}</td>
                            <td>
                                <a href="{{ route('admin.types.show', $type) }}" class="btn btn-primary"><i
                                        class="fa-solid fa-eye"></i>
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('admin.types.edit', $type) }}" class="btn btn-primary"><i
                                        class="fa-solid fa-pencil"></i>
                                </a>
                            </td>
                            <td>

                                <a class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#delete-type-{{ $type->id }}-modal"><i
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

        </div>
    </section>

@endsection

@section('modal')
    <!-- Modal -->
    @foreach ($types as $type)
        <div class="modal fade " id="delete-type-{{ $type->id }}-modal" data-bs-backdrop="static"
            data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">!!!ATTENZIONE!!!</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Sei arrivato ad un punto dove devi scegliere: o tieni {{ $type->label }} o lo cancelli!</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Torrabi</button>

                        <form action="{{ route('admin.types.destroy', $type) }} " method="POST">
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
