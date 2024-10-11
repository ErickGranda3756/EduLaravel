<h2>Crear Nuevo Artículo</h2>


<div class="card">
    <div class="card-body">
        <form method="POST" action="#" enctype="multipart/form-data">

            <div class="form-group">
                <label for="">Título</label>
                <input type="text" class="form-control" id="title" name='title'
                    placeholder="Ingrese el nombre del artículo" minlength="5" maxlength="255" 
                    value="">

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
                    placeholder="Ingrese la introducción del artículo" minlength="5" maxlength="255"
                    value="">

                <span class="text-danger">
                    <span>*</span>
                </span>

            </div>

            <div class="form-group">
                <label for="">Subir imagen</label>
                <input type="file" class="form-control-file" id="image" name='image'>

                <span class="text-danger">
                    <span>*</span>
                </span>

            </div>

            <div class="form-group w-5">
                <label for="">Desarrollo del artículo</label>
                <textarea class="form-control" id="body" name="body"> </textarea>

                <span class="text-danger">
                    <span>*</span>
                </span>
                
            </div>

            <label for="">Estado</label>
            <div class="form-group">
                <div class="form-check form-check-inline">
                    <label class="form-check-label" for="">Privado</label>
                    <input class="form-check-input ml-2" type="radio" name='status' 
                    id="status" value="0" checked>
                </div>

                <div class="form-check form-check-inline">
                    <label class="form-check-label" for="">Público</label>
                    <input class="form-check-input ml-2" type="radio" name='status' 
                    id="status" value="1">
                </div>

                
                <span class="text-danger">
                    <span>*</span>
                </span>
            
            </div>

            <div class="form-group">
                <select class="form-control" name="category_id" id="category_id">
                    <option value="">Seleccione una categoría</option>
                    
                    <option value="">
                    </option>
                    
                </select>

                
                <span class="text-danger">
                    <span>*</span>
                </span>
                
            </div>

            <input type="submit" value="Agregar artículo" class="btn btn-primary">
        </form>
    </div>
</div>


