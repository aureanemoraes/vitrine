@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/produtos.css') }}"/>

    <style>
        img.logo-empresa-parceira {
            height:80px;
            width:80px;
            object-fit:contain;
            box-shadow: rgba(0, 0, 0, 0.2) 0px 5px 5px;
            padding: 0.500rem;
            margin-bottom: 1rem;
        }

        /* .submenu {
            background: white;
            border-radius: 0.500rem;
            padding: 0.05rem;
    } */

        .submenu-title {
            /* color: #53aeda; */
            color: #25558b;
            /* color: white; */
            font-weight: 600;
            /* background-image: linear-gradient(to bottom, #f5f5f5, #53aeda); */

        }

        .submenu-container {
            margin-top: 1rem;
            box-shadow: rgba(37, 85, 139, 0.35) 2px 5px 5px 5px;
            /* background-image: linear-gradient(to bottom, #f5f5f5, #53aeda); */
            /* background-image: linear-gradient(to bottom, #f5f5f5, #25558b); */
            /* background: #f5f5f5; */

            padding: 1rem;


        }

        .info-produto:hover {
            filter: brightness(0.9);
        }

        .card-empresa-parceira {
            /* border: 1px solid rgba(37,	85,	139, 0.35) ; */
            box-shadow: rgba(37, 85, 139, 0.2)  2px 2px 2px 2px;
            /* background-image: linear-gradient(to bottom, #f5f5f5, #53aeda); */


        }

        .card-empresa-parceira:hover {
            filter: brightness(0.9);
        }

        .btn-ver-todos {
            color: #25558b;
        }

        .empresas-parceiras-container {
        }

        .produtos-em-promocao, .empresas-parceiras-principais {
            margin-top: 2rem;
            /* box-shadow: rgba(37, 85, 139, 0.35) 2px 5px 5px 5px; */
            /* background-image: linear-gradient(to bottom, #f5f5f5, #25558b); */
        }

        hr {
            border-top: 1px solid #53aeda;
        }
    </style>
@stop

@section('content')
    <section class="anuncios">
        @php($anuncios = App\Models\Anuncio::getAnuncios())
        <div
        id="carouselDarkVariant"
        class="carousel slide carousel-fade carousel-dark"
        data-mdb-ride="carousel"
        >
            <div class="carousel-indicators">
                @foreach($anuncios as $key => $anuncio)
                    @if($key == 0)
                        <button
                        data-mdb-target="#carouselDarkVariant"
                        data-mdb-slide-to="{{$key}}"
                        class="active"
                        aria-current="true"
                        aria-label="Slide {{$key}}"
                        ></button>
                    @else
                        <button
                        data-mdb-target="#carouselDarkVariant"
                        data-mdb-slide-to="{{$key}}"
                        aria-label="Slide {{$key}}"
                        ></button>
                    @endif
                @endforeach
                {{-- <button
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
                ></button> --}}
            </div>

            <div class="carousel-inner">
                @foreach($anuncios as $key => $anuncio)
                    @if($key == 0)
                        @php($carouselLcass = "carousel-item active")
                    @else
                        @php($carouselLcass = "carousel-item")
                    @endif
                    <div class="{{$carouselLcass}}">
                        <a href="{{$anuncio->link}}">
                            <img
                                src="{{ asset('anuncios-imagens/' . $anuncio->imagem) }}"
                                class="d-block w-100"
                                alt="{{$anuncio->descricao}}"
                                style="height: 300px; object-fit:fit;"
                            />
                        </a>
                        <div class="carousel-caption d-none d-md-block">
                            {{-- <h5>First slide label</h5>
                            <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p> --}}
                        </div>
                    </div>
                @endforeach
                {{-- <div class="carousel-item active">
                    <img
                        src="{{ asset('produtos-imagens/banner-site.png') }}"
                        class="d-block w-100"
                        alt="..."
                        style="height: 300px; object-fit:cover;"
                    />
                    <div class="carousel-caption d-none d-md-block">
                        {{-- <h5>First slide label</h5>
                        <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p> --}}
                    {{-- </div>
                </div>  --}}


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
                <div>
                    <div class="d-flex justify-content-between">
                        <h5 class="submenu-title">Nossas principais parceiras</h5>
                            <a
                        type="button"
                        href="{{ route('empresas_parceiras.index') }}"
                        class="btn btn-link btn-ver-todos"
                        >
                        Ver todas
                        </a>
                    </div>
                    <hr>
                </div>
                @php($empresas_parceiras = App\Models\EmpresaParceira::getEmpresasParceirasPrincipais())
                @if(count($empresas_parceiras) > 0)
                <div class="row row-cols-1 row-cols-md-4 g-4 d-flex justify-content-center empresas-parceiras-container">
                    @foreach($empresas_parceiras as $empresa_parceira)
                        <div class="col">
                          <div class="card h-100 card-empresa-parceira">
                            <div class="card-body text-center card-empresa-parceira">
                                <a href="{{ route('empresas_parceiras.show', $empresa_parceira->id) }}" title="{{$empresa_parceira->nome}}">
                                    <div class="mask rgba-white-slight"></div>
                                </a>
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
                          </div>
                        </div>
                    @endforeach
                </div>
                @endif
        </section>
        <section class="produtos-em-promocao">
            <div>
                <div class="d-flex justify-content-between">
                    <h5 class="submenu-title">Nossas promoções</h5>
                    <a
                    type="button"
                    href="{{ route('empresas_parceiras.index') }}"
                    class="btn btn-link btn-ver-todos"
                    >
                    Ver todas
                    </a>
                </div>
                <hr>
            </div>
            @php($produtos_relevantes = App\Models\Produto::getProdutosRelevantes())
            @if(count($produtos_relevantes) > 0)
                @include('partials.produtos', [
                    'produtos' => $produtos_relevantes,
                    'ordenar' => false,
                    'paginacao' => false
                ])
            @endif

        </section>
    </div>
@stop
