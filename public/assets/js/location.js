//add location
if(document.querySelector('.btn-add-location') !== null){    

    const formLocation = document.querySelector('#formLocation')
    const btnAddLocation = document.querySelector('.btn-add-location')
    const urlSaveLocation = "/agregar-locacion";

    btnAddLocation.addEventListener('click', (e)=>{
        e.preventDefault

        const data = new FormData(formLocation)

        fetch(urlSaveLocation,{
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
                formLocation.reset()
             }
             formLocation.prepend(frag)

            //duracion de msg
            setTimeout(() => {
                formLocation.removeChild(formLocation.firstElementChild)  
            }, 6000);

        })
        .catch(err => console.log(err))        
    })
}

//edit location
if(document.querySelector('.btn-edit-location') !== null){

    const formEditLocation = document.querySelector('#formEditLocation')
    const btnEditLocation = document.querySelector('.btn-edit-location')
    const urlEditLocation = "/editar-locacion";    

    btnEditLocation.addEventListener('click', (e)=>{
        e.preventDefault
        
        const data = new FormData(formEditLocation)
        
        fetch(urlEditLocation, {
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
             formEditLocation.prepend(frag)

            //duracion de msg
            setTimeout(() => {
                formEditLocation.removeChild(formEditLocation.firstElementChild)  
            }, 6000);
        })
    })                  
}

//insert or edit office
if(document.querySelector('#btn-new-office') !== null){
    const btnInsertOffice = document.querySelector('#btn-new-office')
    btnInsertOffice.addEventListener('click',()=>{
        const formOffice = document.querySelector('#formBrachOffice')
        const urlOffice = '/gestion-sucursal'

        const data = new FormData(formOffice)

        fetch(urlOffice,{
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
             if(msg.update){ 
                h6.style.color="var(--color11)";
                h6.textContent = msg.update
                frag.append(h6)                
             }
             formOffice.prepend(frag)

            //duracion de msg
            setTimeout(() => {
                formOffice.removeChild(formOffice.firstElementChild)  
            }, 6000);
        })
        .catch( err => console.log(err))
    })

}