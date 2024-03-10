<div class="modal fade" id="shrinkageModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detalle de producto mermado</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body"> <!-- fechaingreso, codprod, cantidad, descripcion, producto_, foto  -->
        <div class="container">             
          <img id="foto-prod" src="" alt="img-product" style="height: 200px; width:200px; border:2px solid #000;">
          <ul class="list-group list-group-flush list-modal">
            <li class="list-group-item list-modal-item"><h4 id="name-product" style="font-style: italic;"></h4></li>           
            <li class="list-group-item list-modal-item"><strong>Fecha Ingreso: </strong><span id="date"></span></li>
            <li class="list-group-item list-modal-item"><strong>Código: </strong><span id="cod"></span></li>
            <li class="list-group-item list-modal-item"><strong>Detalle: </strong><p id="details"></p></li>            
            <li class="list-group-item list-modal-item"><strong style="color: red;">Cantidad: </strong><span id="qn"></span></li>           
          </ul>

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>