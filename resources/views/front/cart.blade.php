@extends('front.layouts.app')
@section('content')

<section class="ftco-section bg-light">
    <div class="container">
        <div class="row">
            @foreach($vehicules as $car)
                <div class="col-md-4">
                    <div class="car-wrap rounded ftco-animate">
                        <div class="img rounded d-flex align-items-end" style="background-image: url('{{ asset('storage/' . $car->image) }}');">
                        </div>
                        <div class="text">
                            <h2 class="mb-0">
                                <a href="">
                                    {{ $car->type }} ({{ $car->numero_immatriculation }})
                                </a>
                            </h2>
                            <div class="d-flex mb-3">
                                <span class="cat">Places : {{ $car->nombre_places }}</span>
                                <p class="price ml-auto">
                                    {{ ucfirst($car->status) }}
                                </p>
                            </div>
                            <p class="d-flex mb-0 d-block">
                                <a href="{{url('reservation')}}" class="btn btn-primary py-2 mr-1">Réserver</a>
                                <a href="" class="btn btn-secondary py-2 ml-1">Détails</a>
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
