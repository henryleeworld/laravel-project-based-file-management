@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.operation.edit') }} {{ trans('cruds.project.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.projects.update", [$project->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.project.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $project->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.project.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="users">{{ trans('cruds.project.fields.users') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.operation.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.operation.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('users') ? 'is-invalid' : '' }}" name="users[]" id="users" multiple>
                    @foreach($users as $id => $users)
                        <option value="{{ $id }}" {{ (in_array($id, old('users', [])) || $project->users->contains($id)) ? 'selected' : '' }}>{{ $users }}</option>
                    @endforeach
                </select>
                @if($errors->has('users'))
                    <div class="invalid-feedback">
                        {{ $errors->first('users') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.project.fields.users_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="thumbnail_id">{{ trans('global.thumbnail') }}</label>
                <select class="form-control select2 {{ $errors->has('thumbnail') ? 'is-invalid' : '' }}" name="thumbnail_id" id="thumbnail_id">
                    <option value="">{{ trans('global.information.select') }}</option>
                    @foreach($project->images as $image)
                        <option value="{{ $image->id }}" {{ old('thumbnail_id', $project->thumbnail_id) == $image->id ? 'selected' : '' }}>{{ $image->name }}</option>
                    @endforeach
                </select>
                @if($errors->has('thumbnail'))
                    <div class="invalid-feedback">
                        {{ $errors->first('thumbnail') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.operation.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection
