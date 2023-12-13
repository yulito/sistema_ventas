if(document.querySelector('#idfrom') !==null){
    const from = document.querySelector('#idfrom')
    const to = document.querySelector('#idto')
    const btnBatch = document.querySelector('.btn-list-batch')

    const tbd = document.getElementById('tbd-batch')
    const template = document.querySelector('#tmp-batch').content
    const fragment = document.createDocumentFragment() 

    from.addEventListener('change',(e)=>{
        e.preventDefault
        from.classList.add('is-valid')
        to.disabled = false
    })
    to.addEventListener('change',(e)=>{
        e.preventDefault
        to.classList.add('is-valid')
        btnBatch.disabled = false
    })
    btnBatch.addEventListener('click',(e)=>{
        e.preventDefault
        //limpiar registros anteriores
        tbd.innerHTML = ""
        //obtener y enviar datos de fechas
        const formBatch = document.querySelector('#formBatchList')
        const data = new FormData(formBatch)
        fetch('/lotes',{
            method:'post',
            body:data
        }).then( response => response.json())
        .then(list =>{            
            if(list.emptySection){
                document.querySelector('.msgEmpty').textContent = list.emptySection
            }else{
                document.querySelector('.msgEmpty').textContent =""
                let i = 1
                list.forEach(data =>{                
                    template.getElementById('id-count-batch').textContent = i
                    template.getElementById('td-batch').textContent = data.lote_cod
                    template.getElementById('td-prod').textContent = data.producto_.substring(0, 42)+'...'
                    template.getElementById('td-quantity').textContent = data.cantidad
                    template.getElementById('td-date').textContent = data.feceingreso               

                    const link = template.querySelector('#a-batch')           
                    link.href = '/mostrar-lote/'+data.id_lote

                    const clone = template.cloneNode(true)       
                    fragment.appendChild(clone)
                    i++         
                })
                tbd.appendChild(fragment)
            }
        })
        .catch(err => console.log(err))
    })
}