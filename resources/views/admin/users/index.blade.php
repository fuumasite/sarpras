<x-app-layout>
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold text-dark m-0">Manage Users</h3>
                <small class="text-muted">List of authorized personnel</small>
            </div>
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary shadow-sm px-4">
                <i class="fas fa-user-plus me-2"></i> Add User
            </a>
        </div>

        <div class="card shadow-lg border-0 rounded-3">
            <div class="card-body p-4">
                <table class="table table-hover align-middle datatable" style="width:100%">
                    <thead class="bg-light">
                        <tr>
                            <th class="py-3 px-3 small fw-bold text-muted text-center" style="width: 7%;">#</th>
                            <th class="py-3 px-3 small fw-bold text-muted">Avatar</th>
                            <th class="py-3 px-3 small fw-bold text-muted">Name</th>
                            <th class="py-3 px-3 small fw-bold text-muted">Email</th>
                            <th class="py-3 px-3 small fw-bold text-muted">Joined Date</th>
                            
                            <th class="py-3 px-3 small fw-bold text-muted text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td class="px-3 fw-bold text-secondary text-center">{{ $loop->iteration }}</td>
                                <td class="px-3">
                                    @if($user->avatar)
                                        <img src="{{ asset('storage/' . $user->avatar) }}" 
                                            alt="{{ $user->name }}" 
                                            class="rounded-circle border border-success border-opacity-25"
                                            style="width: 40px; height: 40px; object-fit: cover;">
                                    @else
                                        <div class="rounded-circle bg-success bg-opacity-10 text-success d-flex align-items-center justify-content-center fw-bold border border-success border-opacity-25" 
                                            style="width: 40px; height: 40px;">
                                            {{ substr($user->name, 0, 1) }}
                                        </div>
                                    @endif
                                </td>
                                <td class="px-3 fw-bold text-dark small">{{ $user->name }}</td>
                                <td class="px-3 text-muted fw-bold small">{{ $user->email }}</td>
                                <td class="px-3 text-muted small">{{ $user->created_at->format('M d, Y') }}</td>
                              
                                <td class="px-3 text-center">
                                    <div class="btn-group">
                                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-light text-primary border me-2 rounded" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to remove this user?');">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-sm btn-light text-danger border rounded" title="Remove User">
                                                <i class="fas fa-user-times"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>