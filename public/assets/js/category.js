//add categoria
if(document.querySelector('.btn-add-cat') !== null){

    const formCat = document.querySelector('#formCat')
    const btnAddCat = document.querySelector('.btn-add-cat')
    const urlSaveCat = "/agregar-categoria";

    btnAddCat.addEventListener('click', (e)=>{
        e.preventDefault

        const data = new FormData(formCat)

        fetch(urlSaveCat,{
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
                formCat.reset()
             }
             formCat.prepend(frag)

            //duracion de msg
            setTimeout(() => {
                formCat.removeChild(formCat.firstElementChild)  
            }, 6000);

        })
        .catch(err => console.log(err))        
    })
}

//edit categoria
if(document.querySelector('.btn-edit-cat') !== null){

    const formEditCat = document.querySelector('#formEditCat')
    const btnEditCat = document.querySelector('.btn-edit-cat')
    const urlEditCat = "/editar-categoria";    

    btnEditCat.addEventListener('click', (e)=>{
        e.preventDefault
        
        const data = new FormData(formEditCat)
        
        fetch(urlEditCat, {
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
             formEditCat.prepend(frag)

            //duracion de msg
            setTimeout(() => {
                formEditCat.removeChild(formEditCat.firstElementChild)  
            }, 6000);
        })
    })                  
}