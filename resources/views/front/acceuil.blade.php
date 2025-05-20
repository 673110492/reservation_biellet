@extends('front.layouts.app')
@section('content')
    <section class="ftco-section ftco-no-pt bg-light">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-md-12	featured-top">
                    <div class="row no-gutters">
                        <div class="col-md-4 d-flex align-items-center">
                            <form action="#" class="request-form ftco-animate bg-primary">
                                <h2>Make your trip</h2>
                                <div class="form-group">
                                    <label for="" class="label">Pick-up location</label>
                                    <input type="text" class="form-control" placeholder="City, Airport, Station, etc">
                                </div>
                                <div class="form-group">
                                    <label for="" class="label">Drop-off location</label>
                                    <input type="text" class="form-control" placeholder="City, Airport, Station, etc">
                                </div>
                                <div class="d-flex">
                                    <div class="form-group mr-2">
                                        <label for="" class="label">Pick-up date</label>
                                        <input type="text" class="form-control" id="book_pick_date" placeholder="Date">
                                    </div>
                                    <div class="form-group ml-2">
                                        <label for="" class="label">Drop-off date</label>
                                        <input type="text" class="form-control" id="book_off_date" placeholder="Date">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="label">Pick-up time</label>
                                    <input type="text" class="form-control" id="time_pick" placeholder="Time">
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="Rent A Car Now" class="btn btn-secondary py-3 px-4">
                                </div>
                            </form>
                        </div>
                        <div class="col-md-8 d-flex align-items-center">
                            <div class="services-wrap rounded-right w-100">
                                <h3 class="heading-section mb-4">Réservez vos billets de voyage facilement</h3>
                                <div class="row d-flex mb-4">
                                    <div class="col-md-4 d-flex align-self-stretch ftco-animate">
                                        <div class="services w-100 text-center">
                                            <div class="icon d-flex align-items-center justify-content-center">
                                                <span class="flaticon-route"></span>
                                            </div>
                                            <div class="text w-100">
                                                <h3 class="heading mb-2">Choisissez votre destination</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 d-flex align-self-stretch ftco-animate">
                                        <div class="services w-100 text-center">
                                            <div class="icon d-flex align-items-center justify-content-center">
                                                <span class="flaticon-handshake"></span>
                                            </div>
                                            <div class="text w-100">
                                                <h3 class="heading mb-2">Trouvez l’offre qui vous convient</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 d-flex align-self-stretch ftco-animate">
                                        <div class="services w-100 text-center">
                                            <div class="icon d-flex align-items-center justify-content-center">
                                                <span class="flaticon-rent"></span>
                                            </div>
                                            <div class="text w-100">
                                                <h3 class="heading mb-2">Réservez votre billet en ligne</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <p><a href="#" class="btn btn-primary py-3 px-4">Réserver un billet maintenant</a></p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
    </section>


    <section class="ftco-section ftco-no-pt bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 heading-section text-center ftco-animate mb-5">
                    <span class="subheading">What we offer</span>
                    <h2 class="mb-2">Featured Vehicles</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="carousel-car owl-carousel">

                        @foreach ($vehicules as $vehicule)
                            <div class="item">
                                <div class="car-wrap rounded ftco-animate">
                                    <div class="img rounded d-flex align-items-end"
                                        style="background-image: url('{{ $vehicule->image ? asset('storage/' . $vehicule->image) : asset('assets1/images/default-car.jpg') }}');">
                                    </div>
                                    <div class="text">
                                        <h2 class="mb-0">
                                            <a href="#">
                                                {{ ucfirst($vehicule->type) }} - {{ $vehicule->numero_immatriculation }}
                                            </a>
                                        </h2>
                                        <div class="d-flex mb-3">
                                            <span class="cat">
                                                {{ $vehicule->status == 'plein' ? 'Full' : 'Available' }}
                                            </span>
                                            <p class="price ml-auto">
                                                {{ $vehicule->nombre_places }} places
                                            </p>
                                        </div>
                                        <p class="d-flex mb-0 d-block">
                                            <a href="#" class="btn btn-primary py-2 mr-1">Book now</a>
                                            <a href="{{ route('vehicule.show', $vehicule->id) }}"
                                                class="btn btn-secondary py-2 ml-1">Details</a>

                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="ftco-section ftco-about">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-md-6 p-md-5 img img-2 d-flex justify-content-center align-items-center"
                    style="background-image: url(assets1/images/about.jpg);">
                </div>
                <div class="col-md-6 wrap-about ftco-animate">
                    <div class="heading-section heading-section-white pl-md-5">
                        <span class="subheading">About us</span>
                        <h2 class="mb-4">Welcome to Carbook</h2>

                        <p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It
                            is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>
                        <p>On her way she met a copy. The copy warned the Little Blind Text, that where it came from it
                            would have been rewritten a thousand times and everything that was left from its origin would be
                            the word "and" and the Little Blind Text should turn around and return to its own, safe country.
                            A small river named Duden flows by their place and supplies it with the necessary regelialia. It
                            is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>
                        <p><a href="#" class="btn btn-primary py-3 px-4">Search Vehicle</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-7 text-center heading-section ftco-animate">
                <span class="subheading">Services</span>
                <h2 class="mb-3">Nos Services de Transport</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="services services-2 w-100 text-center">
                    <div class="icon d-flex align-items-center justify-content-center">
                        <span class="flaticon-route"></span>
                    </div>
                    <div class="text w-100">
                        <h3 class="heading mb-2">Réservation en ligne</h3>
                        <p>Réservez vos billets de bus en quelques clics, où que vous soyez.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="services services-2 w-100 text-center">
                    <div class="icon d-flex align-items-center justify-content-center">
                        <span class="flaticon-location"></span>
                    </div>
                    <div class="text w-100">
                        <h3 class="heading mb-2">Voyages interurbains</h3>
                        <p>Profitez d’un service rapide et sécurisé entre les grandes villes du pays.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="services services-2 w-100 text-center">
                    <div class="icon d-flex align-items-center justify-content-center">
                        <span class="flaticon-schedule"></span>
                    </div>
                    <div class="text w-100">
                        <h3 class="heading mb-2">Horaires flexibles</h3>
                        <p>Choisissez les départs qui correspondent à votre emploi du temps.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="services services-2 w-100 text-center">
                    <div class="icon d-flex align-items-center justify-content-center">
                        <span class="flaticon-customer-service"></span>
                    </div>
                    <div class="text w-100">
                        <h3 class="heading mb-2">Assistance 24h/24</h3>
                        <p>Une équipe à votre écoute pour répondre à toutes vos questions.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


   <section class="ftco-section ftco-intro" style="background-image: url(assets1/images/bg_3.jpg);">
    <div class="overlay"></div>
    <div class="container">
        <div class="row justify-content-end">
            <div class="col-md-6 heading-section heading-section-white ftco-animate">
                <h2 class="mb-3">Envie de collaborer avec nous ? Rejoignez notre réseau.</h2>
                <a href="#" class="btn btn-primary btn-lg">Devenir partenaire</a>
            </div>
        </div>
    </div>
