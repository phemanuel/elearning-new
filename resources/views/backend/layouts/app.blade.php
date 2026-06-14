<!DOCTYPE html>
<html lang="{{str_replace('_','_', app()->getLocale())}}">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>{{ config('app.name') }} | @yield('title')</title>

    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('images/favicon.png')}}">
    <link rel="stylesheet" href="{{asset('vendor/bootstrap-select/dist/css/bootstrap-select.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <!-- <link href="{{asset('frontend/summernote/summernote-lite.min.css')}}" rel="stylesheet"> -->
    <link href="https://cdn.jsdelivr.net/npm/summernote/dist/summernote-lite.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    
    @stack('styles')
    <style>
       /* Ensure long URLs wrap properly */
.long-url {
    word-break: break-all; /* Allows the URL to break within words if necessary */
    overflow-wrap: break-word; /* Ensures the URL breaks in small containers */
    white-space: normal; /* Allows the text to wrap normally */
    width: 100%; /* Ensure the URL takes up available space */
}

/* Alternative: Truncate the URL with ellipsis if it overflows */
.ellipsis-url {
    display: block;
    max-width: 100%;        /* Ensure it fits the container */
    white-space: nowrap;    /* Prevent wrapping */
    overflow: hidden;       /* Hide the overflow */
    text-overflow: ellipsis; /* Show ellipsis if text overflows */
    word-break: break-word; /* Prevents breaking in the middle of URLs */
}
    </style>
    <style>
        .progress {
    height: 20px;
    margin-top: 15px;
}


.progress-bar {
    background-color: green;
    transition: width 0.4s ease-in-out;
    font-size: 14px;
    font-weight: bold;
    line-height: 25px; /* Matches progress bar height for perfect centering */
}
    </style>
    <style>
      .scrollable-list {
    max-height: 100px; /* Limit the height */
    overflow-y: auto; /* Enable vertical scrolling */
    border: 1px solid #ddd; /* Optional: border for better visibility */
    padding: 10px;
    border-radius: 5px;
    background-color: #f9f9f9;
}

.bullet-list {
    list-style-type: disc !important; /* Force bullets */
    padding-left: 20px; /* Indent to display bullets properly */
    margin: 0;
}

.bullet-list li {
    margin-bottom: 5px; /* Add spacing between items */
    font-size: 14px; /* Adjust font size for readability */
    color: #333; /* Optional: Set text color */
}
    </style>
    <style>
    .scrollable-list-container {
    max-height: 350px; /* Adjust height as needed */
    overflow-y: auto; /* Enables vertical scrolling */
    overflow-x: hidden; /* Prevents horizontal scrolling */
    border: 1px solid #ddd; /* Optional: adds a border for clarity */
    padding: 10px; /* Optional: spacing around the list */
    background-color: #fff; /* Optional: ensures the background stays consistent */
}

/* Optional: Add a scrollbar style for better aesthetics */
.scrollable-list-container::-webkit-scrollbar {
    width: 8px;
}

.scrollable-list-container::-webkit-scrollbar-thumb {
    background: #ccc;
    border-radius: 4px;
}

.scrollable-list-container::-webkit-scrollbar-thumb:hover {
    background: #999;
}

</style>
<style>
/* Google Font */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

.dashboard-card{
    background:#fff;
    border-radius:20px;
    padding:25px;
    display:flex;
    align-items:center;
    gap:18px;
    min-height:130px;

    box-shadow:
        0 10px 25px rgba(0,0,0,.05);

    transition:.35s ease;
    border-left:5px solid;
}

.dashboard-card:hover{
    transform:translateY(-8px);
    box-shadow:
        0 18px 35px rgba(0,0,0,.12);
}

.card-icon{
    width:65px;
    height:65px;
    border-radius:18px;

    display:flex;
    align-items:center;
    justify-content:center;

    font-size:32px;
    flex-shrink:0;
}

.card-icon i{
    font-size:32px;
}

.card-content{
    flex:1;
}

.card-label{
    display:block;
    color:#6b7280;
    font-size:14px;
    font-weight:500;
    margin-bottom:8px;
    text-transform:uppercase;
    letter-spacing:.8px;
}

.card-value{
    margin:0;
    font-size:34px;
    font-weight:700;
    color:#111827;
}

/* Blue */
.card-primary{
    border-color:#2563eb;
}

.card-primary .card-icon{
    background:#dbeafe;
    color:#2563eb;
}

/* Green */
.card-success{
    border-color:#10b981;
}

.card-success .card-icon{
    background:#d1fae5;
    color:#10b981;
}

/* Orange */
.card-warning{
    border-color:#f59e0b;
}

.card-warning .card-icon{
    background:#fef3c7;
    color:#f59e0b;
}

/* Purple */
.card-action{
    border-color:#7c3aed;
}

.card-action .card-icon{
    background:#ede9fe;
    color:#7c3aed;
}

/* -------------------- */
.course-card{
    background:#fff;
    border-radius:20px;
    overflow:hidden;
    box-shadow:0 10px 30px rgba(0,0,0,.08);
    transition:.3s;
    height:100%;
}

.course-card:hover{
    transform:translateY(-8px);
    box-shadow:0 20px 40px rgba(0,0,0,.15);
}

.course-image{
    position:relative;
}

.course-image img{
    width:100%;
    height:220px;
    object-fit:cover;
}

.course-status{
    position:absolute;
    top:15px;
    right:15px;
    padding:6px 14px;
    border-radius:30px;
    color:#fff;
    font-size:12px;
    font-weight:600;
}

/* .active{
    background:#10b981;
} */

.course-body{
    padding:20px;
}

.course-title{
    font-weight:700;
    color:#1f2937;
    min-height:55px;
}

.course-category{
    color:#6b7280;
    font-size:14px;
    margin-bottom:15px;
}

.badge-level{
    background:#eef2ff;
    color:#4338ca;
    padding:8px 15px;
    border-radius:20px;
}

.course-stats{
    display:flex;
    justify-content:space-between;
    margin-top:20px;
    text-align:center;
}

.course-stats h4{
    margin-bottom:3px;
    font-weight:700;
}

.course-stats small{
    color:#6b7280;
}

.course-footer{
    padding:15px 20px;
    border-top:1px solid #eee;
    display:flex;
    justify-content:space-between;
}

.empty-course-card{
    background:#fff;
    border-radius:20px;
    padding:60px 30px;
    text-align:center;
    box-shadow:0 10px 30px rgba(0,0,0,.08);
    border:2px dashed #dbeafe;
}

.empty-icon{
    width:90px;
    height:90px;
    margin:0 auto 20px;
    border-radius:50%;
    background:#eff6ff;
    display:flex;
    align-items:center;
    justify-content:center;
}

.empty-icon i{
    font-size:42px;
    color:#2563eb;
}

.empty-course-card h4{
    font-weight:700;
    color:#1f2937;
    margin-bottom:10px;
}

.empty-course-card p{
    color:#6b7280;
    max-width:450px;
    margin:0 auto 25px;
    line-height:1.6;
}
</style>
<style>
.dashboard-card{
    position:relative;
    overflow:hidden;

    border-radius:22px;

    padding:30px 25px;

    min-height:170px;

    color:#fff;

    box-shadow:0 12px 30px rgba(0,0,0,.15);

    transition:.35s ease;
}

