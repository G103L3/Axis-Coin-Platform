<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Drip Coin </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
    <!-- Custom Stylesheet -->


    <link rel="stylesheet" href="./vendor/owlcarousel/css/owl.carousel.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <script src="js/set_theme.js"></script>

</head>

<body>

    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>

    <div id="main-wrapper pt-0">

        <div class="header landing_page">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12 position-relative">
                        <nav class="navbar navbar-expand-lg navbar-light px-0">
                            <a class="navbar-brand" href="index.php"><img src="./images/logo.png" alt="">
                                <span>Drip Coin </span></a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#" data-scroll-nav="0">Home</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#" data-scroll-nav="1">Market</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#" data-scroll-nav="2">Portfolio</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#" data-scroll-nav="3">Testimonial</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#" data-scroll-nav="4">Contact</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="dashboard_log">
                                <div class="d-flex align-items-center">
                                    <div class="header_auth">
                                        <a href="signin.php" class="btn btn-primary">Sign In</a>
                                        <a href="signup.php" class="btn btn-outline-primary">Sign Up</a>
                                    </div>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="intro section-padding position-relative" id="intro" data-scroll-index="0">
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <div class="col-xl-7 col-md-6">
                        <div class="intro-content">
                            <h2>Buy and sell <br>Drip Coin ocurrency</h2>
                            <p>Fast and secure way to purchase or exchange 150+ Drip Coin ocurrencies</p>
                            <div class="mt-4">
                                <a href="#" class="btn my-1 waves-effect">
                                    <img src="./images/android.svg" alt="">
                                </a>
                                <a href="#" class="btn my-1 waves-effect">
                                    <img src="./images/apple.svg" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5 col-md-6 py-md-5">
                        <div class="card">
                            <div class="card-body">
                                <div class="buy-sell-widget px-2">
                                    <form method="post" name="myform" class="currency_validate">
                                        <div class="mb-3">
                                            <label class="me-sm-2">Currency</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <label class="input-group-text"><i class="cc BTC-alt"></i></label>
                                                </div>
                                                <select name='currency' class="form-control">
                                                    <option value="">Select</option>
                                                    <option value="bitcoin">Bitcoin</option>
                                                    <option value="litecoin">Litecoin</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="me-sm-2">Payment Method</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <label class="input-group-text"><i class="fa fa-bank"></i></label>
                                                </div>
                                                <select class="form-control" name="method">
                                                    <option value="">Select</option>
                                                    <option value="bank">Bank of America ********45845</option>
                                                    <option value="master">Master Card ***********5458</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="me-sm-2">Enter your amount</label>
                                            <div class="input-group">
                                                <input type="text" name="currency_amount" class="form-control"
                                                    placeholder="0.0214 BTC">
                                                <input type="text" name="usd_amount" class="form-control"
                                                    placeholder="125.00 USD">
                                            </div>
                                            <div class="d-flex justify-content-between mt-3">
                                                <p class="mb-0">Monthly Limit</p>
                                                <h6 class="mb-0">$49750 remaining</h6>
                                            </div>
                                        </div>
                                        <button type="submit" name="submit" class="btn btn-success w-100">Exchange
                                            Now</button>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="market section-padding page-section" data-scroll-index="1">
            <div class="container">
                <div class="row py-lg-5 justify-content-center">
                    <div class="col-xl-7">
                        <div class="section_heading">
                            <span>Explore</span>
                            <h3>The World's Leading Drip Coin ocurrency Exchange</h3>
                            <p>Trade Bitcoin, ETH, and hundreds of other Drip Coin ocurrencies in minutes.</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="market-table">
                                    <div class="table-responsive">
                                        <table class="table mb-0 table-responsive-sm">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Price</th>
                                                    <th>Change</th>
                                                    <th>Chart</th>
                                                    <th>Trade</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</span>
                                                    </td>
                                                    <td class="coin_icon">
                                                        <i class="cc BTC"></i>
                                                        <span>Bitcoin <b>BTC</b></span>
                                                    </td>

                                                    <td>
                                                        USD 680,175.06
                                                    </td>
                                                    <td>
                                                        <span class="text-success">+1.13%</span>
                                                    </td>
                                                    <td> <span class="sparkline8"></span></td>
                                                    <td><a href="#" class="btn btn-success">Buy</a></td>
                                                </tr>
                                                <tr>
                                                    <td>2</span>
                                                    </td>
                                                    <td class="coin_icon">
                                                        <i class="cc ETH"></i>
                                                        <span>Ethereum <b>ETH</b></span>
                                                    </td>

                                                    <td>
                                                        USD 680,175.06
                                                    </td>
                                                    <td>
                                                        <span class="text-success">+1.13%</span>
                                                    </td>
                                                    <td> <span class="sparkline8"></span></td>
                                                    <td><a href="#" class="btn btn-success">Buy</a></td>
                                                </tr>
                                                <tr>
                                                    <td>3</span>
                                                    </td>
                                                    <td class="coin_icon">
                                                        <i class="cc BCH-alt"></i>
                                                        <span>Bitcoin Cash <b>BCH</b></span>
                                                    </td>

                                                    <td>
                                                        USD 680,175.06
                                                    </td>
                                                    <td>
                                                        <span class="text-success">+1.13%</span>
                                                    </td>
                                                    <td> <span class="sparkline8"></span></td>
                                                    <td><a href="#" class="btn btn-success">Buy</a></td>
                                                </tr>
                                                <tr>
                                                    <td>4</span>
                                                    </td>
                                                    <td class="coin_icon">
                                                        <i class="cc LTC"></i>
                                                        <span>Litecoin <b>LTC</b></span>
                                                    </td>

                                                    <td>
                                                        USD 680,175.06
                                                    </td>
                                                    <td>
                                                        <span class="text-danger">-0.47%</span>
                                                    </td>
                                                    <td> <span class="sparkline8"></span></td>
                                                    <td><a href="#" class="btn btn-success">Buy</a></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="features section-padding">
            <div class="container">
                <div class="row py-lg-5 justify-content-center">
                    <div class="col-xl-7">
                        <div class="section_heading">
                            <span>Features</span>
                            <h3>The most trusted Drip Coin ocurrency platform</h3>
                            <p>Here are a few reasons why you should choose Coinbase</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="features-content">
                            <span><i class="fa fa-shield"></i></span>
                            <h4>Secure storage</h4>
                            <p>We store the vast majority of the digital assets in secure offline storage.</p>
                            <a href="#">Learn more <i class="la la-angle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="features-content">
                            <span><i class="fa fa-cubes"></i></span>
                            <h4>Protected by insurance</h4>
                            <p>Drip Coin ocurrency stored on our servers is covered by our insurance policy.</p>
                            <a href="#">Learn more <i class="la la-angle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="features-content">
                            <span><i class="fa fa-life-ring"></i></span>
                            <h4>Industry best practices</h4>
                            <p>Drip Coin supports a variety of the most popular digital currencies.</p>
                            <a href="#">Learn more <i class="la la-angle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="portfolio section-padding" data-scroll-index="2">
            <div class="container">
                <div class="row py-lg-5 justify-content-center">
                    <div class="col-xl-7">
                        <div class="section_heading">
                            <span>Join Us</span>
                            <h3>Create your Drip Coin ocurrency portfolio today</h3>
                            <p>Drip Coin has a variety of features that make it the best place to start trading</p>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center justify-content-center">
                    <div class="col-xl-7 col-md-6">
                        <div class="portfolio_img">
                            <img src="./images/portfolio.jpg" alt="" class="img-fluid">
                        </div>
                    </div>
                </div>
                <div class="row portfolio_list">
                    <div class="col-xl-6 col-md-6">
                        <div class="d-flex">
                            <span class="port-icon"> <i class="la la-chart-bar"></i></span>
                            <div class="flex-grow-1">
                                <h4>Manage your portfolio</h4>
                                <p>Buy and sell popular digital currencies, keep track of them in the one place.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-md-6">
                        <div class="d-flex">
                            <span class="port-icon"> <i class="la la-calendar-check"></i></span>
                            <div class="flex-grow-1">
                                <h4>Recurring buys</h4>
                                <p>Invest in Drip Coin ocurrency slowly over time by scheduling buys daily, weekly, or
                                    monthly.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-md-6">
                        <div class="d-flex">
                            <span class="port-icon"> <i class="la la-lock"></i></span>
                            <div class="flex-grow-1">
                                <h4>Vault protection</h4>
                                <p>For added security, store your funds in a vault with time delayed withdrawals.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-md-6">
                        <div class="d-flex">
                            <span class="port-icon"> <i class="la la-mobile"></i></span>
                            <div class="flex-grow-1">
                                <h4>Mobile apps</h4>
                                <p>Stay on top of the markets with the Drip Coin app for <a href="#">Android</a> or
                                    <a href="#">iOS</a>.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="testimonial section-padding" data-scroll-index="3">
            <div class="container">
                <div class="row py-lg-5 justify-content-center">
                    <div class="col-xl-7">
                        <div class="section_heading">
                            <span>What's Say</span>
                            <h3>Trusted by 2 million customers</h3>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-xl-8 col-md-11">
                        <div class="testimonial-content">
                            <div class="owl-carousel owl-theme">
                                <div class="row align-items-center no-gutters">
                                    <div class="col-xl-6 col-md-6">
                                        <div class="customer-img">
                                            <img class="img-fluid" src="./images/testimonial/1.jpg" alt="">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-6">
                                        <div class="customer-review px-4">
                                            <img class="img-fluid" src="./images/brand/2.webp" alt="">
                                            <p>Integrating Drip Coin services into Trezor Wallet's exchange has been a
                                                great success for all parties, especially the users.
                                            </p>
                                            <div class="customer-info">
                                                <h5>Mr John Doe</h5>
                                                <p>CEO, Example Company</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-center no-gutters">
                                    <div class="col-xl-6 col-md-6">
                                        <div class="customer-img">
                                            <img class="img-fluid" src="./images/testimonial/2.jpg" alt="">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-6">
                                        <div class="customer-review px-4">
                                            <img class="img-fluid" src="./images/brand/3.webp" alt="">
                                            <p>MEW is excited to bring Drip Coin ’s extensive range of Drip Coin o assets,
                                                competitive rates and seamless swap functionality</p>
                                            <div class="customer-info">
                                                <h5>Mr Abraham</h5>
                                                <p>CEO, Example Company</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="contact-form section-padding" data-scroll-index="4">
            <div class="container">
                <div class="row py-lg-5 justify-content-center">
                    <div class="col-xl-7">
                        <div class="section_heading">
                            <span>Ask Question</span>
                            <h3>Let us hear from you directly!</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-4 col-md-4 col-sm-4">
                        <div class="info-list">
                            <h4 class="mb-3">Address</h4>
                            <ul>
                                <li><i class="fa fa-map-marker"></i> California, USA</li>
                                <li><i class="fa fa-phone"></i> (+880) 1243 665566</li>
                                <li><i class="fa fa-envelope"></i> hello@example.com</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-8 col-md-8 col-sm-8">
                        <form method="post" name="myform" class="contact_validate">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="mb-3">
                                        <label for="contactName">
                                            Full name
                                        </label>
                                        <input type="text" class="form-control" id="contactName" placeholder="Full name"
                                            name="firstname">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="mb-3">
                                        <label for="contactEmail">
                                            Email
                                        </label>
                                        <input type="email" class="form-control" name="email"
                                            placeholder="hello@domain.com">

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-3">
                                        <textarea class="form-control p-3" name="message" rows="5"
                                            placeholder="Tell us what we can help you with!"></textarea>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary px-4">
                                Send message
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>



        <div class="footer landing">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-md-6">
                        <div class="footer-link text-left">
                            <a href="#" class="m_logo"><img src="./images/logo.png" alt=""></a>
                            <a href="about.html">About</a>
                            <a href="privacy-policy.html">Privacy Policy</a>
                            <a href="term-condition.html">Term & Service</a>
                        </div>
                    </div>
                    <div class="col-xl-6 col-md-6 text-lg-right text-center">
                        <div class="social">
                            <a href="#"><i class="fa fa-youtube-play"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-facebook"></i></a>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col-xl-12 text-center text-lg-right">
                        <div class="copy_right text-center text-lg-center">
                            Copyright ©
                            <script>
                                var CurrentYear = new Date().getFullYear()
                                document.write(CurrentYear)
                            </script> Quixlab. All Rights Reserved.
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </div>

    <div class="cookie_alert">

        <div class="alert alert-light fade show">
            <p>
                We use cookies to enhance your experience. By using Drip Coin , you agree to our <a href="#">Terms of
                    Use</a> and <a href="#">Privacy
                    Policy</a>
            </p>
            <button class="btn btn-success w-100" data-dismiss="alert">Accept</button>
        </div>
    </div>






    <script src="./vendor/jquery/jquery.min.js"></script>
    <script src="./vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


    <script src="./vendor/owlcarousel/js/owl.carousel.min.js"></script>
    <script src="./js/plugins/owl-carousel-init.js"></script>
    <script src="./vendor/scrollit/scrollIt.js"></script>
    <script src="./js/plugins/scrollit-init.js"></script>

    <!-- Chart sparkline plugin files -->
    <script src="./vendor/jquery-sparkline/jquery.sparkline.min.js"></script>
    <script src="./js/plugins/sparkline-init.js"></script>

    <script src="./vendor/validator/jquery.validate.js"></script>
    <script src="./vendor/validator/validator-init.js"></script>
    <script src="js/scripts.js"></script>




</body>

</html>