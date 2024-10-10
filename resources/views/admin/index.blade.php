@extends('adminlte::page')

@section('title', 'Panel de administración')

@section('content_header')
    <h1>Bienvenidos al panel de administración</h1>
@stop

@section('content')
    <p>¡Hola! {{Auth::user()->full_name}} desde aquí podras administrar tus artículos, categorías y comentarios.</p>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop