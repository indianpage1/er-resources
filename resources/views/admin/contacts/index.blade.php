@extends('layoutss.admin.master')

@section('content')
<div class="container py-5">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">

    <h2 class="mb-4">Contact Messages</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-hover shadow-sm">
            <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Message</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($contacts as $contact)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $contact->name }}</td>
                <td>{{ $contact->email }}</td>
                <td>{{ Str::limit($contact->message, 50) }}</td>
                <td>
                    <a href="{{ route('contacts.edit', $contact) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('contacts.destroy', $contact) }}" method="POST" style="display:inline-block">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

    {{ $contacts->links() }}
</div>

    <style>
    /* General page styles */
   /* General container */
.container {
    width: 100%;
    padding: 15px;
    height: auto;
}

/* Header */
h2 {
    font-size: 28px;
    color: #2c3e50;
    font-weight: bold;
    text-align: center;
    margin-bottom: 30px;
}

/* Alert */
.alert-success {
    background-color: #28a745;
    color: white;
    padding: 10px;
    border-radius: 5px;
    margin-bottom: 20px;
    text-align: center;
}

/* Responsive table */
.table-responsive {
    width: 100%;
    overflow-x: auto;
}

/* Table styles */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 30px;
    margin-bottom: 30px;
}

th, td {
    padding: 12px 15px;
    text-align: center;
    border: 1px solid #ddd;
    word-break: break-word;
}

thead {
    background-color: #f8f9fa;
    color: #495057;
    font-weight: bold;
}

thead th {
    border-bottom: 2px solid #ddd;
}

/* Table rows */
tbody tr:nth-child(even) {
    background-color: #f9f9f9;
}

tbody tr:hover {
    background-color: #f1f1f1;
    cursor: pointer;
}

/* Buttons */
.btn {
    padding: 6px 12px;
    border-radius: 5px;
    font-size: 14px;
    text-decoration: none;
    display: inline-block;
    margin: 2px 3px;
    cursor: pointer;
    min-width: 80px;
    white-space: nowrap;
}

.btn-warning {
    background-color: #ffc107;
    color: white;
}

.btn-warning:hover {
    background-color: #e0a800;
}

.btn-danger {
    background-color: #dc3545;
    color: white;
}

.btn-danger


</style>
@endsection
