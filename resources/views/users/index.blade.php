@extends('layouts.app')

@section('page-title', 'Users')

@section('content')
<div class="table-container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5>Users</h5>
        @if(auth()->user()->isSuperAdmin() || auth()->user()->isManager())
        <a href="{{ route('users.create') }}" class="btn btn-primary">Create User</a>
        @endif
    </div>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Created</th>
                    @if(auth()->user()->isSuperAdmin() || auth()->user()->isManager())
                    <th>Actions</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ ucfirst(str_replace('_', ' ', $user->role)) }}</td>
                    <td>
                        <span class="badge bg-{{ $user->status === 'active' ? 'success' : 'danger' }}">
                            {{ ucfirst($user->status) }}
                        </span>
                    </td>
                    <td>{{ $user->created_at->format('M d, Y') }}</td>
                    @if(auth()->user()->isSuperAdmin() || auth()->user()->isManager())
                    <td>
                        @if($user->role !== 'super_admin')
                        <form method="POST" action="{{ route('users.toggle-status', $user->id) }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-{{ $user->status === 'active' ? 'warning' : 'success' }}">
                                {{ $user->status === 'active' ? 'Disable' : 'Enable' }}
                            </button>
                        </form>
                        @else
                        <span class="text-muted">-</span>
                        @endif
                    </td>
                    @endif
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">No users found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $users->links() }}
</div>
@endsection

