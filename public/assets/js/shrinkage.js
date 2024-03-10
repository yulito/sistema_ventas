const tbd = document.getElementById('tbd-shrinkage')
const template = document.querySelector('#tmp-tbd-shrinkage').content
const fragment = document.createDocumentFragment() 

window.addEventListener('load',(e)=>{            
    loadShrinkage(false);        
})

//input dinamic filter 
if(document.getElementById('searchShrinkage') !== null){
    const search = document.getElementById('searchShrinkage')
    search.addEventListener('keyup',(e)=>{
        e.stopPropagation
        let s = search.value == "" ? false : search.value.replaceAll(" ", "0y0")        
        loadShrinkage(s)

        //clean tbody
        tbd.innerHTML = ""       
    })
}

function loadShrinkage(parameter){
    fetch('/listar-mermas/'+parameter,{
        method:'get'
    }).then( response => response.json())
    .then(list =>{ 
        let i = 1
        list.forEach(data =>{
            
            template.getElementById('count').textContent = i
            template.getElementById('fecha-tb').textContent = data.fechaingreso
            template.getElementById('cod-tb').textContent = data.codprod
            template.getElementById('cantidad-tb').textContent = data.cantidad

            const ditails = template.querySelector('.btn-see-shrinkage')            
            ditails.value = data.id_merma

            const clone = template.cloneNode(true)       
            fragment.appendChild(clone)
            i++         
        })
        tbd.appendChild(fragment)      
        
        watchShrinkage()

    }).catch( err => console.log( err ) )
}

//watch shrinkage 
function watchShrinkage(){ 
    const btnWatch = document.querySelectorAll('.btn-see-shrinkage')

    for(let i = 0; i < btnWatch.length; i++){
        btnWatch[i].addEventListener('click',()=>{
            
            const foto       = document.getElementById('foto-prod')
            const product    = document.getElementById('name-product')
            const date = document.getElementById('date')
            const cod        = document.getElementById('cod')
            const details   = document.getElementById('details') 
            const qn      = document.getElementById('qn')                

            fetch('/ver-merma/'+btnWatch[i].value,{
                method:'get'
            }).then( response => response.json())
            .then(data =>{

                if(data.foto == null || data.foto == ""){
                    foto.src = '/assets/images/interrogacion.png'
                }else{
                    foto.src = '/uploads/'+data.foto
                }
                product.textContent= data.producto_
                date.textContent= data.fechaingreso
                cod.textContent= data.codprod
                details.textContent= data.descripcion
                qn.textContent= data.cantidad
    
            }).catch( err => console.log( err ) )
        })
    }
    
}