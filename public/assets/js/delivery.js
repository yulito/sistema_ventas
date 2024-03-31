const tbd = document.getElementById('tbd-delivery')
const template = document.querySelector('#tmp-tbd-delivery').content
const fragment = document.createDocumentFragment() 

window.addEventListener('load',(e)=>{    
    e.preventDefault
    e.stopPropagation
    loadDelivery(false);    
})

//input dinamic filter 
if(document.getElementById('searchDelivery') !== null){
    const search = document.getElementById('searchDelivery')
    search.addEventListener('keyup',(e)=>{
        e.stopPropagation
        let s = search.value == "" ? false : search.value.replaceAll(" ", "0y0")
        console.log(s)
        loadDelivery(s)

        //clean tbody
        tbd.innerHTML = ""       
    })
}

function loadDelivery(parameter){
    fetch('/listar-despachos/'+parameter,{
        method:'get'
    }).then( response => response.json())
    .then(list =>{                                

        let color=''
        let status = ''
        list.forEach(data =>{
                        
            template.getElementById('nro-tb').textContent = data.id_despacho
            template.getElementById('date-tb').textContent = data.fecdespacho  
            template.getElementById('date2-tb').textContent = data.fecmodificar
            
            if(data.estado == 1){ color='yellow'; status = 'Pendiente' }
            if(data.estado == 2){ color='green'; status = 'Despachado' }

            template.getElementById('status-tb').innerHTML = 
            '<span style="color:'+color+';text-shadow:1px 1px 2px #000";><strong>'+status+'</strong></span>'

            const check = template.querySelector('#link-check')           
            check.href = '/ver-despacho/'+data.id_despacho

            const del = template.querySelector('#link-del')
            del.href = '/eliminar-despacho/'+data.id_despacho           

            const clone = template.cloneNode(true)       
            fragment.appendChild(clone)                   
        })
        tbd.appendChild(fragment)        

    }).catch( err => console.log( err ) )
};