.dashboard-card:hover{
    transform:translateY(-8px) scale(1.02);
    box-shadow:0 20px 45px rgba(0,0,0,.25);
}

.dashboard-card-content{
    position:relative;
    z-index:2;
}

.card-title{
     color:#ffffff !important;
    display:block;
    font-size:15px;
    font-weight:600;
    letter-spacing:.5px;
    opacity:.9;
    margin-bottom:10px;
}

.card-number{
     color:#ffffff !important;
    font-size:38px;
    font-weight:800;
    margin-bottom:5px;
    line-height:1;
}

.dashboard-card small{
    font-size:13px;
    opacity:.9;
}

.card-bg-icon{
    position:absolute;
    right:-10px;
    bottom:-10px;
    z-index:1;
}

.card-bg-icon i{
    font-size:120px;
    color:rgba(255,255,255,.15);
}

/* Students */
.students-card{
    background:linear-gradient(
        135deg,
        #4f46e5,
        #7c3aed
    );
}

/* Courses */
.courses-card{
    background:linear-gradient(
        135deg,
        #0891b2,
        #06b6d4
    );
}

/* Revenue */
.revenue-card{
    background:linear-gradient(
        135deg,
        #16a34a,
        #22c55e
    );
}

/* Coupons */
.coupon-card{
    background:linear-gradient(
        135deg,
        #ea580c,
        #f97316
    );
}

/* Mobile */
@media(max-width:768px){

    .dashboard-card{
        min-height:150px;
        padding:25px 20px;
    }

    .card-number{
        font-size:30px;
    }

    .card-bg-icon i{
        font-size:90px;
    }
}

/* enrolled students */
.enrolled-card{
    border-radius:24px;
    box-shadow:0 10px 30px rgba(0,0,0,.06);
}

.student-counter{
    background:#eef4ff;
    color:#2563eb;
    padding:10px 18px;
    border-radius:30px;
    font-weight:600;
}

.modern-table{
    border-collapse:separate;
    border-spacing:0 12px;
}

.modern-table thead th{
    border:none;
    color:#64748b;
    font-size:13px;
    text-transform:uppercase;
    letter-spacing:.8px;
    font-weight:700;
}

.modern-table tbody tr{
    background:#fff;
    box-shadow:0 3px 12px rgba(0,0,0,.04);
    transition:.3s;
}

.modern-table tbody tr:hover{
    transform:translateY(-2px);
    box-shadow:0 10px 25px rgba(0,0,0,.08);
}

.modern-table td{
    padding:18px !important;
    border:none;
    vertical-align:middle;
}

.student-avatar{
    width:50px;
    height:50px;
    border-radius:50%;
    object-fit:cover;
    border:3px solid #e0e7ff;
}

.course-pill{
    background:#f8fafc;
    padding:8px 14px;
    border-radius:20px;
    font-size:13px;
    font-weight:600;
    display:inline-block;
}

.metric-badge{
    background:#eff6ff;
    color:#2563eb;
    padding:6px 14px;
    border-radius:20px;
    font-weight:700;
}

.active-segment{
    background:#dcfce7;
    color:#16a34a;
}

.modern-progress{
    height:8px;
    border-radius:20px;
    background:#e5e7eb;
    margin-bottom:5px;
}

.modern-progress .progress-bar{
    background:linear-gradient(
        90deg,
        #3b82f6,
        #06b6d4
    );
    border-radius:20px;
}

.status-completed{
    background:#dcfce7;
    color:#15803d;
    padding:8px 14px;
    border-radius:20px;
    font-size:12px;
    font-weight:700;
}

.status-progress{
    background:#fef3c7;
    color:#b45309;
    padding:8px 14px;
    border-radius:20px;
    font-size:12px;
    font-weight:700;
}

/* subscription widget */
.compact-subscription{
    background:#fff;
}

.subscription-top{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:20px;
}

.subscription-icon{
    width:55px;
    height:55px;

    border-radius:14px;

    background:linear-gradient(
        135deg,
        #2563eb,
        #4f46e5
    );

    display:flex;
    align-items:center;
    justify-content:center;

    color:#fff;
    font-size:22px;
}

.subscription-status{
    background:#dcfce7;
    color:#15803d;

    padding:4px 12px;

    border-radius:30px;

    font-size:12px;
    font-weight:600;
}

.subscription-stats{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:10px;

    margin-bottom:20px;
}

.mini-stat{
    background:#f8fafc;

    border-radius:12px;

    padding:12px;

    text-align:center;
}

.mini-stat i{
    display:block;

    margin-bottom:6px;

    color:#2563eb;
}

.mini-stat strong{
    display:block;
    font-size:15px;
}

.mini-stat small{
    color:#64748b;
}

.subscription-footer{
    border-top:1px solid #e2e8f0;

    padding-top:15px;

    display:flex;
    justify-content:space-between;
    align-items:center;
}

.subscription-footer small{
    color:#64748b;
}

/* course section */
.courses-dashboard-card{
    border-radius:24px;
    box-shadow:0 10px 30px rgba(0,0,0,.06);
}

.course-count-badge{
    background:#eef4ff;
    color:#2563eb;
    padding:10px 18px;
    border-radius:30px;
    font-weight:600;
}

.course-table{
    border-collapse:separate;
    border-spacing:0 12px;
}

.course-table thead th{
    border:none;
    color:#64748b;
    text-transform:uppercase;
    font-size:12px;
    letter-spacing:.8px;
    font-weight:700;
}

.course-table tbody tr{
    background:#fff;
    box-shadow:0 4px 15px rgba(0,0,0,.04);
    transition:.3s;
}

.course-table tbody tr:hover{
    transform:translateY(-2px);
    box-shadow:0 10px 25px rgba(0,0,0,.08);
}

.course-table td{
    border:none;
    padding:18px !important;
}

.course-thumb{
    width:80px;
    height:55px;
    object-fit:cover;
    border-radius:12px;
}

.segments-pill{
    background:#dbeafe;
    color:#2563eb;
    padding:8px 15px;
    border-radius:20px;
    font-weight:700;
}

.category-pill{
    background:#f8fafc;
    color:#475569;
    padding:8px 15px;
    border-radius:20px;
    font-weight:600;
}

.price-tag{
    color:#16a34a;
    font-weight:700;
}

.free-course{
    background:#dcfce7;
    color:#15803d;
    padding:6px 14px;
    border-radius:20px;
    font-weight:700;
}

.difficulty{
    padding:8px 15px;
    border-radius:20px;
    font-weight:600;
    font-size:13px;
}

.beginner{
    background:#dcfce7;
    color:#15803d;
}

.intermediate{
    background:#fef3c7;
    color:#b45309;
}

.advanced{
    background:#fee2e2;
    color:#dc2626;
}

.status-active{
    background:#dcfce7;
    color:#15803d;
    padding:8px 15px;
    border-radius:20px;
    font-weight:700;
}

.status-pending{
    background:#fef3c7;
    color:#b45309;
    padding:8px 15px;
    border-radius:20px;
    font-weight:700;
}

.status-inactive{
    background:#fee2e2;
    color:#dc2626;
    padding:8px 15px;
    border-radius:20px;
    font-weight:700;
}

