<?php echo view('2023/commons/doc_header');?>

        <div class="wrapper">
        <?php echo view('2023/commons/header');?>

            
            
            <!-- Page Header Start -->
            <div class="page-header" style="background-image:url(<?=base_url('2023/img/cont2.jpg')?>);">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <h2>Médiathèque</h2>
                        </div>
                        <div class="col-12">
                            <a href="index.php">Accueil</a>
                            <a href="">Nos prospectus</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page Header End -->


            <!-- Portfolio Start -->
            <div class="portfolio">
                <div class="container">
                    <div class="section-header text-center">
                        <p>Nos projets</p>
                        <h2>Visitez nos prospectus</h2>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <ul id="portfolio-flters">
                                <li data-filter="*" class="filter-active">Tous</li>
                                <li data-filter=".first">Opportunité</li>
                                <li data-filter=".second">En cour</li>
                                <li data-filter=".third">Appel à candidature</li>
                            </ul>
                        </div>
                    </div>
                    <div class="row portfolio-container">
                        <div class="col-lg-4 col-md-6 col-sm-12 portfolio-item first wow fadeInUp" data-wow-delay="0.1s">
                            <div class="portfolio-warp">
                                <div class="portfolio-img">
                                    <img src="<?= base_url('2023/img/d.png')?>" alt="Image">
                                    <div class="portfolio-overlay">
                                        <p>
                                          
                                        </p>
                                    </div>
                                </div>
                                <div class="portfolio-text">
                                    <h3>FInAB</h3>
                                    <a class="btn" href="<?=base_url('2023/img/d.png')?>" data-lightbox="portfolio">+</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 portfolio-item second wow fadeInUp" data-wow-delay="0.2s">
                            <div class="portfolio-warp">
                                <div class="portfolio-img">
                                    <img src="<?=base_url('2023/img/danse.png')?>" alt="Image">
                                    <div class="portfolio-overlay">
                                        <p>
                                            
                                        </p>
                                    </div>
                                </div>
                                <div class="portfolio-text">
                                    <h3>Danse</h3>
                                    <a class="btn" href="<?=base_url('2023/img/danse.png')?>" data-lightbox="portfolio">+</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 portfolio-item third wow fadeInUp" data-wow-delay="0.3s">
                            <div class="portfolio-warp">
                                <div class="portfolio-img">
                                    <img src="<?=base_url('2023/img/competition.png')?>" alt="Image">
                                    <div class="portfolio-overlay">
                                        <p>
                                            
                                        </p>
                                    </div>
                                </div>
                                <div class="portfolio-text">
                                    <h3>Art plastique</h3>
                                    <a class="btn" href="<?=base_url('2023/img/competition.png')?>" data-lightbox="portfolio">+</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 portfolio-item first wow fadeInUp" data-wow-delay="0.4s">
                            <div class="portfolio-warp">
                                <div class="portfolio-img">
                                    <img src="<?=base_url('2023/img/b.png')?>" alt="Image">
                                    <div class="portfolio-overlay">
                                        <p>
                                            
                                        </p>
                                    </div>
                                </div>
                                <div class="portfolio-text">
                                    <h3>Opportinuité</h3>
                                    <a class="btn" href="<?=base_url('2023/img/b.png')?>" data-lightbox="portfolio">+</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 portfolio-item second wow fadeInUp" data-wow-delay="0.5s">
                            <div class="portfolio-warp">
                                <div class="portfolio-img">
                                    <img src="<?=base_url('2023/img/a.png')?>" alt="Image">
                                    <div class="portfolio-overlay">
                                        <p>
                                           
                                        </p>
                                    </div>
                                </div>
                                <div class="portfolio-text">
                                    <h3>Appel à candidature</h3>
                                    <a class="btn" href="<?=base_url('2023/img/a.png')?>" data-lightbox="portfolio">+</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 portfolio-item third wow fadeInUp" data-wow-delay="0.6s">
                            <div class="portfolio-warp">
                                <div class="portfolio-img">
                                    <img src="<?=base_url('2023/img/musique.png')?>" alt="Image">
                                    <div class="portfolio-overlay">
                                        <p>
                                            
                                        </p>
                                    </div>
                                </div>
                                <div class="portfolio-text">
                                    <h3>Musique</h3>
                                    <a class="btn" href="<?=base_url('2023/img/musique.png')?>" data-lightbox="portfolio">+</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 load-more">
                            <a class="btn" href="#">Voir plus</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Portfolio End -->
