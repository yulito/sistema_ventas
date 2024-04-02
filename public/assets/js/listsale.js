if(document.querySelector('#idfrom') !==null){
    const from = document.querySelector('#idfrom')
    const to = document.querySelector('#idto')
    const btnSale = document.querySelector('.btn-list-sale')

    const tbd = document.getElementById('tbd-sale')
    const template = document.querySelector('#tmp-sale').content
    const fragment = document.createDocumentFragment() 

    from.addEventListener('change',(e)=>{
        e.preventDefault
        from.classList.add('is-valid')
        to.disabled = false
    })
    to.addEventListener('change',(e)=>{
        e.preventDefault
        to.classList.add('is-valid')
        btnSale.disabled = false
    })
    btnSale.addEventListener('click',(e)=>{
        e.preventDefault
        //limpiar registros anteriores
        tbd.innerHTML = ""
        //obtener y enviar datos de fechas
        const formSale = document.querySelector('#formSaleList')
        const data = new FormData(formSale)
        fetch('/ventas',{
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
                    template.getElementById('id-count-sale').textContent = i
                    template.getElementById('td-sale').innerHTML = '<strong>'+data.id_venta+'</strong>'
                    template.getElementById('td-type').textContent = data.doc
                    template.getElementById('td-date').textContent = data.fecventa
                    template.getElementById('td-total').innerHTML = '<strong>$'+data.total+'</strong>'
                    template.getElementById('td-seller').textContent = data.vendedor               

                    const link = template.querySelector('#a-sale')           
                    link.href = '/mostrar-venta/'+data.id_venta

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