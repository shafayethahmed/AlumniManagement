@extends('user.layout')

@section('content')

@push('css')
<style>
/* Modern Minimalist UI - Black & White Industry Standard */
:root {
    --bg-main: #ffffff;
    --bg-subtle: #f9fafb;
    --text-main: #111827;
    --text-muted: #6b7280;
    --border-color: #e5e7eb;
    --accent-black: #000000;
    --danger: #dc2626;
    --radius: 8px;
}

body { background-color: var(--bg-subtle); color: var(--text-main); font-family: 'Inter', sans-serif; }

.section-title { font-size: 1.25rem; font-weight: 700; color: var(--accent-black); margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.5rem; }

.glass-card { background: var(--bg-main); border: 1px solid var(--border-color); border-radius: var(--radius); padding: 1.5rem; margin-bottom: 1.5rem; }

.info-grid { display: grid; gap: 1rem; }
.info-item { display: flex; flex-direction: column; border-bottom: 1px solid var(--bg-subtle); padding-bottom: 0.5rem; }
.info-label { font-size: 0.75rem; text-transform: uppercase; font-weight: 600; color: var(--text-muted); margin-bottom: 0.25rem; }
.info-value { font-size: 0.95rem; font-weight: 500; }

.custom-table { width: 100%; border-collapse: collapse; }
.custom-table th { background: var(--bg-subtle); color: var(--text-muted); font-size: 0.75rem; text-transform: uppercase; padding: 1rem; border-bottom: 2px solid var(--accent-black); }
.custom-table td { padding: 1rem; border-bottom: 1px solid var(--border-color); font-size: 0.9rem; vertical-align: middle; }

/* Inline Form Styling */
#experienceFormContainer, #editExperienceFormContainer {
    display: none; 
    border: 2px solid var(--accent-black);
    animation: slideDown 0.3s ease-out;
}

@keyframes slideDown {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}

.form-control { border-radius: 6px; border: 1px solid var(--border-color); padding: 0.6rem; margin-bottom: 10px; font-size: 0.9rem; width: 100%; }
.form-control:focus { border-color: var(--accent-black); box-shadow: none; outline: none; }

.btn-black { background: var(--accent-black); color: white; padding: 0.6rem 1.2rem; border-radius: var(--radius); text-decoration: none; font-size: 0.875rem; font-weight: 500; border: 1px solid var(--accent-black); cursor: pointer; transition: 0.2s; display: inline-flex; align-items: center; }
.btn-black:hover { background: white; color: var(--accent-black); }

.btn-outline { background: white; border: 1px solid var(--border-color); color: var(--text-main); padding: 0.4rem 0.8rem; border-radius: 6px; font-size: 0.75rem; font-weight: 600; cursor: pointer; transition: 0.2s; }
.btn-outline:hover { border-color: var(--accent-black); background: var(--bg-subtle); }

.close-form { cursor: pointer; color: var(--text-muted); transition: 0.2s; }
.close-form:hover { color: var(--accent-black); }
</style>
@endpush

<div class="container py-5">
    <div class="row">
        <div class="col-lg-4">
            <h2 class="section-title">Personal Information</h2>
            <div class="glass-card">
                <div class="info-grid">
                    <div class="info-item"><span class="info-label">Full Name</span><span class="info-value" id="name">...</span></div>
                    <div class="info-item"><span class="info-label">Email</span><span class="info-value" id="email">...</span></div>
                    <div class="info-item"><span class="info-label">Mobile</span><span class="info-value" id="mobile">...</span></div>
                </div>
            </div>

            <h2 class="section-title">Academic Information</h2>
            <div class="glass-card">
                <div class="info-grid">
                    <div class="info-item"><span class="info-label">Department</span><span class="info-value" id="department">...</span></div>
                    <div class="info-item"><span class="info-label">Student ID</span><span class="info-value" id="academic_id">...</span></div>
                    <div class="info-item"><span class="info-label">CGPA</span><span class="info-value" id="cgpa">...</span></div>
                    <div class="info-item"><span class="info-label">Timeline</span><span class="info-value"><span id="admission"></span> — <span id="graduation"></span></span></div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="section-title mb-0">Professional Experience</h2>
                <button class="btn-black" onclick="openExperienceForm()">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right:8px"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                    New Entry
                </button>
            </div>

            <div id="experienceFormContainer" class="glass-card mb-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold m-0">Add New Experience</h5>
                    <span class="close-form" onclick="toggleForm(false)">
                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M18 6L6 18M6 6l12 12"></path></svg>
                    </span>
                </div>
                
                <form id="expForm" action="{{ route('experience.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <label class="info-label">Organization</label>
                            <input type="text" name="company" class="form-control" placeholder="Company Name" required>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="info-label">Role</label>
                            <input type="text" name="position" class="form-control" placeholder="Job Title" required>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="info-label">Started Date</label>
                            <input type="date" name="started_at" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="info-label">End Date (Optional)</label>
                            <input type="date" name="resign_at" class="form-control">
                        </div>
                        <div class="col-12 d-flex justify-content-end mt-3">
                            <button type="submit" class="btn-black">Save Record</button>
                        </div>
                    </div>
                </form>
            </div>

            <div id="editExperienceFormContainer" class="glass-card mb-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold m-0">Edit Experience</h5>
                    <span class="close-form" onclick="toggleEditForm(false)">
                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M18 6L6 18M6 6l12 12"></path></svg>
                    </span>
                </div>
                
                <form id="editExpForm" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                    <input type="hidden" name="id" id="edit_exp_id">
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <label class="info-label">Organization</label>
                            <input type="text" id="edit_form_company" name="company" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="info-label">Role</label>
                            <input type="text" id="edit_form_position" name="position" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="info-label">Started Date</label>
                            <input type="date" id="edit_form_started" name="started_at" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="info-label">End Date (Optional)</label>
                            <input type="date" id="edit_form_ended" name="resign_at" class="form-control">
                        </div>
                        <div class="col-12 d-flex justify-content-end mt-3">
                            <button type="submit" class="btn-black">Update Record</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="glass-card p-0 overflow-hidden">
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th>Organization</th>
                            <th>Role</th>
                            <th>Period</th>
                            <th style="text-align: center;">Action</th>
                        </tr>
                    </thead>
                    <tbody id="experienceTable">
                        <tr><td colspan="4" class="text-center py-5">Loading...</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>

 window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
