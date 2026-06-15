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
/* =========================
   HEADER WRAPPER
========================= */
.lmsHeader{
    position: sticky;
    top: 0;
    z-index: 999;
    background: #fff;
    border-bottom: 1px solid #eef1f6;
}

/* container */
.lmsHeader__container{
    max-width: 1200px;
    margin: 0 auto;
    padding: 14px 20px;

    display: flex;
    align-items: center;
    justify-content: space-between;
}

/* =========================
   LEFT SECTION
========================= */
.lmsHeader__left{
    display: flex;
    align-items: center;
    gap: 14px;
}

.lmsHeader__logo img{
    height: 38px;
}

/* mobile toggle */
.lmsHeader__toggle{
    display: none;
    flex-direction: column;
    gap: 4px;
    border: none;
    background: transparent;
    cursor: pointer;
}

.lmsHeader__toggle span{
    width: 24px;
    height: 2px;
    background: #222;
}

/* =========================
   NAVIGATION
========================= */
.lmsNav{
    flex: 1;
    display: flex;
    justify-content: center;
}

.lmsNav__list{
    display: flex;
    gap: 22px;
    list-style: none;
    margin: 0;
    padding: 0;
}

.lmsNav__link{
    text-decoration: none;
    font-size: 14px;
    font-weight: 500;
    color: #333;
    transition: 0.2s ease;
}

.lmsNav__link:hover{
    color: #2563eb;
}

/* =========================
   RIGHT ACTIONS
========================= */
.lmsActions{
    display: flex;
    align-items: center;
    gap: 14px;
}

/* icon button */
.lmsActions__iconBtn{
    border: none;
    background: #f3f4f6;
    padding: 8px 10px;
    border-radius: 10px;
    cursor: pointer;
}

/* cart */
.lmsActions__cart{
    position: relative;
    text-decoration: none;
    font-size: 18px;
    color: #111;
}

.lmsActions__badge{
    position: absolute;
    top: -6px;
    right: -8px;
    background: #2563eb;
    color: #fff;
    font-size: 11px;
    padding: 2px 6px;
    border-radius: 999px;
}

/* =========================
   USER DROPDOWN
========================= */
.lmsUser{
    position: relative;
    display: flex;
    align-items: center;
    gap: 10px;
}

/* avatar */
.lmsUser__trigger img{
    width: 40px;
    height: 40px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid #eef1f6;
    cursor: pointer;
}

/* dropdown hidden */
.lmsUser__dropdown{
    position: absolute;
    right: 0;
    top: calc(100% + 8px);

    width: 200px;
    background: #fff;
    border: 1px solid #eef1f6;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);

    display: flex;
    flex-direction: column;

    opacity: 0;
    visibility: hidden;
    transform: translateY(10px);
    pointer-events: none;

    transition: 0.2s ease;
    z-index: 999;
}

/* open state */
.lmsUser.open .lmsUser__dropdown{
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
    pointer-events: auto;
}

/* links */
.lmsUser__dropdown a{
    padding: 11px 14px;
    font-size: 13px;
    text-decoration: none;
    color: #2b2b2b;
    transition: 0.2s ease;
}

.lmsUser__dropdown a:hover{
    background: #f5f7fb;
    color: #2563eb;
}

.lmsUser__dropdown .danger{
    color: #dc2626;
}

.lmsUser__dropdown .danger:hover{
    background: #fef2f2;
}

/* =========================
   BUTTONS
========================= */
.lmsBtn{
    padding: 8px 14px;
    border-radius: 10px;
    font-size: 13px;
    text-decoration: none;
    font-weight: 500;
}

.lmsBtn--primary{
    background: #2563eb;
    color: #fff;
}

.lmsBtn--ghost{
    background: #f3f4f6;
    color: #111;
}

/* =========================
   RESPONSIVE
========================= */
@media (max-width: 992px){
    .lmsNav{
        display: none;
    }

    .lmsHeader__toggle{
        display: flex;
    }
}

/* =========================
   HERO WRAPPER
========================= */
.lmsHero{
    position: relative;
    padding: 80px 0;
    overflow: hidden;
    background: #f9fafb;
}

/* background image layer */
.lmsHero__bg{
    position: absolute;
    inset: 0;
    background-size: cover;
    background-position: center;
    opacity: 0.08;
    z-index: 0;
}

/* container */
.lmsHero__container{
    position: relative;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
    z-index: 1;
}

/* grid layout */
.lmsHero__grid{
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 40px;
}

/* =========================
   CONTENT
========================= */
.lmsHero__content{
    flex: 1;
    max-width: 600px;
}

.lmsHero__title{
    font-size: 48px;
    font-weight: 700;
    line-height: 1.2;
    color: #111827;
    margin-bottom: 16px;
}

.lmsHero__subtitle{
    font-size: 16px;
    line-height: 1.6;
    color: #6b7280;
    margin-bottom: 28px;
}

/* =========================
   SEARCH
========================= */
.lmsHero__searchForm{
    width: 100%;
}

.lmsHero__searchBox{
    display: flex;
    align-items: center;
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 14px;
    padding: 6px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.04);
}

.lmsHero__input{
    flex: 1;
    border: none;
    outline: none;
    padding: 12px 14px;
    font-size: 14px;
    color: #111827;
}

.lmsHero__searchBtn{
    background: #2563eb;
    color: #fff;
    border: none;
    padding: 10px 18px;
    border-radius: 10px;
    cursor: pointer;
    font-weight: 500;
    transition: 0.2s;
}

.lmsHero__searchBtn:hover{
    background: #1d4ed8;
}

/* =========================
   IMAGE
========================= */
.lmsHero__media{
    flex: 1;
    display: flex;
    justify-content: center;
}

