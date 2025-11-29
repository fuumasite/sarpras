<x-app-layout>
    <div class="container py-5">
        <div class="mb-4">
            <h3 class="fw-bold text-dark m-0">History Aktivitas</h3>
            <small class="text-muted">Lihat semua sistem aktivitas</small>
        </div>

        <div class="card shadow-lg border-0 rounded-3">
            <div class="card-body p-4">
              
                <table class="table table-hover align-middle datatable" style="width:100%">
                    <thead class="bg-light">
                        <tr>
                            <th class="py-3 px-3 small fw-bold text-muted text-center" style="width: 5%;">#</th>
                            <th class="py-3 px-3 small fw-bold text-muted">Date & Time</th>
                            <th class="py-3 px-3 small fw-bold text-muted">User</th>
                            <th class="py-3 px-3 small fw-bold text-muted">Action</th>
                            <th class="py-3 px-3 small fw-bold text-muted">Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($logs as $log)
                            <tr>
                                <td class="px-3 fw-bold text-secondary text-center">{{ $loop->iteration }}</td>
                                <td class="px-3 text-muted small fw-bold">{{ $log->created_at->format('M d, Y h:i A') }}</td>
                                <td class="px-3 fw-bold small text-dark">
                                    <div class="d-flex align-items-center gap-2">
                                        {{-- CHECK: Siguraduhin na may "user" ang log bago i-check ang avatar --}}
                                        @if($log->user && $log->user->avatar)
                                            <img src="{{ asset('storage/' . $log->user->avatar) }}" 
                                                alt="{{ $log->user->name }}" 
                                                class="rounded-circle" 
                                                style="width: 30px; height: 30px; object-fit: cover;">
                                        @else
                                            <div class="rounded-circle bg-success bg-opacity-10 text-success d-flex align-items-center justify-content-center" 
                                                style="width: 30px; height: 30px; font-size: 0.8rem;">
                                                {{-- Ginamitan ko ng fallback '??' para di mag error pag walang user --}}
                                                {{ substr($log->user->name ?? '?', 0, 1) }}
                                            </div>
                                        @endif

                                        {{ $log->user->name ?? 'Unknown User' }}
                                    </div>
                                </td>
                                <td class="px-3">
                                    @if(str_contains($log->action, 'Created'))
                                        <span class="badge bg-success bg-opacity-10 text-success">{{ $log->action }}</span>
                                    @elseif(str_contains($log->action, 'Updated'))
                                        <span class="badge bg-primary bg-opacity-10 text-primary">{{ $log->action }}</span>
                                    @elseif(str_contains($log->action, 'Deleted'))
                                        <span class="badge bg-danger bg-opacity-10 text-danger">{{ $log->action }}</span>
                                    @else
                                        <span class="badge bg-secondary">{{ $log->action }}</span>
                                    @endif
                                </td>
                                <td class="px-3 text-muted small">{{ $log->details }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</x-app-layout>
