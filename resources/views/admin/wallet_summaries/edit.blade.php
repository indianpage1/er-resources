@extends('layoutss.admin.master')

@section('content')
<div class="container mt-5">
    <h2>Edit Wallet Summary</h2>

    <form action="{{ route('admin.wallet_summaries.update', $summary->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="total_earning" class="form-label">Total Earning</label>
            <input type="number" step="0.01" name="total_earning" value="{{ old('total_earning', $summary->total_earning) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="total_withdrawal" class="form-label">Total Withdrawal</label>
            <input type="number" step="0.01" name="total_withdrawal" value="{{ old('total_withdrawal', $summary->total_withdrawal) }}" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Summary</button>
        <a href="{{ route('admin.wallet_summaries.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>

<style>
    /* General styles */
body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f7fc;
    color: #333;
}

.container {
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    padding: 0px;
    margin: 0 auto;
}

h2 {
    color: #333;
    font-size: 34px;
    margin-bottom: 20px;
    font-weight: 600;
    margin: 50px
}

/* Form Styles */
form {
    display: flex;
    flex-direction: column;
    margin: 40px;
}

.form-label {
    font-size: 14px;
    font-weight: 500;
    margin-bottom: 5px;
    color: #555;
}

.form-control {
    padding: 10px;
    font-size: 14px;
    border-radius: 5px;
    border: 1px solid #ccc;
    margin-bottom: 15px;
    transition: border-color 0.3s ease;
}

.form-control:focus {
    border-color: #007bff;
    outline: none;
}

.mb-3 {
    margin-bottom: 15px;
}

/* Button styles */
.btn {
    padding: 10px 20px;
    font-size: 16px;
    border-radius: 5px;
    text-decoration: none;
    width: 200px;
    margin: 20px;
    display: inline-block;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.2s ease;
}

.btn-primary {
    background-color: #0b925e;
    color: #fff;
    border: none;
}

.btn-primary:hover {
    background-color: #0056b3;
    transform: scale(1.05);
}

a {
    margin-top: 15px;
    font-size: 24px;
    color: #243446;
    background: color(/***** Section *****/  /***** End Section *****/
     red green blue);
    text-decoration: none;
    margin: 20px;
}


</style>
@endsection