.lmsHero__media img{
    max-width: 100%;
    height: auto;
}

/* =========================
   RESPONSIVE
========================= */
@media (max-width: 992px){

    .lmsHero{
        padding: 60px 0;
    }

    .lmsHero__grid{
        flex-direction: column;
        text-align: center;
    }

    .lmsHero__title{
        font-size: 34px;
    }

    .lmsHero__searchBox{
        flex-direction: column;
        gap: 8px;
        padding: 10px;
    }

    .lmsHero__searchBtn{
        width: 100%;
    }
}

.lmsCategories{
    padding: 70px 0;
    background: #f9fafb;
}

.lmsCategories__container{
    max-width: 1200px;
    margin: auto;
    padding: 0 20px;
}

/* header row */
.lmsCategories__header{
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
}

.lmsCategories__title{
    font-size: 26px;
    font-weight: 700;
}

.lmsCategories__viewAll{
    font-size: 14px;
    color: #2563eb;
    text-decoration: none;
}

/* grid */
.lmsCategories__grid{
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 18px;
}

/* card */
.lmsCategoryCard{
    background: #fff;
    border: 1px solid #eef1f6;
    border-radius: 14px;

    padding: 16px;
    display: flex;
    align-items: center;
    gap: 12px;

    text-decoration: none;
    transition: 0.2s ease;
}

.lmsCategoryCard:hover{
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.06);
}

.lmsCategoryCard__img{
    width: 55px;
    height: 55px;
    border-radius: 50%;
    object-fit: cover;
}

.lmsCategoryCard__info h4{
    font-size: 15px;
    margin: 0;
    color: #111827;
}

.lmsCategoryCard__info p{
    font-size: 13px;
    color: #6b7280;
    margin: 2px 0 0;
}

