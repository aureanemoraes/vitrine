<style>
    .footer {
        background: #25558b;
        bottom: 0;
        left: 0;
        right: 0;
        margin: 0;
        padding: 0;
    }

    .formas_pagamento {
        list-style-type: none;
        display: flex;
        justify-content: space-around;
    }



    .formas_pagamento li {
        background: white;
        padding: 0.5rem;
        border-radius: 1rem;
    }

    .horario-funcionamento {
        list-style: none;
        text-align: left;
        font-size: 10px;
    }
</style>
<!-- Footer -->
<footer class="footer text-center text-white">
    <!-- Grid container -->
    <div class="container p-4">
      <!-- Section: Social media -->
      <section class="mb-4">
        <!-- Facebook -->
        <a class="btn btn-outline-light btn-floating m-1" href="https://www.facebook.com/norteodonto" role="button"
          ><i class="fab fa-facebook-f"></i
        ></a>

        <!-- Twitter -->
        {{-- <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
          ><i class="fab fa-twitter"></i
        ></a> --}}

        <!-- Google -->
        {{-- <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
          ><i class="fab fa-google"></i
        ></a> --}}

        <!-- Instagram -->
        <a class="btn btn-outline-light btn-floating m-1" href="https://www.instagram.com/norteodontoap/" role="button"
          ><i class="fab fa-instagram"></i
        ></a>

        <!-- Linkedin -->
        {{-- <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
          ><i class="fab fa-linkedin-in"></i
        ></a>

        <!-- Github -->
        <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
          ><i class="fab fa-github"></i
        ></a> --}}
      </section>
      <!-- Section: Social media -->

      <!-- Section: Links -->
      <section class="">
        <!--Grid row-->
        <div class="row text-center">
          <!--Grid column-->
            <div class="col">
                <a href="{{ route('entidades.show', 1) }}" class="text-white">Sobre nós</a>
            </div>
            <div class="col">
                <a href="#!" class="text-white">Contato</a>
                <h4>+55 96 8118-8325</h4>
            </div>
            <div class="col">
                <a href="#!" class="text-white">Endereço</a>
                <p>R. Leopoldo Machado, 3416 - Beirol, Macapá - AP, 68902-020</p>
            </div>
            <div class="col">
                <a href="#!" class="text-white">Horário de funcionamento</a>
                <ul class="horario-funcionamento">
                    <li>segunda-feira	08:00–18:00</li>
                    <li>terça-feira	08:00–18:00</li>
                    <li>quarta-feira	08:00–18:00</li>
                    <li>quinta-feira	08:00–18:00</li>
                    <li>sexta-feira	08:00–18:00</li>
                    <li>sábado	08:00–12:00</li>
                    <li>domingo	Fechado</li>
                </ul>
            </div>
            <div class="col">
                <p class="titulo">
                    <strong>Formas de Pagamento</strong>
                </p>
                <ul class="formas_pagamento">
                    <li><span>
                        <img id="ctl00_Footer1_rptFormasPagamento_ctl01_imgFormaPag" title="MasterCard" src="https://www.morelli.com.br/loja/_html/morelli/pt-BR/imagens/icones/ico_mastercard_checkout.jpg" style="border-width:0px;">
                    </span></li>

                    <li><span>
                        <img id="ctl00_Footer1_rptFormasPagamento_ctl02_imgFormaPag" title="Visa" src="https://www.morelli.com.br/loja/_html/morelli/pt-BR/imagens/icones/ico_visa_checkout.jpg" style="border-width:0px;">
                    </span></li>

                    <li><span>
                        <img id="ctl00_Footer1_rptFormasPagamento_ctl03_imgFormaPag" title="ELO" src="https://www.morelli.com.br/loja/_html/morelli/pt-BR/imagens/icones/ico_ELO.png" style="border-width:0px;">
                    </span></li>

                    <li><span>
                        <img id="ctl00_Footer1_rptFormasPagamento_ctl04_imgFormaPag" title="Boleto à Vista" src="https://www.morelli.com.br/loja/_html/morelli/pt-BR/imagens/icones/ico_boleto_checkout.png" style="border-width:0px;">
                    </span></li>

                    <li><span>
                        <img id="ctl00_Footer1_rptFormasPagamento_ctl05_imgFormaPag" title="Boleto à Prazo" src="https://www.morelli.com.br/loja/_html/morelli/pt-BR/imagens/icones/ico_boleto_prazo_checkout.png" style="border-width:0px;">
                    </span></li>

                </ul>
            </div>
        </div>
        <!--Grid row-->
      </section>
      <!-- Section: Links -->
    </div>
    <!-- Grid container -->

    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
      © 2021 Copyright: NordeOdonto
    </div>
    <!-- Copyright -->
  </footer>
  <!-- Footer -->
