@extends('layouts.front')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ trans('frontend.folder.create.title') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('folders.store') }}">
                            @csrf
                            <input type="hidden" name="parent_id" value="{{ request('parent_id') }}" />

                            <div class="mb-3">
                                <label for="name">{{ trans('frontend.folder.create.content.name') }}</label>
                                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                                @error('name')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="mb-0">
                                <button type="submit" class="btn btn-primary">{{ trans('frontend.folder.create.content.submit') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
