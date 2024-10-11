@extends('adminlte::page')

@section('title', '')

@section('content_header')
<h2>Modificar artículo</h2>
@stop

@section('content')

<div class="card">
    <div class="card-body">
        <form method="POST" action="#" enctype="multipart/form-data">

            <div class="form-group"><input type="hidden" name="id" value=""></div>

            <div class="form-group">
                <label>Título</label>
                <input type="text" class="form-control" id="title" name='title' minlength="5" 
                maxlength="255" value="">

                <span class="text-danger">
                    <span>*</span>
                </span>
                
            </div>

            <div class="form-group">
                <label for="">Slug</label>
                <input type="text" class="form-control" id="slug" name='slug' 
                placeholder="Slug del artículo" readonly value="">
 
                <span class="text-danger">
                    <span>*</span>
                </span>
                
            </div>

            <div class="form-group">
                <label>Introducción</label>
                <input type="text" class="form-control" id="introduction" name='introduction' 
                minlength="5" maxlength="255" value="">
       
                <span class="text-danger">
                    <span>*</span>
                </span>
               
            </div>

            <div class="form-group">
                <label>Cambiar imagen</label>
                <input type="file" class="form-control-file mb-2" id="image" name='image'>

                <div class="rounded mx-auto d-block">
                    <img src="" style="width: 250px">
                </div>

                <span class="text-danger">
                    <span>*</span>
                </span>
             
            </div>


            <div class="form-group">
                <label for="">Desarrollo del artículo</label>
                <textarea class="form-control" id="body" name="body"></textarea>             

                <span class="text-danger">
                    <span>*</span>
                </span>
                
            </div>

            <label>Estado</label>
            <div class="form-group">
                <div class="form-check form-check-inline">
                    <label class="form-check-label">Privado</label>
                    <input class="form-check-input ml-2" type="radio" name='status' id="status" value="0">
                </div>

                <div class="form-check form-check-inline">
                    <label class="form-check-label">Público</label>
                    <input class="form-check-input ml-2" type="radio" name='status' id="status" value="1">
                </div>

                <span class="text-danger">
                    <span>*</span>
                </span>
            </div>

            <div class="form-group">
                <select class="form-control" name="category_id" id="category_id">
                    <option>Seleccione una categoría</option>
 
                    <option value=""></option>
                    
                </select>

                
                <span class="text-danger">
                    <span>*</span>
                </span>
                
            </div>
            <input type="submit" value="Modificar artículo" class="btn btn-primary">
        </form>
    </div>
</div>
@endsection