</section>



   <section class="ftco-section testimony-section bg-light">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-7 text-center heading-section ftco-animate">
                <span class="subheading">Témoignages</span>
                <h2 class="mb-3">Ce que disent nos voyageurs</h2>
            </div>
        </div>
        <div class="row ftco-animate">
            <div class="col-md-12">
                <div class="carousel-testimony owl-carousel ftco-owl">
                    <div class="item">
                        <div class="testimony-wrap rounded text-center py-4 pb-5">
                            <div class="user-img mb-2" style="background-image: url(assets1/images/person_1.jpg)">
                            </div>
                            <div class="text pt-4">
                                <p class="mb-4">J’ai réservé mon billet en ligne en moins de 5 minutes. Très pratique et fiable !</p>
                                <p class="name">Aminata Diallo</p>
                                <span class="position">Cliente satisfaite</span>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="testimony-wrap rounded text-center py-4 pb-5">
                            <div class="user-img mb-2" style="background-image: url(assets1/images/person_2.jpg)">
                            </div>
                            <div class="text pt-4">
                                <p class="mb-4">Un service client très réactif. Mon voyage s’est déroulé sans stress !</p>
                                <p class="name">Jean-Pierre Mbang</p>
                                <span class="position">Voyageur régulier</span>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="testimony-wrap rounded text-center py-4 pb-5">
                            <div class="user-img mb-2" style="background-image: url(assets1/images/person_3.jpg)">
                            </div>
                            <div class="text pt-4">
                                <p class="mb-4">J’ai pu choisir mon siège à l’avance. Le site est vraiment bien fait !</p>
                                <p class="name">Sarah Ndongo</p>
                                <span class="position">Étudiante</span>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="testimony-wrap rounded text-center py-4 pb-5">
                            <div class="user-img mb-2" style="background-image: url(assets1/images/person_1.jpg)">
                            </div>
                            <div class="text pt-4">
                                <p class="mb-4">Facile, rapide et efficace. Je recommande cette plateforme à tous !</p>
                                <p class="name">Mohamed Koné</p>
                                <span class="position">Homme d'affaires</span>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="testimony-wrap rounded text-center py-4 pb-5">
                            <div class="user-img mb-2" style="background-image: url(assets1/images/person_2.jpg)">
                            </div>
                            <div class="text pt-4">
                                <p class="mb-4">Même en dernière minute, j’ai trouvé une place disponible. Super pratique !</p>
                                <p class="name">Clarisse Abena</p>
                                <span class="position">Voyageuse occasionnelle</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


  <section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-7 heading-section text-center ftco-animate">
                <span class="subheading">Blog</span>
                <h2>Nos Derniers Articles</h2>
            </div>
        </div>
        <div class="row d-flex">
            <div class="col-md-4 d-flex ftco-animate">
                <div class="blog-entry justify-content-end">
                    <a href="#" class="block-20" style="background-image: url('assets1/images/bus1.jpeg');">
                    </a>
                    <div class="text pt-4">
                        <div class="meta mb-3">
                            <div><a href="#">20 Mai 2025</a></div>
                            <div><a href="#">Le Pivot</a></div>
                            <div><a href="#" class="meta-chat"><span class="icon-chat"></span> 5</a></div>
                        </div>
                        <h3 class="heading mt-2"><a href="#">Comment booster votre carrière avec les formations digitales</a></h3>
                        <p><a href="#" class="btn btn-primary">Lire la suite</a></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 d-flex ftco-animate">
                <div class="blog-entry justify-content-end">
                    <a href="#" class="block-20" style="background-image: url('assets1/images/bus2.jpeg');">
                    </a>
                    <div class="text pt-4">
                        <div class="meta mb-3">
                            <div><a href="#">18 Mai 2025</a></div>
                            <div><a href="#">Le Pivot</a></div>
                            <div><a href="#" class="meta-chat"><span class="icon-chat"></span> 2</a></div>
                        </div>
                        <h3 class="heading mt-2"><a href="#">Les secrets d’un apprentissage en ligne efficace</a></h3>
                        <p><a href="#" class="btn btn-primary">Lire la suite</a></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 d-flex ftco-animate">
                <div class="blog-entry">
                    <a href="#" class="block-20" style="background-image: url('assets1/images/bus3.jpeg');">
                    </a>
                    <div class="text pt-4">
                        <div class="meta mb-3">
                            <div><a href="#">15 Mai 2025</a></div>
                            <div><a href="#">Le Pivot</a></div>
                            <div><a href="#" class="meta-chat"><span class="icon-chat"></span> 4</a></div>
                        </div>
                        <h3 class="heading mt-2"><a href="#">L’impact des compétences numériques sur l’employabilité</a></h3>
                        <p><a href="#" class="btn btn-primary">Lire la suite</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


    <section class="ftco-counter ftco-section img bg-light" id="section-counter">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
                    <div class="block-18">
                        <div class="text text-border d-flex align-items-center">
                            <strong class="number" data-number="60">0</strong>
                            <span>Year <br>Experienced</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
                    <div class="block-18">
                        <div class="text text-border d-flex align-items-center">
                            <strong class="number" data-number="1090">0</strong>
                            <span>Total <br>Cars</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
                    <div class="block-18">
                        <div class="text text-border d-flex align-items-center">
                            <strong class="number" data-number="2590">0</strong>
                            <span>Happy <br>Customers</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
                    <div class="block-18">
                        <div class="text d-flex align-items-center">
                            <strong class="number" data-number="67">0</strong>
                            <span>Total <br>Branches</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
