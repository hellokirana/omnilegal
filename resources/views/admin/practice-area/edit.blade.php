@extends('layouts.app')

@section('content')
<div class="container">
    <form method="POST" action="{{ route('admin.practice-area.update', $practiceArea->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            {{-- LEFT SIDE --}}
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-capitalize">
                        Edit Practice Area
                    </div>
                    <div class="card-body">
                        <div class="row">
                            {{-- Image --}}
                            <div class="col-12 mb-3">
                                <x-form.file label="Image" for="image" name="image" 
                                    data-default-file="{{ $practiceArea->image ? asset('storage/'.$practiceArea->image) : '' }}"
                                    :error="$errors->first('image')" />
                            </div>

                            {{-- Title Indonesia --}}
                            <div class="col-12 mb-3">
                                <x-form.text label="Nama Practice Area (ID)" for="title_id" name="title_id"
                                    value="{{ old('title_id', $practiceArea->title_id) }}" :error="$errors->first('title_id')" />
                            </div>

                            {{-- Title English --}}
                            <div class="col-12 mb-3">
                                <x-form.text label="Nama Practice Area (EN)" for="title_en" name="title_en"
                                    value="{{ old('title_en', $practiceArea->title_en) }}" :error="$errors->first('title_en')" />
                            </div>

                            {{-- Description Indonesia --}}
                            <div class="col-12 mb-3">
                                <label>Deskripsi (ID)</label>
                                <textarea name="description_id" class="form-control" rows="4">{{ old('description_id', $practiceArea->description_id) }}</textarea>
                                @if ($errors->first('description_id'))
                                    <small class="text-danger">{{ $errors->first('description_id') }}</small>
                                @endif
                            </div>

                            {{-- Description English --}}
                            <div class="col-12 mb-3">
                                <label>Deskripsi (EN)</label>
                                <textarea name="description_en" class="form-control" rows="4">{{ old('description_en', $practiceArea->description_en) }}</textarea>
                                @if ($errors->first('description_en'))
                                    <small class="text-danger">{{ $errors->first('description_en') }}</small>
                                @endif
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
                        {{-- Status --}}
                        <div class="form-group mb-3">
                            <label>Status</label>
                            {{ Form::select('status', ['0' => 'Inactive', '1' => 'Active'], old('status', $practiceArea->status), ['class' => 'form-select']) }}
                            @if ($errors->first('status'))
                                <small class="text-danger">{{ $errors->first('status') }}</small>
                            @endif
                        </div>

                        {{-- Created At --}}
                        <div class="form-group mb-3">
                            <label>Tanggal Publish</label>
                            <input type="datetime-local" name="created_at" class="form-control"
                                value="{{ old('created_at', $practiceArea->created_at ? $practiceArea->created_at->format('Y-m-d\TH:i') : '') }}">
                            @if ($errors->first('created_at'))
                                <small class="text-danger">{{ $errors->first('created_at') }}</small>
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
