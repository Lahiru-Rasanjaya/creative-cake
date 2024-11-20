<?php
include "./include/header.php";
?>


<!-- Page Header Start -->
<div class="container-fluid page-header py-6 wow fadeIn" data-wow-delay="0.1s">
    <div class="container text-center pt-5 pb-3">
        <h1 class="display-4 text-white animated slideInDown mb-3">Contact Us</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a class="text-white" href="./index.php">Home</a></li>
                <li class="breadcrumb-item text-primary active" aria-current="page">Contact</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->

<?php
$message = isset($_GET['message']) ? urldecode($_GET['message']) : '';
$msgType = isset($_GET['type']) ? $_GET['type'] : '';
?>

<?php if ($message): ?>
    <div id="alertBox" class="alert 
                                <?php echo $msgType === 'success' ? 'alert-success' : 'alert-danger'; ?> 
                                alert-dismissible fade show" role="alert" style="position: relative; margin: -4rem 5rem 2rem 5rem;">
        <span><?php echo htmlspecialchars($message); ?></span>
        <!-- Bootstrap Close Button aligned to the right and vertically centered -->
        <p id="closeAlert" style="cursor: pointer; position: absolute; right: 10px; top: 50%; transform: translateY(-50%);">
            x
        </p>
    </div>
<?php endif; ?>

<!-- Contact Start -->
<div class="container-xxl py-6" id="contact" style="margin-top: -6rem;">
    <div class="container">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <p class="text-primary text-uppercase mb-2">// Contact Us</p>
            <h1 class="display-6 mb-4">If You Have Any Query, Please Contact Us</h1>
        </div>
        <div class="row g-0 justify-content-center" style="margin-top: -2rem;">
            <div class="col-lg-8 wow fadeInUp" data-wow-delay="0.1s">
                <p class="text-center mb-4">We'd love to help make your celebration sweeter! For custom cake orders or any questions about our delicious treats, please reach out through our contact form. Our team is here to bring your dessert dreams to life!</a>.</p>
                <form action="./backend/contact_process.php" method="POST">
                    <div class="row g-3">



                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="name" name="name" required placeholder="Your Name">
                                <label for="name">Your Name</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="contact_number" name="contact_number" required placeholder="Your contact number">
                                <label for="contact_number">Contact Number</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="subject" name="subject" required placeholder="Subject">
                                <label for="subject">Subject</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <textarea class="form-control" name="message" required placeholder="Leave a message here" id="message" style="height: 200px"></textarea>
                                <label for="message">Message</label>
                            </div>
                        </div>
                        <div class="col-12 text-center">
                            <button class="btn btn-primary rounded-pill py-3 px-5" type="submit" name="submit">Send Message</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->


<!-- Google Map Start -->
<div class="px-0 wow fadeInUp" data-wow-delay="0.1s">
    <iframe class="w-100 mb-n2" style="height: 450px;"
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63293.76060101959!2d80.3165803333291!3d7.480703540812434!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae3398ab06be8b9%3A0x1f90e4e71e885052!2sKurunegala!5e0!3m2!1sen!2slk!4v1731401764268!5m2!1sen!2slk"
        frameborder="0" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
</div>
<!-- Google Map End -->

<script>
    // Script to Handle Close Button and Hide Message 
    const alertBox = document.getElementById('alertBox');
    const closeAlert = document.getElementById('closeAlert');


    if (closeAlert) {
        closeAlert.addEventListener('click', function() {
            alertBox.style.display = 'none';
            // Prevent the message from reappearing after reload
            const url = new URL(window.location.href);
            url.searchParams.delete('message');
            url.searchParams.delete('type');
            window.history.replaceState(null, null, url);
        });
    }
</script>

<?php
include "./include/footer.php";
?>