.student-counter{
    background:linear-gradient(135deg,#2563eb,#4f46e5);
    color:#fff;
    padding:12px 22px;
    border-radius:50px;
    font-weight:600;
    font-size:14px;
    box-shadow:0 8px 20px rgba(37,99,235,.25);
    white-space:nowrap;
}

.student-counter i{
    font-size:16px;
}

/* profile-link card */
.profile-link-card{
    background:#fff;
    border-radius:18px;
    padding:18px 22px;

    display:flex;
    align-items:center;
    gap:15px;

    box-shadow:0 8px 25px rgba(0,0,0,.06);

    transition:.3s;
}

.profile-link-card:hover{
    transform:translateY(-2px);
}

.profile-link-icon{
    width:55px;
    height:55px;

    border-radius:14px;

    background:linear-gradient(
        135deg,
        #2563eb,
        #4f46e5
    );

    color:#fff;

    display:flex;
    align-items:center;
    justify-content:center;

    font-size:20px;

    flex-shrink:0;
}

.profile-link-content{
    flex:1;
    overflow:hidden;
}

.profile-link-content h6{
    font-weight:700;
    margin-bottom:4px;
    color:#1e293b;
}

.profile-link{
    color:#2563eb;
    text-decoration:none;

    white-space:nowrap;
    overflow:hidden;
    text-overflow:ellipsis;

    display:block;
}

.profile-link:hover{
    color:#1d4ed8;
}

.copy-profile-btn{
    border-radius:12px;
    padding:8px 16px;
    white-space:nowrap;
}
</style>
<style>
    
/* =========================
   PREMIUM LMS DESIGN SYSTEM
========================= */

:root {
    --lms-bg: #f6f8fc;
    --lms-card: #ffffff;
    --lms-border: #e6eaf0;
    --lms-text: #0f172a;
    --lms-muted: #64748b;

    --lms-primary: #2563eb;
    --lms-success: #16a34a;
    --lms-warning: #f59e0b;
    --lms-danger: #ef4444;

    --lms-shadow-sm: 0 2px 8px rgba(15, 23, 42, 0.06);
    --lms-shadow-md: 0 10px 25px rgba(15, 23, 42, 0.08);

    --lms-radius: 18px;
}

/* =========================
   PAGE BACKGROUND (KEY UPGRADE)
========================= */

body {
    background: linear-gradient(180deg, #f6f8fc 0%, #f1f5f9 100%);
    color: var(--lms-text);
    font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Arial;
}

/* =========================
   LMS CARD (NOW PREMIUM)
========================= */

.lms-card {
    background: var(--lms-card);
    border: 1px solid var(--lms-border);
    border-radius: var(--lms-radius);
    overflow: hidden;
    box-shadow: var(--lms-shadow-sm);
    transition: all 0.25s ease;

     /* ✅ THIS FIXES EDGE TOUCH ISSUE */
    padding: 7px;
}

.lms-card:hover {
    transform: translateY(-2px);
    box-shadow: var(--lms-shadow-md);
}

/* =========================
   CARD HEADER (MODERN LOOK)
========================= */

.lms-card-header {
    padding: 16px 20px;
    background: linear-gradient(180deg, #ffffff 0%, #f9fafb 100%);
    border-bottom: 1px solid var(--lms-border);
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.lms-card-title {
    font-size: 16px;
    font-weight: 700;
    color: var(--lms-text);
    letter-spacing: -0.2px;
}

/* =========================
   TABLE SYSTEM (CLEAN + BREATHING SPACE)
========================= */

.lms-table-wrapper {
    width: 100%;
    overflow-x: auto;
}

.lms-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 14px;
}

/* Header */
.lms-table thead {
    background: #f8fafc;
}

.lms-table thead th {
    text-align: left;
    padding: 14px 18px;
    font-size: 11px;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    color: var(--lms-muted);
}

/* Body */
.lms-table tbody tr {
    border-bottom: 1px solid var(--lms-border);
    transition: background 0.2s ease;
}

.lms-table tbody tr:hover {
    background: #f9fbff;
}

.lms-table tbody td {
    padding: 14px 18px;
    color: var(--lms-text);
    vertical-align: middle;
}

/* =========================
   AVATAR (MORE MODERN)
========================= */

.lms-avatar {
    width: 42px;
    height: 42px;
    border-radius: 14px;
    object-fit: cover;
    border: 2px solid #eef2ff;
    box-shadow: 0 2px 6px rgba(0,0,0,0.06);
}

/* =========================
   BADGES (SOFT PILL STYLE)
========================= */

.lms-badge {
    display: inline-flex;
    align-items: center;
    padding: 5px 12px;
    font-size: 12px;
    font-weight: 600;
    border-radius: 999px;
}

.lms-badge-success {
    background: rgba(22, 163, 74, 0.12);
    color: var(--lms-success);
}

.lms-badge-warning {
    background: rgba(245, 158, 11, 0.12);
    color: var(--lms-warning);
}

.lms-badge-danger {
    background: rgba(239, 68, 68, 0.12);
    color: var(--lms-danger);
}

/* =========================
   PROGRESS BAR (IMPORTANT LMS FEATURE)
========================= */

.lms-progress {
    width: 140px;
    height: 6px;
    background: #e5e7eb;
    border-radius: 999px;
    overflow: hidden;
}

.lms-progress-bar {
    height: 100%;
    background: linear-gradient(90deg, #2563eb, #60a5fa);
    border-radius: 999px;
}

/* =========================
   SCROLL AREA
========================= */

.lms-scroll {
    max-height: 370px;
    overflow-y: auto;
}

/* =========================
   LMS BUTTON SYSTEM
========================= */

.lms-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;

    padding: 8px 14px;
    border-radius: 10px;

    font-size: 13px;
    font-weight: 600;

    text-decoration: none;

    background: #2563eb; /* PRIMARY BLUE */
    color: #ffffff;

    border: 1px solid transparent;

    transition: all 0.2s ease;
    cursor: pointer;
}

.lms-btn:hover {
    background: #1d4ed8;
    transform: translateY(-1px);
}

/* Danger button */
.lms-btn-danger {
    background: #ef4444;
    color: #fff;
}

.lms-btn-danger:hover {
    background: #dc2626;
}

/* Secondary button */
.lms-btn-secondary {
    background: #f1f5f9;
    color: #0f172a;
    border: 1px solid #e2e8f0;
}

.lms-btn-secondary:hover {
    background: #e2e8f0;
}

/* Success button */
.lms-btn-success {
    background: #10b981;
    color: #fff;
}

.lms-btn-success:hover {
    background: #059669;
}

/* =========================
   RESPONSIVE
========================= */

@media (max-width: 768px) {
    .lms-card-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 8px;
    }

    .lms-table thead th,
    .lms-table tbody td {
        padding: 12px 14px;
    }
}


/* ==========================
   PRICING CARDS
========================== */

.lms-pricing-card{
    background:#fff;
    border:1px solid #e2e8f0;
    border-radius:20px;
    padding:24px;
    height:100%;
    transition:.3s ease;
    box-shadow:0 4px 20px rgba(15,23,42,.04);
}

.lms-pricing-card:hover{
    transform:translateY(-6px);
    box-shadow:0 20px 40px rgba(15,23,42,.10);
}

/* Header */

.lms-plan-header{
    text-align:center;
    margin-bottom:24px;
}

.lms-plan-header h4{
    font-weight:700;
    margin-bottom:12px;
}

.lms-plan-price .amount{
    font-size:34px;
    font-weight:800;
    color:#2563eb;
}

.lms-plan-price small{
    color:#64748b;
}

/* Features */

.lms-plan-features{
    display:flex;
    flex-direction:column;
    gap:12px;
    margin-bottom:24px;
}

.feature-item{
    padding:10px 12px;
    background:#f8fafc;
    border-radius:10px;
    font-size:14px;
}

/* Badges */

.lms-plan-badges{
    display:flex;
    flex-wrap:wrap;
    gap:10px;
    margin-bottom:24px;
}

/* Actions */

.lms-plan-actions{
    display:flex;
    gap:10px;
    margin-top:auto;
}

.lms-plan-actions .lms-btn,
.lms-plan-actions .lms-btn-danger{
    flex:1;
    text-align:center;
}

.lms-btn-danger{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    padding:10px 16px;
    border-radius:10px;
    font-size:13px;
    font-weight:600;
    text-decoration:none;
    transition:.25s ease;
    min-height:40px;
}

/* Empty State */

.lms-empty-state{
    background:#fff;
    padding:50px;
    border-radius:20px;
    text-align:center;
    border:1px dashed #cbd5e1;
}



.lms-course-card{
    background:#fff;
    border-radius:22px;
    overflow:hidden;
    box-shadow:0 10px 35px rgba(15,23,42,.08);
    border:1px solid #eef2f7;
    transition:.3s ease;
    height:100%;
    display:flex;
    flex-direction:column;
}

.lms-course-card:hover{
    transform:translateY(-6px);
    box-shadow:0 20px 50px rgba(15,23,42,.12);
}

.lms-course-cover{
    position:relative;
    height:220px;
}

.lms-course-cover img{
    width:100%;
    height:100%;
    object-fit:cover;
}

.lms-status-badge{
    position:absolute;
    top:16px;
    right:16px;
    padding:7px 14px;
    border-radius:999px;
    font-size:11px;
    font-weight:700;
    backdrop-filter:blur(10px);
}

.lms-status-badge.active{
    background:#dcfce7;
    color:#166534;
}

.lms-status-badge.inactive{
    background:#fee2e2;
    color:#b91c1c;
}

.lms-status-badge.pending{
    background:#fef3c7;
    color:#92400e;
}

.lms-course-content{
    padding:24px;
    flex:1;
}

.lms-course-tags{
    display:flex;
    gap:10px;
    margin-bottom:15px;
}

.lms-tag-category,
.lms-tag-level{
    padding:6px 12px;
    border-radius:999px;
    font-size:11px;
    font-weight:600;
}

.lms-tag-category{
    background:#eff6ff;
    color:#1d4ed8;
}

.lms-tag-level{
    background:#f8fafc;
    color:#475569;
}

.lms-course-title{
    font-size:18px;
    font-weight:700;
    margin-bottom:20px;
    line-height:1.4;
    color:#0f172a;
}

.lms-course-metrics{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:12px;
    margin-bottom:20px;
}

.metric-box{
    background:#f8fafc;
    border-radius:14px;
    padding:14px;
}

.metric-label{
    display:block;
    font-size:11px;
    text-transform:uppercase;
    color:#94a3b8;
    margin-bottom:6px;
}

.metric-box strong{
    color:#0f172a;
}

.lms-course-details{
    border-top:1px solid #e2e8f0;
    padding-top:15px;
}

.detail-item{
    display:flex;
    justify-content:space-between;
    margin-bottom:12px;
    font-size:14px;
}

.lms-course-footer{
    padding:20px 24px;
    border-top:1px solid #eef2f7;
    display:flex;
    gap:10px;
}

.lms-course-footer a{
    flex:1;
    text-align:center;
}


.segment-card{
    background:#fff;
    border-radius:20px;
    overflow:hidden;
    box-shadow:0 8px 30px rgba(15,23,42,.08);
    transition:.3s;
    border:1px solid #eef2f7;
    height:100%;
}

.segment-card:hover{
    transform:translateY(-6px);
    box-shadow:0 18px 40px rgba(15,23,42,.12);
}

.segment-cover{
    position:relative;
    height:220px;
}

.segment-cover img{
    width:100%;
    height:100%;
    object-fit:cover;
}

.segment-overlay{
    position:absolute;
    top:15px;
    left:15px;
    right:15px;
    display:flex;
    justify-content:space-between;
}

.segment-number{
    background:#0f172a;
    color:#fff;
    padding:6px 14px;
    border-radius:30px;
    font-size:12px;
    font-weight:600;
}

.segment-status{
    padding:6px 14px;
    border-radius:30px;
    font-size:12px;
    font-weight:600;
}

.segment-status.success{
    background:#dcfce7;
    color:#15803d;
}

.segment-status.warning{
    background:#fef3c7;
    color:#b45309;
}

.segment-status.danger{
    background:#fee2e2;
    color:#b91c1c;
}

.segment-body{
    padding:24px;
}

.segment-title{
    font-size:18px;
    font-weight:700;
    margin-bottom:20px;
}

.segment-meta{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:15px;
    margin-bottom:20px;
}

.segment-meta small{
    display:block;
    color:#94a3b8;
    margin-bottom:4px;
}

.segment-meta strong{
    font-size:14px;
}

.segment-stats{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:15px;
    margin-bottom:24px;
}

.stat-box{
    background:#f8fafc;
    border-radius:14px;
    padding:16px;
    text-align:center;
}

.stat-box h5{
    margin:0;
    font-size:22px;
    font-weight:700;
}

.stat-box span{
    color:#64748b;
    font-size:12px;
}

.segment-actions{
    display:flex;
    gap:10px;
}

.btn-edit,
.btn-manage{
    flex:1;
    text-align:center;
    padding:10px;
    border-radius:10px;
    font-weight:600;
    text-decoration:none;
}

.btn-edit{
    border:1px solid #dbeafe;
    color:#2563eb;
}

.btn-manage{
    background:#2563eb;
    color:white;
}

.lms-empty-state{
    background:white;
    border-radius:20px;
    padding:60px;
    text-align:center;
}

.empty-icon{
    font-size:48px;
    margin-bottom:15px;
}

/* Main wrapper card */
.lms-section-card{
    background:#fff;
    border-radius:24px;
    padding:30px;
    border:1px solid #e2e8f0;
    box-shadow:0 10px 40px rgba(15,23,42,.06);
}

/* Header */
.lms-section-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:30px;
    padding-bottom:20px;
    border-bottom:1px solid #f1f5f9;
}

/* Add button */
.lms-btn{
    background:#2563eb;
    color:#fff;
    text-decoration:none;
    padding:12px 20px;
    border-radius:12px;
    font-weight:600;
    transition:.3s;
}

.lms-btn:hover{
    background:#1d4ed8;
    color:#fff;
}

/* Better spacing between cards */
.lms-section-card .row{
    margin-left:-10px;
    margin-right:-10px;
}

.lms-section-card .col-xl-4,
.lms-section-card .col-lg-6{
    padding:10px;
}

/* =========================
   CLEAN LMS BREADCRUMB
========================= */

.breadcrumb{
    display:flex;
    align-items:center;
    flex-wrap:wrap;

    margin:0 0 20px;
    padding:0;

    background:transparent;
    border:none;
    box-shadow:none;

    font-size:13px;
    font-weight:500;
}

/* Links */

.breadcrumb-item a{
    color:#64748b;
    text-decoration:none;
    transition:.2s ease;
}

.breadcrumb-item a:hover{
    color:#2563eb;
}

/* Separator */

.breadcrumb-item + .breadcrumb-item::before{
    content:"/";
    color:#cbd5e1;
    padding:0 10px;
}

/* Active */

.breadcrumb-item.active,
.breadcrumb-item.active a{
    color:#0f172a;
    font-weight:600;
}

/* =========================
   LMS HEADER CONTROL CARD
========================= */

.lms-header-card{
    background:#fff;
    border:1px solid #e2e8f0;
    border-radius:18px;

    padding:18px 22px;

    display:flex;
    align-items:center;
    justify-content:space-between;

    box-shadow:0 6px 20px rgba(15,23,42,.05);
}

/* Left side text */
.lms-header-left h3{
    font-size:20px;
    font-weight:700;
    color:#0f172a;
    margin:0;
}

.lms-header-left p{
    font-size:13px;
    color:#64748b;
    margin-top:4px;
}

/* Right side button alignment */
.lms-header-right{
    display:flex;
    align-items:center;
    justify-content:flex-end;
}

/* Button (keep consistent LMS style) */
.lms-btn{
    background:#2563eb;
    color:#fff;
    padding:10px 18px;
    border-radius:12px;
    font-weight:600;
    text-decoration:none;
    transition:.25s ease;
    white-space:nowrap;
}

.lms-btn:hover{
    background:#1d4ed8;
    color:#fff;
}

/* Mobile responsiveness */
@media(max-width:768px){
    .lms-header-card{
        flex-direction:column;
        align-items:flex-start;
        gap:12px;
    }

    .lms-header-right{
        width:100%;
    }

    .lms-btn{
        width:100%;
        text-align:center;
    }
}

/* =========================
   LMS WELCOME TEXT
   ========================= */
.welcome-text {
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    padding: 18px 20px;
    margin-bottom: 20px;
    box-shadow: 0 2px 8px rgba(15, 23, 42, 0.04);
}

/* Heading */
.welcome-text h4 {
    font-size: 18px;
    font-weight: 700;
    color: #0f172a;
    margin: 0;
    line-height: 1.4;
}

/* Optional subtitle support */
.welcome-text small,
.welcome-text p {
    display: block;
    margin-top: 6px;
    font-size: 13px;
    color: #64748b;
}

/* Subtle accent line (modern LMS touch) */
.welcome-text {
    position: relative;
}

.welcome-text::before {
    content: "";
    position: absolute;
    left: 0;
    top: 0;
    height: 100%;
    width: 4px;
    background: linear-gradient(180deg, #2563eb, #60a5fa);
    border-radius: 12px 0 0 12px;
}

/* Responsive */
@media (max-width: 768px) {
    .welcome-text {
        padding: 15px;
    }

    .welcome-text h4 {
        font-size: 16px;
    }
}

/* Navbar grpup style *//* ================= BASE LABEL STYLE ================= */
.dlabnav .nav-label{
    position:relative;

    margin:30px 0 12px;
    padding:0 20px;

    color:#0f172a;

    font-family:'Plus Jakarta Sans',sans-serif;
    font-size:12px;
    font-weight:800;

    letter-spacing:1px;
    text-transform:uppercase;
}

.dlabnav .nav-label::after{
    content:'';

    display:block;

    width:28px;
    height:3px;

    margin-top:6px;

    border-radius:20px;

    background:#4f46e5;
}


/* ================= ADMIN ================= */
.dlabnav .label-admin{
    background: linear-gradient(135deg, #0f172a, #1e293b);
}

/* ================= MANAGEMENT ================= */
.dlabnav .label-management{
    background: linear-gradient(135deg, #4f46e5, #6366f1);
}

/* ================= LEARNING ================= */
.dlabnav .label-learning{
    background: linear-gradient(135deg, #10b981, #059669);
}

/* ================= ENGAGEMENT ================= */
.dlabnav .label-engagement{
    background: linear-gradient(135deg, #ec4899, #ef4444);
}

/* ================= FINANCE ================= */
.dlabnav .label-finance{
    background: linear-gradient(135deg, #f59e0b, #f97316);
}

/* ================= SYSTEM ================= */
.dlabnav .label-system{
    background: linear-gradient(135deg, #ef4444, #991b1b);
}

/* Course Review */
/* PAGE WRAPPER */
.crv-page{
    padding:20px;
    background:#f6f8fb;
    font-family:inherit;
}

/* HEADER */
.crv-header{
    display:flex;
    justify-content:space-between;
    margin-bottom:18px;
}

.crv-title{
    font-size:22px;
    font-weight:600;
    margin:0;
}

.crv-breadcrumb{
    font-size:13px;
    color:#64748b;
}

.crv-breadcrumb a{
    color:#2563eb;
    text-decoration:none;
}

/* COURSE CARD */
.crv-course-card{
    display:flex;
    gap:15px;
    background:#fff;
    border:1px solid #e5e7eb;
    border-radius:14px;
    padding:15px;
    margin-bottom:20px;
    align-items:center;
}

.crv-course-img{
    width:75px;
    height:75px;
    border-radius:10px;
    object-fit:cover;
}

.crv-course-title{
    margin:0;
    font-size:18px;
}

.crv-meta{
    font-size:13px;
    color:#64748b;
    margin-top:5px;
}

.crv-meta span{
    margin-right:10px;
}

/* LAYOUT */
.crv-layout{
    display:flex;
    gap:20px;
    align-items:flex-start;
}

/* MAIN */
.crv-main{
    flex:1;
    min-width:0;
}

/* MODULE */
.crv-module{
    background:#fff;
    border:1px solid #e5e7eb;
    border-radius:12px;
    margin-bottom:15px;
    overflow:hidden;
}

.crv-module-head{
    background:#f1f5f9;
    padding:12px 15px;
}

.crv-tag{
    font-size:10px;
    background:#2563eb;
    color:#fff;
    padding:2px 6px;
    border-radius:4px;
    margin-right:8px;
}

.crv-module-head h4{
    display:inline;
    font-size:15px;
}

/* LESSON */
.crv-lesson{
    padding:12px 15px;
    border-top:1px solid #f1f5f9;
}

.crv-lesson-title{
    font-weight:500;
    margin-bottom:6px;
}

/* MATERIAL */
.crv-material{
    font-size:13px;
    color:#475569;
    margin-left:18px;
    padding:3px 0;
}

/* SIDEBAR */
.crv-side{
    width:320px;
    flex-shrink:0;
    position:sticky;
    top:20px;
}

.crv-panel{
    background:#fff;
    border:1px solid #e5e7eb;
    border-radius:14px;
    padding:15px;
}

/* STATUS */
.crv-status{
    font-size:13px;
    margin:10px 0;
}

.crv-status span{
    background:#e2e8f0;
    padding:3px 8px;
    border-radius:6px;
    font-size:12px;
}

/* BUTTONS */
.crv-btn{
    width:100%;
    padding:10px;
    border:none;
    border-radius:10px;
    cursor:pointer;
    font-weight:500;
    margin-top:10px;
}

.crv-approve{
    background:#16a34a;
    color:#fff;
}

.crv-reject{
    background:#dc2626;
    color:#fff;
}

/* META */
.crv-panel .crv-meta p{
    font-size:13px;
    color:#64748b;
    margin:6px 0;
}
.crv-material-item{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:10px 12px;
    margin-left:15px;
    border-left:2px solid #e2e8f0;
    margin-bottom:6px;
    background:#f9fafb;
    border-radius:8px;
}

.crv-material-left{
    display:flex;
    align-items:center;
    gap:10px;
}

.crv-material-icon{
    font-size:18px;
}

.crv-material-title{
    font-size:13px;
    font-weight:500;
}

.crv-material-type{
    font-size:10px;
    color:#94a3b8;
}

.crv-preview-btn{
    background:#2563eb;
    color:#fff;
    border:none;
    padding:5px 10px;
    border-radius:6px;
    font-size:12px;
    cursor:pointer;
    text-decoration:none;
}

.crv-preview-btn:hover{
    background:#1d4ed8;
}

.crv-modal{
    display:none;
    position:fixed;
    top:0;
    left:0;
    width:100%;
    height:100%;
    background:rgba(15,23,42,0.6);
    z-index:9999;
    justify-content:center;
    align-items:center;
}

.crv-modal-content{
    background:#fff;
    width:700px;
    max-width:95%;
    border-radius:12px;
    overflow:hidden;
    animation:fadeIn 0.2s ease-in-out;
}

.crv-modal-header{
    display:flex;
    justify-content:space-between;
    padding:12px 15px;
    border-bottom:1px solid #e5e7eb;
    font-weight:600;
}

.crv-close{
    cursor:pointer;
    font-size:20px;
}

.crv-modal-body{
    padding:15px;
    max-height:70vh;
    overflow:auto;
}

@keyframes fadeIn{
    from{transform:scale(0.95); opacity:0;}
    to{transform:scale(1); opacity:1;}
}

/* ---------------------- */

/* ---------------------- */
</style>
</head>

<body>


    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <a href="{{route('home')}}" class="brand-logo">
                <img class="logo-abbr" src="{{asset('images/kdh_logo.png')}}" alt="">
                <img class="logo-compact" src="{{asset('images/h-logo.png')}}" alt="">
                <img class="brand-title" src="{{asset('images/h-logo.png')}}" alt="">
            </a>

            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <!-- HEADER START -->
<div class="header">
    <div class="header-content">

        <nav class="navbar navbar-expand">

            <div class="collapse navbar-collapse justify-content-between">

                {{-- ================= LEFT ================= --}}
                <div class="header-left d-flex align-items-center">

                    {{-- MOBILE MENU TOGGLE --}}
                    <button class="btn btn-light btn-sm mr-3 d-md-none" id="menu-toggle">
                        <i class="las la-bars"></i>
                    </button>

                    {{-- GLOBAL SEARCH --}}
                    <div class="search_bar">

                        <div class="input-group shadow-sm rounded">

                            <span class="input-group-text bg-white border-0">
                                <i class="las la-search text-muted"></i>
                            </span>

                            <input type="text"
                                   class="form-control border-0"
                                   placeholder="Search courses, students, quizzes..."
                                   aria-label="Search">

                            <span class="input-group-text bg-white border-0 text-muted small">
                                Ctrl + K
                            </span>

                        </div>

                    </div>

                </div>


                {{-- ================= RIGHT ================= --}}
                <ul class="navbar-nav header-right align-items-center">


                    {{-- ================= QUICK ACTIONS ================= --}}
                    <li class="nav-item mr-3">
                        <a href="{{ route('course.index') }}" class="btn btn-primary btn-sm">
                            <i class="las la-plus"></i>
                            Create Course
                        </a>
                    </li>


                    {{-- ================= NOTIFICATIONS ================= --}}
                    <li class="nav-item dropdown notification_dropdown">

                        <a class="nav-link position-relative" href="#" data-toggle="dropdown">

                            {{-- FIXED ICON (always visible) --}}
                            <i class="las la-bell"
                               style="font-size:22px; color:#374151;"></i>

                            {{-- BADGE --}}
                            <span class="badge badge-danger"
                                  style="position:absolute; top:2px; right:0px; font-size:10px; border-radius:50%;">
                                1
                            </span>

                        </a>

                        <div class="dropdown-menu dropdown-menu-right shadow border-0" style="min-width:320px;">

                            <div class="p-3 border-bottom">
                                <strong>Notifications</strong>
                            </div>

                            <ul class="list-unstyled mb-0">

                                <li class="dropdown-item">
                                    <div class="d-flex align-items-start">

                                        <div class="mr-2">
                                            <span class="badge badge-success">
                                                <i class="las la-user"></i>
                                            </span>
                                        </div>

                                        <div>
                                            <strong>New User Registered</strong>
                                            <div class="small text-muted">
                                                A student just joined your platform
                                            </div>
                                            <small class="text-muted">Just now</small>
                                        </div>

                                    </div>
                                </li>

                            </ul>

                            <div class="p-2 text-center border-top">
                                <a href="#" class="small">View all notifications</a>
                            </div>

                        </div>
                    </li>


                    {{-- ================= MESSAGES (LMS ESSENTIAL) ================= --}}
                    <li class="nav-item mr-3">
                        <a href="{{ route('message.index') }}" class="position-relative">

                            <i class="las la-envelope"
                               style="font-size:22px; color:#374151;"></i>

                            <span class="badge badge-primary"
                                  style="position:absolute; top:-6px; right:-8px; font-size:10px;">
                                0
                            </span>

                        </a>
                    </li>


                    {{-- ================= PROFILE ================= --}}
                    @php $user = auth()->user(); @endphp

                    <li class="nav-item dropdown header-profile">

                        <a class="nav-link d-flex align-items-center" href="#" data-toggle="dropdown">

                            <img src="{{ asset('uploads/users/' . request()->session()->get('image')) }}"
                                 class="rounded-circle"
                                 width="38"
                                 height="38"
                                 alt="profile">

                        </a>

                        <div class="dropdown-menu dropdown-menu-right shadow border-0">

                            {{-- PROFILE --}}
                            @if(Auth::check())
                                <a class="dropdown-item"
                                   href="{{ $user->role_id == 3
                                        ? route('instructor.edit', encryptor('encrypt', $user->instructor_id))
                                        : route('user.edit', encryptor('encrypt', $user->id)) }}">

                                    <i class="las la-user-circle mr-2"></i>
                                    My Profile
                                </a>
                            @endif

                            <a class="dropdown-item" href="#">
                                <i class="las la-cog mr-2"></i>
                                Settings
                            </a>

                            <a class="dropdown-item" href="#">
                                <i class="las la-life-ring mr-2"></i>
                                Support
                            </a>

                            <div class="dropdown-divider"></div>

                            <a class="dropdown-item text-danger" href="{{ route('logOut') }}">
                                <i class="las la-sign-out-alt mr-2"></i>
                                Logout
                            </a>

                        </div>

                    </li>

                </ul>

            </div>

        </nav>

    </div>
</div>
<!-- HEADER END -->
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

       <div class="app-wrapper">

            <!-- sidebar -->
              <!--**********************************
            Sidebar start
        ***********************************-->
       @if(fullAccess())
        <div class="dlabnav">
            <div class="dlabnav-scroll">

                <ul class="metismenu" id="menu">

                    {{-- ================= ADMIN BLOCK ================= --}}
                    <li class="nav-label" >                       
                        ADMIN PANEL
                    </li>

                    <li class="mt-2">
                        <a class="ai-icon" href="{{ route('home') }}">
                            <i class="las la-home"
                            style="background:#e0f2fe; color:#0284c7; padding:6px; border-radius:8px;"></i>
                            <span class="nav-text font-weight-bold">Home</span>
                        </a>
                    </li>

                    <li>
                        <a class="ai-icon" href="{{ route('dashboard') }}">
                            <i class="las la-tachometer-alt"
                            style="background:#dcfce7; color:#16a34a; padding:6px; border-radius:8px;"></i>
                            <span class="nav-text font-weight-bold">Dashboard</span>
                        </a>
                    </li>

                    @php $user = auth()->user(); @endphp

                    @if(Auth::check())
                    <li>
                        <a class="ai-icon"
                        href="{{ $user->role_id == 3
                                ? route('instructor.edit', encryptor('encrypt', $user->instructor_id))
                                : route('user.edit', encryptor('encrypt', $user->id)) }}">
                            <i class="las la-user-circle"
                            style="background:#fef3c7; color:#f59e0b; padding:6px; border-radius:8px;"></i>
                            <span class="nav-text">Profile</span>
                        </a>
                    </li>
                    @endif


                    {{-- ================= MANAGEMENT BLOCK ================= --}}
                    <li class="nav-label">
                        MANAGEMENT
                    </li>

                    <li class="mt-2">
                        <a class="ai-icon" href="{{ route('role.index') }}">
                            <i class="las la-shield-alt"
                            style="background:#fee2e2; color:#ef4444; padding:6px; border-radius:8px;"></i>
                            <span class="nav-text">Permissions</span>
                        </a>
                    </li>

                    <li>
                        <a class="has-arrow ai-icon" href="javascript:void(0)">
                            <i class="las la-users"
                            style="background:#ede9fe; color:#7c3aed; padding:6px; border-radius:8px;"></i>
                            <span class="nav-text">User Management</span>
                        </a>
                        <ul>
                            <li><a href="{{ route('user.index') }}">Users</a></li>
                            <li><a href="{{ route('instructor.index') }}">Instructors</a></li>
                            <li><a href="{{ route('student.index') }}">Students</a></li>
                        </ul>
                    </li>


                    {{-- ================= LEARNING BLOCK ================= --}}
                    <li class="nav-label">
                        LEARNING
                    </li>

                    <li class="mt-2">
                        <a class="has-arrow ai-icon" href="javascript:void(0)">
                            <i class="las la-school"
                            style="background:#dbeafe; color:#2563eb; padding:6px; border-radius:8px;"></i>
                            <span class="nav-text">Courses</span>
                        </a>
                        <ul>
                            <li><a href="{{ route('courseCategory.index') }}">Categories</a></li>
                            <li><a href="{{ route('courseList') }}">All Courses</a></li>
                            <!-- <li><a href="{{ route('course.index') }}">Course Setup</a></li> -->
                        </ul>
                    </li>

                    <li>
                        <a class="ai-icon" href="{{ route('enrollment.index') }}">
                            <i class="las la-bullseye"
                            style="background:#dcfce7; color:#16a34a; padding:6px; border-radius:8px;"></i>
                            <span class="nav-text">Enrollments</span>
                        </a>
                    </li>

                    <li>
                        <a class="has-arrow ai-icon" href="javascript:void(0)">
                            <i class="las la-tasks"
                            style="background:#fef9c3; color:#ca8a04; padding:6px; border-radius:8px;"></i>
                            <span class="nav-text">Assessments</span>
                        </a>
                        <ul>
                            <li><a href="{{ route('quiz.index') }}">Quizzes</a></li>
                            <li><a href="{{ route('question.index') }}">Questions</a></li>
                        </ul>
                    </li>

                    <li>
                        <a class="ai-icon" href="{{ route('certificates.index') }}">
                            <i class="las la-certificate"
                            style="background:#f3e8ff; color:#9333ea; padding:6px; border-radius:8px;"></i>
                            <span class="nav-text">Certificates</span>
                        </a>
                    </li>


                    {{-- ================= ENGAGEMENT BLOCK ================= --}}
                    <li class="nav-label">
                        ENGAGEMENT
                    </li>

                    <li class="mt-2">
                        <a class="ai-icon" href="{{ route('event.index') }}">
                            <i class="las la-calendar"
                            style="background:#ffe4e6; color:#e11d48; padding:6px; border-radius:8px;"></i>
                            <span class="nav-text">Events</span>
                        </a>
                    </li>

                    <li>
                        <a class="has-arrow ai-icon" href="javascript:void(0)">
                            <i class="las la-comments"
                            style="background:#e0f2fe; color:#0284c7; padding:6px; border-radius:8px;"></i>
                            <span class="nav-text">Community</span>
                        </a>
                        <ul>
                            <li><a href="{{ route('discussion.index') }}">Discussions</a></li>
                            <li><a href="{{ route('message.index') }}">Messages</a></li>
                        </ul>
                    </li>

                    <li>
                        <a class="has-arrow ai-icon" href="javascript:void(0)">
                            <i class="las la-star"
                            style="background:#fff7ed; color:#f97316; padding:6px; border-radius:8px;"></i>
                            <span class="nav-text">Reviews</span>
                        </a>
                        <ul>
                            <li><a href="{{ route('review.index') }}">All Reviews</a></li>
                            <li><a href="{{ route('review.index') }}">Ratings</a></li>
                        </ul>
                    </li>


                    {{-- ================= FINANCE BLOCK ================= --}}
                    <li class="nav-label">
                        FINANCE
                    </li>

                    <li class="mt-2">
                        <a class="has-arrow ai-icon" href="javascript:void(0)">
                            <i class="las la-money-check"
                            style="background:#dcfce7; color:#16a34a; padding:6px; border-radius:8px;"></i>
                            <span class="nav-text">Payments</span>
                        </a>
                        <ul>
                            <li><a href="{{ route('courseFee') }}">Course Payments</a></li>
                            <li><a href="{{ route('subscriptionPlan.index') }}">Subscription Plans</a></li>
                            <li><a href="{{ route('subscription.index') }}">Subscriptions</a></li>
                        </ul>
                    </li>

                    <li>
                        <a class="ai-icon" href="{{ route('coupon.index') }}">
                            <i class="las la-tags"
                            style="background:#fee2e2; color:#ef4444; padding:6px; border-radius:8px;"></i>
                            <span class="nav-text">Coupons</span>
                        </a>
                    </li>


                    {{-- ================= SYSTEM ================= --}}
                    <li class="nav-label">
                        SYSTEM
                    </li>

                    <li class="mt-2">
                        <a class="ai-icon" href="{{ route('logOut') }}">
                            <i class="lab la-gg-circle"
                            style="background:#fee2e2; color:#ef4444; padding:6px; border-radius:8px;"></i>
                            <span class="nav-text">Logout</span>
                        </a>
                    </li>

                </ul>
            </div>
        </div>
        @endif

        @if(!fullAccess())
        <div class="dlabnav">
            <div class="dlabnav-scroll">

                <ul class="metismenu" id="menu">

                    {{-- ================= INSTRUCTOR BLOCK ================= --}}
                    <li class="nav-label">
                        INSTRUCTOR PANEL
                    </li>

                    <li class="mt-2">
                        <a class="ai-icon" href="{{ route('home') }}">
                            <i class="las la-home"
                            style="background:#e0f2fe; color:#0284c7; padding:6px; border-radius:8px;"></i>
                            <span class="nav-text font-weight-bold">Home</span>
                        </a>
                    </li>

                    <li>
                        <a class="ai-icon" href="{{ route('dashboard') }}">
                            <i class="las la-tachometer-alt"
                            style="background:#dcfce7; color:#16a34a; padding:6px; border-radius:8px;"></i>
                            <span class="nav-text font-weight-bold">Dashboard</span>
                        </a>
                    </li>

                    @php $user = auth()->user(); @endphp

                    @if(Auth::check())
                    <li>
                        <a class="ai-icon"
                        href="{{ $user->role_id == 3
                                ? route('instructor.edit', encryptor('encrypt', $user->instructor_id))
                                : route('user.edit', encryptor('encrypt', $user->id)) }}">
                            <i class="las la-user-circle"
                            style="background:#fef3c7; color:#f59e0b; padding:6px; border-radius:8px;"></i>
                            <span class="nav-text">Profile</span>
                        </a>
                    </li>
                    @endif


                    {{-- ================= TEACHING ================= --}}
                    <li class="nav-label">
                        TEACHING
                    </li>

                    <li class="mt-2">
                        <a class="ai-icon" href="{{ route('course.index') }}">
                            <i class="las la-school"
                            style="background:#dbeafe; color:#2563eb; padding:6px; border-radius:8px;"></i>
                            <span class="nav-text">My Courses</span>
                        </a>
                    </li>

                    <li>
                        <a class="ai-icon" href="{{ route('enrollment.index') }}">
                            <i class="las la-bullseye"
                            style="background:#dcfce7; color:#16a34a; padding:6px; border-radius:8px;"></i>
                            <span class="nav-text">Enrollments</span>
                        </a>
                    </li>

                    <li>
                        <a class="ai-icon" href="{{ route('certificates.index') }}">
                            <i class="las la-certificate"
                            style="background:#f3e8ff; color:#9333ea; padding:6px; border-radius:8px;"></i>
                            <span class="nav-text">Certificates</span>
                        </a>
                    </li>


                    {{-- ================= ASSESSMENTS ================= --}}
                    <li class="nav-label">
                        ASSESSMENTS
                    </li>

                    <li class="mt-2">
                        <a class="has-arrow ai-icon" href="javascript:void(0)">
                            <i class="las la-tasks"
                            style="background:#fef9c3; color:#ca8a04; padding:6px; border-radius:8px;"></i>
                            <span class="nav-text">Quiz</span>
                        </a>
                        <ul>
                            <li>
                                <a href="{{ route('quiz.index') }}">
                                    All Quiz
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a class="has-arrow ai-icon" href="javascript:void(0)">
                            <i class="las la-clipboard-list"
                            style="background:#ede9fe; color:#7c3aed; padding:6px; border-radius:8px;"></i>
                            <span class="nav-text">Projects</span>
                        </a>
                        <ul>
                            <li>
                                <a href="{{ route('project.index') }}">
                                    All Projects
                                </a>
                            </li>
                        </ul>
                    </li>


                    {{-- ================= FINANCE ================= --}}
                    <li class="nav-label">
                        FINANCE
                    </li>

                    <li class="mt-2">
                        <a class="has-arrow ai-icon" href="javascript:void(0)">
                            <i class="las la-money-check"
                            style="background:#dcfce7; color:#16a34a; padding:6px; border-radius:8px;"></i>
                            <span class="nav-text">Payments</span>
                        </a>
                        <ul>
                            <li>
                                <a href="{{ route('courseFee') }}">
                                    Course Payments
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('subscription.view') }}">
                                    Subscription
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a class="ai-icon" href="{{ route('coupon.index') }}">
                            <i class="las la-tags"
                            style="background:#fee2e2; color:#ef4444; padding:6px; border-radius:8px;"></i>
                            <span class="nav-text">Coupons</span>
                        </a>
                    </li>


                    {{-- ================= NETWORK ================= --}}
                    <!-- <li class="nav-label mt-3"
                        style="background:#0f172a; color:#fff; padding:10px 12px; border-radius:6px; font-weight:700;">
                        NETWORK
                    </li> -->

                    <!-- <li class="mt-2">
                        <a class="ai-icon" href="{{ route('instructor.index') }}">
                            <i class="las la-chalkboard-teacher"
                            style="background:#e0f2fe; color:#0284c7; padding:6px; border-radius:8px;"></i>
                            <span class="nav-text">Instructors List</span>
                        </a>
                    </li> -->


                    {{-- ================= SYSTEM ================= --}}
                    <li class="nav-label">
                        SYSTEM
                    </li>

                    <li class="mt-2">
                        <a class="ai-icon" href="{{ route('logOut') }}">
                            <i class="lab la-gg-circle"
                            style="background:#fee2e2; color:#ef4444; padding:6px; border-radius:8px;"></i>
                            <span class="nav-text">Logout</span>
                        </a>
                    </li>

                </ul>

            </div>
        </div>
        @endif
        <!--**********************************
            Sidebar end
        ***********************************-->
