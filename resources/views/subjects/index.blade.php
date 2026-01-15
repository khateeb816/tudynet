@extends('layouts.app')

@section('page-title', 'Subjects')

@section('content')
<div class="table-container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5>Subjects</h5>
        @if(auth()->user()->isSuperAdmin() || auth()->user()->isManager())
        <a href="{{ route('subjects.create') }}" class="btn btn-primary">Create Subject</a>
        @endif
    </div>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Created</th>
                    @if(auth()->user()->isSuperAdmin() || auth()->user()->isManager())
                    <th>Actions</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse($subjects as $subject)
                <tr>
                    <td>{{ $subject->id }}</td>
                    <td>{{ $subject->name }}</td>
                    <td>{{ \Illuminate\Support\Str::limit($subject->description ?? '', 50) }}</td>
                    <td>{{ $subject->created_at->format('M d, Y') }}</td>
                    @if(auth()->user()->isSuperAdmin() || auth()->user()->isManager())
                    <td>
                        <a href="{{ route('subjects.edit', $subject->id) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form method="POST" action="{{ route('subjects.destroy', $subject->id) }}" class="d-inline" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                    @endif
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">No subjects found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $subjects->links() }}
</div>
@endsection

