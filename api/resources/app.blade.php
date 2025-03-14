<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Tareas</title>
    @vite('resources/js/app.js')
</head>
<body>
    <div id="app">
        <h1>Gestión de Proyectos y Tareas</h1>

        <!-- Mostrar proyectos -->
        <div>
            <h2>Proyectos</h2>
            <ul>
                @foreach ($projects as $project)
                    <li>
                        <strong>{{ $project->name }}</strong>
                        <p>{{ $project->description }}</p>
                        <!-- Tareas del proyecto -->
                        <ul>
                            @foreach ($project->tasks as $task)
                                <li>
                                    <strong>{{ $task->title }} - {{ $task->priority }}</strong>
                                    <p>{{ $task->description }}</p>
                                    <form action="{{ route('tasks.complete', $task) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit">Marcar como completada</button>
                                    </form>

                                    <!-- Comentarios -->
                                    <h4>Comentarios</h4>
                                    <ul>
                                        @foreach ($task->comments as $comment)
                                            <li>{{ $comment->comment }} - {{ $comment->user->name }}</li>
                                        @endforeach
                                    </ul>

                                    <!-- Formulario para agregar comentarios -->
                                    <form action="{{ route('tasks.addComment', $task) }}" method="POST">
                                        @csrf
                                        <input type="text" name="comment" placeholder="Agregar comentario" required>
                                        <button type="submit">Comentar</button>
                                    </form>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- Crear nueva tarea -->
        <div>
            <h2>Crear Nueva Tarea</h2>
            <form action="{{ route('tasks.store') }}" method="POST">
                @csrf
                <label for="title">Título</label>
                <input type="text" name="title" id="title" required>

                <label for="description">Descripción</label>
                <textarea name="description" id="description"></textarea>

                <label for="priority">Prioridad</label>
                <select name="priority" id="priority">
                    <option value="low">Baja</option>
                    <option value="medium">Media</option>
                    <option value="high">Alta</option>
                </select>

                <label for="due_date">Fecha de vencimiento</label>
                <input type="date" name="due_date" id="due_date">

                <label for="user_id">Asignar a:</label>
                <select name="user_id" id="user_id">
                    <!-
