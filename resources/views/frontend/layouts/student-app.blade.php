<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }} | @yield('title', 'Home')</title>
    <link rel="stylesheet" href="{{asset('frontend/dist/main.css')}}" />
    <link rel="icon" type="image/png" href="{{asset('frontend/dist/images/favicon/favicon.png')}}" />
    <link rel="stylesheet" href="{{asset('frontend/fontawesome-free-5.15.4-web/css/all.min.css')}}">
    
    <style>
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
            left: -160px;
            /* Adjust this value based on your design */

        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }

        .dropdown.active .dropdown-content {
            display: block;
        }
    </style>
    <style>
      .course-title-container {
    background-color: #007bff; /* Bootstrap primary blue or any custom blue */
    padding: 0px;
    border-radius: 8px;
    margin-bottom: 0px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Adds depth with a subtle shadow */
}

.course-title {
    font-size: 1.2rem;
    margin-bottom: 0;
}

.course-title-link {
    color: #ffffff; /* White text color */
    font-weight: 500;
    text-transform: uppercase;
    text-decoration: none;
    transition: color 0.3s ease, transform 0.3s ease;
}

.course-title-link:hover {
    color: #ffeb3b; /* Bright yellow on hover for contrast */
    transform: scale(1.05);
}

.text-center {
    text-align: center;  /* Center the text and inline elements */
}
    </style>
    <style>
      .contentCard-watch--progress {
    height: 30px; /* Match the height of the outer container */
    transition: width 0.4s ease; /* Smooth transition for progress changes */
}

.contentCard-watch--progress-wrapper {
    margin-top: 10px; /* Add some spacing */
}

.percentage {
    display: block;
    height: 100%; /* Match height of the container */
    border-radius: 5px; /* Round edges for the progress bar */
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
}

.font-weight-bold {
    font-weight: bold; /* Make percentage text bold */
}

.text-center {
    text-align: center; /* Center align text */
}

.button--primary {
    background-color: #007bff;
    color: white;
}

/* Secondary button color */
.button--secondary {
    background-color: #28a745;
    color: white;
}

/* .button--primary:hover, .button--secondary:hover {
    opacity: 0.8;
} */

.button {
    cursor: pointer;
}
    </style>
    <style>
    /* Center the table and add styling */
    table {
        margin: 20px auto; /* Center the table horizontally */
        border-collapse: collapse; /* Remove spacing between table borders */
    }

    td {
        padding: 10px;
        text-align: center; /* Center-align the content inside the cell */
    }

    label {
        font-weight: bold; /* Bold label text */
        font-size: 16px;
    }

    .form-control {
        width: 100%; /* Full width dropdown */
        padding: 8px;
        font-size: 16px;
        border: 1px solid #ccc; /* Light gray border */
        border-radius: 5px; /* Rounded edges */
    }

    #planDetails {
        margin: 20px auto;
        width: 50%; /* Adjust width for better centering */
        padding: 15px;
        border: 1px solid #ddd; /* Add border to the plan details */
        border-radius: 8px; /* Rounded corners */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Light shadow effect */
        background-color: #f9f9f9; /* Light background color */
    }

    .list-group-item {
        padding: 10px 15px;
        font-size: 14px;
        border: none; /* Remove list border */
        background: transparent; /* Transparent background */
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
.students-info-intro{
    background:linear-gradient(
       135deg,
    #2563eb 0%,
    #4f46e5 50%,
    #7c3aed 100%
    );

    border-radius:24px;
    position:relative;
    overflow:hidden;
    margin-top:-40px !important;
    /* border:3px solid #f79a58 !important; */
}

.students-info-intro::before{
    content:'';
    position:absolute;
    top:-80px;
    right:-80px;
    width:250px;
    height:250px;
    background:rgba(255,255,255,.08);
    border-radius:50%;
}

.students-info-intro::after{
    content:'';
    position:absolute;
    bottom:-60px;
    left:-60px;
    width:180px;
    height:180px;
    background:rgba(255,255,255,.05);
    border-radius:50%;
}

/* ========================
   TOP SECTION
======================== */

.students-info-intro{
    background:linear-gradient(
        135deg,
        #2563eb 0%,
        #4f46e5 50%,
        #7c3aed 100%
    );

    border-radius:24px;
    position:relative;
    overflow:hidden;
}

/* TOP BAR */

.students-info-intro__profile{
    display:flex;
    justify-content:space-between;
    align-items:center;

    gap:25px;

    padding:22px 28px;
}

/* PROFILE */

.students-info-intro-start{
    display:flex;
    align-items:center;
    gap:16px;
    
}

.students-info-intro-start .image img{
    width:75px;
    height:75px;

    border-radius:50%;
    object-fit:cover;

    border:4px solid rgba(255,255,255,.2);
}

.students-info-intro-start .text h5{
    margin:0;
    color:#fff;
    font-size:24px;
    font-weight:700;
}

.students-info-intro-start .text p{
    margin:4px 0 8px;
    color:rgba(255,255,255,.85);
}

.student-badge{
    display:inline-flex;
    align-items:center;
    gap:8px;

    padding:6px 12px;

    background:rgba(255,255,255,.15);

    color:#fff;

    border-radius:50px;

    font-size:12px;
}

/* STATS */

.students-info-intro-end{
    display:flex;
    gap:15px;
}

/* ================= CARD ================= */
.enrolled-courses,
.completed-courses{
    display:flex;
    align-items:center;
    gap:12px;

    padding:14px 18px;
    border-radius:16px;

    background:linear-gradient(
        135deg,
        #2563eb 0%,
        #4f46e5 50%,
        #7c3aed 100%
    );

    color:#fff;

    box-shadow:0 10px 25px rgba(0,0,0,0.15);

    min-width:170px;

    transition:.3s ease;
    position:relative;
    overflow:hidden;
}

/* subtle shine overlay */
.enrolled-courses::before,
.completed-courses::before{
    content:"";
    position:absolute;
    inset:0;
    background:rgba(255,255,255,0.08);
    opacity:0;
    transition:.3s ease;
}

.enrolled-courses:hover,
.completed-courses:hover{
    transform:translateY(-4px);
}

.enrolled-courses:hover::before,
.completed-courses:hover::before{
    opacity:1;
}

/* ================= ICON ================= */
.enrolled-courses-icon,
.completed-courses-icon{
    width:52px;
    height:52px;
    border-radius:14px;

    display:flex;
    align-items:center;
    justify-content:center;

    font-size:20px;

    color:#fff;

    /* stronger visibility upgrade */
    background:rgba(255,255,255,0.28);
    border:1px solid rgba(255,255,255,0.45);

    box-shadow:
        0 8px 18px rgba(0,0,0,0.25),
        inset 0 1px 0 rgba(255,255,255,0.35);

    backdrop-filter:blur(14px);

    flex-shrink:0;
    position:relative;
}

/* optional icon variation (if you still want differentiation) */
.completed-courses-icon{
    background:rgba(255,255,255,0.22);
}

/* ================= TEXT ================= */
.enrolled-courses-text h6,
.completed-courses-text h5{
    margin:0;
    color:#fff;
    font-size:22px;
    font-weight:800;
}

.enrolled-courses-text p,
.completed-courses-text p{
    margin:0;
    color:rgba(255,255,255,0.85);
    font-size:13px;
    font-weight:500;
}

/* NAVIGATION */

.students-info-intro__nav{
    padding:16px 24px;

    background:rgba(255,255,255,.08);

    border-top:1px solid rgba(255,255,255,.12);
}

.students-info-intro__nav .nav{
    display:flex;
    gap:10px;
    flex-wrap:wrap;
}

.students-info-intro__nav .nav-link{
    display:flex;
    align-items:center;
    gap:8px;

    padding:10px 16px;

    border:none !important;

    border-radius:12px;

    background:rgba(255,255,255,.12);

    color:#fff !important;

    font-weight:600;

    transition:.3s;
}

.students-info-intro__nav .nav-link:hover{
    background:#fff;
    color:#4f46e5 !important;
}

.students-info-intro__nav .nav-link.active{
    background:#fff;
    color:#4f46e5 !important;

    box-shadow:0 8px 20px rgba(0,0,0,.12);
}

/* MOBILE */

@media(max-width:768px){

    .students-info-intro__profile{
        flex-direction:column;
        align-items:flex-start;
    }

    .students-info-intro-end{
        width:100%;
        justify-content:space-between;
    }

    .students-info-intro-start .image img{
        width:65px;
        height:65px;
    }

    .students-info-intro-start .text h5{
        font-size:20px;
    }

    .students-info-intro__nav .nav-link{
        width:100%;
        justify-content:center;
    }
}

/* breadcrumb style */
/* ===== PAGE HEADER WRAPPER ===== */
.lms-page-header {
    padding: 10px 0;
    background: linear-gradient(135deg, #f8fafc, #eef2ff);
}

/* ===== MAIN CARD ===== */
.lms-header-card {
    display: flex;
    justify-content: space-between;
    align-items: center;

    background: #ffffff;
    border-radius: 16px;
    padding: 20px 24px;

    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
    border: 2px solid #3440e6;

}

/* ===== LEFT SIDE ===== */
.lms-page-title {
    font-size: 22px;
    font-weight: 800;
    color: #111827;
    margin-bottom: 6px;
}

/* Breadcrumb */
.lms-breadcrumb-nav .breadcrumb {
    background: transparent;
    padding: 0;
    margin: 0;
}

.lms-breadcrumb-nav .breadcrumb-item {
    font-size: 13px;
}

.lms-breadcrumb-nav .breadcrumb-item a {
    color: #4f46e5;
    font-weight: 600;
    text-decoration: none;
}

.lms-breadcrumb-nav .breadcrumb-item a:hover {
    text-decoration: underline;
}

.lms-breadcrumb-nav .breadcrumb-item.active {
    color: #6b7280;
    font-weight: 600;
}

/* Divider */
.breadcrumb-item + .breadcrumb-item::before {
    content: "›";
    color: #9ca3af;
    font-weight: 600;
}

/* ===== RIGHT SIDE BUTTONS ===== */
.lms-header-right {
    display: flex;
    gap: 10px;
}

.lms-btn {
    padding: 8px 14px;
    border-radius: 10px;
    font-size: 13px;
    font-weight: 600;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    transition: 0.25s ease;
}

/* Outline button */
.lms-btn-outline {
    border: 1px solid #4f46e5;
    color: #4f46e5;
    background: transparent;
}

.lms-btn-outline:hover {
    background: #4f46e5;
    color: #fff;
}

/* Primary button */
.lms-btn-primary {
    background: #4f46e5;
    color: #fff;
    border: 1px solid #4f46e5;
}

.lms-btn-primary:hover {
    background: #3730a3;
    border-color: #3730a3;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 768px) {
    .lms-header-card {
        flex-direction: column;
        align-items: flex-start;
        gap: 15px;
    }

    .lms-header-right {
        width: 100%;
        justify-content: flex-start;
        flex-wrap: wrap;
    }
}
</style>
<style>
    /* ===== LAYOUT ===== */
.lms-layout {
    display: flex;
    min-height: 100vh;
    background: #f5f7fb;
}


/* ===== MAIN ===== */
.lms-main {
    margin-left: 260px;
    width: 100%;
}

/* TOPBAR */
.lms-topbar {
    height: 60px;
    background: #fff;
    border-bottom: 1px solid #e5e7eb;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 20px;
}

/* TOGGLE */
.lms-toggle-btn {
    border: none;
    background: transparent;
    font-size: 20px;
    cursor: pointer;
}

/* ICONS */
.lms-icon-btn {
    position: relative;
    margin-right: 15px;
    text-decoration: none;
}

.lms-icon-btn span {
    background: #4f46e5;
    color: #fff;
    font-size: 11px;
    padding: 2px 6px;
    border-radius: 50%;
    position: absolute;
    top: -6px;
    right: -10px;
}

/* AVATAR */
.lms-avatar img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    object-fit: cover;
}

/* CONTENT */
.lms-content {
    padding: 25px;
}

/* Mobile hidden state */
/* ==========================================
   MOBILE SIDEBAR FIX (NON-DESTRUCTIVE)
========================================== */

/* RIGHT SIDE WRAPPER */
.lms-topbar-right {
    display: flex;
    align-items: center;
    gap: 18px;
}

/* ICON GROUP */
.lms-topbar-icons {
    display: flex;
    align-items: center;
}

/* CART ICON */
.lms-icon-btn {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;

    width: 20px;
    height: 20px;

    border-radius: 10px;
    background: #f3f4f6;
    text-decoration: none;
    transition: 0.2s ease;
}

.lms-icon-btn:hover {
    background: #e0e7ff;
}

/* CART ICON SIZE */
.lms-cart-icon {
    font-size: 18px;
}

/* BADGE */
.lms-badge{
    position: absolute;

    top: 12px;
    left: 12px;

    z-index: 100;

    display: inline-flex;
    align-items: center;

    padding: 6px 12px;

    border-radius: 30px;

    font-size: 12px;
    font-weight: 700;

    color: #fff;

    box-shadow: 0 4px 12px rgba(0,0,0,.15);

    white-space: nowrap;
}

/* Status Colors */
.lms-badge.success{
    background: #16a34a;
}

.lms-badge.progress{
    background: #4f46e5;
}

.lms-badge.neutral{
    background: #64748b;
}
/* AVATAR */
.lms-avatar-wrapper img {
    width: 38px;
    height: 38px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid #e5e7eb;
    cursor: pointer;
    transition: 0.2s ease;
}

.lms-avatar-wrapper img:hover {
    border-color: #4f46e5;
}

/* ===== SIDEBAR ===== */

/* ================= SIDEBAR ROOT ================= */
.lms-sidebar {
    width: 260px;
    height: 100vh;

    position: fixed;
    left: 0;
    top: 0;

    background: #ffffff;
    border-right: 1px solid #e5e7eb;

    display: flex;
    flex-direction: column;

    overflow: hidden;
}

/* ================= TOP LOGO ================= */
.lms-sidebar-top {
    padding: 18px 20px;
    border-bottom: 1px solid #f1f1f1;
    flex-shrink: 0;
}

.lms-sidebar-top img {
    max-width: 140px;
}

/* ================= SCROLL AREA ================= */
.lms-sidebar-scroll {
    flex: 1;
    overflow-y: auto;

    padding: 12px 10px;
}

/* scrollbar */
.lms-sidebar-scroll::-webkit-scrollbar {
    width: 5px;
}

.lms-sidebar-scroll::-webkit-scrollbar-thumb {
    background: #d1d5db;
    border-radius: 10px;
}

.lms-sidebar-scroll::-webkit-scrollbar-thumb:hover {
    background: #9ca3af;
}

/* ================= MENU ================= */
.lms-sidebar-menu {
    list-style: none;
    padding: 0;
    margin: 0;
}

.lms-sidebar-menu li {
    margin: 4px 0;
}

.lms-sidebar-menu a {
    display: flex;
    align-items: center;
    gap: 10px;

    padding: 10px 12px;
    border-radius: 10px;

    text-decoration: none;
    color: #374151;
    font-weight: 600;
    font-size: 14px;

    transition: all 0.2s ease;
}

.lms-sidebar-menu a:hover {
    background: #eef2ff;
    color: #4f46e5;
    transform: translateX(2px);
}

/* ================= SECTION TITLES ================= */
.lms-section-title {
    font-size: 11px;
    font-weight: 700;
    color: #9ca3af;

    margin: 16px 0 6px 10px;

    letter-spacing: 0.08em;
    text-transform: uppercase;
}

/* ================= FOOTER ================= */
/* ================= FOOTER BACKGROUND ================= */
.lms-sidebar-footer {
    padding: 14px 16px;

    display: flex;
    flex-direction: column;
    gap: 14px; /* 🔥 more breathing space */

    flex-shrink: 0;

    background: linear-gradient(
        135deg,
        #0f172a 0%,
        #111827 50%,
        #1e1b4b 100%
    );

    border-top: 1px solid rgba(255,255,255,0.08);
}

/* ================= APP INFO ================= */
.lms-footer-top {
    padding-bottom: 6px;
}

.lms-app-info {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

/* 🔥 FIX: make text white and visible */
.lms-app-info .app-name {
    font-size: 14px;
    font-weight: 700;
    color: #ffffff;
    letter-spacing: 0.4px;
}

.lms-app-info .app-version {
    font-size: 11px;
    padding: 3px 8px;
    border-radius: 999px;

    color: #ffffff;
    background: rgba(255,255,255,0.12);
    border: 1px solid rgba(255,255,255,0.18);
}

/* ================= LINKS WRAPPER (FIX SPACING) ================= */
.lms-footer-links {
    display: flex;
    flex-direction: column;
    gap: 10px; /* 🔥 more separation between buttons */
}

/* ================= BUTTON STYLE ================= */
.lms-sidebar-footer a {
    font-size: 13px;
    font-weight: 600;

    text-decoration: none;

    display: flex;
    align-items: center;
    gap: 10px;

    padding: 11px 12px;
    border-radius: 10px;

    color: rgba(255,255,255,0.92);

    background: rgba(255,255,255,0.10);
    border: 1px solid rgba(255,255,255,0.12);

    backdrop-filter: blur(10px);

    transition: all 0.25s ease;

    box-shadow: 0 4px 10px rgba(0,0,0,0.25);
}

/* hover effect */
.lms-sidebar-footer a:hover {
    transform: translateX(5px);

    background: rgba(255,255,255,0.18);
    border-color: rgba(255,255,255,0.25);

    color: #ffffff;

    box-shadow: 0 10px 20px rgba(0,0,0,0.35);
}

/* ================= DANGER BUTTON ================= */
.lms-sidebar-footer a.text-danger {
    background: rgba(239,68,68,0.18);
    border: 1px solid rgba(239,68,68,0.25);
    color: #fecaca;
}

.lms-sidebar-footer a.text-danger:hover {
    background: rgba(239,68,68,0.30);
    color: #ffffff;
}

.lms-sidebar-mobile-header{
    display:none;
}

/* ==========================================
   MOBILE SIDEBAR
========================================== */
@media (max-width:991px){

    #lmsSidebar{
        transform: translateX(-100%);
        transition: transform .3s ease;
        z-index: 9999;
    }

    #lmsSidebar.is-open{
        transform: translateX(0);
    }

    .lms-main{
        margin-left: 0;
        width: 100%;
    }

      .lms-sidebar-mobile-header{
        display:flex;
        justify-content:flex-end;
        align-items:center;
        padding:14px 16px;
        border-bottom:1px solid #e5e7eb;
        background:#fff;
    }

    .lms-sidebar-close-btn{
        width:40px;
        height:40px;

        display:flex;
        align-items:center;
        justify-content:center;

        border:none;
        border-radius:12px;

        background:#f1f5f9;
        color:#0f172a;

        cursor:pointer;

        transition:all .25s ease;

        box-shadow:0 2px 8px rgba(0,0,0,.08);
    }

    .lms-sidebar-close-btn span{
        font-size:24px;
        line-height:1;
        font-weight:700;
    }

    .lms-sidebar-close-btn:hover{
        background:#e2e8f0;
        transform:scale(1.05);
    }

    .lms-sidebar-close-btn:active{
        transform:scale(.95);
    }

}

