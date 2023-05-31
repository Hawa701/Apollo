<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Style/Header.css">
    <link rel="stylesheet" href="./Style/index.css">
    <title>Apollo</title>
</head>

<body>
    <?php
    include('header.php');
    ?>

    <section class="hero container">
        <div class="callToAction">
            <div class="callToActionText">
                <h1>Best Place <br> to <span>Find & Hire <br> Top Freelancers!</span></h1>
                <p>Find greate talent on Apollo. Build your business. <br> Take your carear to the next level.</p>
            </div>
            <div class="callToActionButton">
                <button class="getHired" id="getHired">Get Hired</button>
                <button class="hire" id="hire">Hire Top Talent</button>
            </div>
        </div>
        <div class="heroImage">

            <img src="./image/blob.png" alt="" class="blob">
            <img src="./image/hero-image.png" alt="" class="apolloImage">

        </div>
    </section>
    <section class="testimonial container">
        <h2 class="testTitle">Here's What Others Think of Us</h2>
        <div class="testimonialCards">
            <div class="card">
                <div class="cardContent">
                    <p class="tetText"><q>I've been using Apollo for the past year to find freelance gigs, and it's been a game-changer for my career. The platform is easy to use and has a wide variety of job opportunities available. I highly recommend it!</q> </p>
                    <div class="testProfile">
                        <div class="headShot"><img src="./image/headShot/sara.jpg" alt=""></div>
                        <div class="testName">
                            <h3 class="name">Sarah</h3>
                            <p class="title">Freelance Writer</p>
                        </div>


                    </div>
                </div>
            </div>
            <div class="card">
                <div class="cardContent">
                    <p class="tetText"><q>Apollo has helped me connect with clients from all over the world, and I've been able to build a successful freelance business because of it. The platform is user-friendly, and the support team is always available to answer any questions I have.</q></p>
                    <div class="testProfile">
                        <div class="headShot"><img src="./image/headShot/john.jpg" alt=""></div>
                        <div class="testName">
                            <h3 class="name">John</h3>
                            <p class="title">Graphic Designe</p>
                        </div>


                    </div>
                </div>
            </div>
            <div class="card">
                <div class="cardContent">
                    <p class="tetText"><q>I love using Apollo to find freelance jobs because it saves me time and hassle. I no longer have to scour the internet for opportunities or worry about getting paid on time. The platform takes care of all of that for me, so I can focus on doing what I love.</q></p>
                    <div class="testProfile">
                        <div class="headShot"><img src="./image/headShot/emily.jpg" alt=""></div>
                        <div class="testName">
                            <h3 class="name">Emily</h3>
                            <p class="title">Social Media Manager</p>
                        </div>


                    </div>
                </div>
            </div>
            <div class="card">
                <div class="cardContent">
                    <p class="tetText"><q>As a freelancer, it can be challenging to find consistent work. But since I started using Apollo, I've been able to find new clients regularly and build my reputation in the industry. The platform is reliable, and I appreciate the transparency in the job listings.</q></p>
                    <div class="testProfile">
                        <div class="headShot"><img src="./image/headShot/michael.jpg" alt=""></div>
                        <div class="testName">
                            <h3 class="name">Michael</h3>
                            <p class="title">Web Developer</p>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="app">
        <div class="getApp">
            <div class="getAppContainer">
                <div class="appContent">
                    <h2 class="getAppTitle">Get things done <br> with Apollo</h2>
                    <h4>Download the Apollo app and never miss out <br> on new updates, job posts, important <br> messages, and more.</h4>
                    <button class="getAppBtn">Download Now</button>
                </div>

                <div class="getAppImage">
                    <img src="./image/getApp.png" alt="">
                </div>
            </div>

        </div>
    </section>

</body>
<script>
    var navbar = document.getElementById('header');
    window.onscroll = function() {
        console.log("scrolled")
        if (window.screenY > 2) {
            console.log("scrolled123")
            navbar.classList.remove('navShadow')
        } else {
            console.log("scrolled1234")
            navbar.classList.add('navShadow')

        }
    }
</script>

</html>