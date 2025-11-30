<x-app-layout>
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold text-dark m-0">Dasbor Inventaris</h3>
                <small class="text-muted">Tampilan Pengguna - Penyesuaian Stok Cepat</small>
            </div>
        </div>

        <div class="mb-3">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#reportModal" title="Tambah Laporan Baru">
                <i class="fas fa-plus me-2"></i> Tambah Laporan
            </button>
        </div>

        <div class="card shadow-lg border-0 rounded-3">
            <div class="card-body p-4">
                <table class="table table-hover align-middle datatable" style="width:100%">
                    <thead class="bg-light">
                        <tr>
                            <th class="py-3 px-3 small fw-bold text-muted text-center" style="width: 7%;">#</th>
                            <th class="py-3 px-3 small fw-bold text-muted">Nama</th>
                            <th class="py-3 px-3 small fw-bold text-muted">Deskripsi</th>
                            <th class="py-3 px-3 small fw-bold text-muted text-center">Kategori</th>
                            <th class="py-3 px-3 small fw-bold text-muted text-center">Jumlah</th>
                            <th class="py-3 px-3 small fw-bold text-muted text-center" style="width: 20%">Aksi Cepat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                            <tr>
                                <td class="px-3 fw-bold text-secondary text-center">{{ $loop->iteration }}</td>
                                <td class="px-3">
                                    <div class="d-flex align-items-center">
                            
                                            <div class="rounded border me-3 bg-light d-flex align-items-center justify-content-center text-muted" style="width: 40px; height: 40px;">
                                                <i class="fas fa-box"></i>
                                            </div>
                                        
                                        <div>
                                            <div class="fw-bold small text-dark">{{ $product->name }}</div>
                                            
                                        </div>
                                    </div>
                                </td>
                                <td class="px-3 text-muted small" style="max-width: 200px;">
                                    <div class="text-truncate" title="{{ $product->description }}">
                                        {{ Str::limit($product->description, 100) }} 
                                    </div>
                                </td>
                                <td class="px-3 text-center">
                                    <span class="badge bg-light text-dark border">{{ $product->category->name ?? 'Tidak Dikategorikan' }}</span>
                                </td>
                                <td class="px-3 text-center">
                                    @if($product->quantity <= 10)
                                        <span class="badge bg-danger">Rendah: {{ $product->quantity }}</span>
                                    @else
                                        <span class="badge bg-success">{{ $product->quantity }}</span>
                                    @endif
                                </td>
                                
                                <td class="px-3 text-center">
                                    <a href="{{ route('staff.products.label', $product->id) }}"
                                       target="_blank"
                                       class="btn btn-sm btn-light text-warning border rounded"
                                       title="Cetak Label">
                                        <i class="fas fa-print"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    

    <!-- Report Modal -->
    <div class="modal fade" id="reportModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <form action="{{ route('reports.store') }}" method="POST">
                    @csrf

                    <div class="modal-header bg-light text-dark">
                        <h5 class="modal-title fw-bold"><i class="fas fa-flag me-2"></i> Tambah Laporan Sarana dan Prasarana</h5>
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body p-4">
                        <label class="form-label fw-bold small text-muted">Pilih Sarpar <span class="text-danger">*</span></label>
                        <select name="product_id" id="report_product_id" class="form-select mb-3" required>
                            <option value="">-- pilih Sarpar --</option>
                            @foreach($products as $p)
                                <option value="{{ $p->id }}" {{ (string)old('product_id') === (string)$p->id ? 'selected' : '' }}>{{ $p->name }}</option>
                            @endforeach
                        </select>

                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <label class="form-label fw-bold small text-muted">Tipe Laporan</label>
                        <select name="type" class="form-select mb-3" required>
                            <option value="">-- Pilih Tipe --</option>
                            <option value="rusak" {{ old('type') === 'rusak' ? 'selected' : '' }}>Rusak</option>
                            <option value="peminjaman" {{ old('type') === 'peminjaman' ? 'selected' : '' }}>Peminjaman</option>
                            <option value="pengembalian" {{ old('type') === 'pengembalian' ? 'selected' : '' }}>Pengembalian</option>
                            <option value="lainnya" {{ old('type') === 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>

                        <label class="form-label fw-bold small text-muted">Jumlah (jika relevan)</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text bg-light"><i class="fas fa-hashtag"></i></span>
                            <input type="number" name="quantity" class="form-control" placeholder="Jumlah (opsional)" value="{{ old('quantity') }}">
                        </div>

                        <label class="form-label fw-bold small text-muted">Deskripsi / Catatan</label>
                        <textarea name="notes" class="form-control" rows="3" placeholder="Jelaskan masalah atau kebutuhan...">{{ old('notes') }}</textarea>
                    </div>

                    <div class="modal-footer border-0 bg-light">
                        <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Kirim Laporan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- User's Reports List -->
    <div class="container py-4">
        <div class="card">
            <div class="card-body">
                <h5 class="fw-bold">Laporan Saya</h5>
                @if(isset($myReports) && $myReports->count())
                    <ul class="list-group list-group-flush mt-3">
                        @foreach($myReports as $r)
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="fw-bold">{{ ucfirst($r->type) }} @if($r->product) - {{ $r->product->name }} @endif</div>
                                    <div class="small text-muted">{{ Str::limit($r->notes, 120) }}</div>
                                </div>
                                <div class="text-end">
                                    <div class="small text-muted">{{ $r->created_at->diffForHumans() }}</div>
                                    <div class="mt-1">
                                        @if($r->status === 'pending')
                                            <span class="badge bg-warning">Menunggu</span>
                                            <form action="{{ route('reports.destroy', $r->id) }}" method="POST" class="d-inline ms-2">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus laporan ini?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        @elseif($r->status === 'approved')
                                            <span class="badge bg-success">Disetujui</span>
                                        @else
                                            <span class="badge bg-danger">Ditolak</span>
                                        @endif
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-muted small mt-3">Belum ada laporan. Gunakan tombol 'Laporkan' pada produk untuk mengirim laporan.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

@push('scripts')
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        var reportModal = document.getElementById('reportModal');
        var reportForm = document.querySelector('#reportModal form');

        // Reset form when modal is dismissed
        reportModal && reportModal.addEventListener('hidden.bs.modal', function () {
            if (reportForm) reportForm.reset();
            var clientError = document.getElementById('report_client_error');
            if (clientError) clientError.classList.add('d-none');
        });
    });
</script>
@endpush