/* completed courses */

/* ========== COURSE CARD ========== */
.lms-course-card {
    display: flex;
    flex-direction: column;

    border-radius: 16px;
    overflow: hidden;

    background: #fff;
    border: 1px solid #eef2f7;
    margin-top:-35px !important;
}

.lms-course-card:hover {
    transform: translateY(-4px);
}

/* IMAGE */
.lms-course-image{
    position: relative;
    height: 220px;
    overflow: hidden;
    padding: 0;
    margin: 0;
}

.lms-course-image-link{
    display: block;
    width: 100%;
    height: 100%;
}

.lms-course-image img{
    width: 100%;
    height: 100%;
    display: block;
    object-fit: cover;
}

/* BADGE */
.lms-badge {
    position: absolute;
    top: 12px;
    left: 12px;

    padding: 5px 10px;
    border-radius: 20px;

    font-size: 12px;
    font-weight: 600;
    color: #fff;

    z-index: 10; /* IMPORTANT */
}

/* STATUS COLORS */
.lms-badge.success {
    background: #16a34a;
}

.lms-badge.progress {
    background: #4f46e5;
}

.lms-badge.neutral {
    background: #6b7280;
}

/* BODY */
.lms-course-body {
    padding: 14px 16px;

    display: flex;
    flex-direction: column;
    margin-top: -40px;

    gap: 8px; /* replaces random margins */
}

/* INSTRUCTOR */
.lms-instructor {
    display: flex;
    align-items: center;
    gap: 8px;

    text-decoration: none;
    margin-bottom: 10px;

    font-size: 13px;
    color: #4b5563;
}

.lms-instructor img {
    width: 28px;
    height: 28px;
    border-radius: 50%;
    object-fit: cover;
}

/* TITLE */
.lms-course-title {
    font-size: 15px;
    font-weight: 700;
    color: #111827;

    margin-bottom: 10px;
}

/* STATS */
.lms-course-stats {
    display: flex;
    justify-content: space-between;

    font-size: 12px;
    color: #6b7280;

    margin-bottom: 12px;
}

/* PROGRESS */
.lms-progress-bar {
    height: 6px;
    background: #e5e7eb;
    border-radius: 10px;
    overflow: hidden;
    margin-bottom: 6px;
}

.lms-progress-bar span {
    display: block;
    height: 100%;
    background: #4f46e5;
    border-radius: 10px;
}

.lms-progress-text {
    font-size: 12px;
    color: #6b7280;
    margin-bottom: 12px;
}

/* BUTTON */
.lms-btn {
    display: block;
    text-align: center;

    padding: 10px;
    border-radius: 10px;

    background: #4f46e5;
    color: #fff;
    font-weight: 600;
    text-decoration: none;

    transition: 0.2s;
}

.lms-btn:hover {
    background: #3730a3;
}

/* EMPTY STATE */
.lms-btn.primary {
    background: #4f46e5;
    padding: 10px 18px;
    display: inline-block;
    margin-top: 10px;
    border-radius: 10px;
    color: #fff;
    text-decoration: none;
}

/* enrolled courses */

/* ================= COURSE CARD ================= */
.lms-course-card {
    background: #fff;
    border-radius: 16px;
    overflow: hidden;

    border: 1px solid #eef2f7;
    box-shadow: 0 6px 18px rgba(0,0,0,0.05);

    transition: 0.25s ease;
}

.lms-course-card:hover {
    transform: translateY(-4px);
}

/* IMAGE */
.lms-course-image {
    position: relative;
}

.lms-course-image img {
    width: 100%;
    height: 180px;
    object-fit: cover;
}

/* BADGES */
.lms-badge {
    position: absolute;
    top: 10px;
    left: 10px;

    padding: 5px 10px;
    border-radius: 20px;

    font-size: 12px;
    font-weight: 600;
    color: #fff;
}

.lms-badge.success {
    background: #16a34a;
}

.lms-badge.progress {
    background: #4f46e5;
}

