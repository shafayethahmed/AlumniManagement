@extends('admin.layout')

@section('title', 'View Announcement')

@push('css')
<style>
    .view-container {
        max-width: 900px; /* Optimized width for reading full-text */
        margin: 0 auto;
    }

    .view-card {
        background: #fff;
        border-radius: 8px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        padding: 50px; /* Generous padding for a clean look */
    }

    .announcement-header {
        border-bottom: 2px solid #f1f5f9;
        margin-bottom: 30px;
        padding-bottom: 20px;
    }

    .announcement-title {
        font-size: 2.2rem;
        color: #0f172a;
        font-weight: 800;
        margin-bottom: 15px;
        line-height: 1.2;
        text-align: left;
    }

    .meta-row {
        display: flex;
        gap: 20px;
        color: #64748b;
        font-size: 0.9rem;
        align-items: center;
    }

    .type-badge {
        background: #f1f5f9;
        color: #475569;
        padding: 4px 12px;
        border-radius: 4px;
        font-weight: 700;
        font-size: 0.75rem;
        text-transform: uppercase;
    }

    .description-content {
        color: #1e293b;
        line-height: 1.8;
        font-size: 1.1rem;
        white-space: pre-line;
        text-align: left;
        border-left: 4px solid #e2e8f0; /* Decorative left border to anchor text */
        padding-left: 25px;
    }

    .status-indicator {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 0.85rem;
        font-weight: 600;
        color: #10b981; /* Success Green */
    }

    @media (max-width: 768px) {
        .view-card { padding: 30px 20px; }
        .announcement-title { font-size: 1.75rem; }
    }
</style>
@endpush

@section('content')
<div class="view-container">
    <div style="margin-bottom: 20px; display: flex; align-items: center; justify-content: space-between;">
        <a href="{{ route('alumni.announcement') }}" style="color: #64748b; text-decoration: none; font-size: 0.9rem; font-weight: 500;">
            <i class="fas fa-arrow-left"></i> Back to Announcements
        </a>
        
        <div class="status-indicator">
            <i class="fas fa-eye"></i> Published & Visible
        </div>
    </div>

    <div class="view-card">
        <div class="announcement-header">
            <div style="margin-bottom: 10px;">
                <span class="type-badge">{{  $announcement->type }}</span>
            </div>
            <h1 class="announcement-title">{{ $announcement->title }}</h1>
            
            <div class="meta-row">
                <span><i class="far fa-calendar-alt"></i> Posted:{{$announcement->created_at->format('d M Y') }}</span>
            </div>
        </div>

        <div class="description-content">
           {{ $announcement->description }}
        </div>

        <div style="margin-top: 50px; padding-top: 20px; border-top: 1px solid #f1f5f9; color: #94a3b8; font-size: 0.8rem;">
            Last Modified: {{  $announcement->updated_at->format('d M Y') }}
        </div>
    </div>
</div>
@endsection