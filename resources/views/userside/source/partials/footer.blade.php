<style>
    .ftco-footer-social li a {
        color: #fff;
        background: #ff6b6b;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }

    .ftco-footer-social li a:hover {
        background: #ff4949;
        transform: translateY(-3px);
    }

    .ftco-footer-social li {
        margin-right: 10px;
    }
</style>

<footer class="ftco-footer bg-bottom ftco-no-pt"
    style="background-image: url('{{ asset('assets_userside/images/bg_3.jpg') }}');">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md pt-5">
                <div class="ftco-footer-widget pt-md-5 mb-4">
                    <h2 class="ftco-heading-2">About</h2>
                    <p>Your gateway to authentic Jordan experiences. We craft unforgettable journeys through Jordan's
                        rich history, culture, and natural wonders with expert guides.</p>
                    <ul class="ftco-footer-social list-unstyled float-md-left float-lft">
                        <li class="ftco-animate">
                            <a href="https://www.linkedin.com/in/sami-yaseen-/" target="_blank"
                                rel="noopener noreferrer">
                                <span class="fa-brands fa-linkedin"></span>
                            </a>
                        </li>
                        <li class="ftco-animate"><a href="mailto:info@jordanadventures.com"><span
                                    class="fa fa-envelope"></span></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md pt-5 border-left">
                <div class="ftco-footer-widget pt-md-5 mb-4">
                    <h2 class="ftco-heading-2">Experience</h2>
                    <ul class="list-unstyled">
                        @foreach(App\Models\Category::all() as $category)
                        <li><a href="{{ route('tours.category', $category->name) }}" class="py-2 d-block">{{
                                $category->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-md pt-5 border-left">
                <div class="ftco-footer-widget pt-md-5 mb-4">
                    <h2 class="ftco-heading-2">Have a Questions?</h2>
                    <div class="block-23 mb-3">
                        <ul>
                            <li><span class="icon fa fa-map-marker"></span><span class="text">Experience the Wonders of
                                    Jordan</span></li>
                            <li><a href="tel:+962790000000"><span class="icon fa fa-phone"></span><span
                                        class="text">+962 79 000 0000</span></a></li>
                            <li><a href="mailto:info@jordanadventures.com"><span
                                        class="icon fa fa-paper-plane"></span><span
                                        class="text">info@jordanadventures.com</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <p>Copyright &copy; <script>
                        document.write(new Date().getFullYear());
                    </script> All rights reserved</p>
            </div>
        </div>
    </div>
</footer>



<!-- loader -->
<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
        <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
        <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10"
            stroke="#F96D00" />
    </svg></div>


<script src="{{asset('assets_userside/js/jquery.min.js')}}"></script>
<script src="{{asset('assets_userside/js/jquery-migrate-3.0.1.min.js')}}"></script>
<script src="{{asset('assets_userside/js/popper.min.js')}}"></script>
<script src="{{asset('assets_userside/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets_userside/js/jquery.easing.1.3.js')}}"></script>
<script src="{{asset('assets_userside/js/jquery.waypoints.min.js')}}"></script>
<script src="{{asset('assets_userside/js/jquery.stellar.min.js')}}"></script>
<script src="{{asset('assets_userside/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('assets_userside/js/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset('assets_userside/js/jquery.animateNumber.min.js')}}"></script>
<script src="{{asset('assets_userside/js/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('assets_userside/js/scrollax.min.js')}}"></script>
{{-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyClGc5dWTXf10vmSHJTySDkAPBkEW6VQAQ"></script> --}}
<script src="{{asset('assets_userside/js/google-map.js')}}"></script>
<script src="{{asset('assets_userside/js/main.js')}}"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>



</body>

</html>