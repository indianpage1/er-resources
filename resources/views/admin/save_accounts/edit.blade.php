@extends('layoutss.admin.master')

@push('styles')
<style>
  /* Center the form vertically and horizontally */
  .full-height-center {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f8f9fa;
  }

  /* Heavy card container */
  .heavy-card {
    margin-top: 40px;
    background: #fff;
    border: none;
    border-radius: 1rem;
    box-shadow: 0 1rem 2rem rgba(0, 0, 0, 0.3);
    padding: 3rem 2rem;
    max-width: 600px;
    width: 100%;
  }

  /* Section heading */
  .heavy-heading {
    font-size: 2rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: #0d6efd;
    margin-bottom: 2rem;
    text-align: center;
  }

  /* Form labels */
  .heavy-card .form-label {
    font-size: 1.125rem;
    font-weight: 600;
    color: #333;
    margin-bottom: 0.75rem;
    display: block; /* Ensures label appears above the field */
  }

  /* Inputs & selects */
  .heavy-card .form-control,
  .heavy-card .form-select {
    font-size: 1rem;
    padding: 1rem 1.5rem;
    border-radius: 50px;
    border: 1px solid #ccc;
    box-shadow: inset 0 0.25rem 0.5rem rgba(0,0,0,0.05);
    transition: all 0.3s ease;
    width: 100%; /* Make the input full width */
    margin-bottom: 1.5rem;
  }

  /* Buttons with cursor pointer */
  .heavy-card .btn {
    font-size: 1.125rem;
    font-weight: 700;
    padding: 0.75rem 2rem;
    border-radius: 50px;
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.2);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
    cursor: pointer;
  }

  .heavy-card .btn-primary {
    margin: 22px;
    background-color: #0d6efd;
    border-color: #0d6efd;
  }

  .heavy-card .btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 0.75rem 1.5rem rgba(13, 110, 253, 0.4);
  }

  .heavy-card .btn-outline-secondary {
    color: #6c757d;
    border-color: #6c757d;
  }

  .heavy-card .btn-outline-secondary:hover {
    background-color: #6c757d;
    color: #fff;
    transform: translateY(-2px);
    box-shadow: 0 0.75rem 1.5rem rgba(108, 117, 125, 0.4);
  }

  /* Alerts */
  .heavy-card .alert {
    border-radius: 0.75rem;
    padding: 1rem 1.5rem;
    font-size: 0.95rem;
    margin-bottom: 1.5rem;
  }

  /* Spacing overrides */
  .heavy-card .mb-4 { margin-bottom: 1.75rem !important; }
  .heavy-card .mt-4 { margin-top: 1.75rem !important; }

  /* Left align form */
  .heavy-card .form-group {
    margin-bottom: 1.5rem;
  }
</style>
@endpush

@section('content')
<div class="container-fluid full-height-center">
  <div class="heavy-card">

    <h2 class="heavy-heading">Edit Withdrawal Account</h2>

    {{-- Success / Error Messages --}}
    @if(session('success'))
      <div class="alert alert-success mb-4">
        {{ session('success') }}
      </div>
    @endif
    @if($errors->any())
      <div class="alert alert-danger mb-4">
        <ul class="mb-0">
          @foreach($errors->all() as $err)
            <li>{{ $err }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('admin.save-accounts.update', $account->id) }}" method="POST" class="">
      @csrf
      @method('PUT')

      <div class="form-group mb-4">
        <label for="holder" class="form-label">Account Holder Name</label>
        <input id="holder" type="text" name="account_holder_name"
               class="form-control"
               value="{{ old('account_holder_name', $account->account_holder_name) }}"
               placeholder="e.g. John Doe" required>
      </div>

      <div class="form-group mb-4">
        <label for="mobile" class="form-label">Mobile Number</label>
        <input id="mobile" type="text" name="mobile_number"
               class="form-control"
               value="{{ old('mobile_number', $account->mobile_number) }}"
               placeholder="e.g. 0312-3456789" required>
      </div>

      <div class="form-group mb-4">
        <label for="method" class="form-label">Method</label>
        <select id="method" name="method" class="form-select" required>
          <option value="JazzCash"  {{ old('method', $account->method)=='JazzCash'  ? 'selected' : '' }}>JazzCash</option>
          <option value="EasyPaisa" {{ old('method', $account->method)=='EasyPaisa' ? 'selected' : '' }}>EasyPaisa</option>
        </select>
      </div>

      <div class="d-flex justify-content-between mt-4">
        <a href="{{ route('admin.save-accounts.index') }}" class="btn btn-outline-secondary">
          Cancel
        </a>
        <button type="submit" class="btn btn-primary">
          Save Changes
        </button>
      </div>

    </form>

  </div>
</div>
@endsection
