@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-md-flex justify-content-between text-capitalize align-items-center">
            <h5 class="mb-0">Inbox User</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                {{-- Render DataTable --}}
                {{ $dataTable->table([
                    'class' => 'table table-bordered table-hover',
                    'id' => 'contacts-table'
                ]) }}
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    {{-- Include DataTable scripts --}}
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