let token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
}


const userId = {{ auth()->id() }};
let experiences = [];

function toggleForm(show) {
    document.getElementById('experienceFormContainer').style.display = show ? 'block' : 'none';
    if(show) toggleEditForm(false);
}

function toggleEditForm(show) {
    document.getElementById('editExperienceFormContainer').style.display = show ? 'block' : 'none';
    if(show) toggleForm(false);
}

function openExperienceForm() {
    document.getElementById('expForm').reset();
    toggleForm(true);
}

function openEditExperienceForm(id) {
    const exp = experiences.find(e => e.id == id);
    if (exp) {
        document.getElementById('edit_exp_id').value = exp.id;
        document.getElementById('edit_form_company').value = exp.company;
        document.getElementById('edit_form_position').value = exp.position;
        document.getElementById('edit_form_started').value = exp.started_at;
        document.getElementById('edit_form_ended').value = exp.resign_at || '';
        toggleEditForm(true);
    }
}

function loadData() {
    axios.get('/api/profile/'+userId).then(res => {
        const user = res.data.data;
        experiences = user.experiences || [];
        
        document.getElementById('name').innerText = user.name || 'N/A';
        document.getElementById('email').innerText = user.email || 'N/A';
        document.getElementById('mobile').innerText = user.profile?.mobile || 'N/A';
        document.getElementById('department').innerText = user.profile?.department || 'N/A';
        document.getElementById('academic_id').innerText = user.profile?.academic_id || 'N/A';
        document.getElementById('cgpa').innerText = user.profile?.cgpa || 'N/A';
        document.getElementById('admission').innerText = user.profile?.admission_year || 'N/A';
        document.getElementById('graduation').innerText = user.profile?.graduation_year || 'N/A';

        renderTable();
    });
}

function renderTable() {
    const tbody = document.getElementById('experienceTable');
    tbody.innerHTML = experiences.map(exp => `
        <tr>
            <td style="text-align:center"><span style="font-weight: 700;">${exp.company}</span></td>
            <td style="text-align:center">${exp.position}</td>
            <td style="text-align:center" class="text-muted">${exp.started_at} — ${exp.resign_at ? exp.resign_at : 'Present'}</td>
            <td style="text-align: center;">
                <button onclick="openEditExperienceForm(${exp.id})" class="btn-outline">Edit</button>
                <button onclick="deleteExp(${exp.id})" class="btn-outline text-danger">Delete</button>
            </td>
        </tr>
    `).join('') || '<tr><td colspan="4" class="text-center py-5">No history found.</td></tr>';
}

// CREATE SUBMIT
document.getElementById('expForm').addEventListener('submit', function(e) {
    e.preventDefault();
    axios.post(this.action, new FormData(this))
        .then(() => { toggleForm(false); loadData(); })
        .catch(err => console.error(err));
});

// EDIT SUBMIT (The Fix)
document.getElementById('editExpForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const id = document.getElementById('edit_exp_id').value;
    const formData = new FormData(this);

    // We use POST because FormData + Method Spoofing (_method: PUT) 
    // is the most reliable way for Laravel to receive data.
    axios.post(`/experience/${id}`, formData)
        .then(() => { 
            toggleEditForm(false); 
            loadData(); 
        })
        .catch(err => alert('Update failed. Check console.'));
});

function deleteExp(id) {
    // Show the ID inside the confirmation box
    if(confirm(`Are you sure you want to delete record ID: ${id}?`)) {
        
        axios.delete(`/experience/${id}`)
            .then(response => {
                loadData(); // Refresh the table
                console.log('Deleted ID:', id);
            })
            .catch(error => {
                // This will alert the actual error from Laravel (e.g., "Record not found")
                console.error('Full Error:', error.response);
                alert('Error: ' + (error.response.data.message || 'Server error'));
            });
    }
}
loadData();
</script>
@endpush