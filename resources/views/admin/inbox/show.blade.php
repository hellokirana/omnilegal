@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Detail Pesan</h5>
            <a href="{{ route('admin.inbox.index') }}" class="btn btn-sm btn-secondary">Kembali</a>
        </div>

        <div class="card-body">
            <div class="mb-3">
                <strong>Nama:</strong>
                <p class="mb-0">{{ $contact->name }}</p>
            </div>

            <div class="mb-3">
                <strong>Email:</strong>
                <p class="mb-0">{{ $contact->email }}</p>
            </div>

            <div class="mb-3">
                <strong>Subjek:</strong>
                <p class="mb-0">{{ $contact->subject }}</p>
            </div>

            <div class="mb-3">
                <strong>Tanggal:</strong>
                <p class="mb-0">{{ $contact->created_at->format('d-m-Y H:i:s') }}</p>
            </div>

            <div class="mb-3">
                <strong>Pesan:</strong>
                <p class="border rounded p-3 bg-light">{{ $contact->message }}</p>
            </div>
        </div>

        <div class="card-footer text-end">
    <form action="{{ route('admin.inbox.destroy', $contact->id) }}" method="POST" class="delete-form" data-name="{{ $contact->name }}">
        @csrf
        @method('DELETE')
        <button type="button" class="btn btn-danger delete-btn">Hapus Pesan</button>
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
            text: 'Pesan dari "' + name + '" akan dihapus!',
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

