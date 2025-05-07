@extends('layoutss.admin.master')

saad

@section('content')
<div class="form-wrapper">
    <form action="{{ route('contacts.update', $contact) }}" method="POST">
        @csrf
        @method('PUT')

        <h2 class="text-center mb-4">Edit Contact Message</h2>

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $contact->name }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $contact->email }}" required>
        </div>

        <div class="mb-3">
            <label for="message" class="form-label">Message</label>
            <textarea class="form-control" id="message" name="message" rows="5" required>{{ $contact->message }}</textarea>
        </div>

        <div class="action-buttons">
            <a href="{{ route('contacts.index') }}" class="btn-back">Back</a>
            <button type="submit">Update Message</button>
        </div>
        
    </form>
</div>

<style>
    .form-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        padding: 1rem;
        background: #f0f2f5;
    }

    form {
        background: rgba(240, 234, 234, 0.9);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        padding: 2rem;
        width: 100%;
        max-width: 500px;
        border-radius: 1.5rem;
        border: 1px solid #0c0c0c;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .form-label {
        font-weight: 800;
        font-size: 1.1rem;
        color: #2c3e50;
        margin-bottom: 0.5rem;
        display: block;
    }

    .form-control,
    textarea.form-control {
        border-radius: 0.75rem;
        border: 2px solid #dfe6e9;
        padding: 0.85rem 1rem;
        font-size: 1rem;
        color: #2d3436;
        background-color: #fdfdfd;
        transition: all 0.3s ease-in-out;
        box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.02);
        width: 100%;
    }

    .form-control:focus {
        border-color: #0984e3;
        box-shadow: 0 0 0 0.25rem rgba(9, 132, 227, 0.15);
    }

    .form-control:not(:focus) {
        border-bottom: 3px solid #dfe6e9;
    }

    textarea.form-control {
        resize: vertical;
        font-size: 1rem;
        line-height: 1.5rem;
    }

    /* Submit button */
    button[type="submit"] {
        background-color: #0984e3;
        border: none;
        padding: 0.85rem 2.5rem;
        font-size: 1rem;
        font-weight: 600;
        color: #fff;
        border-radius: 0.75rem;
        margin-top: 0.5rem;
        transition: background-color 0.3s ease;
        box-shadow: 0 4px 12px rgba(9, 132, 227, 0.2);
        width: 100%;
    }

    button[type="submit"]:hover {
        background-color: #0652DD;
    }

    /* Back button */
    .btn-back {
        background-color: #b2bec3;
        color: #2d3436;
        border: none;
        padding: 0.85rem 2.5rem;
        font-size: 1rem;
        font-weight: 600;
        border-radius: 0.75rem;
        margin-top: 0.5rem;
        transition: background-color 0.3s ease;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        text-align: center;
        text-decoration: none;
        width: 100%;
        display: inline-block;
    }

    .btn-back:hover {
        background-color: #636e72;
        color: #fff;
    }

    .action-buttons {
        margin-top: 1.5rem;
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }

    @media (min-width: 768px) {
        .action-buttons {
            flex-direction: row;
        }

        .btn-back,
        button[type="submit"] {
            width: 48%;
        }
    }
</style>

@endsection
