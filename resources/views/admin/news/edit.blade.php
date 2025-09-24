@extends('layouts.app')

@section('content')
<div class="container">
    <form method="POST" action="{{ route('admin.news.update', $news->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            {{-- LEFT SIDE --}}
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-capitalize">
                        Edit News
                    </div>
                    <div class="card-body">
                        <div class="row">
                            {{-- Judul Bilingual --}}
                            <div class="col-md-6 mb-3">
                                <x-form.text label="Judul (Indonesia)" for="title_id" name="title_id"
                                    value="{{ old('title_id', $news->title_id) }}"
                                    :error="$errors->first('title_id')" required />
                            </div>
                            <div class="col-md-6 mb-3">
                                <x-form.text label="Judul (English)" for="title_en" name="title_en"
                                    value="{{ old('title_en', $news->title_en) }}"
                                    :error="$errors->first('title_en')" required />
                            </div>

                            {{-- Penulis --}}
                            <div class="col-12 mb-3">
                                <x-form.text label="Penulis" for="author" name="author"
                                    value="{{ old('author', $news->author) }}"
                                    :error="$errors->first('author')" required />
                            </div>

                            {{-- Konten Bilingual --}}
                            <div class="col-12 mb-3">
                                <label>Konten (Indonesia)</label>
                                <textarea id="content_id" name="content_id" class="form-control" rows="5">{!! old('content_id', $news->content_id) !!}</textarea>
                                @if ($errors->first('content_id'))
                                    <small class="text-danger">{{ $errors->first('content_id') }}</small>
                                @endif
                            </div>

                            <div class="col-12 mb-3">
                                <label>Konten (English)</label>
                                <textarea id="content_en" name="content_en" class="form-control" rows="5">{!! old('content_en', $news->content_en) !!}</textarea>
                                @if ($errors->first('content_en'))
                                    <small class="text-danger">{{ $errors->first('content_en') }}</small>
                                @endif
                            </div>


                            {{-- Dokumen bilingual --}}
                            <div class="col-12 mb-3">
                                <x-form.file label="Dokumen (Indonesia)" for="document_id" name="document_id"
                                    data-default-file="{{ $news->document_id_url }}"
                                    :error="$errors->first('document_id')" />
                            </div>
                            <div class="col-12 mb-3">
                                <x-form.file label="Dokumen (English)" for="document_en" name="document_en"
                                    data-default-file="{{ $news->document_en_url }}"
                                    :error="$errors->first('document_en')" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- RIGHT SIDE --}}
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header text-capitalize">
                        Info Data
                    </div>
                    <div class="card-body">
                        {{-- Kategori --}}
                        <div class="form-group mb-3">
                            <label>Kategori</label><br>
                            {{ Form::select('category_id', ['' => 'Pilih kategori'] + category_all(), old('category_id', $news->category_id), ['id' => 'category_id', 'class' => 'form-select']) }}
                            @if ($errors->first('category_id'))
                                <small class="text-danger text-capitalize">{{ $errors->first('category_id') }}</small>
                            @endif
                        </div>

                        {{-- Image --}}
                        <div class="mb-3">
                            <x-form.file label="Image" for="image" name="image"
                                data-default-file="{{ $news->image_url }}"
                                :error="$errors->first('image')" />
                        </div>

                        {{-- Caption --}}
                        <div class="mb-3">
                            <x-form.text label="Caption" for="image_caption" name="image_caption"
                                value="{{ old('image_caption', $news->image_caption) }}"
                                :error="$errors->first('image_caption')" required />
                        </div>

                        {{-- Status --}}
                        <div class="form-group mb-3">
                            <label>Status</label><br>
                            {{ Form::select('status', status_publish(), old('status', $news->status), ['class' => 'form-select']) }}
                            @if ($errors->first('status'))
                                <small class="text-danger text-capitalize">{{ $errors->first('status') }}</small>
                            @endif
                        </div>

                        {{-- Publish Date --}}
                        <div class="form-group mb-3">
                            <label>Tanggal Publish</label>
                            <input type="datetime-local" name="created_at" class="form-control"
                                value="{{ old('created_at', $news->created_at ? $news->created_at->format('Y-m-d\TH:i') : '') }}">
                            @if ($errors->first('created_at'))
                                <small class="text-danger text-capitalize">{{ $errors->first('created_at') }}</small>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer">
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
    ClassicEditor.create(document.querySelector('#content_id'));
    ClassicEditor.create(document.querySelector('#content_en'));
</script>
@endpush
