@extends('layouts.default')

@section('title', 'AlphaLanches - Menu')

@section('content')
    <div class="container mt-4 text-center">
        <h2 class="mb-4">Grade de Painéis</h2>

        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-3">
        <div class="col">
    <button class="btn btn-light square-btn" onclick="redirectTo('painelFinanceiro')">
        <i class="fas fa-money-bill-trend-up icon-size"></i>
        <div class="label-size">Financeiro</div>
    </button>
</div>

<div class="col">
    <button class="btn btn-light square-btn" onclick="redirectTo('estoque')">
        <i class="fas fa-box icon-size"></i>
        <div class="label-size">Estoque</div>
    </button>
</div>

<div class="col">
    <button class="btn btn-light square-btn" onclick="redirectTo('profile')">
        <i class="fas fa-user icon-size"></i>
        <div class="label-size">Perfil</div>
    </button>
</div>

<div class="col">
    <button class="btn btn-light square-btn" onclick="redirectTo('painelUsuarios')">
        <i class="fas fa-users icon-size"></i>
        <div class="label-size">Usuários</div>
    </button>
</div>

<div class="col">
    <button class="btn btn-light square-btn" onclick="redirectTo('painelCompras')">
        <i class="fas fa-basket-shopping icon-size"></i>
        <div class="label-size">Histórico de Compras</div>
    </button>
</div>

<div class="col">
    <button class="btn btn-light square-btn" onclick="redirectTo('painelPDV')">
        <i class="fas fa-store icon-size"></i>
        <div class="label-size">PDV</div>
    </button>
</div>

<div class="col">
    <button class="btn btn-light square-btn" onclick="redirectTo('sobre')">
        <i class="fas fa-info-circle icon-size"></i>
        <div class="label-size">Sobre Nós</div>
    </button>
</div>


        </div>
    </div>

    <script>
        function redirectTo(route) {
            window.location.href = "{{ url('/') }}/" + route;
        }
    </script>

    <style>
        .square-btn {
            width: 175px;
            height: 175px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            font-weight: bold;
            box-shadow: 2px 10px 10px rgba(0, 0, 0, 0.2);
        }

        .square-btn:hover {
            background-color: #4ab3ce;
        }

        .icon-size {
            font-size: 2.5rem;
        }

        .label-size {
            font-size: 1.2rem;
            font-weight: bold;
            margin-top: 5px;
        }
    </style>
@endsection
