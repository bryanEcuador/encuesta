@extends('layouts.encuestaEncuesta')
@section('nombre_pagina','Encuesta')
@section('Principal')
    <p>Encuesta</p>
@endsection
@section('title','Encuesta')

@section('contenido')
    <div class="page-error tile col-md-12">
        <h1><i class="fa fa-exclamation-circle"></i>{{$titulo}}</h1>
        <p>{{$mensaje}}</p>
    </div>
@endsection


