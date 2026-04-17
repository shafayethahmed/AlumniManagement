<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Alumni Portal | Member Access</title>
    <style>
        :root {
            --primary-navy: #0f172a;
            --accent-gold: #b5935b;
            --text-main: #1e293b;
            --text-muted: #64748b;
            --bg-body: #f8fafc;
            --border: #e2e8f0;
            --white: #ffffff;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: var(--bg-body);
            color: var(--text-main);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .portal-container {
            width: 100%;
            max-width: 850px;
            background: var(--white);
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border-top: 6px solid var(--primary-navy);
            overflow: hidden;
        }

        .header-section {
            text-align: center;
            padding: 40px 20px 20px;
        }

        .header-section h1 {
            font-size: 1.75rem;
            color: var(--primary-navy);
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-bottom: 8px;
        }

        .header-section p {
            color: var(--accent-gold);
            font-weight: 500;
            font-size: 0.9rem;
        }

        .nav-tabs {
            display: flex;
            justify-content: center;
            border-bottom: 1px solid var(--border);
            margin-bottom: 30px;
        }

        .tab-trigger {
            padding: 15px 30px;
            border: none;
            background: none;
            font-weight: 600;
            cursor: pointer;
            color: var(--text-muted);
            transition: 0.3s;
            position: relative;
        }

        .tab-trigger.active { color: var(--primary-navy); }
        .tab-trigger.active::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background: var(--accent-gold);
        }

        .form-wrapper { padding: 0 50px 50px; }

        .tab-content {
            display: none;
            animation: slideUp 0.4s ease-out;
        }

        .tab-content.active { display: block; }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-bottom: 20px;
        }

        .full-row { grid-column: span 2; }

        /* Professional Fields Container - Hidden by default */
        #proFields {
            display: none;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            grid-column: span 2;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .field-group label {
            display: block;
            font-size: 0.75rem;
            font-weight: 700;
            margin-bottom: 8px;
            color: var(--primary-navy);
            text-transform: uppercase;
        }

        input, select {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid var(--border);
            border-radius: 8px;
            font-size: 0.95rem;
            background-color: #fbfcfd;
        }

        input:focus, select:focus {
            outline: none;
            border-color: var(--accent-gold);
            background-color: #fff;
        }

        .btn-primary {
            width: 100%;
            padding: 16px;
            background-color: var(--primary-navy);
            color: var(--white);
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-primary:hover { background-color: #1e293b; }

        .alert-box {
            background: #ecfdf5;
            color: #065f46;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 25px;
            display: none;
            text-align: center;
        }

        @media (max-width: 768px) {
            .form-grid, #proFields { grid-template-columns: 1fr; }
            .full-row { grid-column: span 1; }
            .form-wrapper { padding: 0 25px 30px; }
        }
    </style>
</head>
<body>

<div class="portal-container">
    <div class="header-section">
        <h1>Alumni Network</h1>
        <p>Connecting Generations of Excellence</p>
    </div>

    <div class="nav-tabs">
        <button class="tab-trigger active" onclick="toggleTab('login', this)">Sign In</button>
        <button class="tab-trigger" onclick="toggleTab('register', this)">Register Profile</button>
    </div>

    <div class="form-wrapper">
        <div id="login" class="tab-content active">
            <div id="loginNotice" class="alert-box">Login successful.</div>
            <form onsubmit="handleLogin(event); return false;">
                <div class="field-group" style="margin-bottom: 20px;">
                    <label>Email</label>
                    <input type="email" id="loginEmail" placeholder="alumni@university.edu" required>
                </div>
                <div class="field-group" style="margin-bottom: 30px;">
                    <label>Password</label>
                    <input type="password" id="loginPass" placeholder="••••••••" required>
                </div>
                <button type="submit" class="btn-primary">Enter Portal</button>
            </form>
        </div>

        <div id="register" class="tab-content">
            <div id="regNotice" class="alert-box">Registration complete!</div>
            <form method="POST" action="{{ route('pedning.alumni.store') }}">
                @csrf
                <div class="form-grid">
                    <div class="field-group">
                        <label>Acadmic ID</label>
                        <input type="text" name="academic_id" required>
                    </div>
                    <div class="field-group">
                        <label>Full Name</label>
                        <input type="text" name="name" required>
                    </div>
                    <div class="field-group">
                        <label>Contact Number</label>
                        <input type="tel" name="mobile" required>
                    </div>
                    <div class="field-group">
                        <label>Admission Year</label>
                        <input type="number" name="admission_year" required>
                    </div>
                    <div class="field-group">
                        <label>Graduation Year</label>
                        <input type="number" name="graduation_year" required>
                    </div>
                    <div class="field-group">
                        <label>Department</label>
                        <input type="text" name="department" required>
                    </div>
                    <div class="field-group">
                        <label>Final CGPA</label>
                        <input type="number" step="0.01" name="final_result" required>
                    </div>

                    <div class="field-group full-row">
                        <label>Current Status</label>
                        <select name="status" id="rStatus" onchange="toggleProFields()" required>
                            <option value="Unemployed" selected>Unemployed</option>
                            <option value="Employed">Employed</option>
                        </select>
                    </div>

                    <div  name="proFields" id="proFields">
                        <div class="field-group">
                            <label>Current Company</label>
                            <input type="text" id="rCompany" name="company">
                        </div>
                        <div class="field-group">
                            <label>Designation</label>
                            <input type="text" id="rJob" name="job">
                        </div>
                    </div>

                    <div class="field-group full-row">
                        <label>Email Address</label>
                        <input type="email" id="rEmail"  name="email"  required>
                    </div>
                    <div class="field-group full-row">
                        <label>Create Password</label>
                        <input type="password" id="rPass" name="password" required>
                    </div>
                </div>
                <button type="submit" class="btn-primary">Create Alumni Account</button>
            </form>
        </div>
    </div>
</div>

<script>
    function toggleTab(id, btn) {
        document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
        document.querySelectorAll('.tab-trigger').forEach(t => t.classList.remove('active'));
        document.getElementById(id).classList.add('active');
        btn.classList.add('active');
    }

    // New Logic: Toggle Professional Fields
    function toggleProFields() {
        const status = document.getElementById('rStatus').value;
        const proFields = document.getElementById('proFields');
        const companyInput = document.getElementById('rCompany');
        const jobInput = document.getElementById('rJob');

        if (status === 'Employed') {
            proFields.style.display = 'grid';
            companyInput.setAttribute('required', 'true');
            jobInput.setAttribute('required', 'true');
        } else {
            proFields.style.display = 'none';
            companyInput.removeAttribute('required');
            jobInput.removeAttribute('required');
            companyInput.value = ""; // Clear values if user switches back
            jobInput.value = "";
        }
    }
</script>

</body>
</html>