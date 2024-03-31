//add delivery
if(document.querySelector('.btn-add-delivery') !== null){    
    document.querySelector('.btn-add-delivery').addEventListener('click',()=>{
        const formDelivery = document.querySelector('#formDelivery')

        const data = new FormData(formDelivery)

        fetch('/agregar-despacho',{
            method:'post',
            body:data
        }).then(response => response.json())
        .then(msg =>{
            //console.log(msg.field)

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
            if(msg.client){ 
                h6.style.color="var(--color10)";
                h6.textContent = msg.client
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

                formDelivery.reset()
             }
             msgError.prepend(frag)

            //duracion de msg
            setTimeout(() => {
                msgError.removeChild(msgError.firstElementChild)  
            }, 8000);

        }).catch(err => console.log(err))
    })
}