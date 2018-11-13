@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Update Post</div>

                    <div class="panel-body">

                        @cannot('update', $article)
                            <div class="alert alert-danger">
                                Нет прав
                            </div>
                        @endcannot

                        <form class="form-horizontal" method="POST" action="{{ route('admin_update_post') }}">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{$article->id}}">
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <input id="login" type="text" class="form-control" name="name" value="{{ $article->name }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('text') ? ' has-error' : '' }}">
                                <label for="text" class="col-md-4 control-label">Text</label>

                                <div class="col-md-6">
                                    <textarea name="text" id="text" cols="30" rows="10" class="form-control" required><?=$article->text;?></textarea>

                                    @if ($errors->has('text'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('text') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('img') ? ' has-error' : '' }}">
                                <label for="img" class="col-md-4 control-label">Image</label>

                                <div class="col-md-6">
                                    <input id="img" type="text" class="form-control" name="img" value="{{ $article->img }}" required autofocus>

                                    @if ($errors->has('img'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('img') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Submit
                                    </button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection