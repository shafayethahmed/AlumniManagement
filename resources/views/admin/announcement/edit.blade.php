@extends('admin.layout')

@section('title', 'Edit Announcement')

@push('css')
<style>
    .form-container {
        max-width: 1000px;
        margin: 0 auto;
    }

    .card {
        background: #fff;
        border-radius: 8px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        padding: 20px;
        margin-bottom: 20px;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 20px;
    }

    .field-group {
        margin-bottom: 15px;
    }

    .field-group label {
        display: block;
        font-size: 0.8rem;
        font-weight: 700;
        color: #475569;
        text-transform: uppercase;
        margin-bottom: 6px;
    }

    .form-control {
        width: 100%;
        padding: 10px 12px;
        font-size: 0.9rem;
        border: 1px solid #e2e8f0;
        border-radius: 6px;
        outline: none;
        transition: 0.2s;
    }

    .form-control:focus {
        border-color: #b5935b;
        box-shadow: 0 0 0 3px rgba(181, 147, 91, 0.1);
    }

    textarea.form-control {
        resize: vertical;
        min-height: 250px;
    }

    .image-preview-box {
        width: 100%;
        height: 150px;
        background: #f1f5f9;
        border-radius: 6px;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        border: 1px dashed #cbd5e1;
    }

    .image-preview-box img {
        max-width: 100%;
        max-height: 100%;
        object-fit: cover;
    }

    /* Toggle Switch */
    .switch {
        position: relative;
        display: inline-block;
        width: 40px;
        height: 20px;
    }

    .switch input { opacity: 0; width: 0; height: 0; }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0; left: 0; right: 0; bottom: 0;
        background-color: #cbd5e1;
        transition: .4s;
        border-radius: 20px;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 14px; width: 14px;
        left: 3px; bottom: 3px;
        background-color: white;
        transition: .4s;
        border-radius: 50%;
    }

    input:checked + .slider { background-color: #10b981; }
    input:checked + .slider:before { transform: translateX(20px); }

    .btn-update {
        background-color: #0f172a;
        color: white;
        padding: 12px 24px;
        border: none;
        border-radius: 6px;
        font-weight: 600;
        cursor: pointer;
        transition: 0.3s;
        width: 100%;
        margin-bottom: 10px;
    }

    .btn-update:hover { background-color: #1e293b; }

    .btn-delete-outline {
        display: block;
        text-align: center;
        color: #ef4444;
        font-size: 0.8rem;
        font-weight: 600;
        text-decoration: none;
        padding: 8px;
        border: 1px solid #fee2e2;
        border-radius: 6px;
        transition: 0.2s;
    }

    .btn-delete-outline:hover {
        background: #fee2e2;
    }

    @media (max-width: 768px) {
        .form-grid { grid-template-columns: 1fr; }
    }
</style>
@endpush

@section('content')
<div class="form-container">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <div>
            <h2 style="font-size: 1.5rem; color: #0f172a;">Edit Announcement</h2>
            <small style="color: #64748b;">Editing: <strong>Annual Reunion 2026</strong></small>
        </div>
        <a href="{{ route('alumni.announcement') }}" class="btn-delete-outline" style="border: none;">
            <i class="fas fa-arrow-left"></i> Back to List
        </a>
    </div>

    <form action="#" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="form-grid">
            <div class="card">
                <div class="field-group">
                    <label>Announcement Title</label>
                    <input type="text" name="title" class="form-control" value="Annual Reunion 2026" required>
                </div>

                <div class="field-group">
                    <label>Content / Description</label>
                    <textarea name="description" class="form-control">Join us for the biggest alumni gathering of the year at the Grand Hall. We will have networking sessions, dinner, and guest speakers from our successful alumni chapters worldwide.</textarea>
                </div>
            </div>

            <div>
                <div class="card">
                    <div class="field-group">
                        <label>Announcement Type</label>
                        <select name="type" class="form-control">
                            <option value="General">General News</option>
                            <option value="Event" selected>Event</option>
                            <option value="Job">Job Opportunity</option>
                            <option value="Urgent">Urgent Notice</option>
                        </select>
                    </div>

                    <div class="field-group" style="background: #f8fafc; padding: 12px; border-radius: 6px; border: 1px solid #e2e8f0; margin-bottom: 20px;">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <label style="font-size: 0.75rem; margin-bottom: 0;">Show on Website</label>
                            <label class="switch">
                                <input type="checkbox" name="is_visible" checked>
                                <span class="slider"></span>
                            </label>
                        </div>
                    </div>

                    <div class="field-group">
                        <label>Current Featured Image</label>
                        <div class="image-preview-box">
                            <img src="https://via.placeholder.com/300x150" alt="Preview">
                        </div>
                        <label style="font-size: 0.7rem; color: #94a3b8;">Change Image:</label>
                        <input type="file" name="image" class="form-control" style="font-size: 0.8rem; padding: 7px;">
                    </div>

                    <button type="submit" class="btn-update">
                        <i class="fas fa-save"></i> Save Changes
                    </button>

                    <a href="#" class="btn-delete-outline" onclick="return confirm('Permanently delete this announcement?')">
                        <i class="fas fa-trash-alt"></i> Delete Announcement
                    </a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('js')
<script>
    console.log('Edit mode active for Announcement #01');
</script>
@endpush