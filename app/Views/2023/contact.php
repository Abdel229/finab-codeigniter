<?php echo view('2023/commons/doc_header');?>

        <div class="wrapper">
        <?php echo view('2023/commons/header');?>

            
            
           <!-- Image d'acceuil -->
            <div class="page-header" style="background-image:url(<?=base_url('/2023/img/00.jpg')?>);">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <h2>Contactez-nous ici!</h2>
                        </div>
                        <div class="col-12">
                            <a href="index.php">Accueil</a>
                            <a href="">Contact</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Fin -->
            <!-- Page Header End -->


            <!-- Contact Start -->
            <div class="contact wow fadeInUp">
                <div class="container">
                    <div class="section-header text-center">
                        <p>Laissez-nous un message</p>
                        <h2>Contactez-nous!</h2>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="contact-info">
                                <div class="contact-item">
                                    <i class="flaticon-address"></i>
                                    <div class="contact-text">
                                        <h2>Lieu</h2>
                                        <p>Cotonou/Porto-novo/Ouidah, Bénin</p>
                                    </div>
                                </div>
                                <div class="contact-item">
                                    <i class="flaticon-call"></i>
                                    <div class="contact-text">
                                        <h2>Teléphone</h2>
                                        <p>+229 91 43 63 63 / 55 06 18 18 </p>
                                    </div>
                                </div>
                                <div class="contact-item">
                                    <i class="flaticon-send-mail"></i>
                                    <div class="contact-text">
                                        <h2>Email</h2>
                                        <p>welcome@finab.bj</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                                <form method = "POST" class="contact-form" >
                                    <div class="control-group">
                                        <input type="text" class="name" id="name" placeholder="Votre Nom et Prénon" required="required" data-validation-required-message="SVP entrez votre Nom!" />
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div class="control-group">
                                        <input type="email" class="email" id="email" placeholder="Votre Email" required="required" data-validation-required-message="SVP entrez votre email!" />
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div class="control-group">
                                        <input type="text" class="subject" id="subject" placeholder="Objet" required="required" data-validation-required-message="SVP entrez un Objet!" />
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div class="control-group">
                                        <textarea class="message" id="message" placeholder="Message" required="required" data-validation-required-message="Laissez-nous un message!"></textarea>
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div>
                                        <button class="btn" type="submit" id="sendMessageButton">Envoyé</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Contact End -->
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
        
        <!-- Contact Javascript File -->


        <!-- Template Javascript -->
        <script src="js/main.js"></script>
    </body>
	<script src="https://smtpjs.com/v3/smtp.js">
    </script>
    <script>
		const form = document.querySelector(".contact-form");
		  form.addEventListener("submit", e => {
			e.preventDefault();
			let name = document.querySelector(".form-control").value;
			let email = document.querySelector(".email").value;
			let subject = document.querySelector(".subject").value;
			let message = document.querySelector(".message").value;
			document.querySelector(".contact-form").reset();
				sendEmail(name, email, subject, message);
			  })
		function sendEmail(name, email, subject, message){
    Email.send({
				Host : "smtp.elasticemail.com",
				Username : "welcome@finab.bj",
				Password : "DC52D4497A5FF6D6AA775C21B0FB896A2B7B",
				To : "welcome@finab.bj",
				From : "welcome@finab.bj",
				Subject : `${name}Just messaged you from the website form`,
				Body : `Name: ${name} <br> Email: ${email} <br> subject: ${subject} <br> message: ${message}`,

		}).then((success) => {
     
      alert("Message envoyé avec succès. Nous vous contacterons bientôt.");
    }).catch((error) => {
        
      alert("error sending message");
    })
  }
</script>
</html>
