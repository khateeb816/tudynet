@extends('layouts.app')

@section('page-title', 'Edit Subject')

@section('content')
<div class="table-container">
    <h5 class="mb-3">Edit Subject</h5>
    <form method="POST" action="{{ route('subjects.update', $subject->id) }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $subject->name) }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description', $subject->description) }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Update Subject</button>
        <a href="{{ route('subjects.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection

