@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h4>Stats</h4>
    <button class="btn btn-success mb-2" onclick="openCreateForm()">+ Tambah Stat</button>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Label (ID)</th>
                <th>Label (EN)</th>
                <th>Value</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="statsTable">
            @foreach($stats as $stat)
            <tr id="stat-{{ $stat->id }}">
                <form action="{{ route('stats.update', $stat->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <td>{{ $stat->id }}</td>
    <td>
        @if($stat->image)
            <img src="{{ asset('storage/stats/' . $stat->image) }}" width="50" class="mb-2">
        @endif
        <input type="file" name="image" class="form-control">
    </td>
    <td><input type="text" name="label_id" value="{{ $stat->label_id }}" class="form-control"></td>
    <td><input type="text" name="label_en" value="{{ $stat->label_en }}" class="form-control"></td>
    <td><input type="text" name="value" value="{{ $stat->value }}" class="form-control"></td>
    <td>
        <select name="status" class="form-control">
            <option value="1" {{ $stat->status == 1 ? 'selected' : '' }}>Active</option>
            <option value="0" {{ $stat->status == 0 ? 'selected' : '' }}>Inactive</option>
        </select>
    </td>
    <td>
        <button type="submit" class="btn btn-sm btn-primary">Update</button>
</form>
                        <form action="{{ route('stats.delete', $stat->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Create Stat Form (Hidden by default) --}}
    <div id="createForm" class="card p-3" style="display: none;">
    <form action="{{ route('stats.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col">
                <input type="file" name="image" class="form-control" required>
            </div>
            <div class="col">
                <input type="text" name="label_id" placeholder="Label (ID)" class="form-control" required>
            </div>
            <div class="col">
                <input type="text" name="label_en" placeholder="Label (EN)" class="form-control" required>
            </div>
            <div class="col">
                <input type="text" name="value" placeholder="Value" class="form-control" required>
            </div>
            <div class="col">
                <select name="status" class="form-control">
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>
            <div class="col">
                <button type="submit" class="btn btn-success">Simpan</button>
            </div>
        </div>
    </form>
</div>

</div>
@endsection

@push('scripts')
<script>
    function openCreateForm() {
        document.getElementById("createForm").style.display = "block";
    }
</script>
@endpush
