//add subcategory
if(document.querySelector('.btn-add-sub') !== null){

    const formSub = document.querySelector('#formSub')
    const btnAddSub = document.querySelector('.btn-add-sub')
    const urlSaveSub = "/agregar-subcategoria";

    btnAddSub.addEventListener('click', (e)=>{
        e.preventDefault

        const data = new FormData(formSub)

        fetch(urlSaveSub,{
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
                formSub.reset()
             }
             formSub.prepend(frag)

            //duracion de msg
            setTimeout(() => {
                formSub.removeChild(formSub.firstElementChild)  
            }, 6000);

        })
        .catch(err => console.log(err))        
    })
}

//edit subcategory
if(document.querySelector('.btn-edit-sub') !== null){

    const formEditSub = document.querySelector('#formEditSub')
    const btnEditSub = document.querySelector('.btn-edit-sub')
    const urlEditSub = "/editar-subcategoria";    

    btnEditSub.addEventListener('click', (e)=>{
        e.preventDefault
    
        const data = new FormData(formEditSub)
        
        fetch(urlEditSub, {
            method:'post',
            body:data
        }).then( response => response.json())
        .then(msg =>{         
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
             formEditSub.prepend(frag)

            //duracion de msg
            setTimeout(() => {
                formEditSub.removeChild(formEditSub.firstElementChild)  
            }, 6000);
        })
    })                  
}