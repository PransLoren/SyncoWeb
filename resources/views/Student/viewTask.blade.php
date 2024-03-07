@extends('layout.app')

@section('content')
<div class="container">
    <div class="content-wrapper">
        <h1>{{ $project->class_name }}</h1> <!-- Display the title of the project -->
        <h3>Tasks</h3>
        @if($project->tasks->isEmpty())
            <p>No tasks found for this project.</p>
        @else
            <ul>
                @foreach($project->tasks as $task)
                    <li>{{ $task->task_name }} - {{ $task->task_description }}</li> <!-- Display each task name and description -->
                @endforeach
            </ul>
        @endif
    </div>
</div>
@endsection
