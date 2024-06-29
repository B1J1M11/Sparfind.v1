<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link rel="stylesheet" href="styles/contactStyle.css">
</head>
<body>
    <?php include("menu.php"); ?>
    <section class="contact">
        <div class="content">
            <h2>Contactez-nous</h2>
            <p>Nous sommes là pour vous aider !</p>
            <p>Si vous avez des questions, des préoccupations ou demandez des informations, n'hésitez pas à nous contacter.</p>
            <p>Notre équipe d'assistance peut répondre à toutes vos questions.</p>
        </div>
        <div class="container">
            <div class="contactinfo">
                <div class="boite">
                    <div class="icon"></div>
                    <div class="texte">
                        <h3>Adresse</h3>
                        <p>684 Avenue du Club Hippique</p>
                    </div>
                </div>
                <div class="boite">
                    <div class="icon"></div>
                    <div class="texte">
                        <h3>Téléphone</h3>
                        <p>07-88-23-45-33</p>
                    </div>
                    <div class="boite">
                        <div class="icon"></div>
                        <div class="texte">
                            <h3>Email</h3>
                            <p>contact@sparfind.com</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="contactform">
                <form action="mail/mailContact.php" method="POST">
                    <h2>Envoyer un message</h2>
                    <div class="inputboite">
                        <input type="text" name="name" required="required" pattern="[A-Za-z\s]+">
                        <span>Nom complet</span>
                    </div>
                    <div class="inputboite">
                        <input type="email" name="email" required="required">
                        <span>Email</span>
                    </div>
                    <div class="inputboite">
                        <textarea name="message" required="required" pattern="[A-Za-z\s]+"></textarea>
                        <span>Votre message </span>
                    </div>
                    <div class="inputboite">
                        <input type="submit" value="Envoyer">
                    </div>
                </form>
            </div>
        </div>
        <div class="wave-container">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                <path fill="#F97000" fill-opacity="1" d="M0,128L60,144C120,160,240,192,360,213.3C480,235,600,245,720,229.3C840,213,960,171,1080,154.7C1200,139,1320,149,1380,154.7L1440,160L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z"></path>
            </svg>
        </div>
        <div class="p">
            <p>Copyright &copy; 2024</p>
        </div>
    </section>
</body>
</html>