/* responsive */
@media (max-width: 992px){
    .lmsCategories__grid{
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 576px){
    .lmsCategories__grid{
        grid-template-columns: 1fr;
    }
}

.lmsCourseTabs{
    margin-top: 20px;
}

/* HEADER ROW */
.lmsCourseTabs__header{
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;
    flex-wrap: wrap;
}

/* TITLE */
.lmsCourseTabs__title{
    font-size: 24px;
    font-weight: 700;
    color: #111827;
    margin: 0;
}

/* NAV WRAPPER */
.lmsCourseTabs__nav{
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

/* TAB BUTTON */
.lmsTab{
    border: 1px solid #e5e7eb;
    background: #fff;
    padding: 8px 14px;
    border-radius: 999px;

    font-size: 13px;
    font-weight: 500;

    cursor: pointer;
    transition: 0.2s ease;
    color: #374151;
}

/* HOVER */
.lmsTab:hover{
    background: #f3f4f6;
}

/* ACTIVE STATE */
.lmsTab.is-active{
    background: #2563eb;
    color: #fff;
    border-color: #2563eb;
}

/* MOBILE */
@media (max-width: 768px){
    .lmsCourseTabs__header{
        flex-direction: column;
        align-items: flex-start;
    }

    .lmsCourseTabs__nav{
        width: 100%;
        overflow-x: auto;
        flex-wrap: nowrap;
        padding-bottom: 6px;
    }

    .lmsTab{
        flex: 0 0 auto;
    }
}

/* =========================
   TAB CONTENT SYSTEM
========================= */
.lmsTabContent{
    display: none;
}

.lmsTabContent.is-active{
    display: block;
}

/* =========================
   GRID
========================= */
.lmsCourseGrid{
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 22px;
    margin-top: 25px;
}

/* =========================
   COURSE CARD
========================= */
.lmsCourseCard{
    background: #fff;
    border: 1px solid #eef1f6;
    border-radius: 14px;
    overflow: hidden;

    display: flex;
    flex-direction: column;

    transition: 0.25s ease;
}

.lmsCourseCard:hover{
    transform: translateY(-4px);
    box-shadow: 0 12px 30px rgba(0,0,0,0.08);
}

/* IMAGE */
.lmsCourseCard__image img{
    width: 100%;
    height: 180px;
    object-fit: cover;
}

/* BODY */
.lmsCourseCard__body{
    padding: 16px;
}

/* TITLE */
.lmsCourseCard__title{
    font-size: 15px;
    font-weight: 600;
    margin-bottom: 10px;
}

.lmsCourseCard__title a{
    text-decoration: none;
    color: #111827;
}

/* META */
.lmsCourseCard__meta{
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 12px;
    gap: 10px;
}

/* instructor */
.lmsCourseCard__instructor{
    display: flex;
    align-items: center;
    gap: 8px;
    text-decoration: none;
    font-size: 13px;
    color: #374151;
}

.lmsCourseCard__instructor img{
    width: 28px;
    height: 28px;
    border-radius: 50%;
    object-fit: cover;
}

/* price */
.lmsCourseCard__price{
    font-size: 13px;
    font-weight: 600;
    color: #111827;
}

.lmsCourseCard__price del{
    font-size: 12px;
    color: #9ca3af;
    margin-left: 4px;
}

/* STATS */
.lmsCourseCard__stats{
    display: flex;
    justify-content: space-between;
    font-size: 12px;
    color: #6b7280;
    margin-bottom: 14px;
}

/* BUTTON */
.lmsCourseCard__btn{
    width: 100%;
    text-align: center;
}

/* EMPTY */
.lmsEmptyState{
    grid-column: 1 / -1;   /* spans full grid width */
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 60px 20px;
}

.lmsEmptyState__box{
    text-align: center;
    max-width: 420px;
    padding: 30px;
    border: 1px dashed #e5e7eb;
    border-radius: 12px;
    background: #fafafa;
}

.lmsEmptyState__box h3{
    font-size: 18px;
    margin-bottom: 8px;
    color: #111827;
}

.lmsEmptyState__box p{
    font-size: 14px;
    color: #6b7280;
    margin: 0;
}

/* FOOTER */
.lmsTabContent__footer{
    text-align: center;
    margin-top: 50px;     /* increased spacing */
    padding-bottom: 20px; /* prevents touching section bottom */
}

/* =========================
   RESPONSIVE
========================= */
@media (max-width: 992px){
    .lmsCourseGrid{
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 576px){
    .lmsCourseGrid{
        grid-template-columns: 1fr;
    }
}
</style>
<style>
    /* Floating button */
.cat-fab{
    position: fixed;
    right: 20px;
    bottom: 20px;
    background: #2563eb;
    color: #fff;
    border: none;
    padding: 12px 16px;
    border-radius: 50px;
    cursor: pointer;
    z-index: 9999;
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
}

/* Drawer wrapper */
.cat-drawer{
    position: fixed;
    inset: 0;
    display: none;
    z-index: 10000;
}

/* dark overlay */
.cat-drawer__overlay{
    position: absolute;
    inset: 0;
    background: rgba(0,0,0,0.5);
}

/* panel */
.cat-drawer__panel{
    position: absolute;
    right: -380px;
    top: 0;
    width: 360px;
    height: 100%;
    background: #fff;
    transition: 0.3s ease;
    display: flex;
    flex-direction: column;
}

/* open state */
.cat-drawer.open{
    display: block;
}

.cat-drawer.open .cat-drawer__panel{
    right: 0;
}

/* header */
.cat-drawer__header{
    padding: 16px;
    border-bottom: 1px solid #eee;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.cat-drawer__close{
    background: none;
    border: none;
    font-size: 24px;
    cursor: pointer;
}

/* body */
.cat-drawer__body{
    padding: 10px;
    overflow-y: auto;
}

/* category item */
.cat-item{
    display: flex;
    gap: 10px;
    padding: 10px;
    border-radius: 10px;
    text-decoration: none;
    color: #333;
    align-items: center;
    transition: 0.2s;
}

.cat-item img{
    width: 45px;
    height: 45px;
    border-radius: 50%;
    object-fit: cover;
}

.cat-item:hover{
    background: #f3f6ff;
}

.cat-item .title{
    font-weight: 600;
    margin: 0;
}

.cat-item span{
    font-size: 12px;
    color: #666;
}

.empty{
    text-align: center;
    padding: 20px;
    color: #999;
}
</style>
<style>
    /* Back to top button */
.back-to-top{
    position: fixed;
    right: 20px;
    bottom: 80px; /* sits just above category button */
    width: 45px;
    height: 45px;
    border-radius: 50%;
    border: none;
    background: #111827;
    color: #fff;
    font-size: 18px;
    cursor: pointer;
    display: none;
    align-items: center;
    justify-content: center;
    z-index: 9999;
    box-shadow: 0 10px 20px rgba(0,0,0,0.15);
    transition: 0.3s ease;
}

.back-to-top:hover{
    background: #2563eb;
}

.feature--modern .featureCard{
    background: #fff;
    border-radius: 14px;
    padding: 25px;
    height: 100%;
    transition: 0.3s ease;
    border: 1px solid #eef1f6;
}

.feature--modern .featureCard:hover{
    transform: translateY(-5px);
    box-shadow: 0 12px 30px rgba(0,0,0,0.08);
}

.featureCard__icon{
    width: 55px;
    height: 55px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 12px;
    margin-bottom: 15px;
}

.featureCard__icon--green{ background: #e8f7ee; color: #16a34a; }
.featureCard__icon--blue{ background: #e8f1ff; color: #2563eb; }
.featureCard__icon--red{ background: #ffe8e8; color: #dc2626; }

.featureCard h5{
    font-weight: 600;
    margin-bottom: 10px;
}

.featureCard p{
    font-size: 14px;
    color: #6b7280;
    line-height: 1.6;
}

.learningSteps__content{
    padding-right: 20px;
}

.learningSteps__list{
    display: flex;
    flex-direction: column;
    gap: 18px;
}

/* Step item */
.stepItem{
    display: flex;
    gap: 15px;
    align-items: flex-start;
    position: relative;
}

/* number circle */
.stepItem__num{
    width: 42px;
    height: 42px;
    border-radius: 50%;
    background: #2563eb;
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    flex-shrink: 0;
}

/* text */
.stepItem__body h6{
    margin: 0;
    font-weight: 600;
}

.stepItem__body p{
    margin: 5px 0 0;
    font-size: 14px;
    color: #6b7280;
    line-height: 1.6;
}

/* image styling */
.learningSteps__image{
    position: relative;
}

.floatingShape{
    position: absolute;
    border-radius: 50%;
    background: rgba(37,99,235,0.1);
    animation: float 4s ease-in-out infinite;
}

.shape1{
    width: 80px;
    height: 80px;
    top: 20px;
    left: -20px;
}

.shape2{
    width: 60px;
    height: 60px;
    bottom: 30px;
    right: -10px;
}

@keyframes float{
    0%,100%{ transform: translateY(0); }
    50%{ transform: translateY(-10px); }
}

.testimonial-modern-section{
    background: #ffffff;
    padding: 90px 0;
    overflow: hidden;
}

/* Titles */
.testimonial-modern-title{
    font-size: 34px;
    font-weight: 800;
    margin-bottom: 10px;
}

.testimonial-modern-subtitle{
    color: #6b7280;
    margin-bottom: 50px;
}

/* MARQUEE */
.testimonial-marquee{
    overflow: hidden;
}

.testimonial-track{
    display: flex;
    gap: 24px;
    width: max-content;
    animation: scrollLeft 28s linear infinite;
}

/* CARD (MODERN LUX STYLE) */
.testimonial-card{
    width: 340px;
    padding: 22px;
    border-radius: 18px;

    background: rgba(255,255,255,0.8);
    backdrop-filter: blur(10px);

    border: 1px solid rgba(0,0,0,0.06);
    box-shadow: 0 15px 35px rgba(0,0,0,0.08);

    transition: 0.3s ease;
    position: relative;
}

/* subtle accent line */
.testimonial-card::before{
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    height: 4px;
    width: 100%;
    background: linear-gradient(90deg, #4f46e5, #06b6d4);
    border-radius: 18px 18px 0 0;
}

.testimonial-card:hover{
    transform: translateY(-6px) scale(1.02);
}

/* TEXT */
.testimonial-card p{
    font-size: 14px;
    color: #374151;
    line-height: 1.7;
    margin-bottom: 18px;
}

/* FOOTER */
.testimonial-footer{
    display: flex;
    justify-content: space-between;
    align-items: center;
}

/* USER */
.user{
    display: flex;
    align-items: center;
    gap: 10px;
}

.user img{
    width: 44px;
    height: 44px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid #e5e7eb;
}

.user h6{
    margin: 0;
    font-size: 14px;
    font-weight: 600;
}

.user span{
    font-size: 12px;
    color: #6b7280;
}

/* STARS */
.stars{
    font-size: 14px;
    color: #fbbf24;
    letter-spacing: 1px;
}

/* ANIMATION */
@keyframes scrollLeft{
    0% { transform: translateX(0); }
    100% { transform: translateX(-50%); }
}

/* pause on hover */
.testimonial-marquee:hover .testimonial-track{
    animation-play-state: paused;
}

.instructor-card-modern{
    background:#fff;
    border-radius:14px;
    padding:18px;
    text-align:center;
    box-shadow:0 8px 25px rgba(0,0,0,0.06);
    transition:0.3s;
    height:100%;
}

.instructor-card-modern:hover{
    transform:translateY(-6px);
}

.instructor-img-wrapper{
    position:relative;
}

.instructor-img-wrapper img{
    width:110px;
    height:110px;
    border-radius:50%;
    object-fit:cover;
    margin-bottom:12px;
}

.instructor-social{
    position:absolute;
    right:0;
    top:0;
    list-style:none;
    padding:0;
}

.instructor-social li{
    margin-bottom:6px;
}

.instructor-social a{
    display:inline-block;
    width:26px;
    height:26px;
    border-radius:50%;
    background:#f1f1f1;
    font-size:12px;
    line-height:26px;
    text-align:center;
}

.instructor-info h5{
    font-size:16px;
    margin-bottom:4px;
}

.instructor-info p{
    font-size:13px;
    color:#777;
}
.bg-offwhite{
    background:#f7f8fc;
}
</style>
    @stack('styles')

</head>

<body @yield('body-attr')>

    <!-- LMS HEADER -->
<header class="lmsHeader">
    <div class="lmsHeader__container">

        <!-- LEFT: Logo + Menu -->
        <div class="lmsHeader__left">
            <a href="{{ route('home') }}" class="lmsHeader__logo">
                <img src="{{ asset('frontend/dist/images/logo/logo.png') }}" alt="Logo">
            </a>

            <button class="lmsHeader__toggle" id="lmsMenuToggle">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>

        <!-- CENTER: Navigation -->
        <nav class="lmsNav">
            <ul class="lmsNav__list">

                <li class="lmsNav__item">
                    <a href="{{ route('home') }}" class="lmsNav__link">Home</a>
                </li>

                @if(request()->session()->get('studentLogin'))
                    <li class="lmsNav__item">
                        <a href="{{ route('studentdashboard') }}" class="lmsNav__link">Dashboard</a>
                    </li>
                @elseif(auth()->user())
                    <li class="lmsNav__item">
                        <a href="{{ route('dashboard') }}" class="lmsNav__link">Dashboard</a>
                    </li>
                @endif

                <li class="lmsNav__item"><a href="{{ route('searchCourse') }}" class="lmsNav__link">Courses</a></li>
                <li class="lmsNav__item"><a href="{{ route('searchInstructor') }}" class="lmsNav__link">Instructors</a></li>
                <li class="lmsNav__item"><a href="{{ route('about') }}" class="lmsNav__link">About</a></li>
                <li class="lmsNav__item"><a href="{{ route('contact') }}" class="lmsNav__link">Contact</a></li>

            </ul>
        </nav>

        <!-- RIGHT: Actions -->
        <div class="lmsActions">

            <!-- Search -->
            <button class="lmsActions__iconBtn" onclick="openSearch()">
                🔍
            </button>

            <!-- Cart -->
            @if(request()->session()->get('studentLogin'))
            <a href="{{ route('cart') }}" class="lmsActions__cart">
                🛒
                <span class="lmsActions__badge">{{ count((array) session('cart')) }}</span>
            </a>
            @endif

            <!-- USER -->
            <div class="lmsUser" id="lmsUser">

                @if(request()->session()->get('studentLogin'))

                    <!-- STUDENT -->
                    <div class="lmsUser__trigger" id="lmsUserTrigger">
                        <img src="{{ asset('uploads/students/' . request()->session()->get('image')) }}"
                            onerror="this.src='{{ asset('uploads/students/blank_new.png') }}'">
                    </div>

                    <div class="lmsUser__dropdown" id="lmsUserDropdown">
                        <a href="{{ route('student_profile') }}">Profile</a>
                        <a href="{{ route('studentdashboard') }}">Dashboard</a>
                        <a href="{{ route('studentlogOut') }}" class="danger">Logout</a>
                    </div>

                @elseif(auth()->user())

                    <!-- ADMIN / USER -->
                    <div class="lmsUser__trigger" id="lmsUserTrigger">
                        <img src="{{ asset('uploads/users/' . auth()->user()->image) }}"
                            onerror="this.src='{{ asset('uploads/students/blank_new.png') }}'">
                    </div>

                    <div class="lmsUser__dropdown" id="lmsUserDropdown">
                        <a href="{{ route('user.edit', encryptor('encrypt',auth()->user()->id)) }}">Profile</a>
                        <a href="{{ route('dashboard') }}">Dashboard</a>
                        <a href="{{ route('studentlogOut') }}" class="danger">Logout</a>
                    </div>

                @else
                    <!-- GUEST -->
                    <a href="{{ route('studentLogin') }}" class="lmsBtn lmsBtn--ghost">Sign in</a>
                    <a href="{{ route('signup') }}" class="lmsBtn lmsBtn--primary">Sign up</a>
                @endif

            </div>

        </div>
    </div>
</header>
    @yield('content')

    <!-- Footer Starts Here -->
    <footer class="footer @yield('footer-class')">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="footer__wrapper">
                        <div class="footer__wrapper_logo">
                            <img src="{{asset('frontend/dist/images/logo/footerlogo.png')}}" alt="logo"
                                class="img-fluid" />
                        </div>
                        <p>
                        Kings Digital Literacy Hub is dedicated to empowering individuals through digital education. We offer a range of programs designed to enhance your skills in technology, online communication, and digital tools. Join us to unlock new opportunities, 
                        boost your confidence, and thrive in the digital age!
                        </p>
                        <div class="footer__wrapper_social d-none d-lg-block">
                            <ul>
                                <li>
                                    <a href="#">
                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M17.9507 5.29205C17.9086 4.33564 17.7539 3.67812 17.5324 3.10836C17.3038 2.50359 16.9522 1.96213 16.4915 1.51201C16.0414 1.05489 15.4963 0.699691 14.8986 0.474702C14.3255 0.253147 13.6714 0.0984842 12.715 0.0563159C11.7515 0.0105764 11.4456 0 9.00174 0C6.55791 0 6.25202 0.0105764 5.29204 0.0527447C4.33563 0.0949129 3.67811 0.249713 3.1085 0.471131C2.50358 0.699691 1.96213 1.05132 1.51201 1.51201C1.05489 1.96213 0.699827 2.50716 0.474701 3.10493C0.253147 3.67812 0.098484 4.33207 0.0563158 5.28848C0.0105764 6.25203 0 6.55792 0 9.00176C0 11.4456 0.0105764 11.7515 0.0527446 12.7115C0.0949128 13.6679 0.249713 14.3254 0.471267 14.8952C0.699827 15.4999 1.05489 16.0414 1.51201 16.4915C1.96213 16.9486 2.50715 17.3038 3.10493 17.5288C3.67811 17.7504 4.33206 17.905 5.28861 17.9472C6.24845 17.9895 6.55448 17.9999 8.99831 17.9999C11.4421 17.9999 11.748 17.9895 12.708 17.9472C13.6644 17.905 14.3219 17.7504 14.8916 17.5288C16.1012 17.0611 17.0577 16.1047 17.5254 14.8952C17.7468 14.322 17.9016 13.6679 17.9437 12.7115C17.9859 11.7515 17.9965 11.4456 17.9965 9.00176C17.9965 6.55792 17.9929 6.25203 17.9507 5.29205ZM16.3298 12.6411C16.2911 13.5202 16.1434 13.9949 16.0203 14.3114C15.7179 15.0956 15.0955 15.7179 14.3114 16.0204C13.9949 16.1434 13.5168 16.2911 12.6411 16.3297C11.6917 16.372 11.407 16.3824 9.00531 16.3824C6.60365 16.3824 6.31534 16.372 5.36937 16.3297C4.4903 16.2911 4.01559 16.1434 3.69913 16.0204C3.3089 15.8761 2.9537 15.6476 2.66539 15.3487C2.3665 15.0568 2.13794 14.7052 1.99372 14.315C1.87065 13.9985 1.72299 13.5202 1.68439 12.6447C1.64209 11.6953 1.63165 11.4104 1.63165 9.00876C1.63165 6.60709 1.64209 6.31878 1.68439 5.37295C1.72299 4.49387 1.87065 4.01917 1.99372 3.7027C2.13794 3.31234 2.3665 2.95727 2.66896 2.66883C2.9607 2.36994 3.31233 2.14138 3.7027 1.99729C4.01917 1.87422 4.49744 1.72656 5.37294 1.68783C6.32235 1.64566 6.60722 1.63508 9.00875 1.63508C11.414 1.63508 11.6987 1.64566 12.6447 1.68783C13.5238 1.72656 13.9985 1.87422 14.3149 1.99729C14.7052 2.14138 15.0604 2.36994 15.3487 2.66883C15.6476 2.96071 15.8761 3.31234 16.0203 3.7027C16.1434 4.01917 16.2911 4.49731 16.3298 5.37295C16.372 6.32236 16.3826 6.60709 16.3826 9.00876C16.3826 11.4104 16.372 11.6917 16.3298 12.6411Z"
                                                fill="white"></path>
                                            <path
                                                d="M9.00188 4.37744C6.44912 4.37744 4.37793 6.44849 4.37793 9.00139C4.37793 11.5543 6.44912 13.6253 9.00188 13.6253C11.5548 13.6253 13.6258 11.5543 13.6258 9.00139C13.6258 6.44849 11.5548 4.37744 9.00188 4.37744ZM9.00188 12.0008C7.34578 12.0008 6.00244 10.6576 6.00244 9.00139C6.00244 7.34515 7.34578 6.00195 9.00188 6.00195C10.6581 6.00195 12.0013 7.34515 12.0013 9.00139C12.0013 10.6576 10.6581 12.0008 9.00188 12.0008Z"
                                                fill="white"></path>
                                            <path
                                                d="M14.8876 4.19521C14.8876 4.79133 14.4043 5.27469 13.808 5.27469C13.2119 5.27469 12.7285 4.79133 12.7285 4.19521C12.7285 3.59894 13.2119 3.11572 13.808 3.11572C14.4043 3.11572 14.8876 3.59894 14.8876 4.19521Z"
                                                fill="white"></path>
                                        </svg>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M17.9955 18.0002V17.9994H18V11.3979C18 8.16841 17.3047 5.68066 13.5292 5.68066C11.7142 5.68066 10.4962 6.67666 9.99896 7.62091H9.94646V5.98216H6.3667V17.9994H10.0942V12.0489C10.0942 10.4822 10.3912 8.96716 12.3315 8.96716C14.2432 8.96716 14.2717 10.7552 14.2717 12.1494V18.0002H17.9955Z"
                                                fill="white"></path>
                                            <path d="M0.296875 5.98291H4.02888V18.0002H0.296875V5.98291Z" fill="white">
                                            </path>
                                            <path
                                                d="M2.1615 0C0.96825 0 0 0.96825 0 2.1615C0 3.35475 0.96825 4.34325 2.1615 4.34325C3.35475 4.34325 4.323 3.35475 4.323 2.1615C4.32225 0.96825 3.354 0 2.1615 0V0Z"
                                                fill="white"></path>
                                        </svg>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <svg width="18" height="15" viewBox="0 0 18 15" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M18 1.73137C17.3306 2.025 16.6174 2.21962 15.8737 2.31412C16.6388 1.85737 17.2226 1.13962 17.4971 0.2745C16.7839 0.69975 15.9964 1.00013 15.1571 1.16775C14.4799 0.446625 13.5146 0 12.4616 0C10.4186 0 8.77387 1.65825 8.77387 3.69113C8.77387 3.98363 8.79862 4.26487 8.85938 4.53262C5.7915 4.383 3.07687 2.91263 1.25325 0.67275C0.934875 1.22513 0.748125 1.85738 0.748125 2.538C0.748125 3.816 1.40625 4.94887 2.38725 5.60475C1.79437 5.5935 1.21275 5.42138 0.72 5.15025C0.72 5.1615 0.72 5.17613 0.72 5.19075C0.72 6.984 1.99912 8.4735 3.6765 8.81662C3.37612 8.89875 3.04875 8.93812 2.709 8.93812C2.47275 8.93812 2.23425 8.92463 2.01038 8.87512C2.4885 10.3365 3.84525 11.4109 5.4585 11.4457C4.203 12.4279 2.60888 13.0196 0.883125 13.0196C0.5805 13.0196 0.29025 13.0061 0 12.969C1.63462 14.0231 3.57188 14.625 5.661 14.625C12.4515 14.625 16.164 9 16.164 4.12425C16.164 3.96112 16.1584 3.80363 16.1505 3.64725C16.8829 3.1275 17.4982 2.47837 18 1.73137Z"
                                                fill="white"></path>
                                        </svg>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <svg width="18" height="14" viewBox="0 0 18 14" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M16.0427 0.885481C16.8137 1.09312 17.4216 1.70094 17.6291 2.47204C18.0148 3.88048 17.9999 6.81629 17.9999 6.81629C17.9999 6.81629 17.9999 9.73713 17.6293 11.1457C17.4216 11.9167 16.8138 12.5246 16.0427 12.7321C14.6341 13.1029 8.99996 13.1029 8.99996 13.1029C8.99996 13.1029 3.38048 13.1029 1.95721 12.7174C1.18611 12.5098 0.57829 11.9018 0.37065 11.1309C0 9.73713 0 6.80146 0 6.80146C0 6.80146 0 3.88048 0.37065 2.47204C0.578153 1.70108 1.20094 1.07829 1.95707 0.870787C3.36565 0.5 8.99983 0.5 8.99983 0.5C8.99983 0.5 14.6341 0.5 16.0427 0.885481ZM11.8913 6.80154L7.20605 9.50006V4.10303L11.8913 6.80154Z"
                                                fill="white"></path>
                                        </svg>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <svg width="9" height="18" viewBox="0 0 9 18" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M7.3575 2.98875H9.00075V0.12675C8.71725 0.08775 7.74225 0 6.60675 0C4.2375 0 2.6145 1.49025 2.6145 4.22925V6.75H0V9.9495H2.6145V18H5.82V9.95025H8.32875L8.727 6.75075H5.81925V4.5465C5.82 3.62175 6.069 2.98875 7.3575 2.98875Z"
                                                fill="white"></path>
                                        </svg>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-sm-4 col-6">
                    <div class="footer__list">
                        <h6>Company</h6>
                        <ul>
                            <li><a href="{{route('about')}}">About Us</a></li>
                            <li><a href="{{route('searchCourse')}}">Courses</a></li>
                            <li><a href="#">Career</a></li>
                            <li><a href="#">Affiliate</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-sm-4 col-6">
                    <div class="footer__list">
                        <h6>Support</h6>
                        <ul>
                            <li><a href="#">Help &amp; Supports </a></li>
                            <li><a href="#">Pravacy Polocy</a></li>
                            <li><a href="#">FAQs</a></li>
                            <li><a href="{{route('contact')}}">Contact Us</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-sm-4 col-6">
                    <div class="footer__list">
                        <h6>Quick Links</h6>
                        <ul>
                            <li><a href="#">Events</a></li>
                            <li><a href="{{route('instructorSubscription')}}">Become a Instructor</a></li>
                            <li><a href="#">Partnerships</a></li>
                            <li><a href="#">Get the app</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-12 d-block d-lg-none">
                    <div class="footer__wrapper_social d-flex my-4">
                        <ul>
                            <li>
                                <a href="#">
                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M17.9507 5.29205C17.9086 4.33564 17.7539 3.67812 17.5324 3.10836C17.3038 2.50359 16.9522 1.96213 16.4915 1.51201C16.0414 1.05489 15.4963 0.699691 14.8986 0.474702C14.3255 0.253147 13.6714 0.0984842 12.715 0.0563159C11.7515 0.0105764 11.4456 0 9.00174 0C6.55791 0 6.25202 0.0105764 5.29204 0.0527447C4.33563 0.0949129 3.67811 0.249713 3.1085 0.471131C2.50358 0.699691 1.96213 1.05132 1.51201 1.51201C1.05489 1.96213 0.699827 2.50716 0.474701 3.10493C0.253147 3.67812 0.098484 4.33207 0.0563158 5.28848C0.0105764 6.25203 0 6.55792 0 9.00176C0 11.4456 0.0105764 11.7515 0.0527446 12.7115C0.0949128 13.6679 0.249713 14.3254 0.471267 14.8952C0.699827 15.4999 1.05489 16.0414 1.51201 16.4915C1.96213 16.9486 2.50715 17.3038 3.10493 17.5288C3.67811 17.7504 4.33206 17.905 5.28861 17.9472C6.24845 17.9895 6.55448 17.9999 8.99831 17.9999C11.4421 17.9999 11.748 17.9895 12.708 17.9472C13.6644 17.905 14.3219 17.7504 14.8916 17.5288C16.1012 17.0611 17.0577 16.1047 17.5254 14.8952C17.7468 14.322 17.9016 13.6679 17.9437 12.7115C17.9859 11.7515 17.9965 11.4456 17.9965 9.00176C17.9965 6.55792 17.9929 6.25203 17.9507 5.29205ZM16.3298 12.6411C16.2911 13.5202 16.1434 13.9949 16.0203 14.3114C15.7179 15.0956 15.0955 15.7179 14.3114 16.0204C13.9949 16.1434 13.5168 16.2911 12.6411 16.3297C11.6917 16.372 11.407 16.3824 9.00531 16.3824C6.60365 16.3824 6.31534 16.372 5.36937 16.3297C4.4903 16.2911 4.01559 16.1434 3.69913 16.0204C3.3089 15.8761 2.9537 15.6476 2.66539 15.3487C2.3665 15.0568 2.13794 14.7052 1.99372 14.315C1.87065 13.9985 1.72299 13.5202 1.68439 12.6447C1.64209 11.6953 1.63165 11.4104 1.63165 9.00876C1.63165 6.60709 1.64209 6.31878 1.68439 5.37295C1.72299 4.49387 1.87065 4.01917 1.99372 3.7027C2.13794 3.31234 2.3665 2.95727 2.66896 2.66883C2.9607 2.36994 3.31233 2.14138 3.7027 1.99729C4.01917 1.87422 4.49744 1.72656 5.37294 1.68783C6.32235 1.64566 6.60722 1.63508 9.00875 1.63508C11.414 1.63508 11.6987 1.64566 12.6447 1.68783C13.5238 1.72656 13.9985 1.87422 14.3149 1.99729C14.7052 2.14138 15.0604 2.36994 15.3487 2.66883C15.6476 2.96071 15.8761 3.31234 16.0203 3.7027C16.1434 4.01917 16.2911 4.49731 16.3298 5.37295C16.372 6.32236 16.3826 6.60709 16.3826 9.00876C16.3826 11.4104 16.372 11.6917 16.3298 12.6411Z"
                                            fill="white"></path>
                                        <path
                                            d="M9.00188 4.37744C6.44912 4.37744 4.37793 6.44849 4.37793 9.00139C4.37793 11.5543 6.44912 13.6253 9.00188 13.6253C11.5548 13.6253 13.6258 11.5543 13.6258 9.00139C13.6258 6.44849 11.5548 4.37744 9.00188 4.37744ZM9.00188 12.0008C7.34578 12.0008 6.00244 10.6576 6.00244 9.00139C6.00244 7.34515 7.34578 6.00195 9.00188 6.00195C10.6581 6.00195 12.0013 7.34515 12.0013 9.00139C12.0013 10.6576 10.6581 12.0008 9.00188 12.0008Z"
                                            fill="white"></path>
                                        <path
                                            d="M14.8876 4.19521C14.8876 4.79133 14.4043 5.27469 13.808 5.27469C13.2119 5.27469 12.7285 4.79133 12.7285 4.19521C12.7285 3.59894 13.2119 3.11572 13.808 3.11572C14.4043 3.11572 14.8876 3.59894 14.8876 4.19521Z"
                                            fill="white"></path>
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M17.9955 18.0002V17.9994H18V11.3979C18 8.16841 17.3047 5.68066 13.5292 5.68066C11.7142 5.68066 10.4962 6.67666 9.99896 7.62091H9.94646V5.98216H6.3667V17.9994H10.0942V12.0489C10.0942 10.4822 10.3912 8.96716 12.3315 8.96716C14.2432 8.96716 14.2717 10.7552 14.2717 12.1494V18.0002H17.9955Z"
                                            fill="white"></path>
                                        <path d="M0.296875 5.98291H4.02888V18.0002H0.296875V5.98291Z" fill="white">
                                        </path>
                                        <path
                                            d="M2.1615 0C0.96825 0 0 0.96825 0 2.1615C0 3.35475 0.96825 4.34325 2.1615 4.34325C3.35475 4.34325 4.323 3.35475 4.323 2.1615C4.32225 0.96825 3.354 0 2.1615 0V0Z"
                                            fill="white"></path>
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <svg width="18" height="15" viewBox="0 0 18 15" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M18 1.73137C17.3306 2.025 16.6174 2.21962 15.8737 2.31412C16.6388 1.85737 17.2226 1.13962 17.4971 0.2745C16.7839 0.69975 15.9964 1.00013 15.1571 1.16775C14.4799 0.446625 13.5146 0 12.4616 0C10.4186 0 8.77387 1.65825 8.77387 3.69113C8.77387 3.98363 8.79862 4.26487 8.85938 4.53262C5.7915 4.383 3.07687 2.91263 1.25325 0.67275C0.934875 1.22513 0.748125 1.85738 0.748125 2.538C0.748125 3.816 1.40625 4.94887 2.38725 5.60475C1.79437 5.5935 1.21275 5.42138 0.72 5.15025C0.72 5.1615 0.72 5.17613 0.72 5.19075C0.72 6.984 1.99912 8.4735 3.6765 8.81662C3.37612 8.89875 3.04875 8.93812 2.709 8.93812C2.47275 8.93812 2.23425 8.92463 2.01038 8.87512C2.4885 10.3365 3.84525 11.4109 5.4585 11.4457C4.203 12.4279 2.60888 13.0196 0.883125 13.0196C0.5805 13.0196 0.29025 13.0061 0 12.969C1.63462 14.0231 3.57188 14.625 5.661 14.625C12.4515 14.625 16.164 9 16.164 4.12425C16.164 3.96112 16.1584 3.80363 16.1505 3.64725C16.8829 3.1275 17.4982 2.47837 18 1.73137Z"
                                            fill="white"></path>
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <svg width="18" height="14" viewBox="0 0 18 14" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M16.0427 0.885481C16.8137 1.09312 17.4216 1.70094 17.6291 2.47204C18.0148 3.88048 17.9999 6.81629 17.9999 6.81629C17.9999 6.81629 17.9999 9.73713 17.6293 11.1457C17.4216 11.9167 16.8138 12.5246 16.0427 12.7321C14.6341 13.1029 8.99996 13.1029 8.99996 13.1029C8.99996 13.1029 3.38048 13.1029 1.95721 12.7174C1.18611 12.5098 0.57829 11.9018 0.37065 11.1309C0 9.73713 0 6.80146 0 6.80146C0 6.80146 0 3.88048 0.37065 2.47204C0.578153 1.70108 1.20094 1.07829 1.95707 0.870787C3.36565 0.5 8.99983 0.5 8.99983 0.5C8.99983 0.5 14.6341 0.5 16.0427 0.885481ZM11.8913 6.80154L7.20605 9.50006V4.10303L11.8913 6.80154Z"
                                            fill="white"></path>
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <svg width="9" height="18" viewBox="0 0 9 18" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M7.3575 2.98875H9.00075V0.12675C8.71725 0.08775 7.74225 0 6.60675 0C4.2375 0 2.6145 1.49025 2.6145 4.22925V6.75H0V9.9495H2.6145V18H5.82V9.95025H8.32875L8.727 6.75075H5.81925V4.5465C5.82 3.62175 6.069 2.98875 7.3575 2.98875Z"
                                            fill="white"></path>
                                    </svg>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer__bottom">
            <div class="container">
                <div class="footer__bottom-content">
                    <div class="footer__bottom_copyright">
                        <p>© 2023 - <?php echo date('Y') ?> - Kings Digital Literacy Hub. All rights reserved</p>
                    </div>
                    <div class="footer__bottom_topbutton">
                        <a href="#">
                            Go To Top
                            <div class="icon ms-2">
                                <svg width="10" height="6" viewBox="0 0 10 6" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9 5L5 1L1 5" stroke="white" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                </svg>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="{{asset('frontend/src/js/jquery.min.js')}}"></script>
    <script src="{{asset('frontend/src/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('frontend/src/scss/vendors/plugin/js/isotope.pkgd.min.js')}}"></script>
    <script src="{{asset('frontend/src/scss/vendors/plugin/js/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('frontend/src/scss/vendors/plugin/js/slick.min.js')}}"></script>
    <script src="{{asset('frontend/src/scss/vendors/plugin/js/jquery.nice-select.min.js')}}"></script>
    <script src="{{asset('frontend/src/js/app.js')}}"></script>
    <script src="{{asset('frontend/dist/main.js')}}"></script>

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

    const user = document.getElementById("lmsUser");
    const trigger = document.getElementById("lmsUserTrigger");

    if (!user || !trigger) return;

    // toggle dropdown
    trigger.addEventListener("click", function (e) {
        e.stopPropagation();
        user.classList.toggle("open");
    });

    // close on outside click
    document.addEventListener("click", function (e) {
        if (!user.contains(e.target)) {
            user.classList.remove("open");
        }
    });

});
</script>
<script>
    const drawer = document.getElementById('categoryDrawer');

    document.getElementById('openCategoryDrawer').addEventListener('click', () => {
        drawer.classList.add('open');
    });

    document.getElementById('closeCategoryDrawer').addEventListener('click', () => {
        drawer.classList.remove('open');
    });

    document.getElementById('closeCategoryBtn').addEventListener('click', () => {
        drawer.classList.remove('open');
    });
</script>
<script>
    const backToTopBtn = document.getElementById("backToTopBtn");

    // Show button on scroll
    window.addEventListener("scroll", () => {
        if (window.scrollY > 300) {
            backToTopBtn.style.display = "flex";
        } else {
            backToTopBtn.style.display = "none";
        }
    });

    // Scroll to top
    backToTopBtn.addEventListener("click", () => {
        window.scrollTo({
            top: 0,
            behavior: "smooth"
        });
    });
</script>
    @stack('scripts')


</body>

</html>