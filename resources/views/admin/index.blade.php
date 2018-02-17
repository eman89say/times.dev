@extends('admin.admin-layouts.master')


@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!  Your account is {{auth()->user()->verified() ? 'verified ': 'not verified , Please verify your account to continue using the dashboard'}}
                </div>
            </div>
        </div>
    </div>
@endsection