@extends('layouts.app')

@section('content')
<div class="container py-4">

</div>
@endsection

@push('scripts')
<script>
    function openCreateForm() {
        document.getElementById("createForm").style.display = "block";
    }
</script>
@endpush
