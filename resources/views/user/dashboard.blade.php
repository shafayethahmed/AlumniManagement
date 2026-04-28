@extends('user.layout')

@section('title', 'Dashboard')

@push('css')
<style>
    /* Stats Cards Layout */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        margin-bottom: 30px;
    }

    .stat-card {
        background: #fff;
        padding: 20px;
        border-radius: 10px;
        border: 1px solid #e2e8f0;
        display: flex;
        align-items: center;
        gap: 15px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
    }

    .stat-info h3 { margin: 0; font-size: 1.5rem; color: #0f172a; font-weight: 800; }
    .stat-info p { margin: 0; font-size: 0.75rem; color: #64748b; text-transform: uppercase; font-weight: 700; }

    /* Color Accents */
    .bg-blue { background: #eff6ff; color: #2563eb; }
    .bg-amber { background: #fffbeb; color: #d97706; }
    .bg-green { background: #f0fdf4; color: #16a34a; }
    .bg-slate { background: #f8fafc; color: #475569; }

    /* Dashboard Layout */
    .dashboard-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 25px;
    }

    .box {
        background: #fff;
        border-radius: 10px;
        border: 1px solid #e2e8f0;
        padding: 20px;
    }

    .box-title {
        font-size: 1rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    /* Highlights Feed (Left Side) */
    .activity-feed { list-style: none; padding: 0; margin: 0; }
    .activity-item {
        padding: 12px;
        border-bottom: 1px solid #f1f5f9;
        display: flex;
        align-items: flex-start;
        gap: 12px;
    }
    .activity-item:last-child { border-bottom: none; }
    .avatar-sm { width: 35px; height: 35px; border-radius: 50%; background: #e2e8f0; }

    .activity-text { font-size: 0.85rem; color: #475569; line-height: 1.4; }
    .activity-text strong { color: #0f172a; }
    .activity-time { font-size: 0.75rem; color: #94a3b8; display: block; margin-top: 4px; }

    /* Announcement Box (Right Side) */
    .announce-item {
        padding: 10px;
        background: #f8fafc;
        border-radius: 6px;
        margin-bottom: 10px;
        border-left: 3px solid #b5935b;
    }
    .announce-item h4 { margin: 0; font-size: 0.85rem; color: #1e293b; }
    .announce-item p { margin: 5px 0 0 0; font-size: 0.75rem; color: #64748b; }

    @media (max-width: 1024px) {
        .stats-grid { grid-template-columns: repeat(2, 1fr); }
        .dashboard-grid { grid-template-columns: 1fr; }
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon bg-blue"><i class="fas fa-users"></i></div>
            <div class="stat-info">
                <p>Total Alumni</p>
                <h3 id="totalAlumni"></h3>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon bg-green"><i class="fas fa-briefcase"></i></div>
            <div class="stat-info">
                <p>Employed</p>
                <h3 id="totalEmployed"></h3>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon bg-slate"><i class="fas fa-user-slash"></i></div>
            <div class="stat-info">
                <p>Unemployed</p>
                <h3 id="totalUnemployed"></h3>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon bg-slate"><i class="fas fa-podcast"></i></div>
            <div class="stat-info">
                <p>Latest Update</p>
                <h3 id="latestUpdate"></h3>
            </div>
        </div>
    </div>

    <div class="dashboard-grid">
        <div class="box">
            <h3 class="box-title"><i class="fas fa-bolt" style="color: #fbbf24;"></i> Highlights</h3>
            <div id="highlightList"></div>
        </div>

        <div class="box">
            <h3 class="box-title"><i class="fas fa-bullhorn" style="color: #b5935b;"></i>Announcements</h3>
            <div id="announcementList"></div>
        </div>

    </div>
</div>
@endsection
@push('js')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    axios.get('/api/dashboard')
    .then(function(response) {
        console.log(response.data);
        
        // Safety check for data structure
        if (!response.data || !response.data.data) return;

        let stats = response.data.data.stats;
        document.getElementById('totalAlumni').innerText = stats.totalAlumni;
        document.getElementById('totalEmployed').innerText = stats.totalEmployed;
        document.getElementById('totalUnemployed').innerText = stats.totalUnemployed;

        // --- Highlights Section ---
        let highlights = response.data.data.highlights || [];
        document.getElementById('latestUpdate').innerText = highlights.length;

        let html = ''; // First declaration

        if (highlights.length > 0) {
            highlights.forEach(item => {
                let startDate = item.started_at ? new Date(item.started_at).toLocaleDateString() : '';
                let endDate = item.resign_at ? new Date(item.resign_at).toLocaleDateString() : 'Present';
                let createdDate = item.created_at ? new Date(item.created_at).toLocaleDateString() : '';

                html += `
                   <div class="activity-item">
                    <div class="avatar-sm"><img src="https://ui-avatars.com/api/?name=A+M" class="avatar-sm"></div>
                    <div class="activity-text">
                        <strong>Alumni-${item.user_id}</strong> updated his/her <strong>Working Profile</strong>.
                        <span class="activity-time">${createdDate}</span>
                    </div>
                   </div>`;
                
            });
        } else {
            html = `<p>No highlights found</p>`;
        }
        document.getElementById('highlightList').innerHTML = html;

        // --- Announcement Section ---
        let announcements = response.data.data.announcements || [];
        
        // FIX: Removed 'let' here because 'html' is already declared above
        html = ''; 

        if (announcements.length > 0) {
            announcements.forEach(item => {
                html += `
                    <div class="announce-item">
                        <h4>${item.title}</h4>
                        <sup><small style="color:red;">${new Date(item.created_at).toLocaleDateString()}</small></sup>
                        <p>${item.description}</p>
                    </div>`;
            });
        } else {
            html = `<p>No announcements found</p>`;
        }
        document.getElementById('announcementList').innerHTML = html;

    })
    .catch(function(error){
        console.error("API Error:", error);
    });    
</script>

@endpush