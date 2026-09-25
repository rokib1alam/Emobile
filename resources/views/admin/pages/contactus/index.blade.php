@extends('layouts.admin')

@section('title', 'Contact Messages')

@section('admin_content')
<div class="pc-container">
    <div class="pc-content">
        <!-- [ Breadcrumb ] -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center justify-content-between">
                    <div class="col-sm-auto">
                        <div class="page-header-title">
                            <h5 class="mb-0">Contact Messages</h5>
                        </div>
                    </div>
                    <div class="col-sm-auto">
                        <ul class="breadcrumb">
                            {{-- No “Add New” button here, since messages are user‑submitted --}}
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- [ Main Content ] -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header table-card-header">
                        <h5>All Contact Messages</h5>
                    </div>
                    <div class="card-body">
                        <div class="dt-responsive table-responsive">
                            <table class="table table-striped table-bordered nowrap table-sm ytable">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Subject</th>
                                        <th>Message</th>
                                        <th>Received At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- Example row (replace with your loop) --}}
                                    @foreach($messages as $index => $msg)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $msg->name }}</td>
                                            <td>{{ $msg->email }}</td>
                                            <td>{{ $msg->subject }}</td>
                                            <td>{{ Str::limit($msg->message, 50) }}</td>
                                            <td>{{ $msg->created_at->format('Y-m-d H:i') }}</td>
                                            <td>

                                                    <form action="{{ route('contactus.destroy', $msg->id) }}" method="POST" style="display:inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this message?')">
                                                            Delete
                                                        </button>
                                                    </form>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>SL</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Subject</th>
                                        <th>Message</th>
                                        <th>Received At</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        {{-- Pagination, if not using DataTables --}}
                        {{-- {{ $messages->links() }} --}}
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- .pc-content -->
</div> <!-- .pc-container -->
@endsection
