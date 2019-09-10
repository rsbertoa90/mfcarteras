<div class="w-100 bg-danger nav white-bold p-2 mb-4 d-flex justify-content-around">
    <div class="nav-text">
        Administracion - MF
    </div>
   
   
    <div class="nav-text">
        <a href="/admin/cotizador">Cotizador</a>
    </div>
    <div class="nav-text">
        <a href="/admin/ordenes">Mis pedidos</a>
    </div>
    

     @if ($user->role_id < 3 )
      <div class="nav-text">
        <a href="/admin">Administrar productos</a>
      </div>

        <div class="nav-text">
            <a href="/super">Metadata</a>
        </div>
    @endif
    
    <div class="nav-text">
        <a href="/logout">Salir</a>
    </div>
</div>