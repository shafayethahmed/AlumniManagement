@extends('user.layout')

@section('title', 'Alumni Members')

@push('css')
<style>
    .table-container {
        background: #fff;
        padding: 15px;
        border-radius: 8px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        border: 1px solid #e2e8f0;
    }

    .table-controls {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
        gap: 15px;
        flex-wrap: wrap;
    }

    .filter-group {
        display: flex;
        gap: 10px;
        align-items: center;
    }

    .search-input, .filter-select {
        padding: 6px 12px;
        font-size: 0.85rem;
        border: 1px solid #e2e8f0;
        border-radius: 6px;
        outline: none;
    }

    .search-input:focus, .filter-select:focus {
        border-color: #b5935b;
    }

    .search-input { width: 250px; }

    .custom-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.85rem;
    }

    .custom-table th {
        background-color: #f1f5f9;
        color: #475569;
        text-align: left;
        padding: 8px 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        border: 1px solid #e2e8f0;
        white-space: nowrap;
    }

    .custom-table td {
        padding: 6px 12px;
        border: 1px solid #e2e8f0;
        color: #1e293b;
        vertical-align: middle;
        white-space: nowrap;
    }

    .custom-table tr:hover { background-color: #f8fafc; }

    .badge {
        display: inline-block;
        padding: 2px 8px;
        border-radius: 4px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
    }

    /* Matching your custom classes */
    .badge-employed { background-color: #dcfce7; color: #15803d; }
    .badge-unemployed { background-color: #f1f5f9; color: #64748b; }

    .action-btns { display: flex; gap: 5px; justify-content: center; }

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
        background: none;
        cursor: pointer;
    }

    .view-btn { color: #64748b; }
    .edit-btn { border-color: #fbbf24; color: #92400e; }
    .delete-btn { border-color: #f87171; color: #991b1b; }
</style>
@endpush

@section('content')
<div class="table-container">
    <div class="table-header">
        <h2 style="font-size: 1.25rem; color: #0f172a; margin-bottom: 4px;">Alumni Registry</h2>
        <p style="color: #64748b; font-size: 0.8rem;">Filter and manage registered members.</p>
    </div>

    <div class="table-controls">
        <div class="filter-group">
            <input type="text" id="searchInput" class="search-input" placeholder="Search by name, email, or ID..." onkeyup="applyFilters()">
            
            <select id="yearFilter" class="filter-select" onchange="applyFilters()">
                <option value="">All Graduation Years</option>
                <option value="2022">2022</option>
                <option value="2023">2023</option>
                <option value="2024">2024</option>
                <option value="2025">2025</option>
                <option value="2026">2026</option>
            </select>
        </div>
        
        <div style="font-size: 0.8rem; color: #64748b;">
            Showing: <span id="visibleCount">0</span> members
        </div>
    </div>

    <div style="overflow-x: auto;">
        <table class="custom-table" id="alumniTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Email Address</th>
                    <th>Phone</th>
                    <th>Dept.</th>
                    <th>Year</th>
                    <th>Status</th>
                    <th style="text-align: center;">Actions</th>
                </tr>
            </thead>
            <tbody id="AlumniMemberTable">
                <tr>
                    <td colspan="8" style="text-align: center; padding: 20px;">Loading members...</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    function applyFilters() {
        const searchValue = document.getElementById('searchInput').value.toLowerCase();
        const yearValue = document.getElementById('yearFilter').value;
        const rows = document.querySelectorAll('.alumni-row');
        let visibleCount = 0;

        rows.forEach(row => {
            const name = row.querySelector('.col-name').innerText.toLowerCase();
            const email = row.querySelector('.col-email').innerText.toLowerCase();
            const id = row.querySelector('.col-id').innerText.toLowerCase();
            const year = row.querySelector('.col-year').innerText;

            const matchesSearch = name.includes(searchValue) || email.includes(searchValue) || id.includes(searchValue);
            const matchesYear = yearValue === "" || year === yearValue;

            if (matchesSearch && matchesYear) {
                row.style.display = "";
                visibleCount++;
            } else {
                row.style.display = "none";
            }
        });

        document.getElementById('visibleCount').innerText = visibleCount;
    }
    
    // Fetch members
    axios.get('api/alumni-members')
    .then(function(response) {
        // Handle both data.members or data.data.members depending on your API structure
        const members = response.data.data.members || response.data.members;
        const tableBody = document.getElementById('AlumniMemberTable');
        
        tableBody.innerHTML = '';

        members.forEach(member => {
            const status = member.profile?.status || 'Unknown';
            const statusClass = status === 'Employed' ? 'badge-employed' : 'badge-unemployed';
            
            const row = `
                <tr class="alumni-row">
                    <td class="col-id">${member.id}</td>
                    <td class="col-name"><strong>${member.name}</strong></td>
                    <td class="col-email">${member.email}</td>
                    <td>${member.profile ? member.profile.mobile : 'N/A'}</td>
                    <td>${member.profile ? member.profile.department : 'N/A'}</td>
                    <td class="col-year">${member.profile ? member.profile.graduation_year : 'N/A'}</td>
                    <td>
                        <span class="badge ${statusClass}">${status}</span>
                    </td>
                    <td>
                        <div class="action-btns">
                            <button title="View" class="btn-icon view-btn" onclick="viewMember(${member.id})">i</button>
                        </div>
                    </td>
                </tr>
            `;
            tableBody.innerHTML += row;
        });

        // Update the count after loading
        document.getElementById('visibleCount').innerText = members.length;
    })
    .catch(function(error) {
        console.error("Error fetching alumni data:", error);
        document.getElementById('AlumniMemberTable').innerHTML = '<tr><td colspan="8" style="text-align:center; color:red;">Failed to load data.</td></tr>';
    });

    // Placeholder functions for actions
    function viewMember(id) { 
    // Replace 'id_placeholder' with the actual ID in JS
    let url = "{{ route('user.alummni.view', ':id') }}";
    url = url.replace(':id', id);
    
    window.location.href = url;
    }
</script>
@endpush