@extends('layouts.app')

@section('content')
<div class="container">
    <form method="POST" action="{{ isset($disclaimer) ? route('admin.disclaimer.update', $disclaimer->id) : route('admin.disclaimer.store') }}">
        @csrf
        @if(isset($disclaimer))
            @method('PUT')
        @endif

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-capitalize">
                        {{ isset($disclaimer) ? 'Edit Disclaimer' : 'Tambah Disclaimer' }}
                    </div>
                    <div class="card-body">
                        <div class="row">
                            {{-- Konten Bilingual --}}
                            <div class="col-12 mb-3">
                                <label>Deskripsi (Indonesia)</label>
                                <textarea id="description_id" name="description_id" class="form-control" rows="5">{!! old('description_id', $disclaimer->description_id ?? '') !!}</textarea>
                                @if ($errors->first('description_id'))
                                    <small class="text-danger">{{ $errors->first('description_id') }}</small>
                                @endif
                            </div>

                            <div class="col-12 mb-3">
                                <label>Deskripsi (English)</label>
                                <textarea id="description_en" name="description_en" class="form-control" rows="5">{!! old('description_en', $disclaimer->description_en ?? '') !!}</textarea>
                                @if ($errors->first('description_en'))
                                    <small class="text-danger">{{ $errors->first('description_en') }}</small>
                                @endif
                            </div>

                            {{-- Publish Date --}}
                            <div class="col-12 mb-3">
                                <label>Tanggal Publish</label>
                                <input type="datetime-local" name="created_at" class="form-control"
                                    value="{{ old('created_at', isset($disclaimer) && $disclaimer->created_at ? $disclaimer->created_at->format('Y-m-d\TH:i') : '') }}">
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
    ClassicEditor.create(document.querySelector('#description_id'));
    ClassicEditor.create(document.querySelector('#description_en'));
</script>
@endpush
