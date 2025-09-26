@extends('layouts.app')

@section('content')
<div class="container">
    <form method="POST" action="{{ isset($description) ? route('admin.description.update', $description->id) : route('admin.description.store') }}">
        @csrf
        @if(isset($description))
            @method('PUT')
        @endif

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-capitalize">
                        {{ isset($description) ? 'Edit Description' : 'Tambah Description' }}
                    </div>
                    <div class="card-body">
                        <div class="row">
                            {{-- About --}}
                            <div class="col-12 mb-3">
                                <label>About (Indonesia)</label>
                                <textarea id="about_id" name="about_id" class="form-control" rows="4">{!! old('about_id', $description->about_id ?? '') !!}</textarea>
                                @error('about_id')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                            <div class="col-12 mb-3">
                                <label>About (English)</label>
                                <textarea id="about_en" name="about_en" class="form-control" rows="4">{!! old('about_en', $description->about_en ?? '') !!}</textarea>
                                @error('about_en')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>

                            {{-- Team --}}
                            <div class="col-12 mb-3">
                                <label>Team (Indonesia)</label>
                                <textarea id="team_id" name="team_id" class="form-control" rows="4">{!! old('team_id', $description->team_id ?? '') !!}</textarea>
                                @error('team_id')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                            <div class="col-12 mb-3">
                                <label>Team (English)</label>
                                <textarea id="team_en" name="team_en" class="form-control" rows="4">{!! old('team_en', $description->team_en ?? '') !!}</textarea>
                                @error('team_en')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>

                            {{-- Career --}}
                            <div class="col-12 mb-3">
                                <label>Career (Indonesia)</label>
                                <textarea id="career_id" name="career_id" class="form-control" rows="4">{!! old('career_id', $description->career_id ?? '') !!}</textarea>
                                @error('career_id')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                            <div class="col-12 mb-3">
                                <label>Career (English)</label>
                                <textarea id="career_en" name="career_en" class="form-control" rows="4">{!! old('career_en', $description->career_en ?? '') !!}</textarea>
                                @error('career_en')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>

                            {{-- Service --}}
                            <div class="col-12 mb-3">
                                <label>Service (Indonesia)</label>
                                <textarea id="service_id" name="service_id" class="form-control" rows="4">{!! old('service_id', $description->service_id ?? '') !!}</textarea>
                                @error('service_id')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                            <div class="col-12 mb-3">
                                <label>Service (English)</label>
                                <textarea id="service_en" name="service_en" class="form-control" rows="4">{!! old('service_en', $description->service_en ?? '') !!}</textarea>
                                @error('service_en')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>

                            {{-- Practice --}}
                            <div class="col-12 mb-3">
                                <label>Practice (Indonesia)</label>
                                <textarea id="practice_id" name="practice_id" class="form-control" rows="4">{!! old('practice_id', $description->practice_id ?? '') !!}</textarea>
                                @error('practice_id')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                            <div class="col-12 mb-3">
                                <label>Practice (English)</label>
                                <textarea id="practice_en" name="practice_en" class="form-control" rows="4">{!! old('practice_en', $description->practice_en ?? '') !!}</textarea>
                                @error('practice_en')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>

                            {{-- Disclaimer --}}
                            <div class="col-12 mb-3">
                                <label>Disclaimer (Indonesia)</label>
                                <textarea id="disclaimer_id" name="disclaimer_id" class="form-control" rows="4">{!! old('disclaimer_id', $description->disclaimer_id ?? '') !!}</textarea>
                                @error('disclaimer_id')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                            <div class="col-12 mb-3">
                                <label>Disclaimer (English)</label>
                                <textarea id="disclaimer_en" name="disclaimer_en" class="form-control" rows="4">{!! old('disclaimer_en', $description->disclaimer_en ?? '') !!}</textarea>
                                @error('disclaimer_en')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>

                            {{-- Publish Date --}}
                            <div class="col-12 mb-3">
                                <label>Tanggal Publish</label>
                                <input type="datetime-local" name="created_at" class="form-control"
                                    value="{{ old('created_at', isset($description) && $description->created_at ? $description->created_at->format('Y-m-d\TH:i') : '') }}">
                                @error('created_at')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>

                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-save me-2"></i>Simpan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script>
<script>
    ['about_id','about_en','team_id','team_en','career_id','career_en','service_id','service_en','practice_id','practice_en','disclaimer_id','disclaimer_en'].forEach(id => {
        ClassicEditor.create(document.querySelector('#'+id));
    });
</script>
@endpush
    