<!--**********************************
            Content body start
        ***********************************-->

        @yield('content')

        <!--**********************************
            Content body end
        ***********************************-->
           

        </div>

        

        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>Copyright © Powered by <a href="{{route('about')}}" target="_blank">Kings Digital Literacy Hub</a> 2023 - <?php echo date('Y') ?></p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->

        <!--**********************************
           Support ticket button start
        ***********************************-->

        <!--**********************************
           Support ticket button end
        ***********************************-->

    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="{{asset('vendor/global/global.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('js/custom.min.js')}}"></script>
    <script src="{{asset('js/dlabnav-init.js')}}"></script>

    <!-- Svganimation scripts -->
    <script src="{{asset('vendor/svganimation/vivus.min.js')}}"></script>
    <script src="{{asset('vendor/svganimation/svg.animation.js')}}"></script>
    <script src="{{asset('js/styleSwitcher.js')}}"></script>

    @stack('scripts')
    {{-- TOASTER --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" />
    <script>
        @if(Session::has('success'))  
    				toastr.success("{{ Session::get('success') }}");  
    		@endif  
    		@if(Session::has('info'))  
    				toastr.info("{{ Session::get('info') }}");  
    		@endif  
    		@if(Session::has('warning'))  
    				toastr.warning("{{ Session::get('warning') }}");  
    		@endif  
    		@if(Session::has('error'))  
    				toastr.error("{{ Session::get('error') }}");  
    		@endif  
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" />
    {!! Toastr::message() !!}

   
<!-- <script src="{{asset('frontend/summernote/summernote-lite.min.js')}}"></script> -->
<script src="https://cdn.jsdelivr.net/npm/summernote/dist/summernote-lite.min.js"></script>
<script>
  $(document).ready(function() {
    $('#myEditor').summernote({
      height: 200
    });
  });
</script>
<script>
  $(document).ready(function() {
    $('#comment').summernote({
      height: 120
    });
  });
</script>
<script>
  $(document).ready(function() {
    $('#edit-comment').summernote({
      height: 120
    });
  });
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const msg = sessionStorage.getItem('toast_success');

    if (msg) {
        toastr.success(msg);
        sessionStorage.removeItem('toast_success');
    }

});
</script>
</body>

</html>