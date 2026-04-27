@extends('admin.layout')

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

    /* New Control Bar Styling */
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

    .badge-employed { background-color: #dcfce7; color: #15803d; }
    .badge-unemployed { background-color: #f1f5f9; color: #64748b; }

    .action-btns { display: flex; gap: 5px; justify-content: center; }

    .btn-icon {
        width: 26px;
        height: 26px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 4px;
        font-size: 0.8rem;
        text-decoration: none;
        transition: 0.2s;
    }

    .view-btn { border: 1px solid #e2e8f0; color: #64748b; }
    .edit-btn { border: 1px solid #fbbf24; color: #92400e; }
    .delete-btn { border: 1px solid #f87171; color: #991b1b; }
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
            </select>
        </div>
        
        <div style="font-size: 0.8rem; color: #64748b;">
            Showing: <span id="visibleCount">{{ $TotalAlumniMembers }}</span> members
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
            <tbody>
                 @forelse ($members as $member )
                  <tr class="alumni-row">
                    <td class="col-id" style="color: #94a3b8;">{{ $member->profile->academic_id }}</td>
                    <td class="col-name"><strong>{{ $member->name }}</strong></td>
                    <td class="col-email">{{ $member->email }}</td>
                    <td>{{ $member->profile->mobile }}</td>
                    <td>{{ $member->profile->department }}</td>
                    <td class="col-year">{{$member->profile->graduation_year  }}</td>
                    <td><span class="badge badge-employed">{{ $member->profile->status }}</span></td>
                    <td>
                        <div class="action-btns">
                            <a href="{{ route('alumni.show',$member->id) }}" class="btn-icon view-btn"><i class="fas fa-eye"></i></a>
                             
                            <form action="{{ route('alumni.destroy',$member->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                 <button type="submit" class="btn-icon delete-btn" onclick="return(confirm('Are You Sure?'))"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                 @empty
                            <tr>
                        <td colspan="8" style="text-align: center;">
                            No Data Found!
                        </td>
                    </tr>
                 @endforelse
              
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('js')
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
</script>
@endpush