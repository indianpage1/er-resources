@extends('layoutss.admin.master')

@section('title', 'Edit Plan')
<link rel="stylesheet" href="{{ asset('css/custom-styles.css') }}">

@section('content')
<div class="container mt-4">
    <h2>Edit Plan</h2>
    <form action="{{ route('plans.update', $plan->id) }}" method="POST">
        @csrf
        @method('PUT')
        @include('plans.form')
        <button type="submit" class="btn btn-primary">Update Plan</button>
    </form>
</div>
@endsection
<style>
    .btn-primary {
      background-color: #0984e3;
      color: white;
      padding: 0.75rem 2rem;
      font-size: 1.1rem;
      font-weight: 600;
      border: none;
      border-radius: 1rem;
      box-shadow: 0 4px 12px rgba(9, 132, 227, 0.15);
      transition: all 0.3s ease;
    }
  
    .btn-primary:hover {
      background-color: #0652DD;
      box-shadow: 0 6px 18px rgba(9, 132, 227, 0.2);
      transform: translateY(-2px);
    }
  
    .btn-primary:active {
      background-color: #0457c2;
      box-shadow: 0 4px 12px rgba(9, 132, 227, 0.25);
      transform: translateY(0);
    }
  </style>
    