//enable subcategory (igual es mejor CAMBIAR LOS NOMBRES DE LAS IDS Y NAMES)
if(document.querySelector('#idcategory') !== null){
    document.querySelector('#idcategory').addEventListener('change',()=>{
        //traer select y habilitarlo
        const selectSub = document.querySelector('#idsubcat')
        selectSub.disabled = false;
        const valCat = document.querySelector('#idcategory').value

        //limpiar select
        if(document.querySelector('.op-tmp')){
            //let option = document.querySelector('.op-tmp')
            //option.parentNode.removeChild(option);                    
            while(selectSub.firstChild){
                selectSub.removeChild(selectSub.firstChild);
            }
            //restaurar option disabled
            const fragment = document.createDocumentFragment() 
            const option = document.createElement('option');
            option.disabled = true;
            option.selected = true;
            option.textContent = "Seleccionar Subcategoría *";
            fragment.appendChild(option)
            selectSub.appendChild(fragment)
        }

        //obtener valores de select desde bd
        fetch('/adquirir-sub/'+valCat,{
            method:'get'
        }).then(response => response.json())
        .then(list =>{
            if(list.msg){ 
                //crear mensaje de subcategoria
                let msgSelect = document.querySelector('.msgText')
                let frag = document.createDocumentFragment()
                let h6 = document.createElement('h6')
                h6.setAttribute("class", "text-center");
                h6.style.color="var(--color10)";
                h6.textContent = list.msg
                frag.append(h6)
                msgSelect.prepend(frag)
                //duracion de msg
                setTimeout(() => {
                    msgSelect.removeChild(msgSelect.firstElementChild)  
                    }, 8000);
            }
            else{
                //creando el listado de opciones
                list.forEach(data =>{
                    const fragment = document.createDocumentFragment() 
                    const op = document.createElement('option');
                    op.setAttribute('value', data.id_sub);
                    op.setAttribute('class','op-tmp')
                    op.innerHTML = data.subcat;
                    const clone = op.cloneNode(true)
                    fragment.appendChild(clone)
                    selectSub.appendChild(fragment)
                })
            }

        }).catch( err => console.log(err))
    })
}

if(document.querySelector('.btn-update-prod') !== null){    
    document.querySelector('.btn-update-prod').addEventListener('click',()=>{
        const formProd = document.querySelector('#formEditProd')
        
        const data = new FormData(formProd)

        fetch('/editar-producto',{
            method:'post',
            body:data
        }).then(response => response.json())
        .then(msg =>{
            const msgError = document.querySelector('.edit-box')
            let frag = document.createDocumentFragment()
            let h6 = document.createElement('h6')
            h6.setAttribute("class", "text-center");
            h6.textContent = ""

            if(msg.field){ 
                h6.style.color="var(--color10)";
                h6.textContent = msg.field
                frag.appendChild(h6)
            }            
            if(msg.fail){ 
                h6.style.color="var(--color10)";
                h6.textContent = msg.fail
                frag.appendChild(h6)
             }            
            if(msg.success){ 
                h6.style.color="var(--color11)";
                h6.textContent = msg.success
                frag.append(h6)

                formProd.reset()
             }
             msgError.prepend(frag)

            //duracion de msg
            setTimeout(() => {
                msgError.removeChild(msgError.firstElementChild)  
            }, 8000);

        }).catch(err => console.log(err))
    })
}