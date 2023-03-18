<?php $this->load->view('user/includes/header_style') ?>
<?php $this->load->view('user/includes/navbar') ?>


<main>

    <section class="slider-area slider-area2">
        <div class="slider-active">

            <div class="single-slider slider-height2">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-8 col-lg-11 col-md-12">
                            <div class="hero__caption hero__caption2">
                                <h1 data-animation="bounceIn" data-delay="0.2s">Əlaqə</h1>

                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="<?php echo base_url("home") ?>">Ana səhifə</a></li>
                                        <li class="breadcrumb-item"><a href="#">Əlaqə</a></li>
                                    </ol>
                                </nav>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="contact-section">
        <div class="container">
            <div class="d-none d-sm-block mb-5 pb-4">


            </div>
            <div class="row">
                <div class="col-12">
                    <h2 class="contact-title">Əlaqə</h2>
                </div>
                <div class="col-lg-8">
                    <form class="form-contact contact_form" action="<?php echo base_url('contact_message_act') ?>"
                        method="post">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <input class="form-control" name="subject" id="subject" type="text"
                                        onfocus="this.placeholder = ''" onblur="this.placeholder = 'Mövzu'"
                                        placeholder="Mövzu">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <textarea class="form-control w-100" name="message" id="message" cols="30" rows="9"
                                        onfocus="this.placeholder = ''" onblur="this.placeholder = 'Mesaj yazın'"
                                        placeholder="Mesaj yazın"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input class="form-control valid" name="name" id="name" type="text"
                                        onfocus="this.placeholder = ''" onblur="this.placeholder = 'Adınızı daxil edin'"
                                        placeholder="Adınızı daxil edin">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input class="form-control valid" name="email" id="email" type="email"
                                        onfocus="this.placeholder = 'Email adressi daxil edin'"
                                        onblur="this.placeholder = 'Email adressi daxil edin'" placeholder="Email">
                                </div>
                            </div>

                        </div>
                        <div class="form-group mt-3">
                            <button type="submit" class="button button-contactForm boxed-btn">Göndər</button>
                        </div>
                    </form>
                </div>
                <div class="col-lg-3 offset-lg-1">
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-home"></i></span>
                        <div class="media-body">
                            <h3>Bakı, Azərbaycan</h3>
                            <p>AZ1065, Cəfər Cabbarlı 44
                                Caspian Plaza, korpus 3, mərtəbə 10,</p>
                        </div>
                    </div>
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-tablet"></i></span>
                        <div class="media-body">
                            <h3><a href="tel:+9940555283545">(+994 55) 528 35 45</a></h3>
                            <p>Səhər saat 9 axşam saat 6 arası</p>
                        </div>
                    </div>
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-email"></i></span>
                        <div class="media-body">
                            <h3><a href="https://preview.colorlib.com/cdn-cgi/l/email-protection" class="__cf_email__"
                                    data-cfemail="780b0d0808170a0c381b1714170a14111a561b1715">E-mail</a>
                            </h3>
                            <p>İstənilən vaxt sorğunuzu bizə göndərin!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>
<?php $this->load->view('user/includes/footer') ?>