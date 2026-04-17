@extends('admin.layout')

@section('title', 'Member Profile Details')

@push('css')
<style>
    .review-container {
        max-width: 850px;
        margin: 0 auto;
    }

    .review-card {
        background: #fff;
        border-radius: 10px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }

    .review-header {
        background: #fcfcfc;
        padding: 25px 35px;
        border-bottom: 1px solid #f1f5f9;
    }

    .section-label {
        font-size: 0.7rem;
        font-weight: 800;
        color: #b5935b; /* Using your accent color */
        text-transform: uppercase;
        letter-spacing: 1px;
        margin: 35px 0 15px 35px;
        display: block;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px 40px;
        padding: 0 35px 20px 35px;
    }

    .info-item {
        border-bottom: 1px solid #f8fafc;
        padding-bottom: 10px;
    }

    .info-item label {
        display: block;
        font-size: 0.8rem;
        color: #94a3b8;
        margin-bottom: 3px;
    }

    .info-item p {
        font-size: 0.95rem;
        color: #1e293b;
        font-weight: 600;
        margin: 0;
    }

    .status-badge {
        padding: 2px 10px;
        border-radius: 4px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
    }

    .bg-employed { background: #dcfce7; color: #15803d; }
    .bg-unemployed { background: #f1f5f9; color: #475569; }

    .footer-note {
        padding: 20px 35px;
        background: #f8fafc;
        border-top: 1px solid #f1f5f9;
        font-size: 0.8rem;
        color: #94a3b8;
        text-align: center;
    }
</style>
@endpush

@section('content')
<div class="review-container">
    <div style="margin-bottom: 20px;">
        <a href="{{ route('alumni.pending') }}" style="color: #64748b; text-decoration: none; font-size: 0.85rem; font-weight: 500;">
            <i class="fas fa-chevron-left"></i> Back to Members List
        </a>
    </div>

    <div class="review-card">
        <div class="review-header">
            <h2 style="margin:0; color: #0f172a; font-size: 1.4rem;">Member Detailed View</h2>
            <p style="margin: 5px 0 0 0; color: #64748b; font-size: 0.85rem;">Reviewing system registration data for the selected alumnus.</p>
        </div>

        <span class="section-label">Identity & Contact</span>
        <div class="info-grid">
            <div class="info-item">
                <label>Full Name</label>
                <p>{{ucwords($member->name)}}</p>
            </div>
            <div class="info-item">
                <label>Email Address</label>
                <p>{{ $member->email }}</p>
            </div>
            <div class="info-item">
                <label>Contact Number</label>
                <p>{{ $member->mobile }}</p>
            </div>
        </div>

        <span class="section-label">Academic Background</span>
        <div class="info-grid">
            <div class="info-item">
                <label>Department</label>
                <p>{{ ucwords($member->department) }}</p>
            </div>
            <div class="info-item">
                <label>Final CGPA</label>
                <p>{{ $member->final_result }} / 4.00</p>
            </div>
            <div class="info-item">
                <label>Admission Year</label>
                <p>{{$member->admission_year}}</p>
            </div>
            <div class="info-item">
                <label>Graduation Year</label>
                <p>{{$member->graduation_year}}</p>
            </div>
        </div>

        <span class="section-label">Professional Experience</span>
        <div class="info-grid" style="margin-bottom: 20px;">
            <div class="info-item">
                <label>Current Status</label>
                <p><span class="status-badge bg-employed">{{$member->status}}</span></p>
            </div>
            <div class="info-item">
                <label>Current Company</label>
                <p>{{$member->company ?? "N/A"}}</p>
            </div>
            <div class="info-item">
                <label>Designation</label>
                <p>{{ $member->job ?? "N/A" }}</p>
            </div>
        </div>

        <div class="footer-note">
            This profile data is strictly for administrative review within the Alumni Portal.
        </div>
    </div>
</div>
@endsection