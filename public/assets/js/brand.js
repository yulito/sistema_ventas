//add brand
if(document.querySelector('.btn-add-brand') !== null){

    const formBrand = document.querySelector('#formBrand')
    const btnAddBrand = document.querySelector('.btn-add-brand')
    const urlSaveBrand = "/agregar-marca";

    btnAddBrand.addEventListener('click', (e)=>{
        e.preventDefault

        const data = new FormData(formBrand)

        fetch(urlSaveBrand,{
            method:'post',
            body:data
        }).then(response => response.json())
        .then($msg =>{
            
            let frag = document.createDocumentFragment()
            let h6 = document.createElement('h6')
            h6.setAttribute("class", "text-center");
            h6.textContent = ""

            if($msg.field){ 
                h6.style.color="var(--color10)";
                h6.textContent = $msg.field
                frag.appendChild(h6)
            }
            if($msg.exist){ 
                h6.style.color="var(--color10)";
                h6.textContent = $msg.exist
                frag.appendChild(h6)
             }
            if($msg.success){ 
                h6.style.color="var(--color11)";
                h6.textContent = $msg.success
                frag.append(h6)
                formBrand.reset()
             }
             formBrand.prepend(frag)

            //duracion de msg
            setTimeout(() => {
                formBrand.removeChild(formBrand.firstElementChild)  
            }, 6000);

        })
        .catch(err => console.log(err))        
    })
}

//edit brand
if(document.querySelector('.btn-edit-brand') !== null){

    const formEditBrand = document.querySelector('#formEditBrand')
    const btnEditBrand = document.querySelector('.btn-edit-brand')
    const urlEditBrand = "/editar-marca";    

    btnEditBrand.addEventListener('click', (e)=>{
        e.preventDefault
        
        const data = new FormData(formEditBrand)
        
        fetch(urlEditBrand, {
            method:'post',
            body:data
        }).then( response => response.json())
        .then(msg =>{
            console.log(msg)
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
             }
             formEditBrand.prepend(frag)

            //duracion de msg
            setTimeout(() => {
                formEditBrand.removeChild(formEditBrand.firstElementChild)  
            }, 6000);
        })
    })                  
}