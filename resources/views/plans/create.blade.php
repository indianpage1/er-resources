@extends('layoutss.admin.master')

@section('content')
<div class="container mt-4">
    <h2>Create New Plan</h2>
    <form action="{{ route('plans.store') }}" method="POST">
        @csrf
        @include('plans.form')
    </form>
</div>
@endsection
