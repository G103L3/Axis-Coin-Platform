<!DOCTYPE html>
<?php
include "client_conn_server_protocols\config_protocols\start.php";
?>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Drip Coin</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap Icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css" />
        <!-- SimpleLightbox plugin CSS-->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->

        <link href="./css/landing/landing_style.css" rel="stylesheet" />
        <link rel="stylesheet" href="./css/style.css">

    </head>
    <body id="page-top">

    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>

        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="#page-top">Drip Coin</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto my-2 my-lg-0">
                        <li class="nav-item"><a class="nav-link" href="#about-small">Cosa facciamo</a></li>
                        <li class="nav-item"><a class="nav-link" href="#founders">Founders</a></li>
                        <li class="nav-item"><a class="nav-link" href="#contact">Iscriviti</a></li>
                        <li class="nav-item btn btn-primary" style="padding-left: 0px"><a class="nav-link text-white" style="margin-left: 0px" href="signin.php">
                        <?php
                        if(check_session($conn)){
                          echo $_SESSION['name'];
                        }else{
                          echo "Accedi";
                        }
                        ?>
                      </a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Masthead-->
        <header class="masthead">
            <div class="container px-4 px-lg-5 h-100">
                <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
                    <div class="col-lg-8 align-self-end">
                        <h1 class="text-white font-weight-bold">La giusta community per il tuo Business</h1>
                        <hr class="divider" />
                    </div>
                    <div class="col-lg-8 align-self-baseline">
                        <p class="text-white-75 mb-5">Drip Coin è una grande famiglia, che ti permette di raggiungere l'indipendenza economica sfruttando le potenzialità dell’online in multi-business, formandoti a 360° grazie ai tantissimi corsi e servizi offerti dalla community!</p>
                        <a class="btn btn-primary" href="#about-small">Scropri di più</a>
                    </div>
                </div>
            </div>
        </header>
        <!-- Services-->
        <section class="page-section bg-primary" id="about-small">
            <div class="container px-4 px-lg-5">
                <h2 class="text-center mt-0 text-white-75">Ti spieghiamo in breve cosa facciamo!</h2>
                <hr class="divider" />
                <div class="row gx-4 gx-lg-5">
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="mt-5">
                            <div class="mb-2"><i class="bi-gem fs-1 text-white-75"></i></div>
                            <h3 class="h4 mb-2 text-white-75">Benessere economico-sociale</h3>
                            <p class="text-muted mb-0 text-white-75">Grazie alla nostra community ed ai nostri sistemi collaudati Axis, raggiungerai la sicurezza interiore che serve per avere la sicurezza economica!</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="mt-5">
                            <div class="mb-2"><i class="bi-book fs-1 text-white-75"></i></div>
                            <h3 class="h4 mb-2 text-white-75">Accademia</h3>
                            <p class="text-muted mb-0 text-white-75">Il nostro obbiettivo è formare i nostri membri, con contenuti di altissimo livello proprietari!</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="mt-5">
                            <div class="mb-2"><i class="bi-currency-dollar fs-1 text-white-75"></i></div>
                            <h3 class="h4 mb-2 text-white-75">Guadagni</h3>
                            <p class="text-muted mb-0 text-white-75">La nostra community ti permette di guadagnare dall'affiliazione, dai contenuti formativi che crei e dai progetti che gestisci!</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="mt-5">
                            <div class="mb-2"><i class="bi-heart fs-1 text-white-75"></i></div>
                            <h3 class="h4 mb-2 text-white-75">Una grande famiglia</h3>
                            <p class="text-muted mb-0 text-white-75">La nostra community è pronta ad accoglierti e condividere con te i segreti del successo!</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- founders-->
        <div id="founders">
            <div class="container-fluid p-0">
                <div class="row g-0">
                  <div class="col-lg-4 col-sm-6">
                      <a class="founders-box" href="images/landing/founders/fullsize/1.jpg" title="Project Name">
                          <img class="img-fluid" src="images/landing/founders/thumbnails/1.jpg" alt="..." />
                          <div class="founders-box-caption">
                              <div class="project-category text-white-50">Mattia Musumeci</div>
                              <div class="project-name">Da scrivere</div>
                          </div>
                      </a>
                  </div>
                  <div class="col-lg-4 col-sm-6">
                      <a class="founders-box" href="images/landing/founders/fullsize/2.jpg" title="Project Name">
                          <img class="img-fluid" src="images/landing/founders/thumbnails/2.jpg" alt="..." />
                          <div class="founders-box-caption">
                              <div class="project-category text-white-50">Gioele Giunta</div>
                              <div class="project-name">Da scrivere</div>
                          </div>
                      </a>
                  </div>
                  <div class="col-lg-4 col-sm-6">
                      <a class="founders-box" href="images/landing/founders/fullsize/3.jpg" title="Project Name">
                          <img class="img-fluid" src="images/landing/founders/thumbnails/3.jpg" alt="..." />
                          <div class="founders-box-caption">
                              <div class="project-category text-white-50">Alessio Carlo Cirolli</div>
                              <div class="project-name">Da scrivere</div>
                          </div>
                      </a>
                  </div>
                </div>
            </div>
        </div>
        <!-- Call to action-->
        <section class="page-section bg-dark text-white">
            <div class="container px-4 px-lg-5 text-center">
                <h2 class="mb-4">La nostra rete</h2>
                <a class="btn btn-light btn-xl" href="https://startbootstrap.com/theme/creative/">Download Now!</a>
            </div>
        </section>
        <!-- Contact-->
        <section class="page-section" id="contact">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-lg-8 col-xl-6 text-center">
                        <h2 class="mt-0">Restiamo in contatto!</h2>
                        <hr class="divider" />
                        <p class="text-muted mb-5">Pronto per cominciare il prossimo progetto con noi? Lascia i tuoi dati e ti ricercheremo a breve!</p>
                    </div>
                </div>
                <div class="row gx-4 gx-lg-5 justify-content-center mb-5">
                    <div class="col-lg-6">
                        <!-- * * * * * * * * * * * * * * *-->
                        <!-- * * SB Forms Contact Form * *-->
                        <!-- * * * * * * * * * * * * * * *-->
                        <!-- This form is pre-integrated with SB Forms.-->
                        <!-- To make this form functional, sign up at-->
                        <!-- https://startbootstrap.com/solution/contact-forms-->
                        <!-- to get an API token!-->
                        <form id="contactForm" data-sb-form-api-token="API_TOKEN">
                            <!-- Name input-->
                            <div class="form-floating mb-3">
                                <input class="form-control" id="name" type="text" placeholder="Enter your name..." data-sb-validations="required" />
                                <label for="name">Nome completo</label>
                                <div class="invalid-feedback" data-sb-feedback="name:required">E' richiesto un nome</div>
                            </div>
                            <!-- Email address input-->
                            <div class="form-floating mb-3">
                                <input class="form-control" id="email" type="email" placeholder="name@example.com" data-sb-validations="required,email" />
                                <label for="email">Email</label>
                                <div class="invalid-feedback" data-sb-feedback="email:required">E' richiesta una email</div>
                                <div class="invalid-feedback" data-sb-feedback="email:email">Email non valida</div>
                            </div>
                            <!-- Phone number input-->
                            <div class="form-floating mb-3">
                                <input class="form-control" id="phone" type="tel" placeholder="(123) 456-7890" data-sb-validations="required" />
                                <label for="phone">Numero di telefono</label>
                                <div class="invalid-feedback" data-sb-feedback="phone:required">E' richiesto un numero di telefono</div>
                            </div>
                            <!-- Message input-->
                            <div class="form-floating mb-3">
                                <textarea class="form-control" id="message" type="text" placeholder="Enter your message here..." style="height: 10rem" data-sb-validations="required"></textarea>
                                <label for="message">Messaggio</label>
                                <div class="invalid-feedback" data-sb-feedback="message:required">E' richiesto un messaggio</div>
                            </div>
                            <!-- Submit success message-->
                            <!---->
                            <!-- This is what your users will see when the form-->
                            <!-- has successfully submitted-->
                            <div class="d-none" id="submitSuccessMessage">
                                <div class="text-center mb-3">
                                    <div class="fw-bolder">Grazie della tua candidatura!</div>
                                    <br />
                                </div>
                            </div>
                            <!-- Submit error message-->
                            <!---->
                            <!-- This is what your users will see when there is-->
                            <!-- an error submitting the form-->
                            <div class="d-none" id="submitErrorMessage"><div class="text-center text-danger mb-3">Errore</div></div>
                            <!-- Submit Button-->
                            <div class="d-grid"><button onclick="submit_request()" class="btn btn-primary btn-xl disabled" id="submitButton" type="submit">Invia!</button></div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <script src="no-logged/js/request_form.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script>
        function submit_request(){
          var name = $("#name").val();
          var email = $("#email").val();
          var phone = $("#phone").val();
          var message = $("#message").val();

          $.post(
            '/no-logged/scripts/send_request.php',   // url
               { name: name, email: email, phone: phone, message: message}, // data to be submit
               function(data) {// success callback
                 if(data[0][0] == "Success"){
                   document.getElementById("submitSuccessMessage").style.display = "block";
                 }
                 if(data[0][0] == "Fail"){
                   document.getElementById("submitErrorMessage").style.display = "block";
                 }



                },
              'json')
        }

        </script>
        <!-- Footer-->
        <footer class="bg-light py-5">
            <div class="container px-4 px-lg-5"><div class="small text-center text-muted">Copyright &copy; 2022 - Company Name</div></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- SimpleLightbox plugin JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>
        <!-- Core theme JS-->
    <script src="js/landing/scripts.js"></script>

    <script src="./vendor/jquery/jquery.min.js"></script>
    <script src="./vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


    <script src="./vendor/validator/jquery.validate.js"></script>
    <script src="./vendor/validator/validator-init.js"></script>

    <script src="js/scripts.js"></script>

    </body>
</html>
