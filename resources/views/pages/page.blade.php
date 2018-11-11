@extends('pages.layouts.layout')


@section('header')
    @parent
    <div>
        @if($title == "My laravel2")
            <p>YES</p>
        @else
            <p>NO</p>
        @endif
    </div>
    @if(count($errors->all())>0)
        <div class="alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="<?php echo route("pages_route");?>" method="POST">
        <input type="text" name="name">
        <input type="text" name="last_name">
        <input type="text" name="phone">
        <input type="submit" value="SEND">
    </form>
@endsection

@My1('testing')

@section('content')
    <div class="container">
        <!-- Example row of columns -->
        <div class="row">

            @forelse($headers as $header)
                <div class="col-md-4">
                    <h2>{{$header}}</h2>
                    <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
                    <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
                </div>
            @empty
                <p>Ups! Empty</p>
            @endforelse


        </div>

        <hr>

    </div> <!-- /container -->
@endsection
