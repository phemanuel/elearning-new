@extends('layouts.app1')

@section('content')

<style>
    body {
        background: #ffffff;
    }

    /* HEADER */
    .custom-header {
        background: #000;
        color: #fff;
        padding: 20px 0;
        text-align: center;
        font-weight: 600;
        letter-spacing: 1px;
    }

    /* FOOTER */
    .custom-footer {
        background: #000;
        color: #fff;
        text-align: center;
        padding: 20px;
        margin-top: 60px;
        font-size: 14px;
    }

    .wrapper {
        max-width: 1200px;
        margin: 60px auto;
        padding: 20px;
    }

    .profile-img {
        float: left;
        width: 320px;
        height: 420px;
        object-fit: cover;
        border-radius: 20px;
        margin-right: 30px;
        margin-bottom: 20px;
        box-shadow: 0 15px 40px rgba(0,0,0,0.1);
    }

    .content {
        font-size: 16px;
        line-height: 1.9;
        color: #333;
        max-width: 1200px;
    }

    .content p {
        margin-bottom: 18px;
    }

    .highlight {
        font-weight: 600;
        color: #000;
    }

    .cta-box {
    margin: 40px auto; /* centers horizontally */
    padding: 25px;
    background: #ffffff; /* keep it white if you want */
    border-radius: 15px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.05);
    clear: both;
    max-width: 700px;
    text-align: center; /* centers inner text & form inputs/buttons if needed */
}

    .cta-box strong {
        display: block;
        margin-bottom: 15px;
        font-size: 18px;
        text-align: center;
        
    }

    input {
        width: 100%;
        padding: 12px;
        margin-bottom: 12px;
        border-radius: 8px;
        border: 1px solid #ddd;
    }

    button {
        width: 100%;
        padding: 12px;
        border: none;
        border-radius: 30px;
        background: #000;
        color: #fff;
        font-weight: 600;
        cursor: pointer;
    }

    button:hover {
        opacity: 0.85;
    }

    /* MOBILE */
    @media (max-width: 768px) {
        .profile-img {
            float: none;
            width: 100%;
            height: auto;
            margin-right: 0;
        }
    }

    
</style>


<!-- HEADER -->
<!-- <div class="custom-header">
    Miracle Peters
</div> -->


<div class="wrapper">

    <!-- IMAGE -->
    <img src="{{ asset('images/miracle.png') }}" 
         alt="Miracle Peters" 
         class="profile-img">

    <!-- CONTENT -->
    <div class="content">

        <p>
            Miracle Peters is a <strong>Digital Marketing and Social Media Management Specialist, entrepreneur, and trainer</strong> who has built multiple income streams through the power of social media.
        </p>

        <p>
            She is the Creative Director of Kings Digital Literacy Hub and the Consultant at Kings Branding Consult Ltd, brands dedicated to helping individuals and businesses grow using digital skills and modern marketing strategies.
        </p>

        <p class="highlight">
            But her journey didn’t start from a place of comfort.
        </p>

        <p>
            Years ago, Miracle was simply searching for something that could put food on the table and give her family a better life. What began as a search for survival eventually turned into a career in Social Media Management and Digital Marketing.
        </p>

        <p>
            Today, she has worked with businesses across several countries including the United States, the United Kingdom, Germany, Serbia, the Philippines, and many others, helping brands grow their online presence and turn social media into a powerful business tool.
        </p>

        <p>
            Over the years, Miracle has also trained and mentored hundreds of beginners who wanted to break into the digital space. Many of her students have gone on to land clients, start freelancing careers, and begin earning online using the same strategies she teaches.
        </p>

        <p>
            On social media, she is popularly known as 
            <span class="highlight">“The Social Media Goddess”</span>, 
            a name her community gave her because of the results she consistently helps people achieve.
        </p>

        <p class="highlight">
            Through her programs and platforms, Miracle’s mission is simple:
        </p>

        <p>
           ✔ To help more people discover profitable digital skills and build sustainable income in the digital economy.
        </p>

        <p>
          ✔ If there’s anyone you want to learn Social Media Management from, it’s Miracle.
        </p>

    </div>


    <!-- CTA -->
    <div class="cta-box">
        <strong>
            Sign up for The Social Media Management Blueprint
        </strong>

        <form method="POST" action="{{ url('/register') }}">
            @csrf

            <input type="text" name="name" placeholder="Full Name" required>
            <input type="email" name="email" placeholder="Email Address" required>

            <button type="submit">
                Get Started
            </button>
        </form>
    </div>

</div>




@endsection