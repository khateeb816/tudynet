@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-10 mx-auto">

            <!-- HEADER -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold text-dark mb-1">Order #{{ $order->id }}</h2>
                    <span class="badge rounded-pill bg-{{ $order->status === 'cancelled' ? 'danger' : ($order->status === 'completed' ? 'success' : 'primary') }} px-3 py-2 text-uppercase" style="background-color: var(--primary-color) !important;">
                        {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                    </span>
                </div>
                 @if(auth()->user()->isClient())
                <div>
                    <form action="{{ route('reviews.store') }}" method="POST" onsubmit="return confirm('Are you sure you want to request a meeting?');">
                        @csrf
                        <input type="hidden" name="order_id" value="{{ $order->id }}">
                        <input type="hidden" name="comment" value="I would like to request a meeting regarding this order.">
                        <button type="submit" class="btn btn-outline-danger">
                            <i class="bi bi-camera-video me-2"></i> Request Meeting
                        </button>
                    </form>
                </div>
                @endif
            </div>

            <!-- COMPREHENSIVE PROGRESS TRACKER (Compact Multi-Row) -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white border-bottom-0 pt-4 px-4">
                    <h5 class="fw-bold mb-0">Order Progress</h5>
                </div>
                <div class="card-body px-4 pb-4">
                    <div class="p-3 rounded-3" style="background-color: #f8f9fa;">
                         @php
                            $allStatuses = [
                                'pending' => 'Pending',
                                'half_payment_uploaded' => 'Half Payment Uploaded',
                                'approved' => 'Approved',
                                'assigned_to_writer' => 'Assigned to Writer',
                                'researching' => 'Researching',
                                'writing' => 'Writing',
                                'reviewing' => 'Reviewing',
                                'half_file_uploaded' => 'Half File Uploaded',
                                'half_file_visible' => 'Half File Visible',
                                'full_payment_uploaded' => 'Full Payment Uploaded',
                                'full_payment_verified' => 'Full Payment Verified',
                                'full_file_uploaded' => 'Full File Uploaded',
                                'completed' => 'Completed',
                            ];

                            $statusKeys = array_keys($allStatuses);
                            $currentStatusKey = $order->status === 'drafting' ? 'writing' : $order->status;
                            $currentIndex = array_search($currentStatusKey, $statusKeys);
                            $isCancelled = $order->status === 'cancelled';
                        @endphp

                        @if($isCancelled)
                            <div class="alert alert-danger mb-3 fw-bold text-center">
                                <i class="bi bi-x-circle-fill me-2"></i> This order has been CANCELLED.
                            </div>
                        @endif

                        @php
                            // Chunk statuses into rows of 4
                            $chunks = array_chunk($allStatuses, 4, true); 
                            $totalChunks = count($chunks);
                        @endphp

                        <div class="d-none d-md-block">
                            <div class="d-flex flex-column row-gap-5">
                                @foreach($chunks as $chunkIndex => $chunk)
                                    @php
                                        $isEvenRow = $chunkIndex % 2 === 0; // 0, 2 (L->R)
                                        $rowClass = $isEvenRow ? 'flex-row' : 'flex-row-reverse';
                                    @endphp
    
                                    <div class="d-flex {{ $rowClass }} justify-content-between position-relative">
                                        @foreach($chunk as $key => $label)
                                            @php
                                                // Find original index
                                                $index = array_search($key, array_keys($allStatuses));
                                                
                                                $isPastOrCurrent = ($currentIndex !== false && $index <= $currentIndex);
                                                $isCompleted = $isPastOrCurrent && !$isCancelled;
                                                $isLastInChunk = $loop->last;
                                                $isFirstInChunk = $loop->first;
                                                
                                                // Line Colors (Green if Next Step Reached)
                                                $isLineGreen = ($index < $currentIndex) ? 'bg-success' : 'bg-secondary';
                                                $lineOpacity = $isLineGreen === 'bg-success' ? '1' : '0.3';
                                                
                                                // Vertical Line Color (For turns)
                                                $vertLineColor = $isLineGreen; 
                                                $vertOpacity = $lineOpacity;
                                            @endphp
    
                                            <div class="position-relative" style="width: 25%; min-width: 150px;">
                                                
                                                <!-- 1. Standard Horizontal Connector -->
                                                @if(!$isLastInChunk)
                                                    <div class="position-absolute {{ $isLineGreen }}" 
                                                         style="height: 3px; top: 15px; width: 100%; z-index: 1; opacity: {{ $lineOpacity }};
                                                                {{ $isEvenRow ? 'left: 50%;' : 'right: 50%;' }}"></div>
                                                @endif
    
                                                <!-- 2. Side Connectors (Turning Corners) -->
                                                <!-- CASE A: End of L->R Row (Right Turn) -->
                                                @if($isEvenRow && $isLastInChunk && $chunkIndex < $totalChunks - 1)
                                                    <div class="position-absolute {{ $vertLineColor }}" style="height: 3px; top: 15px; left: 50%; width: 50%; z-index: 1; opacity: {{ $vertOpacity }};"></div>
                                                    <div class="position-absolute {{ $vertLineColor }}" style="width: 3px; height: calc(100% + 3rem); top: 15px; right: 0; z-index: 1; opacity: {{ $vertOpacity }};"></div>
                                                @endif
    
                                                <!-- CASE B: Start of R->L Row (Continuing Right Turn) -->
                                                @if(!$isEvenRow && $isFirstInChunk)
                                                    <div class="position-absolute {{ $isLineGreen }}" style="height: 3px; top: 15px; left: 50%; width: 50%; z-index: 1; opacity: {{ $lineOpacity }};"></div>
                                                     @php 
                                                        $isEntryGreen = (($index - 1) < $currentIndex) ? 'bg-success' : 'bg-secondary';
                                                        $entryOpacity = $isEntryGreen === 'bg-success' ? '1' : '0.3';
                                                     @endphp
                                                     <div class="position-absolute {{ $isEntryGreen }}" style="height: 3px; top: 15px; left: 50%; width: 50%; z-index: 1; opacity: {{ $entryOpacity }};"></div> 
                                                @endif
    
                                                <!-- CASE C: End of R->L Row (Left Turn) -->
                                                @if(!$isEvenRow && $isLastInChunk && $chunkIndex < $totalChunks - 1)
                                                    <div class="position-absolute {{ $vertLineColor }}" style="height: 3px; top: 15px; right: 50%; width: 50%; z-index: 1; opacity: {{ $vertOpacity }};"></div>
                                                    <div class="position-absolute {{ $vertLineColor }}" style="width: 3px; height: calc(100% + 3rem); top: 15px; left: 0; z-index: 1; opacity: {{ $vertOpacity }};"></div>
                                                @endif
    
                                                <!-- CASE D: Start of L->R Row (Continuing Left Turn) -->
                                                @if($isEvenRow && $isFirstInChunk && $chunkIndex > 0)
                                                    @php 
                                                        $isEntryGreen = (($index - 1) < $currentIndex) ? 'bg-success' : 'bg-secondary';
                                                        $entryOpacity = $isEntryGreen === 'bg-success' ? '1' : '0.3';
                                                     @endphp
                                                    <div class="position-absolute {{ $isEntryGreen }}" style="height: 3px; top: 15px; right: 50%; width: 50%; z-index: 1; opacity: {{ $entryOpacity }};"></div>
                                                @endif
    
                                                <!-- Content -->
                                                <div class="d-flex flex-column align-items-center position-relative" style="z-index: 2;">
                                                     <!-- Status Circle -->
                                                    <div class="flex-shrink-0 d-flex justify-content-center align-items-center rounded-circle border {{ $isCompleted ? 'border-success bg-success text-white' : 'border-secondary bg-light text-muted' }}" 
                                                         style="width: 30px; height: 30px; transition: all 0.3s ease;">
                                                        @if($isCompleted) 
                                                            <i class="bi bi-check" style="font-size: 1.2rem;"></i> 
                                                        @else
                                                            <i class="bi bi-lock-fill" style="font-size: 0.8rem; opacity: 0.5;"></i>
                                                        @endif
                                                    </div>
                                                    
                                                    <!-- Text -->
                                                    <div class="text-center mt-2 w-100 px-1">
                                                        <div class="fw-bold {{ $isCompleted ? 'text-success' : 'text-muted' }}" style="font-size: 0.85rem; line-height: 1.2;">{{ $label }}</div>
                                                        @if($isCompleted)
                                                            @php $historyRec = $order->statusHistory->where('status', $key)->first(); @endphp
                                                            @if($historyRec)
                                                                <small class="text-muted d-block mt-1" style="font-size: 0.7rem;">
                                                                    {{ $historyRec->created_at->format('M d') }} <br>
                                                                    {{ $historyRec->createdBy->isManager() ? 'Manager' : ($historyRec->createdBy->isWriter() ? 'Writer' : 'Client') }}
                                                                </small>
                                                            @endif
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- MOBILE VERTICAL LAYOUT -->
                        <div class="d-md-none">
                            <div class="position-relative ps-4 border-start border-2 border-secondary" style="border-color: #e9ecef !important;">
                                @foreach($allStatuses as $key => $label)
                                    @php
                                        $index = array_search($key, array_keys($allStatuses));
                                        $isPastOrCurrent = ($currentIndex !== false && $index <= $currentIndex);
                                        $isCompleted = $isPastOrCurrent && !$isCancelled;
                                        $isLast = $loop->last;
                                        
                                        // Line Color logic: If prev item completed, line to this is green?
                                        // Or if THIS item is completed, line from prev is green.
                                        // Timeline: Line connects dots.
                                        $isLineGreen = ($index <= $currentIndex);
                                        $lineClass = $isLineGreen ? 'bg-success' : 'bg-secondary';
                                    @endphp

                                    <div class="position-relative mb-4">
                                        <!-- Dot -->
                                        <div class="position-absolute top-0 start-0 translate-middle rounded-circle border {{ $isCompleted ? 'border-success bg-success text-white' : 'border-secondary bg-light text-muted' }}" 
                                             style="width: 24px; height: 24px; left: -1px !important; z-index: 2; margin-top: 4px;">
                                            @if($isCompleted)
                                                <i class="bi bi-check d-flex justify-content-center align-items-center h-100" style="font-size: 1rem;"></i>
                                            @else
                                                <div class="bg-secondary rounded-circle" style="width: 8px; height: 8px; margin: 7px;"></div>
                                            @endif
                                        </div>

                                        <!-- Content -->
                                        <div class="ps-3">
                                            <div class="fw-bold {{ $isCompleted ? 'text-success' : 'text-muted' }}">{{ $label }}</div>
                                            @if($isCompleted)
                                                @php $historyRec = $order->statusHistory->where('status', $key)->first(); @endphp
                                                @if($historyRec)
                                                    <small class="text-muted d-block" style="font-size: 0.75rem;">
                                                        {{ $historyRec->created_at->format('M d, h:i A') }} &bull; 
                                                        {{ $historyRec->createdBy->isManager() ? 'Manager' : ($historyRec->createdBy->isWriter() ? 'Writer' : 'Client') }}
                                                    </small>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- METRICS GRID -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <div class="row g-4 text-center">
                        <div class="col-md-3 col-6">
                            <div class="p-3 rounded-3 bg-light h-100">
                                <small class="text-uppercase text-muted fw-bold d-block mb-1">Subject</small>
                                <span class="fw-bold text-dark">{{ $order->subject->name }}</span>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="p-3 rounded-3 bg-light h-100">
                                <small class="text-uppercase text-muted fw-bold d-block mb-1">Word Count</small>
                                <span class="fw-bold text-dark">{{ $order->words }} words</span>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="p-3 rounded-3 bg-light h-100">
                                <small class="text-uppercase text-muted fw-bold d-block mb-1">Amount</small>
                                <span class="fw-bold text-success">${{ number_format($order->total_amount, 2) }}</span>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="p-3 rounded-3 bg-light h-100">
                                <small class="text-uppercase text-muted fw-bold d-block mb-1">Deadline</small>
                                <span class="fw-bold text-danger">{{ \Carbon\Carbon::parse($order->expiry_date)->format('M d, Y') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- DESCRIPTION -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white fw-bold py-3">Order Description</div>
                <div class="card-body">
                    <p class="text-secondary mb-0" style="white-space: pre-line;">{{ $order->description }}</p>
                </div>
            </div>
            
            <!-- ATTACHMENTS (With Media Previews for Client) -->
            <div class="card border-0 shadow-sm mb-4">
                 <div class="card-header bg-white fw-bold py-3">Attachments</div>
                 <div class="card-body">
                    @if($order->attachments && count($order->attachments) > 0)
                        <div class="row g-3">
                             @foreach($order->attachments as $index => $path)
                                @php
                                    $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));
                                    $isImage = in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp']);
                                    $isVideo = in_array($extension, ['mp4', 'webm', 'ogg']);
                                    $isAudio = in_array($extension, ['mp3', 'wav']);
                                    $downloadUrl = route('orders.attachments.download', ['orderId' => $order->id, 'attachmentIndex' => $index]);
                                    // Use download URL for source as well, browser handles it
                                @endphp
                                
                                <div class="col-md-4 col-sm-6">
                                    <div class="card h-100 border-light shadow-sm">
                                        @if($isImage)
                                            <!-- Image Preview -->
                                            <div class="bg-light d-flex justify-content-center align-items-center" style="height: 150px; overflow: hidden;">
                                                <img src="{{ $downloadUrl }}" class="img-fluid" style="object-fit: contain; max-height: 100%;" alt="Attachment {{ $index + 1 }}">
                                            </div>
                                        @elseif($isVideo)
                                            <!-- Video Preview -->
                                            <div class="bg-dark d-flex justify-content-center align-items-center" style="height: 150px;">
                                                <video controls style="max-width: 100%; max-height: 100%;">
                                                    <source src="{{ $downloadUrl }}" type="video/{{ $extension }}">
                                                    Your browser does not support the video tag.
                                                </video>
                                            </div>
                                        @elseif($isAudio)
                                            <!-- Audio Preview -->
                                            <div class="bg-light d-flex justify-content-center align-items-center p-3" style="height: 150px;">
                                                <audio controls style="width: 100%;">
                                                    <source src="{{ $downloadUrl }}" type="audio/{{ $extension }}">
                                                    Your browser does not support the audio element.
                                                </audio>
                                            </div>
                                        @else
                                            <!-- Generic File (Doc, etc.) -->
                                            <div class="bg-light d-flex flex-column justify-content-center align-items-center text-muted p-3" style="height: 150px;">
                                                <i class="bi bi-file-earmark-text display-4 mb-2"></i>
                                                <span class="text-uppercase fw-bold small">{{ $extension }}</span>
                                            </div>
                                        @endif
                                        
                                        <div class="card-body p-2 text-center bg-white border-top">
                                             <div class="fw-bold text-dark text-truncate mb-1" title="Attachment {{ $index+1 }}">Attachment {{ $index + 1 }}</div>
                                             <a href="{{ $downloadUrl }}" class="btn btn-sm btn-outline-primary w-100">
                                                 <i class="bi bi-download me-1"></i> Download
                                             </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted mb-0 fst-italic">No attachments provided.</p>
                    @endif
                 </div>
            </div>

            <!-- PAYMENT SCREENSHOTS (For Managers and Clients) -->
            @if((auth()->user()->isManager() || auth()->user()->isSuperAdmin() || auth()->user()->isClient()) && ($order->half_payment_image || $order->full_payment_image))
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white fw-bold py-3">Payment Screenshots</div>
                <div class="card-body">
                    <div class="row g-3">
                        @if($order->half_payment_image)
                        <div class="col-md-6">
                            <div class="card h-100 border-light shadow-sm">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0">Half Payment Screenshot</h6>
                                    <small class="text-muted">
                                        Uploaded: {{ $order->statusHistory->where('status', 'half_payment_uploaded')->first()?->created_at->format('M d, Y h:i A') ?? 'N/A' }}
                                    </small>
                                </div>
                                <div class="card-body p-0">
                                    <div class="bg-light d-flex justify-content-center align-items-center" style="min-height: 300px; max-height: 400px; overflow: hidden;">
                                        <img src="{{ Storage::url($order->half_payment_image) }}" 
                                             class="img-fluid" 
                                             style="object-fit: contain; max-height: 400px; width: 100%;" 
                                             alt="Half Payment Screenshot"
                                             onerror="this.onerror=null; this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22200%22 height=%22200%22%3E%3Ctext x=%2250%25%22 y=%2250%25%22 text-anchor=%22middle%22 dy=%22.3em%22 fill=%22%23999%22%3EImage not found%3C/text%3E%3C/svg%3E';">
                                    </div>
                                </div>
                                <div class="card-footer bg-white text-center">
                                    <a href="{{ Storage::url($order->half_payment_image) }}" 
                                       class="btn btn-sm btn-outline-primary" 
                                       download 
                                       target="_blank">
                                        <i class="bi bi-download me-1"></i> Download
                                    </a>
                                    <a href="{{ Storage::url($order->half_payment_image) }}" 
                                       class="btn btn-sm btn-outline-secondary" 
                                       target="_blank">
                                        <i class="bi bi-eye me-1"></i> View Full Size
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endif

                        @if($order->full_payment_image)
                        <div class="col-md-6">
                            <div class="card h-100 border-light shadow-sm">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0">Full Payment Screenshot</h6>
                                    <small class="text-muted">
                                        Uploaded: {{ $order->statusHistory->where('status', 'full_payment_uploaded')->first()?->created_at->format('M d, Y h:i A') ?? 'N/A' }}
                                    </small>
                                    @if($order->status === 'full_payment_verified')
                                        <span class="badge bg-success ms-2">Verified</span>
                                    @else
                                        <span class="badge bg-warning text-dark ms-2">Pending Verification</span>
                                    @endif
                                </div>
                                <div class="card-body p-0">
                                    <div class="bg-light d-flex justify-content-center align-items-center" style="min-height: 300px; max-height: 400px; overflow: hidden;">
                                        <img src="{{ Storage::url($order->full_payment_image) }}" 
                                             class="img-fluid" 
                                             style="object-fit: contain; max-height: 400px; width: 100%;" 
                                             alt="Full Payment Screenshot"
                                             onerror="this.onerror=null; this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22200%22 height=%22200%22%3E%3Ctext x=%2250%25%22 y=%2250%25%22 text-anchor=%22middle%22 dy=%22.3em%22 fill=%22%23999%22%3EImage not found%3C/text%3E%3C/svg%3E';">
                                    </div>
                                </div>
                                <div class="card-footer bg-white text-center">
                                    <a href="{{ Storage::url($order->full_payment_image) }}" 
                                       class="btn btn-sm btn-outline-primary" 
                                       download 
                                       target="_blank">
                                        <i class="bi bi-download me-1"></i> Download
                                    </a>
                                    <a href="{{ Storage::url($order->full_payment_image) }}" 
                                       class="btn btn-sm btn-outline-secondary" 
                                       target="_blank">
                                        <i class="bi bi-eye me-1"></i> View Full Size
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif

            <!-- ACTION WORKSPACES (Dynamic by Role) -->
            
            <!-- 1. WRITER WORKSPACE -->
            @if(auth()->user()->isWriter() && $order->assigned_to === auth()->id())
            <div class="card border-0 shadow-sm mb-4 border-start border-4 border-primary">
                <div class="card-header bg-white fw-bold py-3 text-primary">Writer Workspace</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-4 mb-md-0">
                             <h6 class="text-uppercase text-muted small fw-bold mb-3">Update Progress</h6>
                             @php
                                $showStatusButtons = !in_array($order->status, ['half_file_uploaded', 'full_file_uploaded', 'completed', 'cancelled']);
                             @endphp
                             
                             @if($showStatusButtons)
                                 @if($order->status === 'assigned_to_writer')
                                     <form method="POST" action="{{ route('orders.update-status', $order->id) }}" class="d-inline">
                                         @csrf
                                         <input type="hidden" name="status" value="researching">
                                         <button class="btn btn-primary w-100" type="submit">
                                             <i class="bi bi-search me-2"></i>Start Researching
                                         </button>
                                     </form>
                                 @elseif($order->status === 'researching')
                                     <form method="POST" action="{{ route('orders.update-status', $order->id) }}" class="d-inline">
                                         @csrf
                                         <input type="hidden" name="status" value="writing">
                                         <button class="btn btn-primary w-100" type="submit">
                                             <i class="bi bi-pencil me-2"></i>Start Writing
                                         </button>
                                     </form>
                                 @elseif($order->status === 'writing')
                                     <form method="POST" action="{{ route('orders.update-status', $order->id) }}" class="d-inline">
                                         @csrf
                                         <input type="hidden" name="status" value="reviewing">
                                         <button class="btn btn-primary w-100" type="submit">
                                             <i class="bi bi-eye me-2"></i>Start Reviewing
                                         </button>
                                     </form>
                                 @elseif($order->status === 'reviewing')
                                     <div class="alert alert-success mb-0">
                                         <i class="bi bi-check-circle me-2"></i>Ready to upload files
                                     </div>
                                 @endif
                             @else
                                 <div class="alert alert-info mb-0">
                                     <i class="bi bi-info-circle me-2"></i>Files uploaded - Status locked
                                 </div>
                             @endif
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-uppercase text-muted small fw-bold mb-3">Upload Deliverables</h6>
                             <!-- Half File Upload -->
                            @if(!in_array($order->status, ['completed', 'cancelled']))
                            <form action="{{ route('orders.upload-half-file', $order->id) }}" method="POST" enctype="multipart/form-data" class="mb-3">
                                @csrf
                                <label class="form-label small">Half File (Doc/PDF)</label>
                                <div class="input-group">
                                    <input type="file" name="half_file" class="form-control form-control-sm border-secondary" required>
                                    <button class="btn btn-outline-secondary btn-sm" type="submit">Upload</button>
                                </div>
                                @if($order->half_file)
                                    <small class="text-success d-block mt-1"><i class="bi bi-check-circle"></i> Uploaded</small>
                                @endif
                            </form>
                            @endif

                            <!-- Full File Upload -->
                            @if(!in_array($order->status, ['completed', 'cancelled']))
                            <form action="{{ route('orders.upload-full-file', $order->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <label class="form-label small">Full File (Final Version)</label>
                                <div class="input-group">
                                    <input type="file" name="full_file" class="form-control form-control-sm border-primary" required>
                                    <button class="btn btn-outline-primary btn-sm" type="submit">Upload Final</button>
                                </div>
                                @if($order->full_file)
                                    <small class="text-success d-block mt-1"><i class="bi bi-check-circle"></i> Uploaded</small>
                                @endif
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- 2. CLIENT WORKSPACE -->
            @if(auth()->user()->isClient())
            <div class="card border-0 shadow-sm mb-4 border-start border-4 border-info">
                <div class="card-header bg-white fw-bold py-3 text-info">Client Workspace</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Half Payment -->
                            <h6 class="text-uppercase text-muted small fw-bold mb-3">Payments</h6>
                            @if($order->status === 'pending')
                            <form action="{{ route('orders.upload-half-payment', $order->id) }}" method="POST" enctype="multipart/form-data" class="mb-3">
                                @csrf
                                <label class="form-label small">Upload Half Payment Screenshot</label>
                                <div class="input-group">
                                    <input type="file" name="half_payment_image" class="form-control form-control-sm border-info" required>
                                    <button class="btn btn-info text-white btn-sm" type="submit">Upload</button>
                                </div>
                            </form>
                            @elseif($order->half_payment_image)
                                <div class="alert alert-success py-2 small mb-3"><i class="bi bi-check-circle"></i> Half Payment Uploaded</div>
                            @endif

                            <!-- Full Payment -->
                            @if($order->half_file_visible && !$order->full_payment_image)
                            <form action="{{ route('orders.upload-full-payment', $order->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <label class="form-label small">Upload Full Payment Screenshot</label>
                                <div class="input-group">
                                    <input type="file" name="full_payment_image" class="form-control form-control-sm border-success" required>
                                    <button class="btn btn-success text-white btn-sm" type="submit">Upload Final Payment</button>
                                </div>
                            </form>
                            @elseif($order->full_payment_image && $order->status !== 'full_payment_verified')
                                <div class="alert alert-info py-2 small mb-3"><i class="bi bi-clock"></i> Full Payment Pending Verification</div>
                            @elseif($order->status === 'full_payment_verified')
                                <div class="alert alert-success py-2 small mb-3"><i class="bi bi-check-circle"></i> Full Payment Verified</div>
                            @endif
                        </div>
                        <div class="col-md-6">
                             <h6 class="text-uppercase text-muted small fw-bold mb-3">Downloads</h6>
                             @if($order->half_file && $order->half_file_visible)
                                <a href="{{ route('orders.files.download', ['orderId' => $order->id, 'fileType' => 'half_file']) }}" class="btn btn-outline-primary w-100 mb-2 text-start">
                                    <i class="bi bi-download me-2"></i> Download Half File
                                </a>
                             @endif
                             @if($order->full_file && $order->full_file_visible)
                                <a href="{{ route('orders.files.download', ['orderId' => $order->id, 'fileType' => 'full_file']) }}" class="btn btn-primary w-100 text-start">
                                    <i class="bi bi-download me-2"></i> Download Final File
                                </a>
                             @endif
                             @if(!$order->half_file_visible && !$order->full_file_visible)
                                <p class="text-muted small fst-italic">Files will appear here once ready and payments are verified.</p>
                             @endif
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- 3. MANAGER ACTIONS -->
             @if(auth()->user()->isManager() || auth()->user()->isSuperAdmin())
            <div class="card border-0 shadow-sm mb-4 border-start border-4 border-danger">
                <div class="card-header bg-white fw-bold py-3 text-danger">Manager Controls</div>
                <div class="card-body">
                    <div class="d-flex flex-wrap gap-2">
                        @if($order->status == 'half_payment_uploaded')
                            <form action="{{ route('orders.approve', $order->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm">Approve Order</button>
                            </form>
                        @endif

                        @if($order->status == 'approved')
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#assignWriterModal">Assign Writer</button>
                        @endif

                        @if($order->half_file && !$order->half_file_visible)
                            <form action="{{ route('orders.toggle-half-file-visibility', $order->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-warning btn-sm text-dark">Show Half File to Client</button>
                            </form>
                        @endif

                        @if($order->full_payment_image && $order->status !== 'full_payment_verified')
                            <form action="{{ route('orders.verify-full-payment', $order->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm">Verify Full Payment</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
            @endif

            <!-- COMMENTS SECTION (YouTube Style) -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white fw-bold py-3 border-bottom">
                    {{ $order->reviews->count() }} Comments
                </div>
                <div class="card-body p-0">
                    <!-- Comment Input (Top) -->
                    @if(!auth()->user()->isWriter())
                    <div class="p-3 border-bottom bg-light">
                        <form action="{{ route('reviews.store') }}" method="POST" class="d-flex gap-3">
                            @csrf
                            <input type="hidden" name="order_id" value="{{ $order->id }}">
                            <div class="flex-shrink-0">
                                <div class="rounded-circle bg-secondary text-white d-flex justify-content-center align-items-center fw-bold" style="width: 40px; height: 40px;">
                                    {{ substr(auth()->user()->name, 0, 1) }}
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <textarea name="comment" class="form-control border-0 border-bottom rounded-0 bg-transparent" placeholder="Add a comment..." rows="1" style="resize: none; box-shadow: none;" required></textarea>
                                <div class="d-flex justify-content-end mt-2">
                                    <button type="submit" class="btn btn-primary btn-sm px-3 rounded-pill">Comment</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    @endif

                    <!-- Comments List -->
                    <div class="comments-list p-3" style="max-height: 500px; overflow-y: auto;">
                        @forelse($order->reviews->sortByDesc('created_at') as $review)
                        <div class="d-flex gap-3 mb-3">
                            <div class="flex-shrink-0">
                                <div class="rounded-circle bg-{{ $review->user_id === auth()->id() ? 'primary' : 'secondary' }} text-white d-flex justify-content-center align-items-center fw-bold" style="width: 40px; height: 40px;">
                                    {{ substr($review->createdBy->name, 0, 1) }}
                                </div>
                            </div>
                            <div>
                                <div class="d-flex align-items-center mb-1">
                                    <!-- Anonymized Name -->
                                    <span class="fw-bold me-2">
                                        {{ $review->createdBy->isManager() ? 'Manager' : ($review->createdBy->isWriter() ? 'Writer' : $review->createdBy->name) }}
                                    </span>
                                    <span class="text-muted small" style="font-size: 0.8rem;">{{ $review->created_at->diffForHumans() }}</span>
                                    @if($review->createdBy->isWriter())
                                        <span class="badge bg-secondary ms-2" style="font-size: 0.7rem;">Writer</span>
                                    @elseif($review->createdBy->isManager())
                                        <span class="badge bg-danger ms-2" style="font-size: 0.7rem;">Manager</span>
                                    @endif
                                </div>
                                <p class="mb-0 {{ str_contains($review->comment, 'request a meeting') ? 'text-danger fw-bold' : 'text-dark' }}">{{ $review->comment }}</p>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-5 text-muted">
                            <i class="bi bi-chat-dots fs-1 d-block mb-3 opacity-50"></i>
                            <p>No comments yet.</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Assign Writer Modal (Keep existing) -->
<div class="modal fade" id="assignWriterModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('orders.assign-writer', $order->id) }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Assign Writer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <select name="writer_id" class="form-select" required>
                        <option value="">Select Writer</option>
                        @foreach(\App\Models\User::where('role', 'writer')->get() as $writer)
                        <option value="{{ $writer->id }}">{{ $writer->name }} (ID: {{ $writer->id }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Assign</button>
                </div>
            </div>
        </form>
    </div>
</div>

<style>
    /* Custom Scrollbar for Comments */
    .comments-list::-webkit-scrollbar {
        width: 8px;
    }
    .comments-list::-webkit-scrollbar-track {
        background: #f1f1f1; 
    }
    .comments-list::-webkit-scrollbar-thumb {
        background: #ccc; 
        border-radius: 4px;
    }
    .comments-list::-webkit-scrollbar-thumb:hover {
        background: #bbb; 
    }
</style>
@endsection