<!-- Video Start -->
            <div class="video wow fadeIn" data-wow-delay="0.1s">
                <div class="container">
                    <button type="button" class="btn-play" data-toggle="modal" data-src="https://www.youtube.com/embed/DWRcNpR6Kdc" data-target="#videoModal">
                        <span></span>
                    </button>
                </div>
            </div>
            
            <div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>        
                            <!-- 16:9 aspect ratio -->
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item" src="" id="video"  allowscriptaccess="always" allow="autoplay"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Video End -->
 <!-- Fact Start -->
             <div class="fact">
                <div class="container-fluid">
                    <div class="row counters">
                        <div class="col-md-6 fact-left wow slideInLeft">
                            <div class="row">
                                <div class="col-6">
                                    <div class="fact-icon">
                                        <i class="flaticon-building"></i>
                                    </div>
                                    <div class="fact-text">
                                        <h2 data-toggle="counter-up">03</h2>
                                        <p>Villes Concernées</p>
                                    </div>
                                </div>
                                <div class="col-6">
                                     <div class="fact-icon">
                                        <i class="flaticon-address"></i>
                                    </div>
                                    <div class="fact-text">
                                        <h2 data-toggle="counter-up">01</h2>
                                        <p>COTONOU</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 fact-right wow slideInRight">
                            <div class="row">
                                <div class="col-6">
                                    <div class="fact-icon">
                                        <i class="flaticon-address"></i>
                                    </div>
                                    <div class="fact-text">
                                        <h2 data-toggle="counter-up">01</h2>
                                        <p>PORTO-NOVO</p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="fact-icon">
                                        <i class="flaticon-address"></i>
                                    </div>
                                    <div class="fact-text">
                                        <h2 data-toggle="counter-up">01</h2>
                                        <p>OUIDAH</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Fact End -->
            
             <!-- FAQs Start -->
            <div class="faqs">
                <div class="container">
                    <div class="section-header text-center">
                        <p>Informations sur le FInAB </p>
                        <h2>1ère Edition</h2>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div id="accordion-1">
                                <div class="card wow fadeInLeft" data-wow-delay="0.1s">
                                    <div class="card-header">
                                        <a class="card-link collapsed" data-toggle="collapse" href="#collapseOne">
                                            Lieu, Date et Heure
                                        </a>
                                    </div>
                                    <div id="collapseOne" class="collapse" data-parent="#accordion-1">
                                        <div class="card-body">
                                            Cotonou, Porto-Novo, Ouidah du 14 au 19 Février 2023
                                        </div>
                                    </div>
                                </div>
                                <div class="card wow fadeInLeft" data-wow-delay="0.2s">
                                    <div class="card-header">
                                        <a class="card-link collapsed" data-toggle="collapse" href="#collapseTwo">
                                            Participants
                                        </a>
                                    </div>
                                    <div id="collapseTwo" class="collapse" data-parent="#accordion-1">
                                        <div class="card-body">
                                           Tout public, Mélomanes, Acteurs culturels, Presse, Amateurs, Passionnées d'arts
                                        </div>
                                    </div>
                                </div>
                                <div class="card wow fadeInLeft" data-wow-delay="0.3s">
                                    <div class="card-header">
                                        <a class="card-link collapsed" data-toggle="collapse" href="#collapseThree">
                                            Intervenants
                                        </a>
                                    </div>
                                    <div id="collapseThree" class="collapse" data-parent="#accordion-1">
                                        <div class="card-body">
                                            Artistes, Acteurs culturels béninois et internationals, Écrivains, Danseurs
                                        </div>
                                    </div>
                                </div>
                                <div class="card wow fadeInLeft" data-wow-delay="0.4s">
                                    <div class="card-header">
                                        <a class="card-link collapsed" data-toggle="collapse" href="#collapseFour">
                                            Activités
                                        </a>
                                    </div>
                                    <div id="collapseFour" class="collapse" data-parent="#accordion-1">
                                        <div class="card-body">
                                            Concerts-Showcases- Masterclass- Marchés TOKP'ART - Conférences - Carnaval - Tourisme - Speed Meeting - Expositions - Projections
                                        </div>
                                    </div>
                                </div>
                                <div class="card wow fadeInLeft" data-wow-delay="0.5s">
                                    <div class="card-header">
                                        <a class="card-link collapsed" data-toggle="collapse" href="#collapseFive">
                                            Tâches de l'agence
                                        </a>
                                    </div>
                                    <div id="collapseFive" class="collapse" data-parent="#accordion-1">
                                        <div class="card-body">
                                          <p> <b> - Conception, réalisation et production du Festival </b></p>
                                           <p><b> - Diffusion du Festival</b></p>
                                           <p><b> - Communication</b></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="card wow fadeInRight" data-wow-delay="0.1s">
                                    <div class="card-header">
                                        <a class="card-link collapsed" data-toggle="collapse" href="#collapseSix">
                                             Les Innovations
                                        </a>
                                    </div>
                                    <div id="collapseSix" class="collapse" data-parent="#accordion-2">
                                        <div class="card-body">
                                           <p>Un grand marché TOKP'ART qui s'animera durant le festival</p>
                                            <p>Un spectacle déambulatoire qui mettra en évidence les danses de nos traditions, une troupe de cirque, des prestations artistiques</p>
                                            <p>Un défilé de Mode</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                       

                        <div class="col-lg-5 col-md-1">
                            <div id="accordion-2">
                                <div class="col-md-6 fact-right wow slideInRight">
                            <div class="col-md-3">
                                <img src="<?=base_url('2023/img/obj.jpg')?>" width="300" alt="Image">
                            </div>
                        </div>
                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- FAQs End -->
		  <!-- bouttons flottants
                        <div class="slideInLeft">
                        <button class="floating-btn">
                            <a href="https://www.facebook.com/"><img src="img/fa.png"></a>
                        </button>
                        <button class="floating-btn3">
                           <a href="https://instagram.com"><img src="img/inst1.png"></a> 
                        </button>
                        <button class="floating-btn1">
                           <a href="https://chat.whatsapp.com"><img src="img/you1.png"></a> 
                        </button>
                        <button class="floating-btn4">
                           <a href="https://twitter.com"><img src="img/twitter.png"></a> 
                        </button>
                        <button class="floating-btn2">
                           <a href="https://fr.linkedin.com"><img src="img/lin.png"></a> 
                        </button>
                    </div>
                <div>
           Footer Start -->
            <div class="footer wow fadeIn" data-wow-delay="0.3s">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-lg-3">
                            <div class="footer-contact">
                                <h2>Office Contact</h2>
                                <p><i class="fa fa-map-marker-alt"></i>C/7004, Haie Vive, Cotonou</p>
                                <p><i class="fa fa-phone-alt"></i>+229 91 43 63 63 / 55 06 18 18 </p>
                                <p><i class="fa fa-envelope"></i>welcome@finab.bj</p>
                                <div class="footer-social">
                                   <a href="https://www.facebook.com/finabbj"><i class="fab fa-facebook-f"></i></a>
									<a href="https://www.instagram.com/finab.bj/"><i class="fab fa-instagram"></i></a>
									<a href="https://www.youtube.com/channel/UCFWi_KjtltyPxeiwZz7Wvkg"><i class="fab fa-youtube"></i></a>
                                    <a href="https://twitter.com/finabbj"><i class="fab fa-twitter"></i></a>
                                    <a href="https://www.linkedin.com/company/festival-international-des-arts-du-b%C3%A9nin/"><i class="fab fa-linkedin-in"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="footer-link">
                                 <div class="col-md-6 fact-left wow slideInLeft" data-wow-delay="0.5s">
                                        <div class="position-relative overflow-hidden ps-5 pt-5 h-100">
                                     <img class="position-absolute" src="<?=base_url('2023/img/logo/1.png')?>" alt="" style="object-fit: cover;">
                                    </div>
                                 </div>

                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="footer-link">
                                <h2> Pages</h2>
                                <a href="description.php">FInAB</a>
                                <a href="qui.php">Groupe Empire</a>
                                <a href="media.php">Actualité</a>
                                <a href="portfolio.php">Médiathèque</a>
                                <a href="contact.php">Contact</a>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="newsletter">
                                <h2>FInAB</h2>
                                <p>
									<div>Thème de l'édition 2023 :</div>
                                     << La diversité culturelle, un levier d'attraction et de rayonnance pour les pays du SUD >>
                                </p>
                                 <div class="form">
                                    <input class="form-control" placeholder="Email">
                                    <button class="btn">Soumettre</button>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
               
                <div class="container copyright">
                    <div class="row">
                        <div class="col-md-6">
                            <p>&copy; <a href="#">www.finab.bj</a>,Tous droit réservés.</p>
                        </div>
                        <div class="col-md-6">
                            <p>Designed By <a href="">MaCom BENIN/BCA CONSULT</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer End -->

            <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
        </div>

        <!-- JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
        <script src="lib/easing/easing.min.js"></script>
        <script src="lib/wow/wow.min.js"></script>
        <script src="lib/owlcarousel/owl.carousel.min.js"></script>
        <script src="lib/isotope/isotope.pkgd.min.js"></script>
        <script src="lib/lightbox/js/lightbox.min.js"></script>
        <script src="lib/waypoints/waypoints.min.js"></script>
        <script src="lib/counterup/counterup.min.js"></script>
        <script src="lib/slick/slick.min.js"></script>

        <!-- Template Javascript -->
        <script src="js/main.js"></script>
    </body>
</html>
