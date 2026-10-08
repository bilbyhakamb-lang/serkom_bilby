@extends('admin_app')

<link rel="icon" type="image/png" href="{{ asset('assets/images/logo sekolah.jpg') }}">

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1">Data User</h4>
            <p class="text-muted mb-0">
                Kelola data pengguna sistem
            </p>
        </div>

        <a href="{{ route('user.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle me-2"></i>
            Tambah User
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success" role="alert">
            <i class="bi bi-check-circle me-2"></i>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger" role="alert">
            <i class="bi bi-exclamation-circle me-2"></i>
            {{ session('error') }}
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body">

            <div class="table-responsive">
                <table
                    id="tabelUser"
                    class="table table-bordered table-hover align-middle"
                    width="100%"
                >
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($user as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>

                                <td>
                                    {{ $item->username }}
                                </td>

                                <td>
                                    {{ $item->name }}
                                </td>

                                <td>
                                    {{ $item->email }}
                                </td>

                                <td>
                                    @if($item->role === 'Admin')
                                        <span class="badge bg-success">
                                            Admin
                                        </span>
                                    @else
                                        <span class="badge bg-secondary">
                                            Operator
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    <div class="d-flex gap-1">

                                        <a
                                            href="{{ route('user.edit', \Illuminate\Support\Facades\Crypt::encryptString((string) $item->id_user)) }}"
                                            class="btn btn-sm btn-warning"
                                        >
                                            <i class="bi bi-pencil"></i>
                                        </a>

                                        <form
                                            action="{{ route('user.destroy', \Illuminate\Support\Facades\Crypt::encryptString((string) $item->id_user)) }}"
                                            method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus user ini?')"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn btn-sm btn-danger"
                                            >
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                    Belum ada data user.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>

@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $('#tabelUser').DataTable({
            responsive: true,
            autoWidth: false,
            pageLength: 10,
            lengthMenu: [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "Semua"]
            ],
            order: [[0, 'asc']],
            columnDefs: [
                {
                    orderable: false,
                    targets: [5]
                }
            ],
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ data",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                infoEmpty: "Tidak ada data",
                zeroRecords: "Data tidak ditemukan",
                paginate: {
                    first: "Pertama",
                    last: "Terakhir",
                    next: "Berikutnya",
                    previous: "Sebelumnya"
                }
            }
        });
    });
</script>
@endpush