@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 py-5">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark mb-1">Landing Page Content</h2>
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-primary" onclick="saveAllChanges()">
                <i class="fas fa-save me-2"></i>Simpan Semua
            </button>
        </div>
    </div>

    <!-- Content Management Cards -->
    <div id="cardView" class="row">
        @foreach($homes as $home)
        <div class="col-xl-6 col-lg-12 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center py-3">
                    <div class="d-flex align-items-center">
                        <div>
                            <small class="text-muted">ID: {{ $home->id }}</small>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('content.update', $home->id) }}" method="POST" class="content-form">
                        @csrf
                        @method('PUT')
                        
                        <!-- Language Tabs -->
                        <ul class="nav nav-pills nav-fill mb-3" id="pills-tab-{{ $home->id }}" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-id-tab-{{ $home->id }}" data-bs-toggle="pill" data-bs-target="#pills-id-{{ $home->id }}" type="button" role="tab">
                                    <i class="fas fa-flag me-2"></i>ID
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-en-tab-{{ $home->id }}" data-bs-toggle="pill" data-bs-target="#pills-en-{{ $home->id }}" type="button" role="tab">
                                    <i class="fas fa-flag me-2"></i>EN
                                </button>
                            </li>
                        </ul>

                        <div class="tab-content" id="pills-tabContent-{{ $home->id }}">
                            <!-- Indonesian Content -->
                            <div class="tab-pane fade show active" id="pills-id-{{ $home->id }}" role="tabpanel">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">
                                        <i class="fas fa-heading me-2"></i>Judul
                                    </label>
                                    <input type="text" name="title_id" value="{{ $home->title_id }}" 
                                           class="form-control form-control-lg" placeholder="Masukkan judul dalam bahasa Indonesia">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">
                                        <i class="fas fa-align-left me-2"></i>Deskripsi
                                    </label>
                                    <textarea name="description_id" class="form-control" rows="4" 
                                              placeholder="Masukkan deskripsi dalam bahasa Indonesia">{{ $home->description_id }}</textarea>
                                </div>
                            </div>

                            <!-- English Content -->
                            <div class="tab-pane fade" id="pills-en-{{ $home->id }}" role="tabpanel">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">
                                        <i class="fas fa-heading me-2"></i>Title
                                    </label>
                                    <input type="text" name="title_en" value="{{ $home->title_en }}" 
                                           class="form-control form-control-lg" placeholder="Enter title in English">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">
                                        <i class="fas fa-align-left me-2"></i>Description
                                    </label>
                                    <textarea name="description_en" class="form-control" rows="4" 
                                              placeholder="Enter description in English">{{ $home->description_en }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex gap-2 mt-4">
                            <button type="button" class="btn btn-primary flex-fill" onclick="confirmSave(this.closest('form'))">
                                <i class="fas fa-save me-2"></i>Simpan Perubahan
                            </button>
                            <button type="button" class="btn btn-outline-secondary" onclick="resetForm(this.closest('form'))">
                                <i class="fas fa-undo me-2"></i>Reset
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

@push('styles')
<style>
    
</style>
@endpush

@push('scripts')
    <script src="{{ asset('assets/js/admin/content.js') }}"></script>
@endpush