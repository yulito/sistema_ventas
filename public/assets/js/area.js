//add area
if(document.querySelector('.btn-add-area') !== null){

    const formArea = document.querySelector('#formArea')
    const btnAddArea = document.querySelector('.btn-add-area')
    const urlSaveArea = "/agregar-area";

    btnAddArea.addEventListener('click', (e)=>{
        e.preventDefault

        const data = new FormData(formArea)

        fetch(urlSaveArea,{
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
                formArea.reset()
             }
             formArea.prepend(frag)

            //duracion de msg
            setTimeout(() => {
                formArea.removeChild(formArea.firstElementChild)  
            }, 6000);

        })
        .catch(err => console.log(err))        
    })
}

//edit area
if(document.querySelector('.btn-edit-area') !== null){

    const formEditArea = document.querySelector('#formEditArea')
    const btnEditArea = document.querySelector('.btn-edit-area')
    const urlEditArea = "/editar-area";    

    btnEditArea.addEventListener('click', (e)=>{
        e.preventDefault
        
        const data = new FormData(formEditArea)
        
        fetch(urlEditArea, {
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
             formEditArea.prepend(frag)

            //duracion de msg
            setTimeout(() => {
                formEditArea.removeChild(formEditArea.firstElementChild)  
            }, 6000);
        })
    })
            
         
}