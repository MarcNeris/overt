@extends('layouts.home')
@section('content')
 <div class="section section-header">
        <div class="parallax filter filter-color-black">
            <div class="image"
                style="background-image: url('assets/img/header-1.jpeg')">
            </div>
            <div class="container">
                <div class="content">
                    <div class="title-area">
                        <p>software</p>
                        <h1 class="title-modern">Serviços</h1>
                        <h3> @if (session('status'))
                            {{ session('status') }}
                        @endif</h3>
                        <div class="separator line-separator">♦</div>
                    </div>
                    <div class="button-get-started">
                        <a href="#" target="_blank" class="btn btn-white btn-fill btn-lg ">
                            Entrar
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
