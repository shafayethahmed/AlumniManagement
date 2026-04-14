@extends('admin.layout')

@section('title', 'Announcements')

@push('css')
<style>
    .table-container {
        background: #fff;
        padding: 15px;
        border-radius: 8px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        border: 1px solid #e2e8f0;
    }

    .table-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }

    /* Industry Standard Add Button */
    .btn-add {
        background-color: #b5935b;
        color: white;
        padding: 8px 16px;
        border-radius: 6px;
        text-decoration: none;
        font-size: 0.85rem;
        font-weight: 600;
        transition: 0.3s;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .btn-add:hover {
        background-color: #0f172a;
        transform: translateY(-1px);
    }

    .custom-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.85rem;
    }

    .custom-table th {
        background-color: #f1f5f9;
        color: #475569;
        text-align: left;
        padding: 10px 12px;
        font-weight: 600;
        border: 1px solid #e2e8f0;
    }

    .custom-table td {
        padding: 8px 12px;
        border: 1px solid #e2e8f0;
        color: #1e293b;
        vertical-align: middle;
    }

    /* Description Truncation */
    .text-truncate-2 {
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;  
        overflow: hidden;
        max-width: 300px;
        color: #64748b;
    }

    /* Show/Hide Toggle Styling */
    .status-toggle {
        font-size: 0.75rem;
        padding: 2px 8px;
        border-radius: 4px;
        font-weight: 700;
        text-transform: uppercase;
    }
    .status-visible { background: #dcfce7; color: #15803d; }
    .status-hidden { background: #fee2e2; color: #991b1b; }

    .action-btns {
        display: flex;
        gap: 5px;
        justify-content: center;
    }

    .btn-icon {
        width: 28px;
        height: 28px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 4px;
        font-size: 0.8rem;
        text-decoration: none;
        transition: 0.2s;
        border: 1px solid #e2e8f0;
    }

    .view-btn { color: #64748b; }
    .edit-btn { border-color: #fbbf24; color: #92400e; }
    .delete-btn { border-color: #f87171; color: #991b1b; }
    
    .view-btn:hover { background: #f1f5f9; }
    .edit-btn:hover { background: #fbbf24; color: white; }
    .delete-btn:hover { background: #f87171; color: white; }
</style>
@endpush

@section('content')
<div class="table-container">
    <div class="table-header">
        <div>
            <h2 style="font-size: 1.25rem; color: #0f172a; margin-bottom: 2px;">Announcements</h2>
            <p style="color: #64748b; font-size: 0.8rem;">Create and manage news for the alumni network.</p>
        </div>
        
        <a href="{{ route('create.announcement') }}" class="btn-add">
            <i class="fas fa-plus-circle"></i> New Announcement
        </a>
    </div>

    <div style="overflow-x: auto;">
        <table class="custom-table">
            <thead>
                <tr>
                    <th style="width: 50px;">#</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Type</th>
                    <th>Visibility</th>
                    <th>Date Posted</th>
                    <th style="text-align: center;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>01</td>
                    <td><strong>Annual Reunion 2026</strong></td>
                    <td>
                        <span class="text-truncate-2">Join us for the biggest alumni gathering of the year at the Grand Hall...</span>
                    </td>
                    <td><span style="color: #6366f1; font-weight:600;">Event</span></td>
                    <td><span class="status-toggle status-visible">Visible</span></td>
                    <td>13 Apr 2026</td>
                    <td>
                        <div class="action-btns">
                            <a href="{{ route('announcement.show') }}" class="btn-icon view-btn" title="View"><i class="fas fa-eye"></i></a>
                            <a href="{{ route('announcement.edit') }}" class="btn-icon edit-btn" title="Edit"><i class="fas fa-edit"></i></a>
                            <a href="#" class="btn-icon delete-btn" title="Delete"><i class="fas fa-trash"></i></a>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td>02</td>
                    <td><strong>Career Fair 2026</strong></td>
                    <td>
                        <span class="text-truncate-2">Top companies are visiting our campus to hire alumni members next week...</span>
                    </td>
                    <td><span style="color: #f59e0b; font-weight:600;">Job Post</span></td>
                    <td><span class="status-toggle status-hidden">Hidden</span></td>
                    <td>10 Apr 2026</td>
                    <td>
                        <div class="action-btns">
                            <a href="#" class="btn-icon view-btn" title="View"><i class="fas fa-eye"></i></a>
                            <a href="#" class="btn-icon edit-btn" title="Edit"><i class="fas fa-edit"></i></a>
                            <a href="#" class="btn-icon delete-btn" title="Delete"><i class="fas fa-trash"></i></a>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('js')
<script>
    console.log('Announcement module initialized');
</script>
@endpush