<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SMM Blueprint</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
 <link rel="icon" type="image/png" href="{{asset('frontend/dist/images/favicon/favicon.png')}}" />

<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:'Poppins',sans-serif}
body{background:#f5f7fb;color:#1a1a1a}

.container{max-width:1100px;margin:auto;padding:20px}

.hero{
  background:linear-gradient(135deg,#0f172a,#1e293b);
  color:#fff;
  padding:80px 20px;
  text-align:center;
}

.hero h1{
  font-size:42px;
  font-weight:700;
  line-height:1.2;
}

.hero p{
  margin-top:15px;
  font-size:18px;
  opacity:0.9;
}

.card{
  background:#fff;
  padding:25px;
  border-radius:12px;
  margin-top:30px;
  box-shadow:0 10px 30px rgba(0,0,0,0.05);
}

input{
  width:100%;
  padding:14px;
  margin:10px 0;
  border-radius:8px;
  border:1px solid #ddd;
  font-size:15px;
}

button{
  width:100%;
  padding:14px;
  background:#22c55e;
  color:#fff;
  border:none;
  border-radius:8px;
  font-size:16px;
  font-weight:600;
  cursor:pointer;
  transition:0.3s;
}

button:hover{background:#16a34a}

.section{
  margin:60px 0;
}

.section-alt{
  background:#eef2f7;
  padding:60px 20px;
  border-radius:12px;
}

.section h2{
  text-align:left;
  margin-bottom:20px;
  font-size:28px;
}

.section p{
  text-align:left;
  max-width:700px;
  margin:0 auto;
}

.grid{
  display:grid;
  grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
  gap:20px;
  justify-content:left;
  align-items:left;
  text-align:left;
}

.feature{
  background:#ffffff;
  padding:20px;
  border-radius:10px;
  box-shadow:0 5px 20px rgba(0,0,0,0.05);
  text-align:left;
}

.highlight{
  background:#22c55e;
  color:#fff;
  padding:40px 20px;
  border-radius:12px;
  text-align:left;
}

.price{
  font-size:32px;
  font-weight:700;
  margin:10px 0;
}

.footer{
  text-align:center;
  padding:30px;
  font-size:14px;
  color:#777;
}
</style>
</head>

<body>

<!-- Image you want to display -->
<img src="{{asset('images/img01.png')}}" 
     alt="Descriptive Text" 
     style="display:block; width:100%; height:auto; max-height:700px; margin:0; border-radius:12px;">

<!-- HERO -->
<div class="hero" style="background:#1a1a2e; padding:40px 40;"> <!-- keep your dark background -->
  <div class="container" style="max-width:1200px; margin:0 auto; padding:0 15px; font-family:Arial, sans-serif; color:#fff; line-height:1.6;">

    <h1 style="font-size:32px; font-weight:700; text-align:center; margin-bottom:15px;">
      Turn Social Media Into a Paying Skill
    </h1>
    <p style="text-align:center; font-size:16px; margin-bottom:30px;">
      Learn how to attract clients & earn online in 6 weeks — even with zero experience
    </p>

    <!-- Additional Hero Text -->
    <div class="hero-text" style="margin-top:20px; color:#fff;">
      <p style="text-align:left;">
  A simple, step-by-step system that shows you how to learn Social Media Management, attract paying clients, and start earning online.
</p>

      <ul style="list-style:none; margin-bottom:20px; padding-left:0; color:#fff;">
        <li style="margin-bottom:10px; display:flex; align-items:flex-start; gap:8px;">
          <span style="color:#ffcc00;">•</span>
          <span>No tech background.</span>
        </li>
        <li style="margin-bottom:10px; display:flex; align-items:flex-start; gap:8px;">
          <span style="color:#ffcc00;">•</span>
          <span>No prior experience.</span>
        </li>
        <li style="margin-bottom:10px; display:flex; align-items:flex-start; gap:8px;">
          <span style="color:#ffcc00;">•</span>
          <span>No complicated tools.</span>
        </li>
      </ul>

      <p style="text-align:left;">Social media management is one of the hottest digital skills right now. Businesses need it, freelancers are making bank with it, and you can too. But most beginners fail because they don’t know where to start or how to get clients.</p>

   <p style="font-weight:600; margin-top:15px; font-size:18px; text-align:left;">Here’s our plan for you:</p>



      <ul style="list-style:none; padding-left:0; margin-top:10px; color:#fff; text-align:left; max-width:700px;">
        <li style="margin-bottom:10px;">
          <span style="color:#22c55e; margin-right:8px;">✔</span>
          Learn PROFITABLE social media management
        </li>
        <li style="margin-bottom:10px;">
          <span style="color:#22c55e; margin-right:8px;">✔</span>
          Learn social media management BUSINESS
        </li>
        <li style="margin-bottom:10px;">
          <span style="color:#22c55e; margin-right:8px;">✔</span>
          Build YOUR portfolio
        </li>
        <li style="margin-bottom:10px;">
          <span style="color:#22c55e; margin-right:8px;">✔</span>
          Land as much CLIENTS/JOBS as possible
        </li>
        <li style="margin-bottom:10px;">
          <span style="color:#22c55e; margin-right:8px;">✔</span>
          GROW and BUILD your business
        </li>
      </ul>

      <p style="text-align:left;">The Social Media Management Blueprint is a 6-week online program that provides you with the knowledge and support needed to succeed as a social media manager, whether you aim to work freelance or within a corporate setting.</p>

      <p style="text-align:left;">This is beyond learning how to manage social media accounts as a social media manager, the program goes further to show you how you can monetize your skill. In other words, you’ll be learning profitable social media management.</p>

      <p style="text-align:left;">The social media management blueprint is more than just a course, it's a life transforming journey you should embark on - even if you're a student looking to earn extra income, a professional seeking a career change, or an entrepreneur aiming to boost your business, the social media management blueprint provides you a clear roadmap to success. In just 6 weeks, you can transform your understanding of social platforms into a profitable venture.</p>

      <p style="font-weight:600; margin-top:15px; font-size:18px; text-align:left;">Here’s our learning Structure:</p>

      <ul style="list-style:none; padding-left:0; margin-top:10px; color:#fff; text-align:left; max-width:700px;">
        <li style="margin-bottom:10px;">
          <span style="color:#22c55e; margin-right:8px;">✔</span>
          Self paced lessons
        </li>
        <li style="margin-bottom:10px;">
          <span style="color:#22c55e; margin-right:8px;">✔</span>
          Live webinars
        </li>
        <li style="margin-bottom:10px;">
          <span style="color:#22c55e; margin-right:8px;">✔</span>
          Weekly coaching call sessions
        </li>
        <li style="margin-bottom:10px;">
          <span style="color:#22c55e; margin-right:8px;">✔</span>
          Practical engagements/Activities
        </li>
        <li style="margin-bottom:10px;">
          <span style="color:#22c55e; margin-right:8px;">✔</span>
          Group based lessons
        </li>
        <li style="margin-bottom:10px;">
          <span style="color:#22c55e; margin-right:8px;">✔</span>
          No prior experience is needed
        </li>
        <li style="margin-bottom:10px;">
          <span style="color:#22c55e; margin-right:8px;">✔</span>
          No tech skill is needed
        </li>
      </ul>

    <!-- Form Card -->
    <div class="card"
      style="
        max-width:800px;
        margin:30px auto 0;
        margin-bottom:20px;
        background:#fff;
        padding:25px;
        border-radius:12px;
        box-shadow:0 10px 30px rgba(0,0,0,0.1);
      ">
      <form action="{{ route('smm.submit') }}" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Your Name" required>
        <input type="email" name="email" placeholder="Your Email" required>
        <button type="submit">
            Join the Program — ₦25,000
        </button>
    </form>      
    </div>
  </div>
</div>

<div class="container" style="max-width:1200px; margin:0 auto; padding:0 15px; font-family:Arial, sans-serif; color:#fff; line-height:1.6;">

  <p style="font-weight:600; margin-top:15px; font-size:18px; text-align:left;">Our curriculum details:</p>

  <ul style="list-style:none; padding-left:0; margin-top:10px; text-align:left;">
    <li style="margin-bottom:8px;"><span style="color:#22c55e; margin-right:8px;">✔</span> Social media management overview</li>
    <li style="margin-bottom:8px;"><span style="color:#22c55e; margin-right:8px;">✔</span> Roles and responsibilities of a social media manager</li>
    <li style="margin-bottom:8px;"><span style="color:#22c55e; margin-right:8px;">✔</span> How to execute social media manager responsibilities</li>
    <li style="margin-bottom:8px;"><span style="color:#22c55e; margin-right:8px;">✔</span> Comprehensive knowledge of social media platforms</li>
    <li style="margin-bottom:8px;"><span style="color:#22c55e; margin-right:8px;">✔</span> Content creation</li>
    <li style="margin-bottom:8px;"><span style="color:#22c55e; margin-right:8px;">✔</span> Creating and organizing content with a plan</li>
    <li style="margin-bottom:8px;"><span style="color:#22c55e; margin-right:8px;">✔</span> Target audience and how to research/find them</li>
    <li style="margin-bottom:8px;"><span style="color:#22c55e; margin-right:8px;">✔</span> Connecting with your audience and building a community</li>
    <li style="margin-bottom:8px;"><span style="color:#22c55e; margin-right:8px;">✔</span> Social media and personal branding</li>
    <li style="margin-bottom:8px;"><span style="color:#22c55e; margin-right:8px;">✔</span> Social media audit</li>
    <li style="margin-bottom:8px;"><span style="color:#22c55e; margin-right:8px;">✔</span> Social media management tools</li>
    <li style="margin-bottom:8px;"><span style="color:#22c55e; margin-right:8px;">✔</span> How to utilize social media management tools effectively</li>
    <li style="margin-bottom:8px;"><span style="color:#22c55e; margin-right:8px;">✔</span> Social media campaigns and promotions</li>
    <li style="margin-bottom:8px;"><span style="color:#22c55e; margin-right:8px;">✔</span> Canva design</li>
    <li style="margin-bottom:8px;"><span style="color:#22c55e; margin-right:8px;">✔</span> Extra income services you can offer as a social media manager</li>
    <li style="margin-bottom:8px;"><span style="color:#22c55e; margin-right:8px;">✔</span> How to Find and attract clients</li>
    <li style="margin-bottom:8px;"><span style="color:#22c55e; margin-right:8px;">✔</span> Freelancing & skill monetization</li>
    <li style="margin-bottom:8px;"><span style="color:#22c55e; margin-right:8px;">✔</span> Client discovery call and onboarding, and lots more!</li>
  </ul>

  <p style="text-align:left;">We could go on and on about the lead trainer, 
    <a href="https://www.kingsdigihub.org/miraclepeters" style="color:#ffcc00; text-decoration:underline;">Miracle Peters</a>
    … but that’s not the most important thing right now.
  </p>

  <p style="text-align:left;">Learn from the woman who went from searching for something that could put food on the table to building multiple income streams with social media.</p>

  <p style="text-align:left;">- Learn from the woman who has worked with clients across various countries of the world.</p>

  <!-- <p style="text-align:left;">- Learn from the woman popularly known online as “The Social Media Goddess.”</p> -->

  <p style="text-align:left;">- Learn from the woman who has helped beginners like you start landing clients and building real income online.</p>

  <p style="text-align:left;">And now she’s sharing the exact blueprint that made it all possible.</p>

</div>

<br>

<!-- OFFER -->
<div class="hero">
  <div class="container" style="text-align:center;">

    <h2>Jump in now.</h2>    
    <p>Only ₦25,000 to start learning how to turn social media into income.</p>

    <!-- FORM -->
    <div style="
      max-width:800px;
      margin:30px auto 0;
      background:#fff;
      padding:25px;
      border-radius:12px;
      box-shadow:0 10px 30px rgba(0,0,0,0.1);
    ">
      <form action="{{ route('smm.submit') }}" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Your Name" required>
        <input type="email" name="email" placeholder="Your Email" required>
        <button type="submit">
            Secure your spot
        </button>
    </form>
    </div>

  </div>
</div>

<div class="container" style="max-width:1200px; margin:0 auto; padding:0 15px; font-family:Arial, sans-serif; color:#fff; line-height:1.6;">

  <h2 style="margin-bottom:15px; text-align:left;">Why This Works</h2>
  <p style="text-align:left;">Most programs fail because they overwhelm you with theory and extra work.</p>
  <p style="text-align:left;">The Social Media Management Blueprint works because it’s built around your time, your energy, and your results.</p>

  <h3 style="margin-top:25px; text-align:left;">Enroll Today and Get Instant Access To:</h3>
  <ul style="list-style:none; padding-left:0; margin-top:10px; text-align:left;">
    <li style="margin-bottom:10px;"><span style="color:#22c55e; margin-right:8px;">✔</span> 6-Week Step-by-Step Training</li>
    <li style="margin-bottom:10px;"><span style="color:#22c55e; margin-right:8px;">✔</span> Portfolio & Client-Building Exercises</li>
    <li style="margin-bottom:10px;"><span style="color:#22c55e; margin-right:8px;">✔</span> Templates & Scripts to Land Your First Client</li>
    <li style="margin-bottom:10px;"><span style="color:#22c55e; margin-right:8px;">✔</span> Weekly Coaching Call Sessions</li>
    <li style="margin-bottom:10px;">
        <span style="color:#22c55e; margin-right:8px;">✔</span> Certificate of Completion</li>
</ul>

<!-- Sample Certificate Image -->
<div style="text-align:left; margin-top:20px;">
    <img src="{{ asset('images/cert-sample.jpg') }}" 
         alt="Certificate Sample" 
         style="max-width:400px; width:100%; height:auto; border-radius:12px; box-shadow:0 8px 25px rgba(0,0,0,0.1);">
</div>

  <h3 style="margin-top:25px; text-align:left;">PLUS LIMITED-TIME BONUSES:</h3>
  <ul style="list-style:none; padding-left:0; margin-top:10px; text-align:left;">
    <li style="margin-bottom:10px;"><span style="color:#22c55e; margin-right:8px;">✔</span> High-Converting Social Media Schedule Templates</li>
    <li style="margin-bottom:10px;"><span style="color:#22c55e; margin-right:8px;">✔</span> Client Pitch Scripts & Discovery Call Templates</li>
    <li style="margin-bottom:10px;"><span style="color:#22c55e; margin-right:8px;">✔</span> Exclusive Community for Networking & Support</li>
  </ul>

  <h3 style="margin-top:25px; text-align:left;">OTHER PERKS</h3>
  <ul style="list-style:none; padding-left:0; margin-top:10px; text-align:left;">
    <p></p>
    <li style="margin-bottom:10px;"><span style="color:#22c55e; margin-right:8px;">✔</span>Our students gain access to a masterclass teaching how to get jobs on freelance platforms like Upwork, LinkedIn, etc.</li>
    <li style="margin-bottom:10px;"><span style="color:#22c55e; margin-right:8px;">✔</span>Our students graduate from the programm with a job-ready portfolio</li>
  </ul>  

</div>
<br>
<div class="hero">
  <div class="container" style="text-align:center;">
    <h2>Don't miss out.</h2>    
    <p>Only ₦25,000 to start learning how to turn social media into income.</p>
      <div style="
            max-width:800px;
            margin:30px auto 0;
            background:#fff;
            padding:25px;
            border-radius:12px;
            box-shadow:0 10px 30px rgba(0,0,0,0.1);
          ">       
          <form action="{{ route('smm.submit') }}" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Your Name" required>
        <input type="email" name="email" placeholder="Your Email" required>
        <button type="submit">
            Join the Program now
        </button>
    </form>
        </div>
  </div>
</div>


<div class="footer">
  © 2026 Kings Digital Literacy Hub. All rights reserved.
</div>

<script>
function redirect(){
  window.location.href="http://www.kingsdigihub.org/paysmmblueprint";
}
</script>

</body>
</html>
