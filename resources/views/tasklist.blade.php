@extends('home')

@section('content')

<div>
    <div class="container top-margin-10px">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Tarea</th>
                    <th scope="col">Etiqueta</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Marcar</th>
                    <th scope="col">Eliminar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                <tr>
                    <td>{{ $task->name }}</td>
                    <td>{{ $task->label->name ?? 'Sin etiqueta' }} </td>
                    <td>{{ $task->status }}</td>
                    <td>
                        @if ($task->status == 'Pendiente')
                            <form action="{{ route('task.update',$task, ['id' => 'id']) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="summit" class="btn btn-success">Completar</button>
                            </form>
                            
                        @else
                            <button type="button" class="btn btn-success" disabled>Completar</button>
                        @endif
                        
                    </td>
                    <td>
                        <form id="deleteTask" action="{{ route('task.destroy',$task, ['id' => 'id']) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger" onclick="openModal()">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>


    </div>
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <p class="text-center">¿Estás seguro de que deseas eliminar la tarea?</p>
            <button class="my-btn-primary" onclick="submit(this,'deleteTask')">Sí</button>
            <button class="top-margin-10px danger-btn" onclick="closeModal()">Cancelar</button>
        </div>
    </div>
</div>


@endsection

@section('scripts')
<script src="{{ asset('js/close.js') }}"></script>
<script src=" {{ asset('js/buttom.js') }}"></script>
@endsection