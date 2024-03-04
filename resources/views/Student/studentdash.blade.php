@extends('layout.app')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="background-color: #E6F0FF;">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0" style="font-family: 'League Spartan', sans-serif; font-size: 24px; color: #000;">My Projects</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                @include('message')
                <div class="card">
                    <div class="card-header" style="background-color: #6991AF; color: #FFFFFF; font-size: 24px; font-weight: bold;">
                    <h3 class="card-title">Project List</h3>
                    </div>
                        <div class="card-body p-0">
                            <table class="table table-hover" style="font-family: Arimo, sans-serif;">
                                <thead class="thead-light">
                                    <tr style="color: #000;">
                                    <th>Project Name</th>
                                    <th>Homework Date</th>
                                    <th>Submission Date</th>
                                    <th>Description</th>
                                    <th>Invite users</th>
                                    <th>Add Tasks</th>
                                    <th>Action</th>
                                    <th>View</th>
                                    <th>Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($getRecord as $key => $value)
                                    <tr style="background-color: {{ $key % 2 == 0 ? '#6991AF' : '#C7D7EB' }}; color: #000;">
                                        <td>{{ $value->class_name }}</td>
                                        <td>{{ date('d-m-Y', strtotime($value->project_date)) }}</td>
                                        <td>{{ date('d-m-Y', strtotime($value->submission_date)) }}</td>
                                        <td>{{ $value->description }}</td>
                                        <td>
                                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#inviteUserModal{{ $value->id }}">
                                                <i class="fas fa-user-plus"></i> Invite
                                            </button>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#taskModal{{ $value->id }}">
                                                <i class="fas fa-tasks"></i> Create Task
                                            </button>
                                        </td>
                                        <td>
                                            <form action="{{ url('student/project/list/'.$value->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-info btn-sm" onclick="return confirm('Are you sure?')">
                                                    <i class="fas fa-check"></i> Done
                                                </button>
                                            </form>
                                        </td>
                                        <td>
                                            <button class="btn btn-info btn-sm view-task" data-task-name="{{ $value->task_name }}">
                                                <i class="fas fa-eye"></i> View
                                            </button>
                                        </td>
                                        <td>
                                            <a href="{{ url('your-edit-url/'.$value->id) }}" class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="mt-3">
                                {!! $getRecord->appends(request()->except('page'))->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Task Modal -->
@foreach($getRecord as $value)
<div class="modal fade" id="taskModal{{ $value->id }}" tabindex="-1" role="dialog" aria-labelledby="taskModalLabel{{ $value->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="taskModalLabel{{ $value->id }}">Task Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Task Form -->
                @csrf
                <form id="taskForm{{ $value->id }}">
                    <div class="form-group">
                        <label for="taskName">Task Name:</label>
                        <input type="text" class="form-control" id="taskName" name="task_name" required>
                        <!-- Make sure the name attribute matches the field name in your controller -->
                    </div>
                    <div class="form-group">
                        <label for="taskDesc">Description:</label>
                        <input type="text" class="form-control" id="taskDesc" name="task_description" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                <!-- Display success or error message -->
                <div id="taskMessage{{ $value->id }}"></div>
            </div>
        </div>
    </div>
</div>
@endforeach

<!-- Modal for inviting users -->
@foreach($getRecord as $value)
<div class="modal fade" id="inviteUserModal{{ $value->id }}" tabindex="-1" role="dialog" aria-labelledby="inviteUserModalLabel{{ $value->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="inviteUserModalLabel{{ $value->id }}">Invite Users</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Invite Users Form -->
                <form id="inviteUserForm{{ $value->id }}" action="{{ route('invite', ['projectId' => $value->id]) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Send Invitation</button>
                </form>
                <!-- Display success or error message -->
                <div id="inviteUserMessage{{ $value->id }}" ></div>
            </div>
        </div>
    </div>
</div>

<!-- Task Modal -->
<div class="modal fade" id="taskModal" tabindex="-1" role="dialog" aria-labelledby="taskModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="taskModalLabel">Task Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 id="taskName"></h5>
                <p>Status: <span id="taskStatus"></span></p>
                <p id="taskDescription"></p>
            </div>
        </div>
    </div>
</div>

@endforeach

<!-- /.content-wrapper -->

<!-- Your custom JavaScript -->
<script>
    $(document).ready(function() {
        @foreach($getRecord as $value)
        $('#inviteUserForm{{ $value->id }}').submit(function(e) {
            e.preventDefault(); // Prevent default form submission
            
            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: $(this).serialize(),
                success: function(response) {
                    if (confirm('Invitation sent successfully. Do you want to close the modal?')) {
                        $('#inviteUserModal{{ $value->id }}').modal('hide');
                    }
                },
                error: function(xhr, status, error) {
                    $('#inviteUserMessage{{ $value->id }}').html('<div class="alert alert-danger">' + xhr.responseJSON.message + '</div>');
                }
            });
        });
        $('#taskForm{{ $value->id }}').submit(function(e) {
            e.preventDefault(); // Prevent default form submission
            
            // Get the CSRF token
            var token = "{{ csrf_token() }}";
            
            $.ajax({
                type: 'POST',
                url: '{{ route("task.submit", ["id" => $value->id]) }}', // Use the correct route with the project ID
                data: $(this).serialize(),
                headers: {
                    'X-CSRF-TOKEN': token // Include CSRF token in headers
                },
                success: function(response) {
                    if (confirm('Task submitted successfully. Do you want to close the modal?')) {
                        $('#taskModal{{ $value->id }}').modal('hide');
                    }
                },
                error: function(xhr, status, error) {
                    $('#taskMessage{{ $value->id }}').html('<div class="alert alert-danger">' + xhr.responseJSON.message + '</div>');
                }
            });
        });
        @endforeach
    });


    $('.view-task').click(function() {
    var taskName = $(this).data('task-name');
    $.ajax({
        url: "{{ route('task.view') }}",
        type: "GET",
        data: { task_name: taskName }, // Ensure task_name is properly assigned
        success: function(response) {
            $('#taskName').text(response.task_name);
            $('#taskStatus').text(response.status);
            $('#taskDescription').text(response.description);
            $('#taskModal').modal('show'); // Show the modal
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });
});

</script>
@endsection
