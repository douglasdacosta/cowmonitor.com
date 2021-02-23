@extends('layouts.default.layout')
@extends('layouts.default.menu')
@extends('layouts.default.rodape')
@section('conteudo')
<div class="right_col" role="main">
  <div class="col-md-12">
    <div class="col-middle">
      <div class="text-center text-center">
        <h1 class="error-number">404</h1>
        <h2>Ops!</h2>
        <p>Pagina não encontrada!<a href=""></a>
        </p>
        <a href='{{ URL::route('dashboard')}}' class="btn btn-success">Você pode ir para a home!</a>
        {{-- <button type="submit" class="btn btn-success">Você pode ir para a home!</button> --}}
      </div>
    </div>
  </div>
</div>
@stop