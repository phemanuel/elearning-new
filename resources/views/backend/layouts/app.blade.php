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
        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
                            <div class="search_bar dropdown">
                                <span class="search_icon p-3 c-pointer" data-toggle="dropdown">
                                    <i class="mdi mdi-magnify"></i>
                                </span>
                                <div class="dropdown-menu p-0 m-0">
                                    <form>
                                        <input class="form-control" type="search" placeholder="Search"
                                            aria-label="Search">
                                    </form>
                                </div>
                            </div>
                        </div>

                        <ul class="navbar-nav header-right">
                            <!-- <li class="nav-item dropdown notification_dropdown">
                                <a class="nav-link bell ai-icon" href="#" role="button" data-toggle="dropdown">
                                    <svg id="icon-user" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell">
                                        <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                                        <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                                    </svg>
                                    <div class="pulse-css"></div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <ul class="list-unstyled">
                                        <li class="media dropdown-item">
                                            <span class="success"><i class="ti-user"></i></span>
                                            <div class="media-body">
                                                <a href="#">
                                                    <p><strong>Martin</strong> has added a <strong>customer</strong>
                                                        Successfully
                                                    </p>
                                                </a>
                                            </div>
                                            <span class="notify-time">3:20 am</span>
                                        </li>
                                        <li class="media dropdown-item">
                                            <span class="primary"><i class="ti-shopping-cart"></i></span>
                                            <div class="media-body">
                                                <a href="#">
                                                    <p><strong>Jennifer</strong> purchased Light Dashboard 2.0.</p>
                                                </a>
                                            </div>
                                            <span class="notify-time">3:20 am</span>
                                        </li>
                                        <li class="media dropdown-item">
                                            <span class="danger"><i class="ti-bookmark"></i></span>
                                            <div class="media-body">
                                                <a href="#">
                                                    <p><strong>Robin</strong> marked a <strong>ticket</strong> as
                                                        unsolved.
                                                    </p>
                                                </a>
                                            </div>
                                            <span class="notify-time">3:20 am</span>
                                        </li>
                                        <li class="media dropdown-item">
                                            <span class="primary"><i class="ti-heart"></i></span>
                                            <div class="media-body">
                                                <a href="#">
                                                    <p><strong>David</strong> purchased Light Dashboard 1.0.</p>
                                                </a>
                                            </div>
                                            <span class="notify-time">3:20 am</span>
                                        </li>
                                        <li class="media dropdown-item">
                                            <span class="success"><i class="ti-image"></i></span>
                                            <div class="media-body">
                                                <a href="#">
                                                    <p><strong> James.</strong> has added a<strong>customer</strong>
                                                        Successfully
                                                    </p>
                                                </a>
                                            </div>
                                            <span class="notify-time">3:20 am</span>
                                        </li>
                                    </ul>
                                    <a class="all-notification" href="#">See all notifications <i
                                            class="ti-arrow-right"></i></a>
                                </div>
                            </li> -->
                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link" title="Profile Info" href="#" role="button" data-toggle="dropdown">
                                    <img src="{{asset('uploads/users/'.request()->session()->get('image'))}}"
                                        width="20" alt="">
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                @if(Auth::check() && auth()->user()->role_id == 1)
                                    <a href="{{route('user.edit', encryptor('encrypt',auth()->user()->id))}}" class="dropdown-item ai-icon">
                                        <svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                            viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                            <circle cx="12" cy="7" r="4"></circle>
                                        </svg>
                                        <span class="ml-2">Profile</span>
                                    </a>
                                    @elseif(Auth::check() && auth()->user()->role_id == 2) 
                                    <a href="{{route('user.edit', encryptor('encrypt',auth()->user()->id))}}" class="dropdown-item ai-icon">
                                        <svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                            viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                            <circle cx="12" cy="7" r="4"></circle>
                                        </svg>
                                        <span class="ml-2">Profile</span>
                                    </a>
                                    @elseif(Auth::check() && auth()->user()->role_id == 3)
                                    <a href="{{route('instructor.edit', encryptor('encrypt',auth()->user()->instructor_id))}}" class="dropdown-item ai-icon">
                                        <svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                            viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                            <circle cx="12" cy="7" r="4"></circle>
                                        </svg>
                                        <span class="ml-2">Profile</span>
                                    </a>
                                    @else
                                    <script>
                                        window.location.href = "{{ route('logOut') }}";
                                    </script>
                                    @endif
                                    <!-- <a href="email-inbox.html" class="dropdown-item ai-icon">
                                        <svg id="icon-inbox" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                            viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail">
                                            <path
                                                d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z">
                                            </path>
                                            <polyline points="22,6 12,13 2,6"></polyline>
                                        </svg>
                                        <span class="ml-2">Inbox </span>
                                    </a> -->
                                    <a href="{{route('logOut')}}" class="dropdown-item ai-icon">
                                        <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                            viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-log-out">
                                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                            <polyline points="16 17 21 12 16 7"></polyline>
                                            <line x1="21" y1="12" x2="9" y2="12"></line>
                                        </svg>
                                        <span class="ml-2">Logout </span>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        @if(fullAccess())
        <div class="dlabnav">
            <div class="dlabnav-scroll">
                <ul class="metismenu" id="menu">
                    <li class="nav-label first">Admin Panel</li>
                    <li><a class="ai-icon" href="{{route('home')}}" aria-expanded="false">
                            <i class="las la-home"></i>
                            <span class="nav-text">Home</span>
                        </a>
                    </li>
                    <li><a class="ai-icon" href="{{route('dashboard')}}" aria-expanded="false">
                            <i class="las la-tachometer-alt"></i>
                            <span class="nav-text">Dashboard</span>
                        </a>
                    </li> 
                    @if(Auth::check() && auth()->user()->role_id == 1) 
                    <li><a href="{{route('user.edit', encryptor('encrypt',auth()->user()->id))}}"><i
                                        class="las la-chalkboard-teacher"></i>Profile</a>
                            </li>   
                    @elseif(Auth::check() && auth()->user()->role_id == 2) 
                    <li><a href="{{route('user.edit', encryptor('encrypt',auth()->user()->id))}}"><i
                                        class="las la-chalkboard-teacher"></i>Profile</a>
                            </li>  
                    @elseif(Auth::check() && auth()->user()->role_id == 3)     
                    <li><a href="{{route('instructor.edit', encryptor('encrypt',auth()->user()->instructor_id))}}"><i
                                        class="las la-chalkboard-teacher"></i>Profile</a>
                            </li> 
                    @else
                    <script>
                        window.location.href = "{{ route('logOut') }}";
                    </script>
                    @endif        
                    <li class="nav-label">Main Menu</li>
                    <li><a class="" href="{{route('role.index')}}" aria-expanded="false">
                            <i class="las la-cog"></i>
                            <span class="nav-text">Permissions</span>
                        </a>
                    </li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="la la-universal-access"></i>
                            <span class="nav-text">Roles</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('user.index')}}"><i class="la la-users"></i>Users</a></li>
                            <li><a href="{{route('instructor.index')}}"><i
                                        class="las la-chalkboard-teacher"></i>Instructors</a>
                            </li>
                            <li><a href="{{route('student.index')}}"><i class="las la-book-reader"></i>Students</a></li>
                        </ul>
                    </li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="las la-school"></i>
                            <span class="nav-text">Courses</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('courseCategory.index')}}"><i class="la la-list"></i>Course
                                    Category</a>
                            </li>
                            <li><a href="{{route('courseList')}}"><i class="las la-school"></i>Courses List</a></li>
                            <li><a href="{{route('course.index')}}"><i class="las la-book-open"></i>All Courses</a></li>
                            <!-- <li><a href="{{route('lesson.index')}}"><i class="las la-chalkboard"></i>Lessons</a></li> -->
                            <!-- <li><a href="{{route('material.index')}}"><i class="las la-atom"></i></i>Materials</a></li> -->
                        </ul>
                    </li>
                    <li><a class="" href="{{route('enrollment.index')}}" aria-expanded="false">
                            <i class="las la-bullseye"></i>
                            <span class="nav-text">Enrollments</span>
                        </a>
                    </li>
                    <li><a class="" href="{{route('event.index')}}" aria-expanded="false">
                            <i class="las la-icons"></i>
                            <span class="nav-text">Events</span>
                        </a>
                    </li>
                    <li><a class="" href="{{route('coupon.index')}}" aria-expanded="false">
                            <i class="las la-tags"></i>
                            <span class="nav-text">Coupons</span>
                        </a>
                    </li>
                     <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="las la-tasks"></i>
                            <span class="nav-text">Quizzes</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('quiz.index')}}"><i class="las la-icons"></i>All Quizzes</a></li>
                            <li><a href="{{route('question.index')}}"><i
                                        class="las la-question-circle"></i>Questions</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="las la-clipboard-list"></i> <!-- Clipboard list icon for project -->
                            <span class="nav-text">Project</span>
                        </a>
                        <ul aria-expanded="false">
                            <li>
                                <a href="#"><i class="las la-folder-open"></i> All Projects</a> <!-- Folder open icon -->
                            </li>
                            <!-- Uncomment if needed -->
                            <!-- <li>
                                <a href="{{route('question.index')}}"><i class="las la-question-circle"></i> Questions</a>
                            </li> -->
                        </ul>
                    </li>
                    <li><a class="" href="{{route('certificates.index')}}" aria-expanded="false">
                    <i class="las la-atom"></i>
                            <span class="nav-text">Certificates</span>
                        </a>
                    </li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="las la-star-half-alt"></i>
                            <span class="nav-text">Reviews</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('review.index')}}"><i class="las la-wave-square"></i>All Review</a>
                            </li>
                            <li><a href="{{route('review.index')}}"><i class="las la-star"></i>Ratings</a></li>
                        </ul>
                    </li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="las la-comment"></i>
                            <span class="nav-text">Forum</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('discussion.index')}}"><i class="las la-comment-alt"></i>Discussion</a>
                            </li>
                            <li><a href="{{route('message.index')}}"><i class="las la-envelope"></i>Messages</a></li>
                        </ul>
                    </li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="las la-money-check"></i>
                            <span class="nav-text">Payments</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('courseFee')}}"><i class="las la-money-bill"></i>Course Payments</a></li>
                            <li><a href="{{route('subscriptionPlan.index')}}"><i class="las la-money-bill"></i>Subscription Plans</a></li>
                            <li><a href="{{route('subscription.index')}}"><i class="las la-money-bill"></i>Subscription Fees</a></li>
                            <li><a href="{{route('coupon.index')}}"><i class="las la-tags"></i>Coupons</a></li>
                        </ul>
                    </li> 
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="las la-file-alt"></i>
                            <span class="nav-text">Report</span>
                        </a>
                        <ul aria-expanded="false">
                            <li>
                                <a href="{{route('customPlan')}}">
                                    <i class="las la-file-signature"></i> Custom Plan Request
                                </a>
                            </li>
                            <li>
                                <a href="{{route('contactReport')}}">
                                    <i class="las la-address-book"></i> Contact Report
                                </a>
                            </li>                            
                        </ul>
                    </li>
                    <li><a class="" href="{{route('logOut')}}" aria-expanded="false">
                            <i class="lab la-gg-circle"></i>
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
                <li class="nav-label first">Instructor Panel</li>
                <li><a class="ai-icon" href="{{route('home')}}" aria-expanded="false">
                        <i class="las la-home"></i><span class="nav-text">Home</span>
                    </a>
                </li>
                <li><a class="ai-icon" href="{{route('dashboard')}}" aria-expanded="false">
                        <i class="las la-tachometer-alt"></i> <span class="nav-text">Dashboard</span>
                    </a>
                </li>  
                @if(Auth::check() && auth()->user()->role_id == 1) 
                    <li><a href="{{route('user.edit', encryptor('encrypt',auth()->user()->id))}}"><i
                                        class="las la-chalkboard-teacher"></i>Profile</a>
                            </li>   
                    @elseif(Auth::check() && auth()->user()->role_id == 2) 
                    <li><a href="{{route('user.edit', encryptor('encrypt',auth()->user()->id))}}"><i
                                        class="las la-chalkboard-teacher"></i>Profile</a>
                            </li>  
                    @elseif(Auth::check() && auth()->user()->role_id == 3)     
                    <li><a href="{{route('instructor.edit', encryptor('encrypt',auth()->user()->instructor_id))}}"><i
                                        class="las la-chalkboard-teacher"></i>Profile</a>
                            </li> 
                    @else
                    <script>
                        window.location.href = "{{ route('logOut') }}";
                    </script>
                    @endif                     
                <li class="nav-label">Main Menu</li>                
                <!-- <li><a href="{{route('student.index')}}"><i class="las la-book-reader"></i>Students List</a></li> -->
                <li><a href="{{route('course.index')}}"><i class="las la-book-open"></i>My Courses</a></li>
                <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="las la-tasks"></i>
                            <span class="nav-text">Quiz</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('quiz.index')}}"><i class="las la-icons"></i>All Quiz</a></li>
                            <!-- <li><a href="{{route('question.index')}}"><i
                                        class="las la-question-circle"></i>Questions</a></li> -->
                        </ul>
                    </li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="las la-clipboard-list"></i> <!-- Clipboard list icon for project -->
                            <span class="nav-text">Project</span>
                        </a>
                        <ul aria-expanded="false">
                            <li>
                                <a href="{{route('project.index')}}"><i class="las la-folder-open"></i> All Projects</a> <!-- Folder open icon -->
                            </li>
                            <!-- Uncomment if needed -->
                            <!-- <li>
                                <a href="{{route('question.index')}}"><i class="las la-question-circle"></i> Questions</a>
                            </li> -->
                        </ul>
                    </li>
                    <li><a class="" href="{{route('certificates.index')}}" aria-expanded="false">
                    <i class="las la-atom"></i>
                            <span class="nav-text">Certificates</span>
                        </a>
                    </li>
                    <li><a href="{{route('coupon.index')}}"><i class="las la-tags"></i>Coupons</a></li>
                    <li><a class="" href="{{route('enrollment.index')}}" aria-expanded="false">
                            <i class="las la-bullseye"></i>
                            <span class="nav-text">Enrollments</span>
                        </a>
                    </li>
                <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="las la-money-check"></i>
                            <span class="nav-text">Payments</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('courseFee')}}"><i class="las la-money-bill"></i>Course Payments</a></li>
                            <li><a href="{{route('subscription.view')}}"><i class="las la-money-bill"></i>Subscription</a></li>                            
                        </ul>
                    </li> 
                    <li><a href="{{route('instructor.index')}}">
                        <i class="las la-chalkboard-teacher"></i>Instructors List
                    </a>
                </li>
                <!-- <li><a href="{{route('enrollment.index')}}"><i class="las la-bullseye"></i>Enrollments</a></li> -->
                <li><a href="{{route('logOut')}}"><i class="lab la-gg-circle"></i>Logout</a></li>
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