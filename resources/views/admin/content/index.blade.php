@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h4>Landing Page Content</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title (ID)</th>
                <th>Title (EN)</th>
                <th>Description (ID)</th>
                <th>Description (EN)</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($homes as $home)
            <tr>
                <form action="{{ route('content.update', $home->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <td>{{ $home->id }}</td>
                    <td><input type="text" name="title_id" value="{{ $home->title_id }}" class="form-control"></td>
                    <td><input type="text" name="title_en" value="{{ $home->title_en }}" class="form-control"></td>
                    <td><textarea name="description_id" class="form-control">{{ $home->description_id }}</textarea></td>
                    <td><textarea name="description_en" class="form-control">{{ $home->description_en }}</textarea></td>
                    <td>
                        <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                    </td>
                </form>
            </tr>
            @endforeach
        </tbody>
    </table>
    <hr>
</div>
@endsection

@push('scripts')
<script>
    function openCreateForm() {
        document.getElementById("createForm").style.display = "block";
    }
</script>
@endpush
