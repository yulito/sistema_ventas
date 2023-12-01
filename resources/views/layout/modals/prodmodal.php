<div class="modal fade" id="prodModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detalle producto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="container">             
          <img id="foto-prod" src="" alt="img-product" style="height: 200px; width:200px; border:2px solid #000;">
          <ul class="list-group list-group-flush list-modal">
            <li class="list-group-item list-modal-item"><h4 id="name-product" style="font-style: italic;">Cemento</h4></li>           
            <li class="list-group-item list-modal-item"><strong>Fecha Actualización: </strong><span id="date-updated"></span></li>
            <li class="list-group-item list-modal-item"><strong>Código: </strong><span id="cod"></span></li>
            <li class="list-group-item list-modal-item"><strong>Descripción: </strong><p id="description"></p></li>
            <li class="list-group-item list-modal-item"><strong>Unidad de Medida: </strong><span id="measure"></span></li>
            <li class="list-group-item list-modal-item"><strong style="color: blue;">Stock: </strong><span id="stock"></span></li>
            <li class="list-group-item list-modal-item"><strong style="color: green;">Valor venta: </strong><span id="price"></span></li>
            <li class="list-group-item list-modal-item"><strong>Descuento: </strong><span id="discount"></span> %</li>
            <li class="list-group-item list-modal-item"><strong>Marca: </strong><span id="brand"></span></li>
            <li class="list-group-item list-modal-item"><strong>Subcategoría: </strong><span id="sub"></span></li>
            <li class="list-group-item list-modal-item"><strong>Área: </strong><span id="area"></span></li>
          </ul>

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>