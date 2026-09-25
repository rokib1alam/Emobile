@extends('layouts.admin')
@section('title','Notifications')

@section('admin_content')
<div class="pc-container">
    <div class="pc-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center justify-content-between">
                    <div class="col-sm-auto">
                        <div class="page-header-title">
                            <h5 class="mb-0">Notifications</h5>
                        </div>
                    </div>
                    <div class="col-sm-auto">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="ph-duotone ph-house"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item" aria-current="page">Notifications</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->

        <!-- [ Main Content ] start -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header table-card-header">
                        <h5>All Notifications</h5>
                    </div>
                    <div class="card-body">
                        <div class="dt-responsive table-responsive">
                            <table class="table table-striped table-bordered nowrap table-sm">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Image</th>
                                        <th>Admin Name</th>
                                        <th>Message</th>
                                        <th>Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        use Illuminate\Support\Carbon;

                                        $newNotifications = auth()->user()->unreadNotifications->filter(function ($notification) {
                                            $created = \Carbon\Carbon::parse($notification->created_at);
                                            return $created->isToday() || $created->isYesterday();
                                        });

                                        $earlierNotifications = auth()->user()->unreadNotifications->filter(function ($notification) {
                                            $created = \Carbon\Carbon::parse($notification->created_at);
                                            return !$created->isToday() && !$created->isYesterday();
                                        });
                                    @endphp

                                    {{-- New Notifications --}}
                                    @if($newNotifications->count())
                                        @foreach($newNotifications as $notification)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    @php
                                                        $image = $notification->data['image'] ?? null;
                                                    @endphp
                                                    <img src="{{ $image ? asset($image) : asset('assets/images/default-avatar.png') }}"
                                                         alt="User Image" class="rounded-circle" width="40" height="40">
                                                </td>
                                                <td>{{ $notification->data['admin_name'] ?? 'Unknown Admin' }}</td>
                                                <td>{{ $notification->data['message'] ?? 'New notification' }}</td>
                                                <td>{{ $notification->created_at->diffForHumans() }}</td>
                                            </tr>
                                        @endforeach
                                    @endif

                                    {{-- Earlier Notifications --}}
                                    @if($earlierNotifications->count())
                                        <tr><td colspan="5" class="text-muted text-center">Earlier</td></tr>
                                        @foreach($earlierNotifications as $notification)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    @php
                                                        $image = $notification->data['image'] ?? null;
                                                    @endphp
                                                    <img src="{{ $image ? asset($image) : asset('assets/images/default-avatar.png') }}"
                                                         alt="User Image" class="rounded-circle" width="40" height="40">
                                                </td>
                                                <td>{{ $notification->data['admin_name'] ?? 'Unknown Admin' }}</td>
                                                <td>{{ $notification->data['message'] ?? 'New notification' }}</td>
                                                <td>{{ $notification->created_at->diffForHumans() }}</td>
                                            </tr>
                                        @endforeach
                                    @endif

                                    @if($newNotifications->isEmpty() && $earlierNotifications->isEmpty())
                                        <tr>
                                            <td colspan="5" class="text-center text-muted">No new notifications</td>
                                        </tr>
                                    @endif
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>SL</th>
                                        <th>Image</th>
                                        <th>Admin Name</th>
                                        <th>Message</th>
                                        <th>Time</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>
@endsection
