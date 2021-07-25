@extends('layouts.app')

@section('css')
    <style>
        img.logo-empresa-parceira {
            height:80px;
            width:80px;
            object-fit:contain;
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
            padding: 0.500rem;
            margin-bottom: 1rem;
        }

        .submenu {
            border-radius: 1rem;
        }
    </style>
@stop

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
                        src="{{ asset('produtos-imagens/caroulse1.png') }}"
                        class="d-block w-100"
                        alt="..."
                        style="height: 300px; object-fit:contain; background: #53AEDA"
                    />
                    <div class="carousel-caption d-none d-md-block">
                        {{-- <h5>First slide label</h5>
                        <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p> --}}
                    </div>
                </div>

                <div class="carousel-item">
                    <img
                        src="{{ asset('produtos-imagens/carousel2.png') }}"
                        class="d-block w-100"
                        alt="..."
                        style="height: 300px; object-fit:contain; background: #53AEDA"
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
            <nav class="navbar navbar-dark bg-dark mt-3 mb-5 submenu">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">Nossas principais parceiras</a>
                </div>
            </nav>
            @php($empresas_parceiras = App\Models\EmpresaParceira::getEmpresasParceirasPrincipais())
            @if(count($empresas_parceiras) > 0)
            <div class="row row-cols-1 row-cols-md-4 g-4">
                @foreach($empresas_parceiras as $empresa_parceira)
                    <div class="col">
                      <div class="card h-100">
                        <div class="card-body text-center">
                            <img
                            src="{{ asset('logos-empresas/' . $empresa_parceira->logo) }}"
                            class="img-fluid rounded logo-empresa-parceira"
                            alt="..."
                            />
                            <h5 class="card-title">{{ $empresa_parceira->nome }}</h5>
                            <p class="card-text">
                                {{ $empresa_parceira->descricao }}
                            </p>
                        </div>
                        <div class="card-footer ">
                            <a
                            href="{{ route('empresas_parceiras.show', $empresa_parceira->id) }}"
                            title=""
                            type="button"
                            class="btn btn-link float-end"
                            data-mdb-ripple-color="dark">
                                Ver produtos <i class="fas fa-chevron-right"></i>
                            </a>
                        </div>
                      </div>
                    </div>
                @endforeach
            </div>
            @endif
        </section>
        <section class="produtos-em-promocao">
            <nav class="navbar navbar-dark bg-dark mt-3 mb-5 submenu">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">Nossas promoções</a>
                </div>
            </nav>
            @php($produtos_relevantes = App\Models\Produto::getProdutosRelevantes())
            @if(count($produtos_relevantes) > 0)
            <div class="row row-cols-1 row-cols-md-4 g-4">
                @foreach($produtos_relevantes as $produto)
                    <div class="col">
                      <div class="card h-100">
                        <img
                          src="{{ asset('produtos-imagens/' . $produto->imagens[0]) }}"
                          class="img-fluid rounded-pill"
                          alt="..."
                        />
                        <div class="card-body">
                          <h5 class="card-title">{{ $produto->nome }}</h5>
                          <p class="card-text">
                           {{ $produto->descricao }}
                          </p>
                        </div>
                      </div>
                    </div>
                @endforeach
            </div>
            @endif
        </section>
    </div>
@stop
