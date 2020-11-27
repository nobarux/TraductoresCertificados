<form action="https://certificacion.esti.cu/solicitudesDocumentos" method="POST" enctype="multipart/form-data">
    
  @method('POST')
  @csrf
            <input type="file" name="archivo_foto"/>

        <button class="btn-secondary" type="submit" 
          >Enviar</button
        >
  </form>