.lms-badge.neutral {
    background: #6b7280;
}

/* BODY */
.lms-course-body {
    padding: 16px;
}

/* TITLE */
.lms-course-title {
    font-size: 15px;
    font-weight: 700;
    margin-bottom: 10px;
    color: #111827;
}

/* STATS */
.lms-course-stats {
    display: flex;
    justify-content: space-between;

    font-size: 12px;
    color: #6b7280;

    margin-bottom: 10px;
}

/* INSTRUCTOR */
.lms-instructor {
    display: flex;
    align-items: center;
    gap: 8px;

    font-size: 13px;
    color: #4b5563;
    text-decoration: none;

    margin-bottom: 10px;
}

.lms-instructor img {
    width: 28px;
    height: 28px;
    border-radius: 50%;
    object-fit: cover;
}

/* PROGRESS */
.lms-progress-bar {
    height: 6px;
    background: #e5e7eb;
    border-radius: 10px;
    overflow: hidden;

    margin-bottom: 6px;
}

.lms-progress-bar span {
    display: block;
    height: 100%;
    background: #4f46e5;
}

.lms-progress-text {
    font-size: 12px;
    color: #6b7280;
    margin-bottom: 12px;
}

/* BUTTON */
.lms-btn {
    display: block;
    text-align: center;

    padding: 10px;
    border-radius: 10px;

    background: #4f46e5;
    color: #fff;
    font-weight: 600;
    text-decoration: none;

    transition: 0.2s;
}

.lms-btn:hover {
    background: #3730a3;
}

/* CERT LINK */
.lms-cert-link {
    display: block;
    text-align: center;

    margin-top: 10px;
    font-size: 13px;
    color: #16a34a;
    font-weight: 600;
    text-decoration: none;
}

.lms-cert-link:hover {
    text-decoration: underline;
}

/* lms-dashboard-nav */
/* ===================================
   LMS DASHBOARD NAVIGATION
=================================== */

.lms-dashboard-nav {
    margin-bottom: 30px;
}

.lms-dashboard-nav-inner {
    display: flex;
    align-items: center;
    gap: 12px;

    padding: 10px;

    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 18px;

    overflow-x: auto;
    scrollbar-width: none;

    box-shadow:
        0 4px 20px rgba(15, 23, 42, 0.05);
}

.lms-dashboard-nav-inner::-webkit-scrollbar {
    display: none;
}

/* NAV ITEMS */

.lms-nav-item {
    display: flex;
    align-items: center;
    gap: 10px;

    border: none;
    background: transparent;

    padding: 12px 18px;

    border-radius: 14px;

    font-size: 14px;
    font-weight: 600;

    color: #64748b;
    text-decoration: none;

    transition: all .25s ease;

    white-space: nowrap;
}

/* HOVER */

.lms-nav-item:hover {
    background: #f8fafc;
    color: #4f46e5;
}

/* ACTIVE */

.lms-nav-item.active {
    background: linear-gradient(
        135deg,
        #564fdb,
        #f1f1f7
    );

    color: #ffffff;

    box-shadow:
        0 10px 20px rgba(79,70,229,.25);
}

/* ICON */

.lms-nav-icon {
    width: 34px;
    height: 34px;

    border-radius: 10px;

    display: flex;
    align-items: center;
    justify-content: center;

    background: rgba(79,70,229,.08);

    font-size: 14px;
}

.lms-nav-item.active .lms-nav-icon {
    background: rgba(255,255,255,.18);
    color: #fff;
}

/* TEXT */

.lms-nav-text {
    font-weight: 600;
    letter-spacing: .2px;
}

/* MOBILE */

@media (max-width: 768px) {

    .lms-dashboard-nav-inner {
        padding: 8px;
        gap: 8px;
    }

    .lms-nav-item {
        padding: 10px 14px;
        font-size: 13px;
    }

    .lms-nav-icon {
        width: 30px;
        height: 30px;
    }
}

/* completed courses */
/* COMPLETED CARD */
.lms-course-card-completed{
    border:1px solid #e5e7eb;
    border-radius:20px;
    overflow:hidden;
    background:#fff;
    transition:.3s;
}

.lms-course-card-completed:hover{
    transform:translateY(-5px);
    box-shadow:0 15px 35px rgba(0,0,0,.08);
}

/* COMPLETED RIBBON */
.lms-completed-ribbon{
    position:absolute;
    top:14px;
    right:14px;

    background:#16a34a;
    color:#fff;

    padding:8px 14px;
    border-radius:30px;

    font-size:12px;
    font-weight:700;
}

/* STATS */
.lms-completed-stats{
    display:flex;
    gap:10px;
    flex-wrap:wrap;
    margin-top:12px;
}

.lms-completed-stats span{
    background:#f8fafc;
    border:1px solid #e2e8f0;

    padding:8px 12px;
    border-radius:999px;

    font-size:13px;
    font-weight:600;
}

/* ACHIEVEMENT */
.lms-achievement-box{
    display:flex;
    gap:12px;

    margin-top:18px;

    background:#f0fdf4;
    border:1px solid #bbf7d0;

    padding:14px;
    border-radius:14px;
}

.lms-achievement-icon{
    font-size:24px;
    color:#16a34a;
}

.lms-achievement-title{
    font-weight:700;
    color:#166534;
}

.lms-achievement-text{
    font-size:13px;
    color:#4b5563;
}

/* ACTIONS */
.lms-course-actions{
    display:flex;
    gap:10px;
    margin-top:18px;
}

.lms-btn-primary{
    flex:1;
    background:#4f46e5;
    color:#fff;
    text-align:center;

    padding:12px;
    border-radius:12px;
    text-decoration:none;
    font-weight:600;
}

.lms-btn-secondary{
    flex:1;
    background:#f8fafc;
    color:#334155;
    text-align:center;

    padding:12px;
    border-radius:12px;
    text-decoration:none;
    font-weight:600;

    border:1px solid #e2e8f0;
}

/* payment-history */
/* ==========================
   PAYMENT HISTORY
========================== */

.payment-history-card{
    background:#fff;
    border-radius:18px;
    padding:24px;
    box-shadow:0 10px 30px rgba(15,23,42,.08);
    border:1px solid #eef2f7;
    transition:.3s;
    margin-top:-35px !important;
}

.payment-history-card:hover{
    transform:translateY(-3px);
    box-shadow:0 15px 35px rgba(15,23,42,.12);
}

.payment-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:20px;
    padding-bottom:15px;
    border-bottom:1px solid #edf2f7;
}

.payment-course{
    display:flex;
    align-items:center;
    gap:15px;
}

.payment-icon{
    width:55px;
    height:55px;
    border-radius:14px;
    background:linear-gradient(
        135deg,
        #4f46e5,
        #7c3aed
    );
    display:flex;
    align-items:center;
    justify-content:center;
    color:#fff;
    font-size:20px;
}

.payment-course h5{
    margin:0;
    font-weight:700;
    color:#0f172a;
}

.payment-course small{
    color:#64748b;
}

.payment-body{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(170px,1fr));
    gap:18px;
}

.payment-stat{
    background:#f8fafc;
    padding:15px;
    border-radius:12px;
}

.payment-stat span{
    display:block;
    color:#64748b;
    font-size:13px;
    margin-bottom:6px;
}

.payment-stat h6{
    margin:0;
    font-weight:700;
    color:#0f172a;
}

.empty-payment-state{
    text-align:center;
    padding:60px 20px;
    background:#fff;
    border-radius:20px;
    border:1px dashed #cbd5e1;
}

.empty-payment-state i{
    font-size:50px;
    color:#94a3b8;
    margin-bottom:15px;
}

.empty-payment-state h5{
    color:#0f172a;
    margin-bottom:10px;
}

.empty-payment-state p{
    color:#64748b;
}
.payment-badge{
    display:inline-flex;
    align-items:center;
    gap:6px;
    padding:8px 14px;
    border-radius:30px;
    font-size:13px;
    font-weight:600;
    line-height:1;
}

.payment-badge.success{
    background:#dcfce7;
    color:#166534;
    border:1px solid #86efac;
}

.payment-badge.pending{
    background:#fef3c7;
    color:#92400e;
    border:1px solid #fcd34d;
}

.payment-badge.failed{
    background:#fee2e2;
    color:#991b1b;
    border:1px solid #fca5a5;
}
/* Profile style */
/* ===================================
   STUDENT PROFILE
=================================== */

.student-profile-grid{
    display:grid;
    grid-template-columns:1fr 1.3fr;
    gap:24px;
}

.profile-card{
    background:#fff;
    border-radius:20px;
    padding:24px;
    border:1px solid #edf2f7;
    box-shadow:0 10px 30px rgba(15,23,42,.06);
    transition:.3s ease;
}

.profile-card:hover{
    transform:translateY(-3px);
    box-shadow:0 15px 35px rgba(15,23,42,.10);
}

.profile-card-header{
    display:flex;
    align-items:center;
    gap:16px;
    margin-bottom:20px;
}

