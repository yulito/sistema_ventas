const tbd = document.getElementById('tbd-prod')
const template = document.querySelector('#tmp-tbd-prod').content
const fragment = document.createDocumentFragment() 

//list
window.addEventListener('load',()=>{    
    loadProd(false);
})

//input dinamic filter 
if(document.getElementById('searchProd') !== null){
    const search = document.getElementById('searchProd')
    search.addEventListener('keyup',(e)=>{
        e.stopPropagation
        let s = search.value == "" ? false : search.value.replaceAll(" ", "0space0")
        console.log(s)
        loadProd(s)

        //clean tbody
        tbd.innerHTML = ""       
    })
}
//fetch data product
function loadProd(parameter){
    fetch('/listar-productos/'+parameter,{
        method:'get'
    }).then( response => response.json())
    .then(list =>{                                

        let i = 1
        list.forEach(data =>{
            
            template.getElementById('count').textContent = i
            template.getElementById('cod-tb').textContent = data.cod
            template.getElementById('prod-tb').textContent = data.producto_.substring(0, 42)+'...'
            template.getElementById('brand-tb').textContent = data.marca_.substring(0, 10)+'...'
            template.getElementById('stock-tb').textContent = data.stock
            template.getElementById('price-tb').textContent = '$ '+data.valor
            template.getElementById('date-tb').textContent = data.fecactual

            const ditails = template.querySelector('.btn-see-prod')            
            ditails.value = data.id_prod

            const linkEdit = template.querySelector('#link-edit-prod')           
            linkEdit.href = '/editar-producto/'+data.id_prod

            const clone = template.cloneNode(true)       
            fragment.appendChild(clone)
            i++         
        })
        tbd.appendChild(fragment)

        watchProduct()

    }).catch( err => console.log( err ) )
};
//watch product
function watchProduct(){ 
    const btnWatch = document.querySelectorAll('.btn-see-prod')
    for(let i = 0; i < btnWatch.length; i++){
        btnWatch[i].addEventListener('click',()=>{
            //console.log(btnWatch[i].value)        
            const foto       = document.getElementById('foto-prod')
            const product    = document.getElementById('name-product')
            const dateUpdate = document.getElementById('date-updated')
            const cod        = document.getElementById('cod')
            const descript   = document.getElementById('description')
            const measure    = document.getElementById('measure')
            const stock      = document.getElementById('stock')
            const price      = document.getElementById('price')
            const discount   = document.getElementById('discount')
            const brand      = document.getElementById('brand')
            const sub        = document.getElementById('sub')
            const area       = document.getElementById('area')
    
            fetch('/mostrar-producto/'+btnWatch[i].value,{
                method:'get'
            }).then( response => response.json())
            .then(data =>{
                //console.log(data)
                if(data.foto == null || data.foto == ""){
                    foto.src = '/assets/images/interrogacion.png'
                }else{
                    foto.src = '/uploads/'+data.foto
                }
                product.textContent= data.producto_
                dateUpdate.textContent= data.fecactual
                cod.textContent= data.cod
                descript.textContent= data.proddescrip
                measure.textContent= data.umedida
                stock.textContent= data.stock
                price.textContent= '$ '+data.valor
                discount.textContent= data.desc_x_prod
                brand.textContent= data.marca_
                sub.textContent= data.subcat
                area.textContent= data.area_ 
    
            }).catch( err => console.log( err ) )
        })
    }
    
}
