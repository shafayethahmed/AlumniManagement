@extends('user.layout')
@section('title', 'Change Password')

@push('css')
<style>
    .password-card {
        max-width: 800px;
        margin: 2px auto;
        background: #fff;
        padding: 20px;
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
        font-size: 1.5rem;
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

    .input-wrapper {
        position: relative;
    }

    .input-wrapper input {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        font-size: 0.95rem;
        transition: all 0.3s;
        background: #fbfcfd;
    }

    .input-wrapper input:focus {
        outline: none;
        border-color: #b5935b;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(181, 147, 91, 0.1);
    }

    .btn-update {
        width: 100%;
        padding: 14px;
        background-color: #0f172a;
        color: white;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: 0.3s;
        margin-top: 10px;
    }

    .btn-update:hover {
        background-color: #1e293b;
        transform: translateY(-1px);
    }

    .error-text {
        color: #ef4444;
        font-size: 0.8rem;
        margin-top: 5px;
        display: none;
    }
</style>
@endpush

@section('content')
<div class="password-card">
    <div class="form-header">
        <h2>Change Password</h2>
        <p>Ensure your account is using a long, random password to stay secure.</p>
    </div>

    <form id="passwordForm" action="#" method="POST">
        @csrf
        
        <div class="form-group">
            <label for="current_password">Current Password</label>
            <div class="input-wrapper">
                <input type="password" id="current_password" name="current_password" required placeholder="••••••••">
            </div>
        </div>

        <hr style="margin: 25px 0; border: 0; border-top: 1px solid #f1f5f9;">

        <div class="form-group">
            <label for="new_password">New Password</label>
            <div class="input-wrapper">
                <input type="password" id="new_password" name="new_password" required placeholder="••••••••">
            </div>
        </div>

        <div class="form-group">
            <label for="new_password_confirmation">Confirm New Password</label>
            <div class="input-wrapper">
                <input type="password" id="new_password_confirmation" name="new_password_confirmation" required placeholder="••••••••">
            </div>
            <p id="matchError" class="error-text">Passwords do not match!</p>
        </div>

        <button type="submit" class="btn-update">Update Password</button>
    </form>
</div>
@endsection

@push('js')
<script>
    document.getElementById('passwordForm').addEventListener('submit', function(e) {
        const newPass = document.getElementById('new_password').value;
        const confirmPass = document.getElementById('new_password_confirmation').value;
        const errorMsg = document.getElementById('matchError');

        if (newPass !== confirmPass) {
            e.preventDefault(); // Stop form submission
            errorMsg.style.display = 'block';
            document.getElementById('new_password_confirmation').style.borderColor = '#ef4444';
        } else {
            errorMsg.style.display = 'none';
        }
    });

    // Clean up error state when user starts typing again
    document.getElementById('new_password_confirmation').addEventListener('input', function() {
        this.style.borderColor = '#e2e8f0';
        document.getElementById('matchError').style.display = 'none';
    });
</script>
@endpush