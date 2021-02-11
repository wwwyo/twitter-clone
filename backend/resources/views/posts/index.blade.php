
@extends('layouts.app')

@section('content')
@for($i = 1; $i<10; $i++)
    <div class="card border-right-0 border-left-0 border-top-0" style="width: 100%;">
        <div class="card-body">
            <h5 class="card-title">user name</h5>
            <p class="card-text">comment comment comment comment <br/> comment commetn</p>
            <div class="card__icon-menu">
                <a class="card__icon">
                    <i class="far fa-comment"></i>
                </a>
                <a class="card__icon">
                    <i class="far fa-heart"></i>
                </a>
            </div>
        </div>
    </div>
@endfor

@endsection

