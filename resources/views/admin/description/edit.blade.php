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
                            {{-- Konten Bilingual --}}
                            <div class="col-12 mb-3">
                                <label>About (Indonesia)</label>
                                <textarea id="about_id" name="about_id" class="form-control" rows="5">{!! old('about_id', $description->about_id ?? '') !!}</textarea>
                                @if ($errors->first('about_id'))
                                    <small class="text-danger">{{ $errors->first('about_id') }}</small>
                                @endif
                            </div>

                            <div class="col-12 mb-3">
                                <label>About (English)</label>
                                <textarea id="about_en" name="about_en" class="form-control" rows="5">{!! old('about_en', $description->about_en ?? '') !!}</textarea>
                                @if ($errors->first('about_en'))
                                    <small class="text-danger">{{ $errors->first('about_en') }}</small>
                                @endif
                            </div>

                            {{-- Publish Date --}}
                            <div class="col-12 mb-3">
                                <label>Tanggal Publish</label>
                                <input type="datetime-local" name="created_at" class="form-control"
                                    value="{{ old('created_at', isset($description) && $description->created_at ? $description->created_at->format('Y-m-d\TH:i') : '') }}">
                                @if ($errors->first('created_at'))
                                    <small class="text-danger">{{ $errors->first('created_at') }}</small>
                                @endif
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
    ClassicEditor.create(document.querySelector('#about_id'));
    ClassicEditor.create(document.querySelector('#about_en'));
</script>
@endpush
