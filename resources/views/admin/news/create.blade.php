@extends('layouts.app')

@section('content')
    <div class="container">
        <form method="POST" action="{{ route('admin.news.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header text-capitalize">
                            Tambah News
                        </div>
                        <div class="card-body">
                            <div class="row">
                                {{-- Judul Bilingual --}}
                                <div class="col-md-6">
                                    <x-form.text label="Judul (Indonesia)" for="title_id" name="title_id"
                                        value="{{ old('title_id') }}" :error="$errors->first('title_id')" required></x-form.text>
                                </div>
                                <div class="col-md-6">
                                    <x-form.text label="Judul (English)" for="title_en" name="title_en"
                                        value="{{ old('title_en') }}" :error="$errors->first('title_en')" required></x-form.text>
                                </div>

                                {{-- Penulis --}}
                                <div class="col-12 mt-3">
                                    <x-form.text label="Penulis" for="author" name="author"
                                        value="{{ old('author') }}" :error="$errors->first('author')" required></x-form.text>
                                </div>

                                {{-- Konten Bilingual --}}
                                <div class="col-12 mt-4">
                                    <label>Konten (Indonesia)</label>
                                    <x-form.textarea for="content_id" name="content_id" :value="old('content_id')"
                                        :error="$errors->first('content_id')"></x-form.textarea>
                                </div>
                                <div class="col-12 mt-4">
                                    <label>Konten (English)</label>
                                    <x-form.textarea for="content_en" name="content_en" :value="old('content_en')"
                                        :error="$errors->first('content_en')"></x-form.textarea>
                                </div>

                                {{-- Dokumen (opsional bilingual) --}}
                                <div class="col-12 mt-4">
                                    <x-form.file label="Dokumen (Indonesia)" for="document_id" name="document_id"
                                        value="{{ old('document_id') }}" :error="$errors->first('document_id')"></x-form.file>
                                </div>
                                <div class="col-12 mt-4">
                                    <x-form.file label="Dokumen (English)" for="document_en" name="document_en"
                                        value="{{ old('document_en') }}" :error="$errors->first('document_en')"></x-form.file>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Sidebar --}}
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header text-capitalize">
                            Info data
                        </div>
                        <div class="card-body">
                            {{-- Kategori --}}
                            <div class="form-group mb-3">
                                <label>Kategori </label><br>
                                {{ Form::select(
                                    'category_id',
                                    ['' => 'Pilih kategori'] + \App\Models\Category::orderBy('title_id')
                                        ->pluck('title_id', 'id')
                                        ->toArray(),
                                    null,
                                    ['id' => 'category_id', 'class' => 'form-select']
                                ) }}
                                @if ($errors->first('category_id'))
                                    <small class="text-danger text-capitalize">{{ $errors->first('category_id') }}</small>
                                @endif
                            </div>

                            {{-- Image --}}
                            <div class="mb-3">
                                <x-form.file label="Image" for="image" name="image" value="{{ old('image') }}"
                                    :error="$errors->first('image')"></x-form.file>
                            </div>

                            {{-- Caption --}}
                            <div class="mb-3">
                                <x-form.text label="Caption" for="image_caption" name="image_caption"
                                    value="{{ old('image_caption') }}" :error="$errors->first('image_caption')" required></x-form.text>
                            </div>

                            {{-- Status --}}
                            <div class="form-group mb-3">
                                <label>Status </label><br>
                                {{ Form::select('status', status_publish(), null, ['class' => 'form-select']) }}
                                @if ($errors->first('status'))
                                    <small class="text-danger text-capitalize">{{ $errors->first('status') }}</small>
                                @endif
                            </div>

                            {{-- Publish Date --}}
                            <div class="form-group mb-3">
                                <label>Tanggal Publish</label>
                                <input type="datetime-local" name="created_at" class="form-control"
                                    value="{{ old('created_at') }}">
                                @if ($errors->first('created_at'))
                                    <small class="text-danger text-capitalize">{{ $errors->first('created_at') }}</small>
                                @endif
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary "><i class="fa fa-save me-2"></i>Simpan</button>
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
        ClassicEditor.create(document.querySelector('#content_id'));
        ClassicEditor.create(document.querySelector('#content_en'));
    </script>
@endpush
