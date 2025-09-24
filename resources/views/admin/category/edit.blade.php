@extends('layouts.app')

@section('content')
<div class="container">
    <form method="POST" action="{{ route('admin.category.update', $data->id) }}">
        @csrf
        @method('PUT')
        <div class="row">
            {{-- LEFT SIDE --}}
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-capitalize">
                        Edit Category
                    </div>
                    <div class="card-body">
                        <div class="row">
                            {{-- Title Indonesia --}}
                            <div class="col-12 mb-3">
                                <x-form.text label="Nama Kategori (ID)" for="title_id" name="title_id"
                                    value="{{ old('title_id', $data->title_id) }}" :error="$errors->first('title_id')" />
                            </div>
                            {{-- Title English --}}
                            <div class="col-12 mb-3">
                                <x-form.text label="Nama Kategori (EN)" for="title_en" name="title_en"
                                    value="{{ old('title_en', $data->title_en) }}" :error="$errors->first('title_en')" />
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
                            {{ Form::select('status', ['0' => 'Inactive', '1' => 'Active'], old('status', $data->status), ['class' => 'form-select']) }}
                            @if ($errors->first('status'))
                                <small class="text-danger text-capitalize">{{ $errors->first('status') }}</small>
                            @endif
                        </div>

                        {{-- Created At --}}
                        <div class="form-group mb-3">
                            <label>Tanggal Publish</label>
                            <input type="datetime-local" name="created_at" class="form-control"
                                value="{{ old('created_at', $data->created_at ? $data->created_at->format('Y-m-d\TH:i') : '') }}">
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
