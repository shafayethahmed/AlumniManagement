@extends('admin.layout')

@section('title', 'Alumni Profile View')

@push('css')
<style>
    .show-container {
        max-width: 900px;
        margin: 0 auto;
    }

    .info-card {
        background: #fff;
        border-radius: 8px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        padding: 35px;
        margin-bottom: 25px;
    }

    .header-section {
        border-bottom: 2px solid #f1f5f9;
        padding-bottom: 20px;
        margin-bottom: 30px;
    }

    .profile-name {
        font-size: 1.75rem;
        color: #0f172a;
        font-weight: 800;
        margin: 0;
    }

    .section-heading {
        font-size: 0.75rem;
        font-weight: 800;
        color: #b5935b;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin: 30px 0 15px 0;
        display: block;
    }

    /* Grid for Data */
    .data-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px 40px;
    }

    .data-item label {
        display: block;
        font-size: 0.8rem;
        color: #94a3b8;
        margin-bottom: 4px;
    }

    .data-item p {
        font-size: 1rem;
        color: #1e293b;
        font-weight: 600;
        margin: 0;
    }

    /* Experience List */
    .experience-box {
        background: #f8fafc;
        border-radius: 6px;
        padding: 20px;
        margin-top: 10px;
        border: 1px solid #e2e8f0;
    }

    .experience-entry {
        padding-bottom: 15px;
        margin-bottom: 15px;
        border-bottom: 1px solid #e2e8f0;
    }

    .experience-entry:last-child {
        border-bottom: none;
        padding-bottom: 0;
        margin-bottom: 0;
    }

    .job-title {
        font-size: 1rem;
        font-weight: 700;
        color: #0f172a;
        margin: 0;
    }

    .company-name {
        font-size: 0.9rem;
        color: #64748b;
        font-weight: 500;
    }

    .status-tag {
        font-size: 0.7rem;
        padding: 2px 8px;
        border-radius: 4px;
        background: #dcfce7;
        color: #15803d;
        margin-left: 8px;
    }
</style>
@endpush

@section('content')
<div class="show-container">
    <div style="margin-bottom: 20px;">
        <a href="{{ route('alumni.member') }}" style="color: #64748b; text-decoration: none; font-size: 0.9rem;">
            <i class="fas fa-arrow-left"></i> Back to Members Registry
        </a>
    </div>

    <div class="info-card">
        <div class="header-section">
            <h1 class="profile-name">Arif Rahman</h1>
            <p style="color: #64748b; margin-top: 5px;">Member ID: #ALUM-2026-8801</p>
        </div>

        <span class="section-heading">Personal & Academic Info</span>
        <div class="data-grid">
            <div class="data-item">
                <label>Email Address</label>
                <p>arif.rahman@example.com</p>
            </div>
            <div class="data-item">
                <label>Contact Number</label>
                <p>+880 1712-345678</p>
            </div>
            <div class="data-item">
                <label>Department</label>
                <p>Computer Science & Engineering</p>
            </div>
            <div class="data-item">
                <label>Final CGPA</label>
                <p>3.92</p>
            </div>
            <div class="data-item">
                <label>Admission Year</label>
                <p>2018</p>
            </div>
            <div class="data-item">
                <label>Graduation Year</label>
                <p>2022</p>
            </div>
        </div>

        <span class="section-heading">Professional Experience Timeline</span>
        <div class="experience-box">
            <div class="experience-entry">
                <p class="job-title">Senior Software Engineer <span class="status-tag">Current</span></p>
                <p class="company-name">Google Bangladesh Ltd.</p>
                <small style="color: #94a3b8;">January 2024 — Present</small>
            </div>

            <div class="experience-entry">
                <p class="job-title">Full Stack Developer</p>
                <p class="company-name">Pathao Inc.</p>
                <small style="color: #94a3b8;">June 2022 — December 2023</small>
            </div>

            <div class="experience-entry">
                <p class="job-title">Junior Web Intern</p>
                <p class="company-name">TigerIT Bangladesh</p>
                <small style="color: #94a3b8;">January 2022 — May 2022</small>
            </div>
        </div>

        <div style="margin-top: 30px; text-align: right; color: #cbd5e1; font-size: 0.75rem;">
            Record Verified: April 13, 2026
        </div>
    </div>
</div>
@endsection