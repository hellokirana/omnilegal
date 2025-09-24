@extends('layouts.app')

@section('content')
<div class="container">
    <form method="POST" action="{{ route('admin.slider.update', $data->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <!-- Kolom kiri -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-capitalize">
                        Edit Slider
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- Title ID -->
                            <div class="col-md-6 mb-3">
                                <x-form.text label="Judul (ID)" for="title_id" name="title_id"
                                    value="{{ old('title_id', $data->title_id) }}" :error="$errors->first('title_id')" />
                            </div>

                            <!-- Title EN -->
                            <div class="col-md-6 mb-3">
                                <x-form.text label="Title (EN)" for="title_en" name="title_en"
                                    value="{{ old('title_en', $data->title_en) }}" :error="$errors->first('title_en')" />
                            </div>

                            <!-- Description ID -->
                            <div class="col-md-6 mb-3">
                                <x-form.textarea label="Deskripsi (ID)" for="description_id" name="description_id"
                                    value="{!! old('description_id', $data->description_id) !!}" :error="$errors->first('description_id')" rows="3" />
                            </div>

                            <!-- Description EN -->
                            <div class="col-md-6 mb-3">
                                <x-form.textarea label="Description (EN)" for="description_en" name="description_en"
                                    value="{!! old('description_en', $data->description_en) !!}" :error="$errors->first('description_en')" rows="3" />
                            </div>


                            <!-- Link -->
                            <div class="col-md-6 mb-3">
                                <x-form.text label="Link" for="link" name="link"
                                    value="{{ old('link', $data->link) }}" :error="$errors->first('link')" />
                            </div>
                            <!-- Link Caption ID -->
                            <div class="col-md-3 mb-3">
                                <x-form.text label="Caption (ID)" for="link_caption_id" name="link_caption_id"
                                    value="{{ old('link_caption_id', $data->link_caption_id) }}" :error="$errors->first('link_caption_id')" />
                            </div>
                            <!-- Link Caption EN -->
                            <div class="col-md-3 mb-3">
                                <x-form.text label="Caption (EN)" for="link_caption_en" name="link_caption_en"
                                    value="{{ old('link_caption_en', $data->link_caption_en) }}" :error="$errors->first('link_caption_en')" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kolom kanan -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header text-capitalize">
                        Info Data
                    </div>
                    <div class="card-body">
                        <!-- Queue -->
                        <div class="mb-3">
                            <x-form.number label="Queue" for="queue" name="queue"
                                value="{{ old('queue', $data->queue) }}" min="1" :error="$errors->first('queue')" required />
                        </div>

                        <!-- Image -->
                        <div class="mb-3">
                            <x-form.file label="Image" for="image" name="image"
                                data-default-file="{{ $data->image_url }}" :error="$errors->first('image')" />
                        </div>

                        <!-- Status -->
                        <div class="form-group mb-3">
                            <label>Status</label>
                            {{ Form::select('status', status_publish(), old('status', $data->status), ['class' => 'form-select']) }}
                            @if ($errors->first('status'))
                                <small class="text-danger text-capitalize">{{ $errors->first('status') }}</small>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-save me-2"></i> Simpan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
