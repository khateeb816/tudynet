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
                <label for="words" class="form-label">Word Count</label>
                <div class="input-group">
                    <button type="button" class="btn btn-outline-secondary" id="btn-minus">-</button>
                    <input type="number" class="form-control text-center @error('words') is-invalid @enderror" id="words" name="words" value="{{ old('words', 0) }}" readonly required>
                    <button type="button" class="btn btn-outline-secondary" id="btn-plus">+</button>
                    @error('words')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const wordsInput = document.getElementById('words');
                const btnMinus = document.getElementById('btn-minus');
                const btnPlus = document.getElementById('btn-plus');
                const step = 250;

                btnPlus.addEventListener('click', function() {
                    let currentValue = parseInt(wordsInput.value) || 0;
                    wordsInput.value = currentValue + step;
                });

                btnMinus.addEventListener('click', function() {
                    let currentValue = parseInt(wordsInput.value) || 0;
                    if (currentValue >= step) {
                        wordsInput.value = currentValue - step;
                    } else {
                        wordsInput.value = 0;
                    }
                });
            });
        </script>
        <div>
           <!-- Spacing Fix if needed, closing div matching original structure -->
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
            <div class="mb-2">
                <input type="file" class="form-control d-none" id="attachments" name="attachments[]" multiple>
                <button type="button" class="btn btn-outline-primary" id="btn-add-files">Choose Files</button>
            </div>
            <ul class="list-group" id="file-list">
                <!-- Files will be added here dynamically -->
            </ul>
            @error('attachments.*')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>
        <script>
            // Existing stepper logic...
            
            // File Upload Logic
            const fileInput = document.getElementById('attachments');
            const btnAddFiles = document.getElementById('btn-add-files');
            const fileListContainer = document.getElementById('file-list');
            const dataTransfer = new DataTransfer();

            btnAddFiles.addEventListener('click', function() {
                fileInput.click();
            });

            fileInput.addEventListener('change', function() {
                for(let i = 0; i < this.files.length; i++){
                    dataTransfer.items.add(this.files[i]);
                }
                updateFileInput();
                renderFileList();
            });

            function updateFileInput() {
                fileInput.files = dataTransfer.files;
            }

            function renderFileList() {
                fileListContainer.innerHTML = '';
                Array.from(dataTransfer.files).forEach((file, index) => {
                    const li = document.createElement('li');
                    li.className = 'list-group-item d-flex justify-content-between align-items-center';
                    li.innerHTML = `
                        <span>${file.name}</span>
                        <button type="button" class="btn btn-sm btn-danger btn-remove-file" data-index="${index}">&times;</button>
                    `;
                    fileListContainer.appendChild(li);
                });

                // Attach event listeners to remove buttons
                document.querySelectorAll('.btn-remove-file').forEach(button => {
                    button.addEventListener('click', function() {
                        const index = parseInt(this.getAttribute('data-index'));
                        dataTransfer.items.remove(index);
                        updateFileInput();
                        renderFileList();
                    });
                });
            }
        </script>
        <button type="submit" class="btn btn-primary">Create Order</button>
        <a href="{{ route('orders.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection

