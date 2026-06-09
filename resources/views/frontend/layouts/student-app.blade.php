<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
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

/* ===== MOBILE ===== */
@media (max-width: 992px) {

    .lms-sidebar {
        position: fixed;
        left: -260px;
        top: 0;
        height: 100vh;
        z-index: 9999;
        transition: 0.3s ease;
    }

    .lms-sidebar.active {
        left: 0;
    }

    .lms-main {
        margin-left: 0;
    }
}

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
</style>

    @stack('styles')

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


    <!-- ================= SCROLLABLE AREA ================= -->
    <div class="lms-sidebar-scroll">

        <ul class="lms-sidebar-menu">

            <!-- ===== MAIN ===== -->
            <li class="lms-section-title">MAIN</li>

            <li><a href="{{ route('home') }}">🏠 Home</a></li>

            @php
                $isStudent = request()->session()->get('studentLogin');
                $isUser = auth()->user();
            @endphp

            @if($isStudent)
                <li><a href="{{ route('studentdashboard') }}">📊 Dashboard</a></li>
            @elseif($isUser)
                <li><a href="{{ route('dashboard') }}">📊 Dashboard</a></li>
            @endif

            <li><a href="{{ route('searchCourse') }}">📚 Browse Courses</a></li>
            <li><a href="{{ route('searchInstructor') }}">👨‍🏫 Instructors</a></li>


            <!-- ===== STUDENT SECTION ===== -->
            @if($isStudent)

                <li class="lms-section-title">LEARNING</li>

                <li><a href="#">📖 My Courses</a></li>
                <!-- <li><a href="#">▶️ Continue Learning</a></li>
                <li><a href="#">📝 Assignments</a></li>
                <li><a href="#">📅 Schedule</a></li> -->
                <li><a href="#">📌 Wishlist</a></li>
                <li><a href="#">🏆 Certificates</a></li>


                <li class="lms-section-title">PROGRESS</li>

                <!-- <li><a href="#">📈 Progress Report</a></li> -->
                <li><a href="#">🎯 Goals</a></li>
                <li><a href="#">📊 Learning Stats</a></li>


                <li class="lms-section-title">PAYMENTS</li>

                <li><a href="{{ route('cart') }}">🛒 Cart</a></li>
                <li><a href="#">💳 Payment History</a></li>
                <!-- <li><a href="#">🧾 Invoices</a></li> -->

            @endif


            <!-- ===== GENERAL ===== -->
            <li class="lms-section-title">EXPLORE</li>

            <li><a href="{{ route('about') }}">ℹ️ About</a></li>
            <li><a href="{{ route('contact') }}">📞 Contact</a></li>

        </ul>

    </div>


    <!-- ================= MODERN FOOTER ================= -->
<div class="lms-sidebar-footer">

    <div class="lms-footer-top">
        <div class="lms-app-info">
            <span class="app-name">Digi-LMS</span>
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

</aside>

    <!-- MAIN CONTENT -->
    <main class="lms-main">

        <!-- TOP BAR (minimal replacement of navbar tools) -->
        <div class="lms-topbar">

            <button class="lms-toggle-btn" onclick="toggleSidebar()">☰</button>

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
function toggleSidebar() {
    const sidebar = document.getElementById('lmsSidebar');

    if (!sidebar) {
        console.error('Sidebar not found: #lmsSidebar');
        return;
    }

    sidebar.classList.toggle('active');
}
</script>

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