@extends('admin.layout')

@section('title', 'Change Password')

@push('css')
<style>
    .password-card {
        max-width: 900px;
        margin: 20px auto;
        background: #fff;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        border: 1px solid #e2e8f0;
    }

    .form-header {
        margin-bottom: 25px;
        text-align: center;
    }

    .form-header h2 {
        color: #0f172a;
        font-size: 1.6rem;
        font-weight: 700;
    }

    .form-header p {
        color: #64748b;
        font-size: 0.9rem;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        font-size: 0.85rem;
        font-weight: 600;
        margin-bottom: 8px;
        color: #1e293b;
    }

    .input-wrapper input {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        font-size: 0.95rem;
        background: #fbfcfd;
        transition: 0.3s;
    }

    .input-wrapper input:focus {
        outline: none;
        border-color: #b5935b;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(181,147,91,0.1);
    }

    .btn-update {
        width: 100%;
        padding: 14px;
        background-color: #0f172a;
        color: #fff;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: 0.3s;
    }

    .btn-update:hover {
        background-color: #1e293b;
        transform: translateY(-1px);
    }

    .error-text {
        color: #ef4444;
        font-size: 0.8rem;
        margin-top: 5px;
    }

    .alert {
        padding: 10px 15px;
        border-radius: 8px;
        margin-bottom: 15px;
        font-size: 0.9rem;
    }

    .alert-success {
        background: #ecfdf5;
        color: #047857;
        border: 1px solid #a7f3d0;
    }

    .alert-danger {
        background: #fef2f2;
        color: #b91c1c;
        border: 1px solid #fecaca;
    }
</style>
@endpush

@section('content')

<div class="password-card">

    <div class="form-header">
        <h2>Change Password</h2>
        <p>Update your password to keep your account secure.</p>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Error Message --}}
    @if($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    <form id="passwordForm" action="#" method="POST">
        @csrf

        {{-- Current Password --}}
        <div class="form-group">
            <label>Current Password</label>
            <div class="input-wrapper">
                <input type="password" name="current_password" required placeholder="Enter current password">
            </div>
        </div>

        <hr style="margin: 20px 0; border: none; border-top: 1px solid #eee;">

        {{-- New Password --}}
        <div class="form-group">
            <label>New Password</label>
            <div class="input-wrapper">
                <input type="password" id="new_password" name="new_password" required placeholder="Enter new password">
            </div>
        </div>

        {{-- Confirm Password --}}
        <div class="form-group">
            <label>Confirm New Password</label>
            <div class="input-wrapper">
                <input type="password" id="confirm_password" name="new_password_confirmation" required placeholder="Confirm new password">
            </div>
            <p id="matchError" class="error-text" style="display:none;">Passwords do not match!</p>
        </div>

        <button type="submit" class="btn-update">Update Password</button>
    </form>
</div>

@endsection

@push('js')
<script>
    document.getElementById('passwordForm').addEventListener('submit', function(e) {
        let newPass = document.getElementById('new_password').value;
        let confirmPass = document.getElementById('confirm_password').value;
        let error = document.getElementById('matchError');

        if (newPass !== confirmPass) {
            e.preventDefault();
            error.style.display = 'block';
        }
    });

    document.getElementById('confirm_password').addEventListener('input', function() {
        document.getElementById('matchError').style.display = 'none';
    });
</script>
@endpush