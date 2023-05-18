@extends('layouts.master')
@section('content')
    @include('layouts.nav')
    <div class="container-fluid pt-3">
        <div class="row border-dark border-bottom">
            <div class="col-md-10 offset-md-1 my-5">
                <h1 class="mb-5" style="font-size: 89px;">Every Idea needs a <strong>Inspire.</strong></h1>
            </div>
        </div>

        <div class="row border-bottom border-dark py-5">
            <div class="col-md-10 d-flex align-items-center">
                <div class="col-md-8 me-4 offset-md-1">
                    <p>
                        The best ideas can change who we are. Medium is where those ideas take shape, take off, and spark
                        powerful conversations. We're an open platform where over 100 million readers come to find
                        insightful and dynamic thinking. Here, expert and undiscovered voices alike dive into the heart of
                        any topic and bring new ideas to the surface. Our purpose is to spread these ideas and deepen
                        understanding of the world.
                    </p>
                    <p>
                        We're creating a new model for digital publishing. One that supports nuance, complexity, and vital
                        storytelling without giving in to the incentives of advertising. It's an environment that's open to
                        everyone but promotes substance and authenticity. And it's where deeper connections forged between
                        readers and writers can lead to discovery and growth. Together with millions of collaborators, we're
                        building a trusted and vibrant ecosystem fueled by important ideas and the people who think about
                        them.
                    </p>
                </div>
                <div class="col-md-4">
                    <img src="{{ url('images/ns3.jpg') }}" alt="" class="img-fluid">
                </div>
                <hr>
            </div>
        </div>


        <div class="row py-5 border-bottom border-dark" style="background-color: #ffceb7">
            <div class="col-md-8 offset-md-2 text-center">
                <div class="col-md-12">
                    <h1 style="font-size:90px;">A living network of curious minds.</h1>
                </div>
                <div class="col-md-10 offset-md-1">
                    <strong>
                        <p class="px-5">Anyone can write on Medium. Thought-leaders, journalists, experts, and individuals
                            with unique perspectives share their thinking here. You’ll find pieces by independent writers
                            from around the globe, stories we feature and leading authors, and smart takes on our own suite
                            of blogs and publications.</p>
                    </strong>
                </div>

            </div>

            <div class="row pt-5">
                <div class="col-md-4">
                    <div class="d-flex align-items-center justify-content-center border-top border-bottom py-2 border-dark">
                        <i class="bi bi-person-circle fs-1 me-3"></i>
                        <h2>Erica Dhawan</h2>
                    </div>
                    <div class="d-flex align-items-center justify-content-center border-bottom py-2 border-dark">
                        <i class="bi bi-person-circle fs-1 me-3"></i>
                        <h2>Erica Dhawan</h2>
                    </div>
                    <div class="d-flex align-items-center justify-content-center border-bottom py-2 border-dark">
                        <i class="bi bi-person-circle fs-1 me-3"></i>
                        <h2>Erica Dhawan</h2>
                    </div>
                    <div class="d-flex align-items-center justify-content-center border-bottom py-2 border-dark">
                        <i class="bi bi-person-circle fs-1 me-3"></i>
                        <h2>Erica Dhawan</h2>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="d-flex align-items-center justify-content-center border-top border-bottom py-2 border-dark">
                        <i class="bi bi-person-circle fs-1 me-3"></i>
                        <h2>Erica Dhawan</h2>
                    </div>
                    <div class="d-flex align-items-center justify-content-center border-bottom py-2 border-dark">
                        <i class="bi bi-person-circle fs-1 me-3"></i>
                        <h2>Erica Dhawan</h2>
                    </div>
                    <div class="d-flex align-items-center justify-content-center border-bottom py-2 border-dark">
                        <i class="bi bi-person-circle fs-1 me-3"></i>
                        <h2>Erica Dhawan</h2>
                    </div>
                    <div class="d-flex align-items-center justify-content-center border-bottom py-2 border-dark">
                        <i class="bi bi-person-circle fs-1 me-3"></i>
                        <h2>Erica Dhawan</h2>
                    </div>
                </div>
                <div class="col-md-4 pb-4">
                    <div class="d-flex align-items-center justify-content-center border-top border-bottom py-2 border-dark">
                        <i class="bi bi-person-circle fs-1 me-3"></i>
                        <h2>Erica Dhawan</h2>
                    </div>
                    <div class="d-flex align-items-center justify-content-center border-bottom py-2 border-dark">
                        <i class="bi bi-person-circle fs-1 me-3"></i>
                        <h2>Erica Dhawan</h2>
                    </div>
                    <div class="d-flex align-items-center justify-content-center border-bottom py-2 border-dark">
                        <i class="bi bi-person-circle fs-1 me-3"></i>
                        <h2>Erica Dhawan</h2>
                    </div>
                    <div class="d-flex align-items-center justify-content-center border-bottom py-2 border-dark">
                        <i class="bi bi-person-circle fs-1 me-3"></i>
                        <h2>Erica Dhawan</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="row border-bottom border-start border-dark mb-5">
            <div class="col-md-6 bg-white px-5 py-5">
                <h1 style="font-size:90px;">Learn more about us. Or join us.</h1>
            </div>
            <div class="col-md-6 bg-white border-start border-dark">
                <div class="row">
                    <div class="col-md-12 py-5 ps-4 border-bottom border-dark">
                        <div class="pb-5">
                            <h1>The Inspire blog</h1>
                            <p>Visit our company blog for the latest news, product updates, and tips and tricks.</p>
                        </div>
                        <a href="{{ route('about') }}" class="btn btn-outline-success">Read Our Blog</a>
                    </div>
                    <div class="col-md-12 py-5 ps-4">
                        <div class="pb-5">
                            <h1>Read, write, and expand your world.</h1>
                        </div>
                        <a href="{{ route('register') }}" class="btn btn-outline-success">Get Started</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="text-center">
                <h1 class="mb-5" style="font-size:60px;">Inspire</h1>
                <div class="mb-5">
                    <a href="#" class="text-dark"><small class="me-5">Terms</small></a>
                    <a href="#" class="text-dark"><small class="me-5">Privacy</small></a>
                    <a href="#" class="text-dark"><small class="me-5">Help</small></a>
                </div>
            </div>
        </div>
    </div>
@endsection
