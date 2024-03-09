@extends('layout.app')

@section('content')
<div class="container">
    <div class="content-wrapper">
        <h1>{{ $project->class_name }}</h1> <!-- Display the title of the project -->
        <h3>Tasks</h3>

        @if($project->tasks->isEmpty())
            <p>No tasks found for this project.</p>
        @else
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-striped">
                        <tbody>
                            @foreach($project->tasks->where('status', '!=', 'done') as $task)
                                <tr>
                                    <td>
                                        <ul style="list-style-type: none; padding-left: 0;">
                                            <li><strong>{{ $task->task_name }}</strong></li>
                                        </ul>
                                        <p>{{ $task->task_description }}</p>
                                        <form action="{{ route('done.task', ['projectId' => $project->id, 'taskId' => $task->id]) }}" method="POST" style="display: inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm">Done</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
