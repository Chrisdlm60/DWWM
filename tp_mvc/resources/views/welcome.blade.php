@extends("layout.master")


@section('content')

    <!--Start your project here-->
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="view overlay  hm-white-light z-depth-1-half">
                    <img src="{{asset('images/logo-iut.png')}}" class="img-fluid" alt="" style="margin-top: 2rem;">
                </div>
                <br>
            </div>

            <!--Main information-->
            <div class="col-md-9">
                <h2 class="h2-responsive">IUT de Lens</h2>
                <hr>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris ultricies euismod arcu. Aliquam
                    imperdiet laoreet nibh, sed posuere dolor feugiat sed. In in dolor et metus cursus ultrices. Nullam
                    blandit eu est a mollis. Cras elit quam, semper id ornare vitae, sodales eget nibh. Nulla dignissim
                    sodales quam, id placerat eros porttitor nec. Proin molestie eros vel tortor tempus, sit amet
                    placerat est pharetra. Vivamus a congue nibh, at lacinia libero. Nullam tristique posuere
                    feugiat.</p>

                <p>Nam fermentum eget lectus commodo luctus. Pellentesque ornare pellentesque justo eget suscipit. Nam
                    pellentesque pulvinar neque sit amet elementum. Aliquam euismod neque sed ipsum scelerisque, sed
                    tempor enim varius. Sed quis scelerisque orci. Ut id vehicula magna. Etiam sed rutrum nunc, a
                    vulputate mi. Phasellus tortor tortor, tempor quis metus et, efficitur congue dui. Suspendisse ac
                    leo eros. Praesent lobortis diam nunc, eget tincidunt ipsum laoreet eget. Proin ut sapien sed neque
                    lacinia accumsan. Vivamus consectetur porta elementum. Etiam id laoreet risus, vitae blandit ipsum.
                    Integer libero libero, sodales et feugiat ut, finibus vel arcu. Ut quis tortor rhoncus, blandit est
                    ut, sodales purus.
                    Sed gravida consectetur ex, non viverra dui venenatis a.</p>

                <a href="http://www.iut-lens.univ-artois.fr" class="btn btn-primary">Plus d'info!</a>
            </div>
        </div>
    </div>
@endsection
