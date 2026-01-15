@extends('layouts.app')

@section('page-title', 'Order #' . $order->id)

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="table-container mb-3">
            <h5>Order Details</h5>
            <table class="table">
                <tr>
                    <th>Order ID:</th>
                    <td>{{ $order->id }}</td>
                </tr>
                <tr>
                    <th>Subject:</th>
                    <td>{{ $order->subject->name }}</td>
                </tr>
                <tr>
                    <th>Words:</th>
                    <td>{{ $order->words }}</td>
                </tr>
                <tr>
                    <th>Total Amount:</th>
                    <td>${{ number_format($order->total_amount, 2) }}</td>
                </tr>
                <tr>
                    <th>Status:</th>
                    <td>
                        <span class="badge bg-{{ $order->status === 'completed' ? 'success' : ($order->status === 'pending' ? 'warning' : 'info') }}">
                            {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                        </span>
                    </td>
                </tr>
                <tr>
                    <th>Expiry Date:</th>
                    <td>{{ $order->expiry_date->format('M d, Y') }}</td>
                </tr>
                <tr>
                    <th>Description:</th>
                    <td>{{ $order->description }}</td>
                </tr>
                @if($order->assignedWriter)
                <tr>
                    <th>Assigned Writer:</th>
                    <td>{{ $order->assignedWriter->name }}</td>
                </tr>
                @endif
            </table>
        </div>

        @if((auth()->user()->isWriter() && $order->assigned_to === auth()->id()) || auth()->user()->isManager() || auth()->user()->isSuperAdmin())
        @if($order->attachments && count($order->attachments) > 0)
        <div class="table-container mb-3">
            <h5>Client Uploaded Files</h5>
            <p class="text-muted">Files uploaded by the client when creating this order</p>
            <div class="list-group">
                @foreach($order->attachments as $attachment)
                <div class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <i class="bi bi-file-earmark me-2"></i>
                        {{ basename($attachment) }}
                    </div>
                    <a href="{{ route('orders.attachments.download', ['orderId' => $order->id, 'attachmentIndex' => $loop->index]) }}" class="btn btn-sm btn-primary">
                        <i class="bi bi-download me-1"></i> Download
                    </a>
                </div>
                @endforeach
            </div>
        </div>
        @endif
        @endif

        @if(auth()->user()->isClient())
        <div class="table-container mb-3">
            <h5>Payment Upload</h5>
            @if(!$order->half_payment_image)
            <form method="POST" action="{{ route('orders.upload-half-payment', $order->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="half_payment_image" class="form-label">Upload Half Payment</label>
                    <input type="file" class="form-control" id="half_payment_image" name="half_payment_image" accept="image/*" required>
                </div>
                <button type="submit" class="btn btn-primary">Upload Half Payment</button>
            </form>
            @else
            <p class="text-success">Half payment uploaded</p>
            @endif

            @if($order->half_file && !$order->full_payment_image)
            <form method="POST" action="{{ route('orders.upload-full-payment', $order->id) }}" enctype="multipart/form-data" class="mt-3">
                @csrf
                <div class="mb-3">
                    <label for="full_payment_image" class="form-label">Upload Full Payment</label>
                    <input type="file" class="form-control" id="full_payment_image" name="full_payment_image" accept="image/*" required>
                </div>
                <button type="submit" class="btn btn-primary">Upload Full Payment</button>
            </form>
            @elseif($order->full_payment_image)
            <p class="text-success mt-3">Full payment uploaded</p>
            @endif
        </div>
        @endif

        @if(auth()->user()->isWriter() && $order->assigned_to === auth()->id())
        <div class="table-container mb-3">
            <h5>Upload Files</h5>
            @if(!$order->half_file)
            <form method="POST" action="{{ route('orders.upload-half-file', $order->id) }}" enctype="multipart/form-data" class="mb-3">
                @csrf
                <div class="mb-3">
                    <label for="half_file" class="form-label">Upload Half File</label>
                    <input type="file" class="form-control" id="half_file" name="half_file" accept=".pdf,.doc,.docx" required>
                </div>
                <button type="submit" class="btn btn-primary">Upload Half File</button>
            </form>
            @else
            <p class="text-success">Half file uploaded</p>
            @endif

            @if(!$order->full_file)
            <form method="POST" action="{{ route('orders.upload-full-file', $order->id) }}" enctype="multipart/form-data" class="mb-3">
                @csrf
                <div class="mb-3">
                    <label for="full_file" class="form-label">Upload Full File</label>
                    <input type="file" class="form-control" id="full_file" name="full_file" accept=".pdf,.doc,.docx" required>
                </div>
                <button type="submit" class="btn btn-primary">Upload Full File</button>
            </form>
            @else
            <p class="text-success">Full file uploaded</p>
            @endif

            @if($order->half_file && $order->full_file && $order->status !== 'completed')
            <form method="POST" action="{{ route('orders.mark-completed', $order->id) }}">
                @csrf
                <button type="submit" class="btn btn-success">Mark as Completed</button>
            </form>
            @endif
        </div>
        @endif

        @if((auth()->user()->isManager() || auth()->user()->isSuperAdmin()))
        <div class="table-container mb-3">
            <h5>Manager Actions</h5>
            @if($order->status === 'half_payment_uploaded' || $order->status === 'pending')
            <form method="POST" action="{{ route('orders.approve', $order->id) }}" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-success">Approve Order</button>
            </form>
            @endif

            @if($order->status === 'approved' && !$order->assigned_to)
            <form method="POST" action="{{ route('orders.assign-writer', $order->id) }}" class="mt-3">
                @csrf
                <div class="mb-3">
                    <label for="writer_id" class="form-label">Assign Writer</label>
                    <select class="form-select" id="writer_id" name="writer_id" required>
                        <option value="">Select Writer</option>
                        @foreach(\App\Models\User::where('role', 'writer')->where('status', 'active')->get() as $writer)
                        <option value="{{ $writer->id }}">{{ $writer->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Assign Writer</button>
            </form>
            @endif

            @if($order->half_file)
            <div class="mt-3">
                <h6>Half File Visibility</h6>
                <form method="POST" action="{{ route('orders.toggle-half-file-visibility', $order->id) }}" class="d-inline">
                    @csrf
                    @if($order->half_file_visible)
                    <button type="submit" class="btn btn-warning btn-sm">Hide Half File from Client</button>
                    @else
                    <button type="submit" class="btn btn-info btn-sm">Show Half File to Client</button>
                    @endif
                </form>
            </div>
            @endif

            @if($order->full_file)
            <div class="mt-3">
                <h6>Full File Visibility</h6>
                <form method="POST" action="{{ route('orders.toggle-full-file-visibility', $order->id) }}" class="d-inline">
                    @csrf
                    @if($order->full_file_visible)
                    <button type="submit" class="btn btn-warning btn-sm">Hide Full File from Client</button>
                    @else
                    <button type="submit" class="btn btn-success btn-sm">Show Full File to Client</button>
                    @endif
                </form>
            </div>
            @endif

            @if($order->status === 'full_payment_uploaded')
            <form method="POST" action="{{ route('orders.verify-full-payment', $order->id) }}" class="mt-3">
                @csrf
                <button type="submit" class="btn btn-success">Verify Full Payment</button>
            </form>
            @endif
        </div>
        @endif

        <div class="table-container mb-3">
            <h5>Order Status History</h5>
            <div class="timeline">
                @foreach($order->statusHistory as $status)
                <div class="mb-2">
                    <strong>{{ ucfirst(str_replace('_', ' ', $status->status)) }}</strong>
                    <br>
                    <small class="text-muted">
                        {{ $status->created_at->format('M d, Y h:i A') }} - By: {{ $status->createdBy->name }}
                    </small>
                </div>
                @endforeach
            </div>
        </div>

        <div class="table-container">
            <h5>Reviews & Feedback</h5>
            @foreach($order->reviews as $review)
            <div class="card mb-2">
                <div class="card-body">
                    <p>{{ $review->comment }}</p>
                    <small class="text-muted">By: {{ $review->createdBy->name }} on {{ $review->created_at->format('M d, Y') }}</small>
                </div>
            </div>
            @endforeach

            <form method="POST" action="{{ route('reviews.store') }}">
                @csrf
                <input type="hidden" name="order_id" value="{{ $order->id }}">
                <div class="mb-3">
                    <textarea class="form-control" name="comment" rows="3" placeholder="Add your feedback or revision request..." required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit Feedback</button>
            </form>
        </div>
    </div>

    <div class="col-md-4">
        @if(auth()->user()->isClient())
        <div class="table-container mb-3">
            <form method="POST" action="{{ route('meetings.request') }}">
                @csrf
                <input type="hidden" name="order_id" value="{{ $order->id }}">
                <button type="submit" class="btn btn-danger w-100">Request Meeting</button>
            </form>
        </div>
        @endif

        @if(auth()->user()->isClient())
        <div class="table-container mb-3">
            <h5>Files</h5>
            @if($order->half_file_visible && $order->half_file)
            <a href="{{ route('orders.files.download', ['orderId' => $order->id, 'fileType' => 'half_file']) }}" class="btn btn-sm btn-primary mb-2 w-100">
                <i class="bi bi-file-earmark-pdf me-1"></i> Download Half File
            </a>
            @elseif($order->half_file)
            <p class="text-muted mb-2">Half file is not yet visible</p>
            @endif

            @if($order->full_file_visible && $order->full_file)
            <a href="{{ route('orders.files.download', ['orderId' => $order->id, 'fileType' => 'full_file']) }}" class="btn btn-sm btn-success mb-2 w-100">
                <i class="bi bi-file-earmark-pdf me-1"></i> Download Full File
            </a>
            @elseif($order->full_file)
            <p class="text-muted mb-2">Full file is not yet visible</p>
            @endif
        </div>
        @endif

        @if((auth()->user()->isWriter() && $order->assigned_to === auth()->id()) || auth()->user()->isManager() || auth()->user()->isSuperAdmin())
        <div class="table-container mb-3">
            <h5>Client Uploaded Files</h5>
            @if($order->attachments && count($order->attachments) > 0)
            @foreach($order->attachments as $attachment)
            <a href="{{ route('orders.attachments.download', ['orderId' => $order->id, 'attachmentIndex' => $loop->index]) }}" class="btn btn-sm btn-outline-primary mb-2 w-100">
                <i class="bi bi-file-earmark me-1"></i> {{ basename($attachment) }}
            </a>
            @endforeach
            @else
            <p class="text-muted mb-0">No files uploaded by client</p>
            @endif
        </div>

        @if($order->half_file)
        <div class="table-container mb-3">
            <h5>Half File</h5>
            <a href="{{ route('orders.files.download', ['orderId' => $order->id, 'fileType' => 'half_file']) }}" class="btn btn-sm btn-primary w-100">
                <i class="bi bi-file-earmark-pdf me-1"></i> Download Half File
            </a>
        </div>
        @endif

        @if($order->full_file)
        <div class="table-container mb-3">
            <h5>Full File</h5>
            <a href="{{ route('orders.files.download', ['orderId' => $order->id, 'fileType' => 'full_file']) }}" class="btn btn-sm btn-success w-100">
                <i class="bi bi-file-earmark-pdf me-1"></i> Download Full File
            </a>
        </div>
        @endif

        @if($order->half_payment_image)
        <div class="table-container mb-3">
            <h5>Half Payment Receipt</h5>
            <a href="{{ route('orders.files.download', ['orderId' => $order->id, 'fileType' => 'half_payment_image']) }}" class="btn btn-sm btn-info w-100">
                <i class="bi bi-image me-1"></i> View Receipt
            </a>
        </div>
        @endif

        @if($order->full_payment_image)
        <div class="table-container mb-3">
            <h5>Full Payment Receipt</h5>
            <a href="{{ route('orders.files.download', ['orderId' => $order->id, 'fileType' => 'full_payment_image']) }}" class="btn btn-sm btn-info w-100">
                <i class="bi bi-image me-1"></i> View Receipt
            </a>
        </div>
        @endif
        @endif
    </div>
</div>
@endsection