.profile-icon{
    width:58px;
    height:58px;
    border-radius:16px;
    background:linear-gradient(135deg,#4f46e5,#7c3aed);
    display:flex;
    align-items:center;
    justify-content:center;
    color:#fff;
    font-size:22px;
}

.profile-card-header h5{
    margin:0;
    font-weight:700;
    color:#0f172a;
}

.profile-card-header span{
    color:#64748b;
    font-size:14px;
}

.profile-card-body p{
    margin:0;
    color:#475569;
    line-height:1.8;
}

.profile-info-list{
    display:flex;
    flex-direction:column;
    gap:14px;
}

.profile-info-item{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:14px 16px;
    background:#f8fafc;
    border-radius:12px;
}

.profile-info-item .label{
    color:#64748b;
    font-size:14px;
    font-weight:500;
}

.profile-info-item .label i{
    margin-right:8px;
    width:18px;
}

.profile-info-item .value{
    color:#0f172a;
    font-weight:600;
    text-align:right;
}

.profile-about-card{
    background:
        linear-gradient(
            135deg,
            rgba(79,70,229,.03),
            rgba(124,58,237,.03)
        );
}

/* Mobile */

@media(max-width:991px){

    .student-profile-grid{
        grid-template-columns:1fr;
    }

    .profile-info-item{
        flex-direction:column;
        align-items:flex-start;
        gap:6px;
    }

    .profile-info-item .value{
        text-align:left;
    }

}
/* Profile Settings */
.settings-layout{
    display:grid;
    grid-template-columns:2fr 1fr;
    gap:25px;
}

.settings-main{
    display:flex;
    flex-direction:column;
    gap:25px;
}

.settings-card{
    background:#fff;
    border-radius:20px;
    padding:24px;
    border:1px solid #edf2f7;
    box-shadow:0 10px 30px rgba(15,23,42,.06);
}

.settings-card-header{
    display:flex;
    align-items:center;
    gap:15px;
    margin-bottom:25px;
}

.settings-icon{
    width:55px;
    height:55px;
    border-radius:14px;
    background:linear-gradient(135deg,#4f46e5,#7c3aed);
    color:#fff;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:20px;
}

.settings-icon.security{
    background:linear-gradient(135deg,#059669,#10b981);
}

.settings-card-header h5{
    margin:0;
    font-weight:700;
}

.settings-card-header span{
    color:#64748b;
    font-size:14px;
}

.settings-form-grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:20px;
}

.full-width{
    grid-column:1 / -1;
}

.form-group-modern label{
    display:block;
    margin-bottom:8px;
    font-weight:600;
    color:#334155;
}

.form-group-modern .form-control{
    border-radius:12px;
    min-height:50px;
    border:1px solid #dbe2ea;
}

.form-group-modern textarea.form-control{
    min-height:140px;
}

.settings-action{
    margin-top:25px;
}

.settings-btn-primary{
    border:none;
    background:linear-gradient(135deg,#4f46e5,#7c3aed);
    color:#fff;
    padding:12px 25px;
    border-radius:12px;
    font-weight:600;
}

.settings-btn-outline{
    width:100%;
    border:2px solid #4f46e5;
    background:none;
    color:#4f46e5;
    padding:12px;
    border-radius:12px;
    font-weight:600;
}

.profile-image-card{
    text-align:center;
}

.student-avatar-wrap img{
    width:180px;
    height:180px;
    object-fit:cover;
    border-radius:50%;
    border:5px solid #eef2ff;
    margin-bottom:15px;
}

.student-avatar-wrap h6{
    margin-bottom:5px;
    font-weight:700;
}

.student-avatar-wrap span{
    color:#64748b;
}

.upload-note{
    display:block;
    margin-top:15px;
    color:#94a3b8;
}

@media(max-width:991px){

    .settings-layout{
        grid-template-columns:1fr;
    }

    .settings-form-grid{
        grid-template-columns:1fr;
    }

}

/* Header-avatar-dropdown */
/* ================= AVATAR ================= */
.lms-avatar-wrapper{
    position: relative;
    display: inline-block;
}

/* avatar image */
.lms-avatar-toggle img{
    width: 42px;
    height: 42px;
    border-radius: 50%;

    object-fit: cover;
    cursor: pointer;

    border: 2px solid rgba(255,255,255,0.25);

    transition: 0.25s ease;
}

.lms-avatar-toggle img:hover{
    transform: scale(1.05);
    border-color: rgba(255,255,255,0.5);
}

/* ================= DROPDOWN ================= */
.lms-avatar-menu{
    position: absolute;
    right: 0;
    top: 55px;

    min-width: 160px;

    background: #0f172a;
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 12px;

    box-shadow: 0 12px 30px rgba(0,0,0,0.35);

    display: none;
    flex-direction: column;

    overflow: hidden;
    z-index: 999;
}

/* menu links */
.lms-avatar-menu a{
    padding: 10px 12px;
    font-size: 13px;
    font-weight: 500;

    color: rgba(255,255,255,0.9);
    text-decoration: none;

    display: flex;
    align-items: center;
    gap: 8px;

    transition: 0.2s ease;
}

.lms-avatar-menu a:hover{
    background: rgba(255,255,255,0.08);
}

/* danger logout */
.lms-avatar-menu a.danger{
    color: #f87171;
}

.lms-avatar-menu a.danger:hover{
    background: rgba(248,113,113,0.12);
    color: #fff;
}

/* footer style */
html, body {
    height: 100%;
}

/* push footer down using viewport math */
.lms-footer {
    width: 100%;
    background: #111827;
    color: #fff;
    padding: 12px 20px;

    /* key fix */
    position: sticky;
    top: 100vh;
}

.lms-footer-content{
    display:flex;
    align-items:center;
    justify-content:space-between;
}

.lms-footer-left,
.lms-footer-right{
    color:#fff;

    font-size:13px;
    font-weight:500;
}

/* lms course panel */

/* ===========================
   COURSE PANEL
=========================== */

.lms-course-panel{
    background:#fff;
    border-radius:28px;
    border:1px solid #e5e7eb;

    padding:28px;

    box-shadow:
        0 10px 40px rgba(15,23,42,.06);

    position:relative;
    overflow:hidden;
    margin-top: -40px;
}

/* decorative gradient strip */

.lms-course-panel::before{
    content:'';

    position:absolute;
    top:0;
    left:0;
    right:0;

    height:6px;

    background:linear-gradient(
        90deg,
        #2563eb,
        #4f46e5,
        #7c3aed
    );
}

.lms-course-panel-header{
    display:flex;
    justify-content:space-between;
    align-items:center;

    margin-bottom:30px;
    padding-bottom:20px;

    border-bottom:1px solid #eef2f7;
}

.lms-course-panel-header h4{
    margin:0;
    font-size:1.35rem;
    font-weight:700;
    color:#0f172a;
}

.lms-course-panel-header p{
    margin:6px 0 0;
    color:#64748b;
    font-size:.95rem;
}

.lms-course-count{
    display:inline-flex;
    align-items:center;
    gap:8px;

    padding:10px 16px;

    border-radius:999px;

    background:#eff6ff;
    color:#2563eb;

    font-size:.9rem;
    font-weight:700;
}

/* Optional subtle background */

.lms-course-panel-body{
    position:relative;
}

.lms-course-panel-body::after{
    content:'';

    position:absolute;

    width:350px;
    height:350px;

    top:-150px;
    right:-150px;

    border-radius:50%;

    background:rgba(79,70,229,.03);

    pointer-events:none;
}

/* Mobile */

@media(max-width:768px){

    .lms-course-panel{
        padding:20px;
        border-radius:22px;
    }

    .lms-course-panel-header{
        flex-direction:column;
        align-items:flex-start;
        gap:12px;
    }
}

/* dashboard stat */
.dashboard-stat{
    display:flex;
    align-items:center;
    gap:12px;

    padding:14px 16px;

    border-radius:16px;

    min-width:0;
    overflow:hidden;

    transition:all .3s ease;
}

.dashboard-stat:hover{
    transform:translateY(-2px);
}

.dashboard-stat-icon{
    width:42px;
    height:42px;

    flex-shrink:0;

    display:flex;
    align-items:center;
    justify-content:center;

    border-radius:12px;

    background:rgba(255,255,255,.18);
    backdrop-filter:blur(10px);
}

.dashboard-stat-icon i{
    font-size:18px;
    color:#fff;
}

.dashboard-stat-content{
    min-width:0;
    flex:1;
}

.dashboard-stat-content h6{
    margin:0;

    color:#fff;

    font-size:1.25rem;
    font-weight:700;

    line-height:1.1;
}

.dashboard-stat-content span{
    display:block;

    color:rgba(255,255,255,.92);

    font-size:.8rem;
    font-weight:600;

    white-space:nowrap;
    overflow:hidden;
    text-overflow:ellipsis;
}

/* Keep your existing colors */

.dashboard-stat.enrolled{
    background:linear-gradient(
        135deg,
        #2563eb,
        #4f46e5
    );
}

.dashboard-stat.active{
    background:linear-gradient(
        135deg,
        #b992e7,
        #7a21b1
    );
}

.dashboard-stat.completed{
    background:linear-gradient(
        135deg,
        #16537a,
        #2c94ef
    );
}

/* lms-search-course */
.lms-filter-card{
    background:#fff;
    border-radius:24px;
    padding:24px;

    border:1px solid #e5e7eb;

    box-shadow:
    0 10px 30px rgba(15,23,42,.05);

    position:sticky;
    top:20px;
}
.lms-results-card{
    background:#fff;

    border-radius:24px;

    padding:24px;

    border:1px solid #e5e7eb;

    box-shadow:
    0 10px 30px rgba(15,23,42,.05);
}

.lms-results-header{
    margin-bottom:25px;
    padding-bottom:20px;
    border-bottom:1px solid #eef2f7;
}

.lms-results-header h4{
    margin:0;
    font-weight:700;
}

.lms-results-header p{
    margin:5px 0 0;
    color:#64748b;
}
.course-search-hero{

    background:
    linear-gradient(
        135deg,
        #2563eb,
        #4f46e5,
        #7c3aed
    );

    border-radius:30px;

    padding:50px 40px;

    margin-bottom:35px;

    color:#fff;

    position:relative;
    overflow:hidden;
}

.course-search-content{
    max-width:700px;
}

.course-search-content h2{
    font-size:2rem;
    font-weight:800;
    margin-bottom:10px;
}

.course-search-content p{
    opacity:.9;
    margin-bottom:25px;
}

.course-search-form{
    display:flex;
    align-items:center;
    gap:12px;

    background:#fff;

    padding:10px;

    border-radius:18px;
}

.course-search-form i{
    color:#64748b;
    padding-left:10px;
}

.course-search-form input{
    border:none;
    box-shadow:none;
}

.course-search-form button{
    border:none;

    background:#2563eb;

    color:#fff;

    padding:12px 24px;

    border-radius:12px;

    font-weight:600;
}
/* Category row */
.accordion-body__item{
    display:flex;
    align-items:center;
    justify-content:space-between;

    padding:8px 0;
    border-bottom:1px solid #f1f5f9;
}

/* Left side */
.check-box{
    display:flex;
    align-items:center;
    gap:8px;

    min-width:0;
}

/* Category name */
.check-box label{
    margin:0;
    font-size:.85rem;
    font-weight:500;
    color:#334155;

    white-space:nowrap;
    overflow:hidden;
    text-overflow:ellipsis;
}

/* Count */
.check-details{
    margin:0;

    font-size:.8rem;
    font-weight:600;
    color:#64748b;

    background:#f8fafc;
    border:1px solid #e2e8f0;

    padding:2px 8px;
    border-radius:999px;

    line-height:1.4;
}
.course-search-links{
    display:flex;
    flex-wrap:wrap;
    gap:10px;

    margin-bottom:20px;
}

.hero-link{
    display:inline-flex;
    align-items:center;
    gap:8px;

    padding:8px 14px;

    background:rgba(255,255,255,.15);

    border:1px solid rgba(255,255,255,.2);

    border-radius:999px;

    color:#fff;
    text-decoration:none;

    font-size:.85rem;
    font-weight:600;

    backdrop-filter:blur(10px);

    transition:.3s ease;
}

.hero-link:hover{
    background:rgba(255,255,255,.25);
    color:#fff;
    transform:translateY(-2px);
}

.hero-link i{
    font-size:.8rem;
}

/* my-courses */
/* =========================
   GLOBAL CONTAINER
========================= */
.mycourses-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;
    margin-bottom: 25px;
}

.mycourses-header h2 {
    font-size: 26px;
    font-weight: 700;
    color: #1e293b;
    margin: 0;
}

.mycourses-header p {
    margin: 5px 0 0;
    color: #64748b;
    font-size: 14px;
}

/* Explore Button */
.browse-course-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 16px;
    background: linear-gradient(135deg, #4f46e5, #2563eb);
    color: #fff;
    border-radius: 10px;
    font-weight: 600;
    text-decoration: none;
    transition: 0.25s ease;
    box-shadow: 0 8px 20px rgba(37, 99, 235, 0.25);
}

.browse-course-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 12px 25px rgba(37, 99, 235, 0.35);
}

/* =========================
   STATS CARDS
========================= */

/* =========================
   MAIN CARD
========================= */
.mycourses-card {
    background: #ffffff;
    border-radius: 18px;
    border: 1px solid #eef2f7;
    box-shadow: 0 6px 18px rgba(15, 23, 42, 0.06);
    overflow: hidden;
}

/* Header */
.mycourses-card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 18px 20px;
    border-bottom: 1px solid #eef2f7;
    background: #f8fafc;
}

.mycourses-card-header h5 {
    margin: 0;
    font-size: 16px;
    font-weight: 700;
    color: #1e293b;
    display: flex;
    align-items: center;
    gap: 8px;
}

/* Search */
.course-search-input {
    padding: 10px 14px;
    border-radius: 10px;
    border: 1px solid #e2e8f0;
    outline: none;
    width: 260px;
    transition: 0.2s ease;
    font-size: 14px;
    background: #fff;
}

.course-search-input:focus {
    border-color: #2563eb;
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
}

