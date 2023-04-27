<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Document</title>
        <link rel="stylesheet" href="{{ url('css/style.css') }}" />
        <link rel="stylesheet" href="{{ url('css/variables.css') }}" />
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ"
            crossorigin="anonymous"
        />
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
            crossorigin="anonymous"
        ></script>
    </head>
    <body>
        <div class="container">
            <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top">
                <div class="container-fluid">
                    <a class="navbar-brand ms-4 fs-3 fw-bold" href="index.html"
                        >Inkspire</a
                    >
                    <div
                        class="row collapse navbar-collapse pe-0"
                        id="navbarSupportedContent"
                    >
                        <ul class="col-6 navbar-nav mx-auto mb-lg-0 fs-6">
                            <li class="nav-item">
                                <a
                                    class="nav-link active"
                                    aria-current="page"
                                    href="#"
                                    >Home</a
                                >
                            </li>

                            <li class="nav-item dropdown">
                                <a
                                    class="nav-link dropdown-toggle"
                                    href="#"
                                    role="button"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false"
                                >
                                    Categories
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" href="#"
                                            >Action</a
                                        >
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#"
                                            >Another action</a
                                        >
                                    </li>
                                    <li><hr class="dropdown-divider" /></li>
                                    <li>
                                        <a class="dropdown-item" href="#"
                                            >Something else here</a
                                        >
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">About</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Contact</a>
                            </li>
                        </ul>
                        <form
                            class="col-1 col-lg-auto mb-3 mb-lg-0 me-lg-3"
                            role="search"
                        >
                            <input
                                type="search"
                                class="form-control"
                                placeholder="Search..."
                                aria-label="Search"
                            />
                        </form>
                        <div class="col-md-2 text-end">
                            <a
                                href="{{ url('/login') }}"
                                type="button"
                                class="btn btn-outline-success me-2"
                            >
                                Login
                            </a>
                            <a
                                href="{{ url('/register') }}"
                                type="button"
                                class="btn btn-success"
                            >
                                Register
                            </a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>

        <!--- carousel start -->
        <div class="container mt-5 pt-4">
            <div
                id="carouselExampleCaptions"
                class="carousel slide"
                data-bs-ride="carousel"
            >
                <div class="carousel-indicators">
                    <button
                        type="button"
                        data-bs-target="#carouselExampleCaptions"
                        data-bs-slide-to="0"
                        class="active"
                        aria-current="true"
                        aria-label="Slide 1"
                    ></button>
                    <button
                        type="button"
                        data-bs-target="#carouselExampleCaptions"
                        data-bs-slide-to="1"
                        aria-label="Slide 2"
                    ></button>
                    <button
                        type="button"
                        data-bs-target="#carouselExampleCaptions"
                        data-bs-slide-to="2"
                        aria-label="Slide 3"
                    ></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img
                            src="img/banner1.jpg"
                            class="d-block w-100"
                            alt="..."
                        />
                        <div class="carousel-caption d-none d-md-block">
                            <h5>First slide label</h5>
                            <p>
                                Some representative placeholder content for the
                                first slide.
                            </p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img
                            src="img/banner2.jpg"
                            class="d-block w-100"
                            alt="..."
                        />
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Second slide label</h5>
                            <p>
                                Some representative placeholder content for the
                                second slide.
                            </p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img
                            src="img/banner3.jpg"
                            class="d-block w-100"
                            alt="..."
                        />
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Third slide label</h5>
                            <p>
                                Some representative placeholder content for the
                                third slide.
                            </p>
                        </div>
                    </div>
                </div>
                <button
                    class="carousel-control-prev"
                    type="button"
                    data-bs-target="#carouselExampleCaptions"
                    data-bs-slide="prev"
                >
                    <span
                        class="carousel-control-prev-icon"
                        aria-hidden="true"
                    ></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button
                    class="carousel-control-next"
                    type="button"
                    data-bs-target="#carouselExampleCaptions"
                    data-bs-slide="next"
                >
                    <span
                        class="carousel-control-next-icon"
                        aria-hidden="true"
                    ></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>

        <!-- -->

        <main class="container mt-3">
            <div class="row p-4 p-md-5 mb-4 rounded text-bg-dark">
                <div class="col-md-6 px-0">
                    <h1 class="display-4 fst-italic">
                        Title of a longer featured blog post
                    </h1>
                    <p class="lead my-3">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Explicabo dolor perspiciatis vel nihil fuga dolores quis
                        corrupti quas harum, maxime ad ipsum cumque nam enim
                        modi minima at totam molestiae.
                    </p>
                    <p class="lead mb-0">
                        <a href="#" class="text-white fw-bold"
                            >Continue reading...</a
                        >
                    </p>
                </div>
                <div class="col-md-6">
                    <img
                        src="img/feature1.jpg"
                        class="img-fluid rounded"
                        alt=""
                    />
                </div>
            </div>
            <hr />
            <hr />

            <div class="row mb-2">
                <div class="col-md-6">
                    <div
                        class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative"
                    >
                        <div class="col p-4 d-flex flex-column position-static">
                            <strong class="d-inline-block mb-2 text-primary"
                                >World</strong
                            >
                            <h3 class="mb-0">Featured post</h3>
                            <div class="mb-1 text-body-secondary">Nov 12</div>
                            <p class="card-text mb-auto">
                                This is a wider card with supporting text below
                                as a natural lead-in to additional content.
                            </p>
                            <a href="#" class="stretched-link"
                                >Continue reading</a
                            >
                        </div>
                        <div class="col-auto d-none d-lg-block">
                            <svg
                                class="bd-placeholder-img"
                                width="200"
                                height="250"
                                xmlns="http://www.w3.org/2000/svg"
                                role="img"
                                aria-label="Placeholder: Thumbnail"
                                preserveAspectRatio="xMidYMid slice"
                                focusable="false"
                            >
                                <title>Placeholder</title>
                                <rect
                                    width="100%"
                                    height="100%"
                                    fill="#55595c"
                                ></rect>
                                <text x="50%" y="50%" fill="#eceeef" dy=".3em">
                                    Thumbnail
                                </text>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div
                        class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative"
                    >
                        <div class="col p-4 d-flex flex-column position-static">
                            <strong class="d-inline-block mb-2 text-success"
                                >Design</strong
                            >
                            <h3 class="mb-0">Post title</h3>
                            <div class="mb-1 text-body-secondary">Nov 11</div>
                            <p class="mb-auto">
                                This is a wider card with supporting text below
                                as a natural lead-in to additional content.
                            </p>
                            <a href="#" class="stretched-link"
                                >Continue reading</a
                            >
                        </div>
                        <div class="col-auto d-none d-lg-block">
                            <svg
                                class="bd-placeholder-img"
                                width="200"
                                height="250"
                                xmlns="http://www.w3.org/2000/svg"
                                role="img"
                                aria-label="Placeholder: Thumbnail"
                                preserveAspectRatio="xMidYMid slice"
                                focusable="false"
                            >
                                <title>Placeholder</title>
                                <rect
                                    width="100%"
                                    height="100%"
                                    fill="#55595c"
                                ></rect>
                                <text x="50%" y="50%" fill="#eceeef" dy=".3em">
                                    Thumbnail
                                </text>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-5">
                <div class="col-md-8">hello</div>

                <div class="col-md-4">
                    <div class="position-sticky" style="top: 2rem">
                        <div class="p-4 mb-3 bg-body-tertiary rounded">
                            <h4 class="fst-italic">About</h4>
                            <p class="mb-0">
                                Customize this section to tell your visitors a
                                little bit about your publication, writers,
                                content, or something else entirely. Totally up
                                to you.
                            </p>
                        </div>

                        <div class="p-4">
                            <h4 class="fst-italic">Archives</h4>
                            <ol class="list-unstyled mb-0">
                                <li><a href="#">March 2021</a></li>
                                <li><a href="#">February 2021</a></li>
                                <li><a href="#">January 2021</a></li>
                                <li><a href="#">December 2020</a></li>
                                <li><a href="#">November 2020</a></li>
                                <li><a href="#">October 2020</a></li>
                                <li><a href="#">September 2020</a></li>
                                <li><a href="#">August 2020</a></li>
                                <li><a href="#">July 2020</a></li>
                                <li><a href="#">June 2020</a></li>
                                <li><a href="#">May 2020</a></li>
                                <li><a href="#">April 2020</a></li>
                            </ol>
                        </div>

                        <div class="p-4">
                            <h4 class="fst-italic">Elsewhere</h4>
                            <ol class="list-unstyled">
                                <li><a href="#">GitHub</a></li>
                                <li><a href="#">Twitter</a></li>
                                <li><a href="#">Facebook</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <footer id="footer" class="footer">
            <div class="footer-content">
                <div class="container">
                    <div class="row g-5">
                        <div class="col-lg-4">
                            <h3 class="footer-heading">About Inkspire</h3>
                            <p>
                                Lorem ipsum dolor sit amet consectetur
                                adipisicing elit. Magnam ab, perspiciatis beatae
                                autem deleniti voluptate nulla a dolores,
                                exercitationem eveniet libero laudantium
                                recusandae officiis qui aliquid blanditiis omnis
                                quae. Explicabo?
                            </p>
                            <p>
                                <a href="about.html" class="footer-link-more"
                                    >Learn More</a
                                >
                            </p>
                        </div>
                        <div class="col-6 col-lg-2">
                            <h3 class="footer-heading">Navigation</h3>
                            <ul class="footer-links list-unstyled">
                                <li>
                                    <a href="index.html"
                                        ><i class="bi bi-chevron-right"></i>
                                        Home</a
                                    >
                                </li>
                                <li>
                                    <a href="category.html"
                                        ><i class="bi bi-chevron-right"></i>
                                        Categories</a
                                    >
                                </li>
                                <li>
                                    <a href="about.html"
                                        ><i class="bi bi-chevron-right"></i>
                                        About us</a
                                    >
                                </li>
                                <li>
                                    <a href="contact.html"
                                        ><i class="bi bi-chevron-right"></i>
                                        Contact</a
                                    >
                                </li>

                                <li>
                                    <a href="contact.html"
                                        ><i class="bi bi-chevron-right"></i>
                                        Login</a
                                    >
                                </li>
                                <li>
                                    <a href="contact.html"
                                        ><i class="bi bi-chevron-right"></i>
                                        Register</a
                                    >
                                </li>
                                <li></li>
                            </ul>
                        </div>
                        <div class="col-6 col-lg-2">
                            <h3 class="footer-heading">Categories</h3>
                            <ul class="footer-links list-unstyled">
                                <li>
                                    <a href="category.html"
                                        ><i class="bi bi-chevron-right"></i>
                                        Business</a
                                    >
                                </li>
                                <li>
                                    <a href="category.html"
                                        ><i class="bi bi-chevron-right"></i>
                                        Culture</a
                                    >
                                </li>
                                <li>
                                    <a href="category.html"
                                        ><i class="bi bi-chevron-right"></i>
                                        Sport</a
                                    >
                                </li>
                                <li>
                                    <a href="category.html"
                                        ><i class="bi bi-chevron-right"></i>
                                        Food</a
                                    >
                                </li>
                                <li>
                                    <a href="category.html"
                                        ><i class="bi bi-chevron-right"></i>
                                        Politics</a
                                    >
                                </li>
                                <li>
                                    <a href="category.html"
                                        ><i class="bi bi-chevron-right"></i>
                                        Travel</a
                                    >
                                </li>
                            </ul>
                        </div>

                        <div class="col-lg-4">
                            <h3 class="footer-heading">Recent Posts</h3>

                            <ul
                                class="footer-links footer-blog-entry list-unstyled"
                            >
                                <li>
                                    <a
                                        href="single-post.html"
                                        class="d-flex align-items-center"
                                    >
                                        <img
                                            src="{{
                                                url('img/post-landscape-3.jpg')
                                            }}"
                                            alt=""
                                            class="img-fluid me-3"
                                        />
                                        <div>
                                            <div class="post-meta d-block">
                                                <span class="date"
                                                    >Culture</span
                                                >
                                                <span class="mx-1"
                                                    >&bullet;</span
                                                >
                                                <span>Jul 5th '22</span>
                                            </div>
                                            <span
                                                >5 Great Startup Tips for Female
                                                Founders</span
                                            >
                                        </div>
                                    </a>
                                </li>

                                <li>
                                    <a
                                        href="single-post.html"
                                        class="d-flex align-items-center"
                                    >
                                        <img
                                            src="{{
                                                url('img/post-landscape-2.jpg')
                                            }}"
                                            alt=""
                                            class="img-fluid me-3"
                                        />
                                        <div>
                                            <div class="post-meta d-block">
                                                <span class="date"
                                                    >Culture</span
                                                >
                                                <span class="mx-1"
                                                    >&bullet;</span
                                                >
                                                <span>Jul 5th '22</span>
                                            </div>
                                            <span
                                                >What is the son of Football
                                                Coach John Gruden, Deuce Gruden
                                                doing Now?</span
                                            >
                                        </div>
                                    </a>
                                </li>

                                <li>
                                    <a
                                        href="single-post.html"
                                        class="d-flex align-items-center"
                                    >
                                        <img
                                            src="{{
                                                url('img/post-landscape-1.jpg')
                                            }}"
                                            alt=""
                                            class="img-fluid me-3"
                                        />
                                        <div>
                                            <div class="post-meta d-block">
                                                <span class="date"
                                                    >Culture</span
                                                >
                                                <span class="mx-1"
                                                    >&bullet;</span
                                                >
                                                <span>Jul 5th '22</span>
                                            </div>
                                            <span
                                                >Life Insurance And Pregnancy: A
                                                Working Mom’s Guide</span
                                            >
                                        </div>
                                    </a>
                                </li>

                                <li>
                                    <a
                                        href="single-post.html"
                                        class="d-flex align-items-center"
                                    >
                                        <img
                                            src="img/banner4.jpg"
                                            alt=""
                                            class="img-fluid me-3"
                                        />
                                        <div>
                                            <div class="post-meta d-block">
                                                <span class="date"
                                                    >Culture</span
                                                >
                                                <span class="mx-1"
                                                    >&bullet;</span
                                                >
                                                <span>Jul 5th '22</span>
                                            </div>
                                            <span
                                                >How to Avoid Distraction and
                                                Stay Focused During Video
                                                Calls?</span
                                            >
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="footer-legal">
                <div class="container">
                    <div class="row justify-content-between">
                        <div
                            class="col-md-6 text-center text-md-start mb-3 mb-md-0"
                        >
                            <div class="copyright">
                                © Copyright
                                <strong><span>Inkspire</span></strong
                                >. All Rights Reserved
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div
                                class="social-links mb-3 mb-lg-0 text-center text-md-end"
                            >
                                <a href="#" class="twitter"
                                    ><i class="bi bi-twitter"></i
                                ></a>
                                <a href="#" class="facebook"
                                    ><i class="bi bi-facebook"></i
                                ></a>
                                <a href="#" class="instagram"
                                    ><i class="bi bi-instagram"></i
                                ></a>
                                <a href="#" class="google-plus"
                                    ><i class="bi bi-skype"></i
                                ></a>
                                <a href="#" class="linkedin"
                                    ><i class="bi bi-linkedin"></i
                                ></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </body>
</html>
