@extends('admin.layout')

@section('title', 'Create Announcement')

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
        min-height: 200px;
    }

    .sidebar-section {
        background: #f8fafc;
        padding: 15px;
        border-radius: 6px;
        border: 1px solid #e2e8f0;
    }

    /* Industry toggle switch */
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

    .btn-submit {
        background-color: #0f172a;
        color: white;
        padding: 12px 24px;
        border: none;
        border-radius: 6px;
        font-weight: 600;
        cursor: pointer;
        transition: 0.3s;
        width: 100%;
    }

    .btn-submit:hover { background-color: #1e293b; }

    @media (max-width: 768px) {
        .form-grid { grid-template-columns: 1fr; }
    }
</style>
@endpush

@section('content')
<div class="form-container">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h2 style="font-size: 1.5rem; color: #0f172a;">New Announcement</h2>
        <a href="{{ route('alumni.announcement') }}" style="color: #64748b; font-size: 0.85rem; text-decoration: none;">
            <i class="fas fa-arrow-left"></i> Back to List
        </a>
    </div>

    <form action="{{ route('announcement.store') }}" method="POST">
        @csrf
        <div class="form-grid">
            <div class="card">
                <div class="field-group">
                    <label>Announcement Title</label>
                    <input type="text" name="title" class="form-control" placeholder="e.g. Annual Alumni Meetup 2026" required>
                </div>

                <div class="field-group">
                    <label>Content / Description</label>
                    <textarea name="description" class="form-control" placeholder="Describe the details of your announcement..." required></textarea>
                </div>
            </div>

            <div>
                <div class="card">
                    <div class="field-group">
                        <label>Announcement Type</label>
                        <select name="type" class="form-control">
                            <option value="general">General News</option>
                            <option value="event">Event</option>
                            <option value="job-opportunity">Job Opportunity</option>
                            <option value="urgent-notice">Urgent Notice</option>
                        </select>
                    </div>

                  <div class="sidebar-section" style="margin-bottom: 15px;">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <label style="font-size: 0.8rem; font-weight: 700; color: #475569;">VISIBILITY</label>

                            <!-- Hidden input ensures value always sent -->
                            <input type="hidden" name="is_visible" value="0">

                            <label class="switch">
                                <input type="checkbox" name="is_visible" value="1" checked>
                                <span class="slider"></span>
                            </label>
                        </div>

                        <small style="color: #64748b; display: block; margin-top: 5px;">
                            Toggle to show or hide from the website.
                        </small>
                   </div>

                    <button type="submit" class="btn-submit">
                        <i class="fas fa-paper-plane"></i> Publish Now
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('js')
<script>
    console.log('Create Announcement Page Ready');
</script>
@endpush