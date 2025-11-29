<x-app-layout>
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold">Daftar Laporan Pengguna</h3>
        </div>

        <div class="card">
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>User</th>
                            <th>Produk</th>
                            <th>Tipe</th>
                            <th>Qty</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reports as $report)
                            <tr>
                                <td>{{ $report->created_at->format('Y-m-d H:i') }}</td>
                                <td>{{ $report->user->name }}</td>
                                <td>{{ $report->product?->name ?? '-' }}</td>
                                <td>{{ ucfirst($report->type) }}</td>
                                <td>{{ $report->quantity }}</td>
                                <td>
                                    @if($report->status === 'pending')
                                        <span class="badge bg-warning">Pending</span>
                                    @elseif($report->status === 'approved')
                                        <span class="badge bg-success">Approved</span>
                                    @else
                                        <span class="badge bg-danger">Rejected</span>
                                    @endif
                                </td>
                                <td>
                                    @if($report->status === 'pending')
                                        <form method="POST" action="{{ route('admin.reports.approve', $report->id) }}" style="display:inline">
                                            @csrf
                                            @method('PATCH')
                                            <button class="btn btn-sm btn-success">Approve</button>
                                        </form>
                                        <form method="POST" action="{{ route('admin.reports.reject', $report->id) }}" style="display:inline">
                                            @csrf
                                            @method('PATCH')
                                            <button class="btn btn-sm btn-danger">Reject</button>
                                        </form>
                                    @else
                                        <small class="text-muted">Processed</small>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-4">
            {{ $reports->links() }}
        </div>
    </div>
</x-app-layout>
