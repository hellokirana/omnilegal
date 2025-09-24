@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-md-flex justify-content-between align-items-center text-capitalize">
            <h5 class="mb-0">Manage Disclaimer</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                {{-- Render DataTable --}}
                {{ $dataTable->table([
                    'class' => 'table table-bordered table-hover',
                    'id' => 'disclaimer-table'
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
