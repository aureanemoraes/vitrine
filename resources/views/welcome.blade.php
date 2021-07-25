@extends('layouts.app')

@section('content')
    <section class="anuncios">
        <div
        id="carouselDarkVariant"
        class="carousel slide carousel-fade carousel-dark"
        data-mdb-ride="carousel"
        >
            <div class="carousel-indicators">
                <button
                data-mdb-target="#carouselDarkVariant"
                data-mdb-slide-to="0"
                class="active"
                aria-current="true"
                aria-label="Slide 1"
                ></button>
                <button
                data-mdb-target="#carouselDarkVariant"
                data-mdb-slide-to="1"
                aria-label="Slide 1"
                ></button>
            </div>

            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img
                        src="https://mdbootstrap.com/img/Photos/Slides/img%20(19).jpg"
                        class="d-block w-100"
                        alt="..."
                        style="height: 400px; object-fit:cover"
                    />
                    <div class="carousel-caption d-none d-md-block">
                        <h5>First slide label</h5>
                        <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                    </div>
                </div>

                <div class="carousel-item">
                    <img
                        src="https://mdbootstrap.com/img/Photos/Slides/img%20(35).jpg"
                        class="d-block w-100"
                        alt="..."
                        style="height: 400px; object-fit:cover"
                    />
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Second slide label</h5>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                </div>
            </div>

            <button
            class="carousel-control-prev"
            type="button"
            data-mdb-target="#carouselDarkVariant"
            data-mdb-slide="prev"
            >
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button
            class="carousel-control-next"
            type="button"
            data-mdb-target="#carouselDarkVariant"
            data-mdb-slide="next"
            >
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>
    <div class="container">
        <section class="empresas-parceiras-principais">
            <nav class="navbar navbar-dark bg-dark mt-3 mb-5">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">Nossas principais parceiras ⭐</a>
                </div>
            </nav>
            @php($empresas_parceiras = App\Models\EmpresaParceira::getEmpresasParceirasPrincipais())
            @if(count($empresas_parceiras) > 0)
            <div class="row row-cols-1 row-cols-md-4 g-4">
                {{dd($empresas_parceiras)}}
                @foreach($empresas_parceiras as $empresa_parceira)
                    <div class="col">
                      <div class="card h-100">
                        <img
                          src="{{ asset('logos-empresas/' . $empresa_parceira->imagem) }}"
                          class="img-fluid rounded-pill"
                          alt="..."
                        />
                        <div class="card-body">
                          <h5 class="card-title">Card title</h5>
                          <p class="card-text">
                            This is a longer card with supporting text below as a natural lead-in to
                            additional content. This content is a little bit longer.
                          </p>
                        </div>
                      </div>
                    </div>
                @endforeach
            </div>
            @endif
        </section>
        <section class="produtos-em-promocao">
            <nav class="navbar navbar-dark bg-dark mt-3 mb-5">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">Nossas promoções</a>
                </div>
            </nav>
        </section>
    </div>
@stop