/* =========================
   COURSE ITEM
========================= */
.my-course-item {
    display: flex;
    gap: 16px;
    padding: 18px 20px;
    border-bottom: 1px solid #f1f5f9;
    transition: 0.25s ease;
}

.my-course-item:hover {
    background: #f8fafc;
}

.course-thumb {
    width: 90px;
    height: 70px;
    border-radius: 12px;
    overflow: hidden;
    flex-shrink: 0;
    background: #e2e8f0;
}

.course-thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* Content */
.course-content {
    flex: 1;
}

.course-top {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 10px;
}

.course-top h6 {
    font-size: 15px;
    font-weight: 700;
    margin: 0 0 5px;
    color: #0f172a;
}

.course-meta {
    display: flex;
    gap: 12px;
    font-size: 12px;
    color: #64748b;
}

.course-meta i {
    margin-right: 4px;
}

/* Badge */
.course-badge {
    padding: 5px 10px;
    border-radius: 999px;
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
}

.course-badge.active {
    background: #fff7ed;
    color: #f59e0b;
}

.course-badge.completed {
    background: #ecfdf5;
    color: #10b981;
}

/* =========================
   PROGRESS BAR
========================= */
.course-progress-wrapper {
    margin-top: 10px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.course-progress {
    flex: 1;
    height: 6px;
    background: #e2e8f0;
    border-radius: 999px;
    overflow: hidden;
}

.course-progress span {
    display: block;
    height: 100%;
    background: linear-gradient(135deg, #4f46e5, #2563eb);
    border-radius: 999px;
}

.course-progress-wrapper small {
    font-size: 12px;
    color: #64748b;
}

/* =========================
   ACTION BUTTONS
========================= */
.course-actions {
    margin-top: 12px;
    display: flex;
    gap: 10px;
}

.continue-btn {
    padding: 8px 12px;
    border-radius: 8px;
    background: #2563eb;
    color: #fff;
    font-size: 13px;
    font-weight: 600;
    text-decoration: none;
    transition: 0.2s ease;
}

.continue-btn:hover {
    background: #1d4ed8;
}

.certificate-btn {
    padding: 8px 12px;
    border-radius: 8px;
    background: #10b981;
    color: #fff;
    font-size: 13px;
    font-weight: 600;
    text-decoration: none;
    transition: 0.2s ease;
}

.certificate-btn:hover {
    background: #059669;
}

/* =========================
   EMPTY STATE
========================= */
.empty-courses {
    text-align: center;
    padding: 50px 20px;
    color: #64748b;
}

.empty-courses i {
    font-size: 40px;
    margin-bottom: 10px;
    color: #94a3b8;
}

.empty-courses h4 {
    margin: 10px 0 5px;
    color: #0f172a;
}

/* =========================
   RESPONSIVE
========================= */
@media (max-width: 768px) {
    .mycourses-header {
        flex-direction: column;
        align-items: flex-start;
    }

    .course-search-input {
        width: 100%;
    }

    .my-course-item {
        flex-direction: column;
    }

    .course-thumb {
        width: 100%;
        height: 160px;
    }

    .course-top {
        flex-direction: column;
        align-items: flex-start;
    }
}

 /* =========================
   CONTAINER
========================= */
.mc-container {
    padding: 20px;
}

/* =========================
   HEADER
========================= */
.mc-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
    gap: 20px;
}

.mc-title {
    font-size: 26px;
    font-weight: 700;
    margin: 0;
    color: #0f172a;
}

.mc-subtitle {
    margin: 5px 0 0;
    color: #64748b;
    font-size: 14px;
}

.mc-action-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 16px;
    background: linear-gradient(135deg, #4f46e5, #2563eb);
    color: #fff;
    border-radius: 10px;
    text-decoration: none;
    font-weight: 600;
    transition: 0.25s ease;
}

.mc-action-btn:hover {
    transform: translateY(-2px);
}

/* =========================
   STATS
========================= */
.mc-stats {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 15px;
    margin-bottom: 25px;
}

.mc-stat-card {
    background: #fff;
    border-radius: 14px;
    padding: 18px;
    display: flex;
    align-items: center;
    gap: 12px;
    border: 1px solid #eef2f7;
}

.mc-stat-icon {
    width: 45px;
    height: 45px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
}

.mc-stat-card.active .mc-stat-icon {
    background: linear-gradient(135deg, #3b82f6, #1d4ed8);
}

.mc-stat-card.completed .mc-stat-icon {
    background: linear-gradient(135deg, #10b981, #059669);
}

.mc-stat-info h3 {
    margin: 0;
    font-size: 20px;
}

.mc-stat-info span {
    font-size: 13px;
    color: #64748b;
}

/* =========================
   GRID
========================= */
.mc-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
}

/* =========================
   CARD
========================= */
.mc-card {
    background: #fff;
    border-radius: 16px;
    overflow: hidden;
    border: 1px solid #eef2f7;
    transition: 0.25s ease;
}

.mc-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.08);
}

/* =========================
   IMAGE (FIXED COMPLETELY)
========================= */
.mc-card-image {
    position: relative;
    width: 100%;
    height: 180px;
    overflow: hidden;
    margin: 0;
    padding: 0;
}

/* make link fill full image area */
.mc-card-image a {
    display: block;
    width: 100%;
    height: 100%;
}

/* image fully covers container */
.mc-card-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    border: 0;
}

/* =========================
   BADGE (ONLY ONE CLEAN VERSION)
========================= */
.mc-badge {
    position: absolute;
    top: 10px;
    left: 10px;
    padding: 5px 10px;
    font-size: 11px;
    border-radius: 999px;
    color: #fff;
    z-index: 2;
}

.mc-badge.done {
    background: #10b981;
}

.mc-badge.progress {
    background: #f59e0b;
}

.mc-badge.new {
    background: #64748b;
}

/* =========================
   BODY
========================= */
.mc-card-body {
    padding: 15px;
}

.mc-course-title {
    font-size: 15px;
    font-weight: 700;
    margin-bottom: 10px;
    color: #0f172a;
}

/* =========================
   META
========================= */
.mc-meta {
    display: flex;
    justify-content: space-between;
    font-size: 12px;
    color: #64748b;
    margin-bottom: 10px;
}

/* =========================
   INSTRUCTOR
========================= */
.mc-instructor {
    display: flex;
    align-items: center;
    gap: 8px;
    text-decoration: none;
    margin-bottom: 10px;
}

.mc-instructor img {
    width: 28px;
    height: 28px;
    border-radius: 50%;
}

.mc-instructor span {
    font-size: 13px;
    color: #334155;
}

/* =========================
   PROGRESS
========================= */
.mc-progress-bar {
    width: 100%;
    height: 6px;
    background: #e2e8f0;
    border-radius: 999px;
    overflow: hidden;
}

.mc-progress-bar span {
    display: block;
    height: 100%;
    background: linear-gradient(135deg, #4f46e5, #2563eb);
}

.mc-progress small {
    font-size: 12px;
    color: #64748b;
}

/* =========================
   ACTIONS
========================= */
.mc-actions {
    display: flex;
    gap: 10px;
    margin-top: 12px;
}

.mc-btn {
    flex: 1;
    text-align: center;
    padding: 8px;
    border-radius: 8px;
    font-size: 13px;
    text-decoration: none;
    font-weight: 600;
}

.mc-btn.primary {
    background: #2563eb;
    color: #fff;
}

.mc-btn.secondary {
    background: #10b981;
    color: #fff;
}

/* =========================
   EMPTY
========================= */
.mc-empty {
    text-align: center;
    padding: 50px 20px;
}

/* =========================
   PAGINATION
========================= */
.mc-pagination {
    margin-top: 20px;
}

/* =========================
   RESPONSIVE
========================= */
@media (max-width: 992px) {
    .mc-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 768px) {
    .mc-header {
        flex-direction: column;
        align-items: flex-start;
    }

    .mc-grid {
        grid-template-columns: 1fr;
    }

    .mc-stats {
        grid-template-columns: 1fr;
    }
}

/* active links */
.lms-sidebar-menu a {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 10px 12px;
    border-radius: 6px;
    color: #000; /* inactive links = black */
    text-decoration: none;
    font-size: 14px;
    transition: all 0.2s ease;
}

/* hover only subtle */
.lms-sidebar-menu a:hover {
    color: #2563eb;
    background: transparent;
}

/* ACTIVE LINK (minimal style, no box) */
.lms-sidebar-menu a.active {
    color: #2563eb;
    font-weight: 600;
    position: relative;
}

/* optional subtle left indicator instead of box */
.lms-sidebar-menu a.active::before {
    content: "";
    position: absolute;
    left: 0;
    top: 25%;
    height: 50%;
    width: 3px;
    background: #2563eb;
    border-radius: 10px;
}
/* certificate style */
.cert-wrapper {
    padding: 25px;
}

/* HERO */
.cert-hero {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: linear-gradient(135deg, #1e293b, #111827);
    color: #fff;
    padding: 20px;
    border-radius: 14px;
    margin-bottom: 20px;
}

.cert-hero h1 {
    margin: 0;
    font-size: 24px;
}

.cert-hero p {
    margin: 4px 0 0;
    font-size: 13px;
    color: #cbd5e1;
}

.cert-count {
    background: rgba(255,255,255,0.1);
    padding: 8px 12px;
    border-radius: 10px;
    font-size: 13px;
}

/* GRID */
.cert-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 15px;
}

/* CARD */
.cert-card {
    background: #fff;
    border: 1px solid #eee;
    border-radius: 14px;
    padding: 15px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    transition: 0.25s ease;
}

.cert-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 25px rgba(0,0,0,0.08);
}

/* LEFT SIDE */
.cert-left {
    display: flex;
    align-items: center;
    gap: 12px;
}

.cert-icon {
    width: 45px;
    height: 45px;
    background: #f1f5f9;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
}

.cert-info h3 {
    margin: 0;
    font-size: 15px;
    color: #111827;
}

.cert-info p {
    margin: 3px 0;
    font-size: 12px;
    color: #6b7280;
}

/* BADGE */
.cert-badge {
    display: inline-block;
    font-size: 11px;
    padding: 4px 8px;
    border-radius: 999px;
    background: #dcfce7;
    color: #166534;
    margin-top: 5px;
}

/* BUTTON */
.cert-btn {
    background: #2563eb;
    color: #fff;
    padding: 9px 14px;
    border-radius: 10px;
    font-size: 13px;
    text-decoration: none;
    transition: 0.2s;
}

.cert-btn:hover {
    background: #1d4ed8;
}

/* EMPTY */
.cert-empty {
    text-align: center;
    padding: 60px 20px;
    color: #6b7280;
}

.cert-empty h2 {
    margin-bottom: 5px;
}

/* instructors breadcrumb  */
/* ==========================================
   LMS BREADCRUMB SECTION
========================================== */

.lms-breadcrumb-wrap{
    margin-top: -40px;
    /* margin-bottom: 5px; */
    padding:30px 0;
    
}

.lms-breadcrumb-card{
    background:#ffffff;
    border:1px solid #e2e8f0;
    border-radius:24px;
    padding:30px;
    box-shadow:
        0 10px 30px rgba(15,23,42,0.05);
    position:relative;
    overflow:hidden;
    
}

.lms-breadcrumb-card::before{
    content:"";
    position:absolute;
    top:-100px;
    right:-100px;
    width:250px;
    height:250px;
    border-radius:50%;
    background:linear-gradient(
        135deg,
        rgba(59,130,246,.08),
        rgba(99,102,241,.08)
    );
}

.lms-breadcrumb-content{
    position:relative;
    z-index:2;
    margin-bottom:20px;
}

.lms-breadcrumb-label{
    display:inline-flex;
    align-items:center;
    padding:6px 14px;
    background:#eff6ff;
    color:#2563eb;
    border-radius:999px;
    font-size:13px;
    font-weight:600;
    margin-bottom:12px;
}

.lms-breadcrumb-title{
    font-size:32px;
    font-weight:700;
    color:#0f172a;
    margin-bottom:10px;
    line-height:1.2;
}

.lms-breadcrumb-text{
    max-width:700px;
    color:#64748b;
    font-size:15px;
    margin-bottom:0;
}

.lms-breadcrumb{
    display:flex;
    align-items:center;
    flex-wrap:wrap;
    gap:10px;
    list-style:none;
    padding:0;
    margin:0;
    position:relative;
    z-index:2;
}

.lms-breadcrumb li{
    display:flex;
    align-items:center;
    font-size:14px;
}

.lms-breadcrumb li:not(:last-child)::after{
    content:"/";
    margin-left:10px;
    color:#94a3b8;
}

.lms-breadcrumb a{
    text-decoration:none;
    color:#64748b;
    font-weight:500;
    transition:all .3s ease;
}

.lms-breadcrumb a:hover{
    color:#2563eb;
}

.lms-breadcrumb li:last-child a{
    color:#2563eb;
    font-weight:600;
}

/* ==========================================
   RESPONSIVE
========================================== */

@media (max-width:768px){

    .lms-breadcrumb-card{
        padding:24px;
        border-radius:20px;
    }

    .lms-breadcrumb-title{
        font-size:24px;
    }

    .lms-breadcrumb-text{
        font-size:14px;
    }

}
/* ==========================================
   LMS SEARCH
========================================== */

.lms-search-area{
    position:relative;
    z-index:2;
    margin:30px 0;
}

.lms-search-form{
    max-width:750px;
}

.lms-search-box{
    display:flex;
    align-items:center;
    background:#fff;
    border:1px solid #e2e8f0;
    border-radius:18px;
    padding:8px;
    box-shadow:
        0 8px 24px rgba(15,23,42,0.06);
    transition:all .3s ease;
}

.lms-search-box:focus-within{
    border-color:#3b82f6;
    box-shadow:
        0 0 0 4px rgba(59,130,246,.12);
}

.lms-search-box svg{
    color:#94a3b8;
    margin:0 14px;
    flex-shrink:0;
}

.lms-search-input{
    flex:1;
    border:none;
    outline:none;
    background:transparent;
    font-size:15px;
    color:#0f172a;
    padding:10px 0;
}

.lms-search-input::placeholder{
    color:#94a3b8;
}

.lms-search-btn{
    border:none;
    background:linear-gradient(
        135deg,
        #2563eb,
        #4f46e5
    );
    color:#fff;
    font-weight:600;
    padding:12px 28px;
    border-radius:12px;
    cursor:pointer;
    transition:.3s ease;
}

.lms-search-btn:hover{
    transform:translateY(-2px);
    box-shadow:
        0 10px 20px rgba(37,99,235,.25);
}

/* ==========================================
   MOBILE
========================================== */

@media (max-width:768px){

    .lms-search-box{
        flex-wrap:wrap;
        gap:12px;
        padding:15px;
    }

    .lms-search-box svg{
        margin:0;
    }

    .lms-search-input{
        width:100%;
    }

    .lms-search-btn{
        width:100%;
        padding:14px;
    }

}
/* ==========================================
   LMS FILTER SIDEBAR
========================================== */

.lms-filter-sidebar{
    position:sticky;
    top:100px;
}

.lms-filter-accordion{
    display:flex;
    flex-direction:column;
    gap:20px;
}

/* ==========================================
   CARD
========================================== */

.lms-filter-card{
    border:none;
    border-radius:20px;
    overflow:hidden;
    background:#fff;
    box-shadow:
        0 10px 35px rgba(15,23,42,.06);
}

/* ==========================================
   HEADER
========================================== */

.lms-filter-toggle{
    background:#fff !important;
    padding:20px 24px !important;
    font-size:16px;
    font-weight:700;
    color:#0f172a !important;
    box-shadow:none !important;
    border:none !important;
}

.lms-filter-toggle:not(.collapsed){
    background:#f8fafc !important;
}

.lms-filter-toggle::after{
    width:18px;
    height:18px;
    background-size:18px;
}

.lms-filter-toggle:focus{
    box-shadow:none !important;
}

/* ==========================================
   BODY
========================================== */

.lms-filter-body{
    padding:10px 20px 20px;
}

/* ==========================================
   FILTER ITEM
========================================== */

.lms-filter-item{
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:15px;
    padding:14px 0;
    border-bottom:1px solid #eef2f7;
}

.lms-filter-item:last-child{
    border-bottom:none;
}

/* ==========================================
   CUSTOM CHECKBOX
========================================== */

.lms-checkbox{
    display:flex;
    align-items:center;
    gap:12px;
    cursor:pointer;
    margin:0;
    flex:1;
}

.lms-checkbox input{
    display:none;
}

.lms-checkbox-mark{
    width:18px;
    height:18px;
    border:2px solid #cbd5e1;
    border-radius:6px;
    position:relative;
    transition:.3s;
    flex-shrink:0;
}

.lms-checkbox input:checked + .lms-checkbox-mark{
    background:#2563eb;
    border-color:#2563eb;
}

.lms-checkbox input:checked + .lms-checkbox-mark::after{
    content:"";
    position:absolute;
    left:5px;
    top:1px;
    width:4px;
    height:8px;
    border:solid #fff;
    border-width:0 2px 2px 0;
    transform:rotate(45deg);
}

.lms-filter-name{
    font-size:14px;
    font-weight:500;
    color:#334155;
}

/* ==========================================
   COUNT BADGE
========================================== */

.lms-filter-count{
    min-width:40px;
    text-align:center;
    padding:5px 10px;
    border-radius:999px;
    background:#f1f5f9;
    color:#64748b;
    font-size:12px;
    font-weight:700;
}

/* ==========================================
   BUTTON
========================================== */

.lms-filter-btn{
    width:100%;
    border:none;
    margin-top:20px;
    padding:14px;
    border-radius:12px;
    font-weight:600;
    color:#fff;
    background:linear-gradient(
        135deg,
        #2563eb,
        #4f46e5
    );
    transition:.3s ease;
}

.lms-filter-btn:hover{
    transform:translateY(-2px);
    box-shadow:
        0 10px 20px rgba(37,99,235,.25);
}

/* =====================================
   RESULTS HEADER
===================================== */

.lms-results-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:30px;
    padding:20px 25px;
    background:#fff;
    border-radius:18px;
    box-shadow:0 10px 30px rgba(15,23,42,.05);
}

.lms-results-info h4{
    margin:0;
    font-size:22px;
    font-weight:700;
    color:#0f172a;
}

.lms-results-info span{
    color:#64748b;
    font-size:14px;
}

.lms-results-actions{
    display:flex;
    gap:12px;
}

.lms-sort-select{
    border:1px solid #e2e8f0;
    border-radius:10px;
    padding:10px 16px;
    background:#fff;
}

/* =====================================
   INSTRUCTOR CARD
===================================== */

.lms-instructor-card{
    background:#fff;
    border-radius:22px;
    overflow:hidden;
    border:1px solid #eef2f7;
    transition:.35s;
    height:100%;
    box-shadow:0 8px 30px rgba(15,23,42,.05);
}

.lms-instructor-card:hover{
    transform:translateY(-6px);
    box-shadow:0 18px 40px rgba(15,23,42,.10);
}

.lms-instructor-cover{
    height:220px;
    overflow:hidden;
}

.lms-instructor-cover img{
    width:100%;
    height:100%;
    object-fit:cover;
    transition:.5s;
}

.lms-instructor-card:hover .lms-instructor-cover img{
    transform:scale(1.05);
}

.lms-instructor-body{
    padding:22px;
}

.lms-instructor-header{
    display:flex;
    justify-content:space-between;
    align-items:flex-start;
    margin-bottom:18px;
}

.lms-instructor-header h5{
    margin:0;
    font-size:18px;
    font-weight:700;
}

.lms-instructor-header h5 a{
    color:#0f172a;
    text-decoration:none;
}

.lms-instructor-role{
    font-size:13px;
    color:#64748b;
}

.lms-rating{
    display:flex;
    align-items:center;
    gap:5px;
    background:#fef3c7;
    color:#d97706;
    padding:6px 10px;
    border-radius:999px;
    font-size:13px;
    font-weight:600;
}

.lms-instructor-stats{
    display:flex;
    gap:20px;
    margin-bottom:22px;
}

.lms-stat{
    display:flex;
    align-items:center;
    gap:8px;
    color:#475569;
    font-size:14px;
}

.lms-card-actions{
    display:flex;
    gap:10px;
}

.lms-btn-primary{
    flex:1;
    text-align:center;
    padding:12px;
    border-radius:12px;
    text-decoration:none;
    color:#fff;
    font-weight:600;
    background:linear-gradient(
        135deg,
        #2563eb,
        #4f46e5
    );
}

.lms-btn-outline{
    flex:1;
    text-align:center;
    padding:12px;
    border-radius:12px;
    text-decoration:none;
    font-weight:600;
    color:#2563eb;
    border:1px solid #2563eb;
}

/* =====================================
   EMPTY STATE
===================================== */

.lms-empty-state{
    background:#fff;
    padding:60px 30px;
    text-align:center;
    border-radius:20px;
}

.lms-empty-state i{
    font-size:40px;
    color:#94a3b8;
    margin-bottom:15px;
}

.lms-empty-state h4{
    margin-bottom:10px;
    color:#0f172a;
}

.lms-empty-state p{
    color:#64748b;
}

/* Goal page style */
/* ==========================================
   PAGE
========================================== */

.goalx-page{
    padding:20px;
}

/* ==========================================
   HEADER
========================================== */

.goalx-header-card{
    background:linear-gradient(
        135deg,
        #2563eb 0%,
        #4f46e5 50%,
        #7c3aed 100%
    );
    border-radius:24px;
    padding:40px;
    color:#fff;
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:30px;
    position:relative;
    overflow:hidden;
}

.goalx-header-card::before{
    content:"";
    position:absolute;
    width:300px;
    height:300px;
    border-radius:50%;
    background:rgba(255,255,255,.08);
    right:-100px;
    top:-100px;
}

.goalx-badge{
    display:inline-flex;
    align-items:center;
    padding:8px 16px;
    border-radius:999px;
    background:rgba(255,255,255,.15);
    backdrop-filter:blur(10px);
    font-size:13px;
    margin-bottom:15px;
}

.goalx-header-card h1{
    font-size:36px;
    font-weight:700;
    margin-bottom:10px;
}

.goalx-header-card p{
    max-width:650px;
    opacity:.9;
    margin:0;
}

.goalx-create-btn{
    border:none;
    background:#fff;
    color:#2563eb;
    padding:14px 22px;
    border-radius:14px;
    font-weight:600;
    transition:.3s;
}

.goalx-create-btn:hover{
    transform:translateY(-3px);
}

/* ==========================================
   OVERVIEW
========================================== */

.goalx-overview-grid{
    display:grid;
    grid-template-columns:
        repeat(auto-fit,minmax(230px,1fr));
    gap:20px;
    margin-bottom:35px;
}

.goalx-stat-card{
    background:#fff;
    border-radius:20px;
    padding:22px;
    display:flex;
    gap:16px;
    align-items:center;
    border:1px solid #e2e8f0;
    box-shadow:0 10px 30px rgba(15,23,42,.05);
    transition:.3s;
}

.goalx-stat-card:hover{
    transform:translateY(-4px);
}

