@extends('layouts.app')

@section('page-title', 'Settings')

@section('content')
<div class="table-container mb-3">
    <h5 class="mb-3">Create New Setting</h5>
    <form method="POST" action="{{ route('settings.store') }}">
        @csrf
        <div class="row">
            <div class="col-md-3 mb-3">
                <input type="text" class="form-control" name="key" placeholder="Key" required>
            </div>
            <div class="col-md-3 mb-3">
                <input type="text" class="form-control" name="value" placeholder="Value" required>
            </div>
            <div class="col-md-2 mb-3">
                <select class="form-select" name="type" required>
                    <option value="string">String</option>
                    <option value="integer">Integer</option>
                    <option value="decimal">Decimal</option>
                    <option value="boolean">Boolean</option>
                    <option value="json">JSON</option>
                </select>
            </div>
            <div class="col-md-3 mb-3">
                <input type="text" class="form-control" name="description" placeholder="Description">
            </div>
            <div class="col-md-1 mb-3">
                <button type="submit" class="btn btn-primary w-100">Add</button>
            </div>
        </div>
    </form>
</div>

<div class="table-container">
    <h5 class="mb-3">Settings</h5>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Key</th>
                    <th>Value</th>
                    <th>Type</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($settings as $setting)
                <tr>
                    <td>{{ $setting->key }}</td>
                    <td>
                        <form method="POST" action="{{ route('settings.update', $setting->id) }}" class="d-inline">
                            @csrf
                            @method('PUT')
                            <div class="input-group">
                                <input type="text" class="form-control form-control-sm" name="value" value="{{ $setting->value }}">
                                <button type="submit" class="btn btn-sm btn-primary">Update</button>
                            </div>
                        </form>
                    </td>
                    <td>{{ $setting->type }}</td>
                    <td>{{ $setting->description }}</td>
                    <td>
                        <form method="POST" action="{{ route('settings.destroy', $setting->id) }}" class="d-inline" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">No settings found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

