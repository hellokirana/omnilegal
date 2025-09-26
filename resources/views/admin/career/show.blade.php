@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Detail Aplication</h5>
            <a href="{{ route('admin.career.index') }}" class="btn btn-sm btn-secondary">Kembali</a>
        </div>

        <div class="card-body">
            <div class="mb-3">
                <strong>Nama:</strong>
                <p class="mb-0">{{ $career->name }}</p>
            </div>

            <div class="mb-3">
                <strong>Email:</strong>
                <p class="mb-0">{{ $career->email }}</p>
            </div>

            <div class="mb-3">
                <strong>Subjek:</strong>
                <p class="mb-0">{{ $career->subject }}</p>
            </div>

            <div class="mb-3">
                <strong>Tanggal:</strong>
                <p class="mb-0">{{ $career->created_at->format('d-m-Y H:i:s') }}</p>
            </div>

            <div class="mb-3">
                <strong>Pesan:</strong>
                <p class="border rounded p-3 bg-light">{{ $career->message }}</p>
            </div>

            @if($career->aplication)
            <div class="mb-3">
                <strong>File Aplication (PDF):</strong>
                <div class="border rounded p-2 bg-light">
                    <embed src="{{ $career->aplication_url }}" 
                        type="application/pdf" 
                        width="100%" 
                        height="500px">
                </div>
                <a href="{{ $career->aplication_url }}" target="_blank" class="btn btn-primary btn-sm mt-2">
                    <i class="fas fa-download me-1"></i> Download File
                </a>
            </div>
            @endif

        </div>

        <div class="card-footer text-end">
            <form action="{{ route('admin.career.destroy', $career->id) }}" method="POST" class="delete-form" data-name="{{ $career->name }}">
                @csrf
                @method('DELETE')
                <button type="button" class="btn btn-danger delete-btn">Hapus Aplication</button>
            </form>
        </div>

    </div>
</div>
@endsection

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const deleteBtn = document.querySelector('.delete-btn');

    deleteBtn.addEventListener('click', function() {
        const form = this.closest('.delete-form');
        const name = form.dataset.name;

        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: 'Aplication dari "' + name + '" akan dihapus!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
});
</script>
