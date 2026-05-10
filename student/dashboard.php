<?php
session_start();

if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'student'){
    header("Location: ../login.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="../Assets/styles/ui.css">
    <style>
        .student-hero {
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 20px;
            background: linear-gradient(125deg, #f0fdfa 0%, #ecfeff 60%, #f8fafc 100%);
            margin-bottom: 16px;
        }

        .student-hero h2 {
            margin: 0 0 8px;
            font-size: 1.25rem;
        }

        .student-hero p {
            margin: 0;
            color: var(--text-muted);
        }

        .student-chip-row {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 14px;
        }

        .student-chip {
            border: 1px solid #99f6e4;
            background: #ffffff;
            color: #0f766e;
            padding: 6px 10px;
            border-radius: 999px;
            font-size: 0.8rem;
            font-weight: 700;
            letter-spacing: 0.02em;
            text-transform: uppercase;
        }

        .section-title {
            margin: 18px 0 10px;
            font-size: 1rem;
            color: #334155;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }

        .student-secondary {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 12px;
            margin-top: 10px;
        }

        .student-secondary .card-mini {
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 14px;
            background: #fff;
        }

        .card-mini h3 {
            margin: 0 0 8px;
            font-size: 1rem;
        }

        .card-mini p {
            margin: 0 0 12px;
            color: var(--text-muted);
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
<div class="page">
    <div class="card">
        <div class="topbar">
            <h1>Student Dashboard</h1>
            <a class="btn btn-muted" href="../logout.php">Logout</a>
        </div>
        <div class="student-hero">
            <h2>Career Readiness Center</h2>
            <p>Keep your profile complete, apply to relevant roles, and monitor your selection progress.</p>
            <div class="student-chip-row">
                <span class="student-chip">Profile</span>
                <span class="student-chip">Applications</span>
                <span class="student-chip">Opportunities</span>
            </div>
        </div>

        <p class="section-title">Primary Actions</p>
        <div class="grid">
            <a class="nav-tile" href="profile.php">
                <h3>Update Profile</h3>
                <p>Maintain your academic details, contact info, and skills.</p>
            </a>
            <a class="nav-tile" href="view_profile.php">
                <h3>View Profile</h3>
                <p>Preview the information visible to placement officers.</p>
            </a>
            <a class="nav-tile" href="view_jobs.php">
                <h3>Explore Jobs</h3>
                <p>Browse current openings and role requirements.</p>
            </a>
            <a class="nav-tile" href="my_applications.php">
                <h3>My Applications</h3>
                <p>Track submitted applications and status updates.</p>
            </a>
        </div>

        <p class="section-title">Quick Links</p>
        <div class="student-secondary">
            <div class="card-mini">
                <h3>Application Workflow</h3>
                <p>Review roles in Explore Jobs, then follow status in My Applications.</p>
                <a class="btn btn-muted" href="view_jobs.php">Open Jobs</a>
            </div>
            <div class="card-mini">
                <h3>Profile Completeness</h3>
                <p>Updated profile data improves visibility for suitable opportunities.</p>
                <a class="btn btn-muted" href="profile.php">Edit Profile</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>
