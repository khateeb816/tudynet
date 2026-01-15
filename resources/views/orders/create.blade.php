@extends('layouts.app')

@section('page-title', 'Create New Order')

@section('content')
<div class="table-container">
    <h5 class="mb-3">Create New Order</h5>
    <form method="POST" action="{{ route('orders.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="subject_id" class="form-label">Subject</label>
                <select class="form-select @error('subject_id') is-invalid @enderror" id="subject_id" name="subject_id" required>
                    <option value="">Select Subject</option>
                    @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}" {{ old('subject_id') == $subject->id ? 'selected' : '' }}>{{ $subject->name }}</option>
                    @endforeach
                </select>
                @error('subject_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label for="words" class="form-label">Word Count</label>
                <select class="form-select @error('words') is-invalid @enderror" id="words" name="words" required>
                    <option value="">Select Word Count</option>
                    @foreach($wordOptions as $words)
                    <option value="{{ $words }}" {{ old('words') == $words ? 'selected' : '' }}>{{ $words }} words</option>
                    @endforeach
                </select>
                @error('words')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-3">
            <label for="expiry_date" class="form-label">Expiry Date</label>
            <input type="date" class="form-control @error('expiry_date') is-invalid @enderror" id="expiry_date" name="expiry_date" value="{{ old('expiry_date') }}" required>
            @error('expiry_date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="5" required>{{ old('description') }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="attachments" class="form-label">Attachments (PDF, Word, Image, Video)</label>
            <input type="file" class="form-control @error('attachments.*') is-invalid @enderror" id="attachments" name="attachments[]" multiple>
            @error('attachments.*')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Create Order</button>
        <a href="{{ route('orders.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection

