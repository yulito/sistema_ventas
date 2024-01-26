//para autocompletado y buscador
const template1 = document.querySelector('#tmp-ops').content
const frag1 = document.createDocumentFragment();
const search = document.getElementById('searchCod')
const ops = document.getElementById('options')

//datos de informacion de producto
const foto = document.getElementById('foto-prod')
foto.src = "/assets/images/interrogacion.png"
const inputNro = document.getElementById('idnro')
const cod = document.getElementById('cod')
const prod = document.getElementById('prod')
const area = document.getElementById('area')
const brand = document.getElementById('brand')
const price = document.getElementById('price')
const uni = document.getElementById('uni')
const desc = document.getElementById('desc')
const final = document.getElementById('final')
const stock = document.getElementById('stock')
const idp = document.getElementById('idp')
const saleTotal = document.getElementById('saleTotal')

//lista de fragment e template para lista de compra
const tbsale = document.getElementById('tbsale')
const template2 = document.querySelector('#tmp-salelist').content
const frag2 = document.createDocumentFragment();

//ELIMINAR TODO DATO DEL LOCALSTORAGE
window.addEventListener('load',(e)=>{
    e.preventDefault    
    localStorage.clear()
})

//input dinamic filter 
search.addEventListener('keyup',(e)=>{ 
    e.preventDefault

    //rellenando los espacios en blanco
    let lookfor = search.value == "" ? false : search.value.replaceAll(" ", "0y0") 

    if(e.key !== 'Enter'){   
        //limpiar lista de opciones
        ops.innerHTML = "" 
        //let regex = /[+-/$%&()#"'!¡¿?]/g
        //let w = lookfor.replaceAll('"','\"')
        getList(lookfor)

    }else{
        //limpiar lista de opciones
        ops.innerHTML = "" 
        cleanField()
        getOne(lookfor)
    }
    
})

function getList(prod){
    if(prod){
        fetch('/traer-producto/'+prod,{
            method:'get'
        }).then(response => response.json())
        .then(list =>{  
            if(!list){
                console.log('no coincide')
            }else{
                //listar opciones
                list.forEach(data =>{
                    //console.log(data.producto_)
                    template1.querySelector('.item-op').value = data.producto_
                    const clone = template1.cloneNode(true)       
                    frag1.appendChild(clone)
                })
                //guardamos resultados en las opciones
                ops.appendChild(frag1)
            }
        })
        .catch( err => console.log(err))
    }else{
        console.log('nada')
    }
}

function getOne(p){
    if(p){
        fetch('/traer-producto/'+p,{
            method:'get'
        }).then(response => response.json())
        .then(list =>{  
            if(!list){
                console.log('no coincide')
            }else{
                //listar opciones
                list.forEach(cursor =>{
                    if(cursor.foto){
                        foto.src = "/uploads/"+cursor.foto
                    }
                    cod.textContent = cursor.cod
                    prod.textContent = cursor.producto_
                    area.textContent = cursor.area_
                    brand.textContent = cursor.marca_
                    price.textContent = cursor.valor
                    uni.textContent = cursor.umedida
                    desc.textContent = cursor.desc_x_prod
                    final.textContent = Math.round((cursor.valor-(cursor.valor * (cursor.desc_x_prod/100))))

                    //descontar stock segun cantidad agregada a la lista                   
                    if(document.querySelector('.lead') !== null){

                        let trRow = document.querySelectorAll('.lead')  
                        let valueStock = cursor.stock

                        for(let i = 0; i < trRow.length ; i++){
                            if(trRow[i].children[1].textContent == cursor.producto_){
                                //sobre-escribir valor
                                valueStock = (cursor.stock - Number(trRow[i].children[4].innerHTML))
                            }
                        } 
                        stock.textContent = valueStock
                    }else{                        
                        stock.textContent = cursor.stock
                    }
                    inputNro.disabled = false
                    idp.value = cursor.id_prod
                })
            }
        })
        .catch( err => console.log(err))
    }else{
        console.log('nada')
    }
}

//agregar a la lista de compras
function addToList(){
    inputNro.addEventListener('keydown',(e)=>{
        e.preventDefault
        
        if(e.key === 'Enter'){   
            if(inputNro.value > 0 && prod.textContent != ""){ 
                //REVISAR SI EL STOCK CUENTA CON LA CANTIDAD REQUERIDA
                let resultQn = (stock.textContent - inputNro.value)
                if( resultQn >= 0 ){                    
                    addListToSale()
                }else{
                    alert('NO HAY STOCK SUFICIENTE')
                }            
            }else{
                alert('NO HAY STOCK DE ESTE PRODUCTO')
            }
        }
    })
}
//enviar a funcion escucha del input cantidad
addToList()

//AGREGAR A LA LISTA DE COMPRAS
function addListToSale(){
    if(document.querySelector('.lead') !== null){   

        //Verificar existencia de items    
        let trRow = document.querySelectorAll('.lead')
        let bool = false                    
        for(let i = 0; i < trRow.length ; i++){
            if(trRow[i].children[1].textContent == prod.textContent){

                //actualizar cantidad
                let Qn = (Number(inputNro.value) + Number(trRow[i].children[4].innerHTML)) 
                trRow[i].children[4].innerHTML = Qn
                
                //actualizar valor x cantidad
                let totalxporcent = ((final.textContent * Qn)-((final.textContent * Qn) * (Number(trRow[i].children[3].children[0].value)/100)))
                trRow[i].children[5].innerHTML = '$'+ Math.round(totalxporcent)

                //sobre-escribir el total de venta. 
                calculateTotal()

                cleanField()
                bool = true
            }  
        }
        //comprobar parar crear lista
        if(!bool){
            createItems()
        }

    }else{
        createItems()
    }  
}

//CREAR ELEMENTOS DE LA LISTA DE COMPRAS
function createItems(){
    //listar opciones  
    template2.querySelector('.listprod').textContent = prod.textContent
    template2.querySelector('.listprice').textContent = final.textContent
    template2.querySelector('.listdesc').value = null
    template2.querySelector('.listqn').textContent = inputNro.value
    template2.querySelector('.listtotal').textContent = Math.round((final.textContent * inputNro.value)) 
    //template2.querySelector('.deleterow').value = idp.value
    const clone2 = template2.cloneNode(true)       
    frag2.appendChild(clone2)
    //guardamos resultados en las opciones
    tbsale.appendChild(frag2)

    //sobre-escribir el total de venta
    calculateTotal()

    //escuchar para eliminar fila
    delRow()

    //escuchar input descuento adicional
    porcentRow()

    //limpiar campos
    cleanField() 
}

//CALCULAR EL VALOR TOTAL DE VENTA
function calculateTotal(){
    saleTotal.textContent = Number(0)
    if(document.querySelector('.lead') !== null){
        let trRow = document.querySelectorAll('.lead')  
        for(let i = 0; i < trRow.length ; i++){
            saleTotal.textContent = Math.round((Number(saleTotal.textContent) + Number(trRow[i].children[5].innerText.substring(1))))            
        }         
    }
}

//MODIFICAR VALOR SEGUN DESCUENTO ADICIONAL
function porcentRow(){
    if(document.querySelector('.lead') !== null){
        let btnDesc = document.querySelectorAll('.listdesc')
        let trRow = document.querySelectorAll('.lead')
        for(let i = 0; i < btnDesc.length ; i++){
            btnDesc[i].addEventListener('keyup',(e)=>{
                e.preventDefault                

                //actualizar cantidad
                let Qn = Number(trRow[i].children[4].innerHTML)

                //actualizar valor x cantidad
                let valueBase = trRow[i].children[2].textContent.substring(1)
                let totalxporcent = (Number(valueBase * Qn)-(Number(valueBase * Qn) * (Number(trRow[i].children[3].children[0].value)/100)))
                trRow[i].children[5].innerHTML = '$'+ Math.round(totalxporcent)
                //descontar del valor total
                calculateTotal()
            })   
        } 
    }
}

//ELIMINAR FILA
function delRow(){
    if(document.querySelector('.deleterow') !== null){
        let btnDel = document.querySelectorAll('.deleterow')
        let trRow = document.querySelectorAll('.lead')
        for(let i = 0; i < btnDel.length ; i++){
            btnDel[i].addEventListener('click',(e)=>{
                e.preventDefault

                //eliminar fila                
                //tbsale.removeChild(trRow[i]) --> funciona pero muestra error en consola
                if (trRow[i].parentNode) {
                    trRow[i].parentNode.removeChild(trRow[i]);
                  }

                //descontar del valor total
                calculateTotal()
            })   
        } 
    }
}

//funcion limpiar
function cleanField(){
    foto.src = "/assets/images/interrogacion.png"
    cod.textContent = ""
    prod.textContent = ""
    area.textContent = ""
    brand.textContent = ""
    price.textContent = ""
    uni.textContent = ""
    desc.textContent = ""    
    stock.textContent = ""
    search.value = ""
    inputNro.value = null
    inputNro.disabled = true
    idp.value = null
    final.textContent = ""
}

// ********* BOLETA O FACTURA (traer funciones desde otro archivo [module, export, import]) ***********
document.querySelector('#idBoleta').addEventListener('click',(e)=>{
    e.preventDefault

    if(saleTotal.textContent == 0){
        alert('NO HAS AGREGADO NINGUN PRODUCTO A LA LISTA')
    }else{
        //almacenar en localstorage
        saveLocalStorage()
        //enviar a vista de boleta
        location.href = '/documento/boleta';
    }
})
//----
document.querySelector('#idFactura').addEventListener('click',(e)=>{
    e.preventDefault

    if(saleTotal.textContent == 0){
        alert('NO HAS AGREGADO NINGUN PRODUCTO A LA LISTA')
    }else{
        //almacenar en localstorage
        saveLocalStorage()
        //enviar a vista de factura
        location.href = '/documento/factura';
    }
})

function saveLocalStorage(){
    let listObjs = []
        let trRow = document.querySelectorAll('.lead')
        for(let i = 0; i < trRow.length ; i++){           
            
            listObjs[i] = {
                product:trRow[i].children[1].textContent,
                val:trRow[i].children[2].textContent,
                valueu:trRow[i].children[3].children[0].value,
                qn:trRow[i].children[4].textContent,
                total:trRow[i].children[5].textContent
            }
        }         
        //console.log(listObjs)
        localStorage.setItem("productRow",JSON.stringify(listObjs))
        localStorage.setItem("totalSale",JSON.stringify(saleTotal.textContent))
}