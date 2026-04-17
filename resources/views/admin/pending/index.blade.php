@extends('admin.layout')

@section('title', 'Pending Requests')

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
        gap: 10px;
    }

    /* Industry Search Bar */
    .search-box {
        position: relative;
        width: 300px;
    }

    .search-box input {
        width: 100%;
        padding: 8px 12px 8px 35px;
        font-size: 0.85rem;
        border: 1px solid #e2e8f0;
        border-radius: 6px;
        outline: none;
        transition: 0.2s;
    }

    .search-box input:focus {
        border-color: #b5935b;
        box-shadow: 0 0 0 3px rgba(181, 147, 91, 0.1);
    }

    .search-box i {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
    }

    .custom-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.85rem;
    }

    .custom-table th {
        background-color: #f1f5f9;
        color: #475569;
        padding: 8px 12px;
        font-weight: 600;
        text-transform: uppercase;
        border: 1px solid #e2e8f0;
        white-space: nowrap;
    }

    .custom-table td {
        padding: 8px 12px;
        border: 1px solid #e2e8f0;
        color: #1e293b;
        vertical-align: middle;
        white-space: nowrap;
    }

    .custom-table tr:hover {
        background-color: #f8fafc;
    }

    .btn-icon-sm {
        width: 28px;
        height: 28px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 4px;
        border: 1px solid #e2e8f0;
        color: #64748b;
        transition: 0.2s;
        cursor: pointer;
        background: #fff;
    }

    .btn-icon-sm:hover {
        background: #0f172a;
        color: #fff;
    }

    .btn-action {
        padding: 5px 12px;
        border-radius: 4px;
        font-size: 0.75rem;
        font-weight: 700;
        cursor: pointer;
        border: none;
        transition: 0.2s;
    }

    .approve-btn { background: #10b981; color: #fff; }
    .reject-btn { background: #fee2e2; color: #ef4444; margin-left: 5px; }

    /* Small badge for years */
    .year-badge {
        font-size: 0.7rem;
        background: #f1f5f9;
        color: #475569;
        padding: 2px 5px;
        border-radius: 3px;
        font-weight: 600;
    }
</style>
@endpush

@section('content')
<div class="table-container">
    <div class="table-controls">
        <div class="search-box">
            <i class="fas fa-search"></i>
            <input type="text" id="memberSearch" placeholder="Search by name, ID, or email..." onkeyup="filterTable()">
        </div>
        <div style="font-size: 0.8rem; color: #64748b;">
            Total Pending: <span id="pendingCount">{{ count($pendingMembers) }}</span>
        </div>
    </div>

    <div style="overflow-x: auto;">
        <table class="custom-table" id="pendingTable">
            <thead>
                <tr>
                    <th>Academic ID</th>
                    <th>Full Name</th>
                    <th>Dept.</th>
                    <th>Admission</th>
                    <th>Graduation</th>
                    <th>CGPA</th>
                    <th style="text-align: center;">Details</th>
                    <th style="text-align: center;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pendingMembers as $pm )
                            <tr>
                            <td style="font-family: monospace; font-weight: 600;">{{ $pm->academic_id }}</td>
                            <td><strong>{{ ucwords($pm->name) }}</strong><br><small>{{ $pm->email }}</small></td>
                            <td>CSE</td>
                            <td><span class="year-badge">{{ $pm->admission_year }}</span></td>
                            <td><span class="year-badge">{{ $pm->graduation_year }}</span></td>
                            <td>{{ $pm->final_result }}</td>
                            <td style="text-align: center;">
                                <a href="{{ route('admin.pending.show', $pm->id) }}"><i class="fas fa-eye"></i></a>
                            </td>
                            <td style="text-align: center;">
                                <a href="{{ route('admin.pending.confirm',$pm->id) }}" class="btn-action approve-btn" style="text-decoration: none;"  >APPROVE</a> 
                                 <form action="{{ route('admin.pending.reject',$pm->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                   <button type="submit" class="btn-action reject-btn"   onclick="return confirm('Are You Sure?')" style="border:none; background:none;">REJECT </button>
                                 </form>
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
    function filterTable() {
        const input = document.getElementById("memberSearch");
        const filter = input.value.toUpperCase();
        const table = document.getElementById("pendingTable");
        const tr = table.getElementsByTagName("tr");

        for (let i = 1; i < tr.length; i++) {
            let visible = false;
            let tds = tr[i].getElementsByTagName("td");
            for (let j = 0; j < tds.length - 1; j++) { // Loop through all cells except actions
                if (tds[j] && tds[j].innerText.toUpperCase().indexOf(filter) > -1) {
                    visible = true;
                }
            }
            tr[i].style.display = visible ? "" : "none";
        }
    }

</script>
@endpush