.goalx-stat-icon{
    width:58px;
    height:58px;
    border-radius:16px;
    display:flex;
    align-items:center;
    justify-content:center;
    color:#fff;
    font-size:22px;
}

.goalx-stat-primary .goalx-stat-icon{
    background:linear-gradient(135deg,#2563eb,#3b82f6);
}

.goalx-stat-success .goalx-stat-icon{
    background:linear-gradient(135deg,#16a34a,#22c55e);
}

.goalx-stat-warning .goalx-stat-icon{
    background:linear-gradient(135deg,#d97706,#f59e0b);
}

.goalx-stat-danger .goalx-stat-icon{
    background:linear-gradient(135deg,#dc2626,#ef4444);
}

.goalx-stat-purple .goalx-stat-icon{
    background:linear-gradient(135deg,#7c3aed,#8b5cf6);
}

.goalx-stat-card h3{
    margin:0;
    font-size:28px;
    font-weight:700;
    color:#0f172a;
}

.goalx-stat-card span{
    color:#64748b;
    font-size:14px;
}

/* ==========================================
   GOAL CARD
========================================== */

.goalx-card{
    background:#fff;
    border-radius:24px;
    padding:24px;
    border:1px solid #e2e8f0;
    height:100%;
    box-shadow:0 10px 30px rgba(15,23,42,.05);
    transition:.3s;
}

.goalx-card:hover{
    transform:translateY(-5px);
}

.goalx-card-header{
    display:flex;
    justify-content:space-between;
    gap:20px;
    margin-bottom:15px;
}

.goalx-card-header h4{
    margin:0;
    font-size:18px;
    font-weight:700;
    color:#0f172a;
}

.goalx-type{
    display:inline-block;
    margin-top:8px;
    background:#eff6ff;
    color:#2563eb;
    padding:6px 12px;
    border-radius:999px;
    font-size:12px;
    font-weight:600;
}

.goalx-status{
    background:#f8fafc;
    color:#475569;
    padding:6px 12px;
    border-radius:999px;
    white-space:nowrap;
    font-size:12px;
    font-weight:600;
}

.goalx-description{
    color:#64748b;
    margin-bottom:20px;
    line-height:1.7;
}

/* ==========================================
   PROGRESS
========================================== */

.goalx-progress{
    background:#e2e8f0;
    height:10px;
    border-radius:999px;
    overflow:hidden;
}

.goalx-progress-fill{
    height:100%;
    background:linear-gradient(
        90deg,
        #2563eb,
        #7c3aed
    );
}

.goalx-progress-text{
    display:flex;
    justify-content:space-between;
    margin-top:10px;
    margin-bottom:20px;
    color:#64748b;
    font-size:14px;
}

.goalx-progress-text strong{
    color:#2563eb;
}

/* ==========================================
   FOOTER
========================================== */

.goalx-card-footer{
    display:flex;
    justify-content:space-between;
    align-items:center;
    gap:15px;
}

.goalx-date{
    color:#64748b;
    font-size:14px;
}

.goalx-actions{
    display:flex;
    gap:10px;
}

.goalx-edit-btn{
    border:none;
    background:#eff6ff;
    color:#2563eb;
    padding:8px 16px;
    border-radius:10px;
    font-weight:600;
}

.goalx-delete-btn{
    border:none;
    background:#fef2f2;
    color:#dc2626;
    padding:8px 16px;
    border-radius:10px;
    font-weight:600;
}

/* ==========================================
   EMPTY
========================================== */

.goalx-empty-state{
    background:#fff;
    border-radius:24px;
    padding:70px 30px;
    text-align:center;
    border:1px solid #e2e8f0;
}

.goalx-empty-icon{
    width:80px;
    height:80px;
    border-radius:50%;
    margin:0 auto 20px;
    background:#eff6ff;
    display:flex;
    align-items:center;
    justify-content:center;
    color:#2563eb;
    font-size:34px;
}

/* ==========================================
   MODAL
========================================== */

#goalModal .modal-content{
    border:none;
    border-radius:24px;
}

#goalModal .modal-header{
    border-bottom:1px solid #eef2f7;
}

#goalModal .modal-footer{
    border-top:1px solid #eef2f7;
}

#goalModal .form-control,
#goalModal .form-select{
    min-height:50px;
    border-radius:12px;
}

#goalModal textarea.form-control{
    min-height:120px;
}

#goalModal .btn-primary{
    background:linear-gradient(
        135deg,
        #2563eb,
        #4f46e5
    );
    border:none;
    border-radius:12px;
    padding:12px 24px;
}
.goalx-modal{
    border:none;
    border-radius:24px;
    overflow:hidden;
}

.goalx-delete-icon{
    width:80px;
    height:80px;
    margin:0 auto 20px;
    border-radius:50%;
    background:#fef2f2;
    color:#dc2626;
    font-size:32px;
    display:flex;
    align-items:center;
    justify-content:center;
}

.goalx-label{
    font-weight:600;
    color:#0f172a;
    margin-bottom:8px;
}

.goalx-help{
    display:block;
    margin-top:6px;
    color:#64748b;
    font-size:13px;
    line-height:1.5;
}

.goalx-input{
    min-height:52px;
    border-radius:14px;
    border:1px solid #dbe2ea;
}

.goalx-input:focus{
    border-color:#4f46e5;
    box-shadow:0 0 0 4px rgba(79,70,229,.08);
}

textarea.goalx-input{
    min-height:120px;
}

.goalx-primary-btn{
    background:linear-gradient(
        135deg,
        #2563eb,
        #4f46e5
    );
    border:none;
    color:#fff;
    border-radius:12px;
    padding:12px 24px;
    font-weight:600;
}

/* ==========================================
   SCROLLABLE GOAL MODALS
========================================== */

#createGoalModal .modal-content,
#editGoalModal .modal-content{
    height:80vh;
    max-height:90vh;

    display:flex;
    flex-direction:column;
}

/* Header fixed */

#createGoalModal .modal-header,
#editGoalModal .modal-header{
    flex-shrink:0;
    border-bottom:1px solid #eef2f7;
    background:#fff;
}

/* Body scrollable */

#createGoalModal .modal-content,
#editGoalModal .modal-content{
    height:80vh;
}

#createGoalModal .modal-body,
#editGoalModal .modal-body{
    height:calc(80vh - 160px);
    overflow-y:auto;
    overflow-x:hidden;
}

/* Footer fixed */

#createGoalModal .modal-footer,
#editGoalModal .modal-footer{
    flex-shrink:0;
    border-top:1px solid #eef2f7;
    background:#fff;
}

/* Modern scrollbar */

#createGoalModal .modal-body::-webkit-scrollbar,
#editGoalModal .modal-body::-webkit-scrollbar{
    width:8px;
}

#createGoalModal .modal-body::-webkit-scrollbar-thumb,
#editGoalModal .modal-body::-webkit-scrollbar-thumb{
    background:#cbd5e1;
    border-radius:999px;
}

#createGoalModal .modal-body::-webkit-scrollbar-thumb:hover,
#editGoalModal .modal-body::-webkit-scrollbar-thumb:hover{
    background:#94a3b8;
}

/* Learning Stats Style */

/* BASE */
.stats {
    padding: 28px;
    background: #f8fafc;
    font-family: Inter, system-ui, sans-serif;
    color: #0f172a;
}

/* HEADER */
.stats__header h1 {
    font-size: 24px;
    font-weight: 700;
    margin-bottom: 4px;
}

.stats__header {
    margin-bottom: 22px;
}

/* TITLE ROW (adds modern layout feel) */
.stats__titleRow {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 6px;
}

/* MAIN TITLE */
.stats__header h1 {
    font-size: 26px;
    font-weight: 800;
    color: #0f172a;
    margin: 0;
    letter-spacing: -0.3px;
}

/* BADGE */
.stats__badge {
    font-size: 11px;
    font-weight: 600;
    color: #4f46e5;
    background: #eef2ff;
    padding: 4px 10px;
    border-radius: 999px;
    border: 1px solid #c7d2fe;
}

/* DESCRIPTION */
.stats__header p {
    font-size: 14px;
    color: #64748b;
    margin: 0;
    max-width: 600px;
    line-height: 1.5;
}

/* KPI STRIP */
.stats__kpis {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 14px;
    margin-bottom: 20px;
}

/* KPI CARD */

/* KPI CARD BASE */
.kpi {
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 16px;
    padding: 16px;
    transition: 0.2s ease;
}

.kpi:hover {
    transform: translateY(-2px);
}

/* TOP ROW (ICON + TREND) */
.kpi__top {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 8px;
}

/* ICON */
.kpi__icon {
    font-size: 16px;
}

/* VALUE (STRONG FOCUS) */
.kpi__value {
    font-size: 28px;
    font-weight: 900;
    color: #0f172a;
    line-height: 1.1;
}

/* LABEL */
.kpi__label {
    font-size: 12px;
    color: #64748b;
    font-weight: 600;
    margin-top: 4px;
}

/* TREND BADGES */
.kpi__trend {
    font-size: 11px;
    font-weight: 700;
    padding: 3px 8px;
    border-radius: 999px;
}

/* TREND STATES */
.kpi__trend--up {
    background: #ecfdf5;
    color: #059669;
    border: 1px solid #a7f3d0;
}

.kpi__trend--down {
    background: #fef2f2;
    color: #dc2626;
    border: 1px solid #fecaca;
}

.kpi__trend--neutral {
    background: #f1f5f9;
    color: #475569;
    border: 1px solid #e2e8f0;
}

/* OPTIONAL COLOR VARIANTS (KEEP YOUR EXISTING ONES) */
.kpi--primary {
    background: #eef2ff;
    border-color: #c7d2fe;
}

.kpi--blue {
    background: #eff6ff;
    border-color: #bfdbfe;
}

.kpi--purple {
    background: #f5f3ff;
    border-color: #ddd6fe;
}

/* GRID */
.stats__grid {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 18px;
}

/* PANEL */
.panel {
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 16px;
    padding: 18px;
}

/* TITLE */
.panel__title {
    font-size: 14px;
    font-weight: 700;
    margin-bottom: 14px;
    color: #334155;
}

/* PROGRESS */
.progress__top {
    display: flex;
    justify-content: space-between;
    font-size: 13px;
    margin-bottom: 8px;
    color: #475569;
}

.progress__bar {
    height: 10px;
    background: #e5e7eb;
    border-radius: 999px;
    overflow: hidden;
}

.progress__bar div {
    height: 100%;
    background: #4f46e5;
}

/* MINI BOXES */
.mini {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 10px;
    margin-top: 14px;
}

.mini__box {
    background: #f8fafc;
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    padding: 12px;
}

.mini__box span {
    font-size: 11px;
    color: #64748b;
}

.mini__box strong {
    font-size: 18px;
    font-weight: 800;
    display: block;
    margin-top: 4px;
}

/* INSIGHTS */
.insight {
    background: #f8fafc;
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    padding: 12px;
    margin-bottom: 12px;
}

.insight__title {
    font-size: 12px;
    color: #64748b;
    margin-bottom: 6px;
}

.insight__text {
    font-size: 13px;
    color: #0f172a;
}

.insight__badge {
    display: inline-block;
    padding: 4px 10px;
    background: #eef2ff;
    color: #4f46e5;
    border-radius: 999px;
    font-size: 12px;
    font-weight: 600;
}


/* PAGE */
.activity {
    padding: 28px;
    background: #f8fafc;
    font-family: Inter, system-ui, sans-serif;
    color: #0f172a;
}

/* HEADER */
.activity__header h1 {
    font-size: 24px;
    font-weight: 800;
    margin-bottom: 4px;
}

