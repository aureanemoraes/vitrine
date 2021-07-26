<link rel="preconnect" href="https://fonts.gstatic.com">

<!-- Font Awesome -->
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
  rel="stylesheet"
/>
<!-- Google Fonts -->
<link
  href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
  rel="stylesheet"
/>
<!-- MDB -->
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.6.0/mdb.min.css"
  rel="stylesheet"
/>
<!-- SweetAlert2 -->
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.css" rel="stylesheet">
<!-- Select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<!-- Fonts ---->
<!-- Work Sans 300 e 500 ---->
<!-- Montserrat Alternates 400 e 700 ---->
<link href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:wght@400;700&family=Work+Sans:wght@300;500&display=swap" rel="stylesheet">

<link rel="stylesheet" href="{{asset('css/app.scss')}}"/>

<style>
    * {
        font-family: 'Work Sans', sans-serif;
        scroll-behavior: smooth;
    }

    .dropdown:hover .dropdown-menu { display: block; border-radius: 0; }


    .dropdown-menu {
        border-radius: 0;
        background: #f5f5f5;
    }

    .dropdown-item {
        border-radius: 0;
    }

    .card {
        box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
    }

    .breadcrumb {
        border-bottom: 1px solid black;
        margin: 0;
        padding: 0;
    }
</style>
@yield('css')
