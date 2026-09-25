@extends('layouts.user')
@section('title', 'My Properties')
@section('user_content')
<div class="my-properties">
    <table class="table-responsive">
        <thead>
            <tr>
                <th class="pl-2">My Properties</th>
                <th class="p-0"></th>
                <th>Date Added</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($properties as $property)
                <tr>
                    <td class="image myelist">
                        <a href="#"><img alt="Property Image" src="{{ asset($property->image ?? 'images/default-property.jpg') }}" class="img-fluid"></a>
                    </td>
                    <td>
                        <div class="inner">
                            <a href="#"><h2>{{ $property->title }}</h2></a>
                            <figure><i class="lni-map-marker"></i> {{ $property->address }}</figure>
                        </div>
                    </td>
                    <td>{{ $property->created_at->format('m.d.Y') }}</td>
                    <td class="actions">
                        <!-- Edit Link -->
                        <a href="{{ route('properties.edit', $property->id) }}" class="edit">
                            <i class="fas fa-edit"></i> Edit
                        </a>

                        <!-- Delete Link -->
                        <a href="#"
                           class="delete"
                           onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this property?')) { document.getElementById('delete-form-{{ $property->id }}').submit(); }">
                            <i class="far fa-trash-alt"></i>
                        </a>

                        <!-- Hidden Delete Form -->
                        <form id="delete-form-{{ $property->id }}"
                              action="{{ route('properties.destroy', $property->id) }}"
                              method="POST"
                              style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No properties found</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="pagination-container">
        {{ $properties->links('pagination::bootstrap-5') }}
    </div>
</div>


      <!-- START PRELOADER -->
      <div id="preloader">
        <div id="status">
            <div class="status-mes"></div>
        </div>
    </div>
    <!-- END PRELOADER -->
@endsection