.activity__header p {
    color: #64748b;
    font-size: 14px;
    margin-bottom: 20px;
}

/* TIMELINE WRAPPER */
.timeline {
    max-width: 900px;
}

/* ITEM */
.timeline__item {
    display: flex;
    gap: 14px;
    padding: 14px;
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 14px;
    margin-bottom: 10px;
    transition: 0.2s ease;
}

.timeline__item:hover {
    transform: translateY(-2px);
}

/* ICON */
.timeline__icon {
    width: 38px;
    height: 38px;
    background: #f1f5f9;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
}

/* CONTENT */
.timeline__content {
    flex: 1;
}

/* TITLE */
.timeline__title {
    font-size: 14px;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 4px;
}

/* META */
.timeline__meta {
    font-size: 12px;
    color: #64748b;
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

/* TIME */
.timeline__meta .time {
    margin-left: auto;
    color: #94a3b8;
    font-size: 11px;
}

/* EMPTY */
.empty {
    text-align: center;
    padding: 30px;
    color: #94a3b8;
}

</style>

    @stack('styles')

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>

<body @yield('body-attr')>

    <!-- Header Starts Here -->
    <div class="lms-layout">

    <!-- SIDEBAR -->
    <aside class="lms-sidebar" id="lmsSidebar">

    <!-- ================= TOP LOGO ================= -->
    <div class="lms-sidebar-top">
        <a href="{{ route('home') }}">
            <img src="{{ asset('frontend/dist/images/logo/logo.png') }}" alt="Logo">
        </a>
    </div>

        @php
            function activeLink($routes)
            {
                if (is_array($routes)) {
                    foreach ($routes as $route) {
                        if (request()->routeIs($route)) {
                            return 'active';
                        }
                    }
                    return '';
                }

                return request()->routeIs($routes) ? 'active' : '';
            }
        @endphp
    <!-- ================= SCROLLABLE AREA ================= -->
    <div class="lms-sidebar-scroll">

        <ul class="lms-sidebar-menu">

            <li class="lms-section-title">MAIN</li>

            <li>
                <a href="{{ route('home') }}" class="{{ activeLink('home') }}">🏠 Home</a>
            </li>

            @php
                $isStudent = request()->session()->get('studentLogin');
                $isUser = auth()->user();
            @endphp

            @if($isStudent)
                <li>
                    <a href="{{ route('studentdashboard') }}" class="{{ activeLink('studentdashboard') }}">
                        📊 Dashboard
                    </a>
                </li>
            @elseif($isUser)
                <li>
                    <a href="{{ route('dashboard') }}" class="{{ activeLink('dashboard') }}">
                        📊 Dashboard
                    </a>
                </li>
            @endif

            <li>
                <a href="{{ route('searchCourse') }}" class="{{ activeLink('searchCourse') }}">
                    📚 Browse Courses
                </a>
            </li>

            <li>
                <a href="{{ route('searchInstructor') }}" class="{{ activeLink('searchInstructor') }}">
                    👨‍🏫 Instructors
                </a>
            </li>

            @if($isStudent)

                <li class="lms-section-title">LEARNING</li>

                <li>
                    <a href="{{ route('myCourses.index') }}" class="{{ activeLink('myCourses.index') }}">
                        📖 My Courses
                    </a>
                </li>                

                <li>
                    <a href="{{route('student.certificates')}}" class="{{ activeLink('student.certificates') }}">
                        🏆 Certificates
                    </a>
                </li>

                <li class="lms-section-title">PROGRESS</li>

                <li>
                    <a href="{{route('student.goals')}}" class="{{ activeLink('student.goals') }}">
                        🎯 Goals
                    </a>
                </li>

                <li>
                    <a href="{{route('student.learning.stats')}}" class="{{ activeLink('student.learning.stats') }}">
                        📊 Learning Stats
                    </a>
                </li>

                <li>
                    <a href="{{ route('student.activity') }}" class="{{ activeLink('student.activity') }}">
                        🧾 Activity Feed
                    </a>
                </li>

                <li class="lms-section-title">PAYMENTS</li>

                <li>
                    <a href="{{ route('cart') }}" class="{{ activeLink('cart') }}">
                        🛒 Cart
                    </a>
                </li>

                <li>
                    <a href="#" class="{{ activeLink('payment.history') }}">
                        💳 Payment History
                    </a>
                </li>

            @endif

            <li class="lms-section-title">EXPLORE</li>

            <li>
                <a href="{{ route('about') }}" class="{{ activeLink('about') }}">
                    ℹ️ About
                </a>
            </li>

            <li>
                <a href="{{ route('contact') }}" class="{{ activeLink('contact') }}">
                    📞 Contact
                </a>
            </li>

        </ul>

    </div>


    <!-- ================= MODERN FOOTER ================= -->
<div class="lms-sidebar-footer">

    <div class="lms-footer-top">
        <div class="lms-app-info">
            <span class="app-name">Digi-Hub</span>
            <span class="app-version">v1.0.0</span>
        </div>
    </div>

    <div class="lms-footer-links">

        @if($isStudent)

            <a href="{{ route('student_profile') }}">
                👤 <span>Profile</span>
            </a>

            <a href="{{ route('studentlogOut') }}" class="danger">
                🚪 <span>Logout</span>
            </a>

        @elseif($isUser)

            <a href="{{ route('user.edit', encryptor('encrypt',auth()->user()->id)) }}">
                👤 <span>Profile</span>
            </a>

            <a href="{{ route('studentlogOut') }}" class="danger">
                🚪 <span>Logout</span>
            </a>

        @else

            <a href="{{ route('studentLogin') }}">
                🔐 <span>Sign In</span>
            </a>

            <a href="{{ route('signup') }}">
                ✨ <span>Sign Up</span>
            </a>

        @endif

    </div>

</div>

    <div class="lms-sidebar-mobile-header">
    <button id="closeSidebarBtn" class="lms-sidebar-close-btn">
        <span>&times;</span>
    </button>
</div>


</aside>

<div id="sidebarOverlay"></div>

    <!-- MAIN CONTENT -->
    <main class="lms-main">

        <!-- TOP BAR (minimal replacement of navbar tools) -->
        <div class="lms-topbar">

           <button id="mobileSidebarToggle">
            ☰
        </button>
            

            <div class="lms-topbar-right">

                <!-- ICON GROUP -->
                <div class="lms-topbar-icons">

                    @if(request()->session()->get('studentLogin'))
                    <a href="{{ route('cart') }}" class="lms-icon-btn">
                        <i class="fa fa-shopping-cart lms-cart-icon"></i>
                        <span class="lms-badge">{{ count((array) session('cart')) }}</span>
                    </a>
                    @endif

                </div>

                <!-- AVATAR DROPDOWN -->
                <div class="lms-avatar-wrapper dropdown">

                    <div class="lms-avatar-toggle" id="avatarDropdown">
                        
                        @if(request()->session()->get('studentLogin'))
                            <img src="{{ asset('uploads/students/' . request()->session()->get('image')) }}"
                                onerror="this.src='{{ asset('uploads/students/blank_new.png') }}'">
                        @elseif(auth()->user())
                            <img src="{{ asset('uploads/users/' . auth()->user()->image) }}"
                                onerror="this.src='{{ asset('uploads/students/blank_new.png') }}'">
                        @endif

                    </div>

                    <!-- DROPDOWN MENU -->
                    <div class="lms-avatar-menu" id="avatarMenu">

                        @if(request()->session()->get('studentLogin'))
                            <a href="{{ route('student_profile') }}">
                                👤 My Profile
                            </a>

                            <a href="{{ route('studentlogOut') }}" class="danger">
                                ⎋ Logout
                            </a>

                        @elseif(auth()->user())
                            <a href="{{ route('user.edit', encryptor('encrypt',auth()->user()->id)) }}">
                                👤 My Profile
                            </a>

                            <a href="{{ route('studentlogOut') }}" class="danger">
                                ⎋ Logout
                            </a>
                        @endif

                    </div>

                </div>

            </div>

        </div>

        <!-- PAGE CONTENT -->
        <div class="lms-content">
            @yield('content')
        </div>

        <footer class="lms-footer">
            <div class="lms-footer-content">

                <div class="lms-footer-left">
                    © {{ date('Y') }}
                    <strong>{{ config('app.name') }}</strong>
                    • Learning Management System
                </div>

                <div class="lms-footer-right">
                    Kings Digital Literacy Hub
                </div>

            </div>
        </footer>

    </main>

</div>

    

    <script src="{{asset('frontend/src/js/jquery.min.js')}}"></script>
    <script src="{{asset('frontend/src/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('frontend/src/scss/vendors/plugin/js/isotope.pkgd.min.js')}}"></script>
    <script src="{{asset('frontend/src/scss/vendors/plugin/js/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('frontend/src/scss/vendors/plugin/js/slick.min.js')}}"></script>
    <script src="{{asset('frontend/src/scss/vendors/plugin/js/jquery.nice-select.min.js')}}"></script>
    <script src="{{asset('frontend/src/js/app.js')}}"></script>
    <script src="{{asset('frontend/dist/main.js')}}"></script>

    <script>
document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.lms-nav-item').forEach(button => {

        button.addEventListener('click', function () {

            const target = this.getAttribute('data-bs-target');

            // Remove active from buttons
            document.querySelectorAll('.lms-nav-item').forEach(btn => {
                btn.classList.remove('active');
            });

            this.classList.add('active');

            // Hide all panes
            document.querySelectorAll('.tab-pane').forEach(pane => {
                pane.classList.remove('show', 'active');
            });

            // Show selected pane
            const pane = document.querySelector(target);

            if (pane) {
                pane.classList.add('show', 'active');
            }

        });

    });

});
</script>
    <script>
        function toggleDropdown(event) {
            event.preventDefault();
            var dropdown = document.getElementById('imageDropdown');
            dropdown.classList.toggle('active');
    
            // Close the dropdown when clicking somewhere else on the page
            document.body.addEventListener('click', function (e) {
                if (!dropdown.contains(e.target)) {
                    dropdown.classList.remove('active');
                }
            });
        }
    </script>

  <script>
    document.addEventListener("DOMContentLoaded", function () {

        const sidebar = document.getElementById("lmsSidebar");
        const toggle = document.getElementById("mobileSidebarToggle");

        toggle.addEventListener("click", function () {
            sidebar.classList.toggle("is-open");
        });

    });
</script>
<script>
   document.addEventListener("DOMContentLoaded", function () {

    const sidebar = document.getElementById("lmsSidebar");
    const toggle = document.getElementById("mobileSidebarToggle");
    const closeBtn = document.getElementById("closeSidebarBtn");
    const overlay = document.getElementById("sidebarOverlay");

    toggle.addEventListener("click", function () {

        sidebar.classList.add("is-open");
        overlay.classList.add("active");

    });

    closeBtn.addEventListener("click", function () {

        sidebar.classList.remove("is-open");
        overlay.classList.remove("active");

    });

    overlay.addEventListener("click", function () {

        sidebar.classList.remove("is-open");
        overlay.classList.remove("active");

    });

});
</script>

    {{-- TOASTER --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" />
    <!-- <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script> -->
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

<script>
document.addEventListener("DOMContentLoaded", function () {
    const toggle = document.getElementById("avatarDropdown");
    const menu = document.getElementById("avatarMenu");

    toggle.addEventListener("click", function (e) {
        e.stopPropagation();
        menu.style.display = menu.style.display === "flex" ? "none" : "flex";
    });

    document.addEventListener("click", function () {
        menu.style.display = "none";
    });
});
</script>

    @stack('scripts')


</body>

</html>