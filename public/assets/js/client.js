const tbd = document.getElementById('tbd-cli')
const template = document.querySelector('#tmp-tbd-cli').content
const fragment = document.createDocumentFragment() 

window.addEventListener('load',(e)=>{    
    e.preventDefault
    e.stopPropagation
    loadClient(false);    
})

//input dinamic filter 
if(document.getElementById('searchCli') !== null){
    const search = document.getElementById('searchCli')
    search.addEventListener('keyup',(e)=>{
        e.stopPropagation
        let s = search.value == "" ? false : search.value.replaceAll(" ", "0y0")
        console.log(s)
        loadClient(s)

        //clean tbody
        tbd.innerHTML = ""       
    })
}

function loadClient(parameter){
    fetch('/listar-clientes/'+parameter,{
        method:'get'
    }).then( response => response.json())
    .then(list =>{                                

        let i = 1
        list.forEach(data =>{
            
            template.getElementById('count').textContent = i
            template.getElementById('run-tb').textContent = data.run
            template.getElementById('name-tb').textContent = data.nomcliente
            template.getElementById('phone-tb').textContent = data.fono
            template.getElementById('address-tb').textContent = data.direcliente+' - '+data.comuna_

            /* const delete = template.querySelector('.btn-delete-prod')            
            delete.value = data.id_prod */

            const linkEdit = template.querySelector('#link-edit-cli')           
            linkEdit.href = '/agregar-cliente/'+data.id_cliente

            const clone = template.cloneNode(true)       
            fragment.appendChild(clone)
            i++         
        })
        tbd.appendChild(fragment)        

    }).catch( err => console.log( err ) )
};