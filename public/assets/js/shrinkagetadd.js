//add product
if(document.querySelector('.btn-add-shrinkage') !== null){    
    document.querySelector('.btn-add-shrinkage').addEventListener('click',()=>{
        const formShr = document.querySelector('#formShrinkage')
        const data = new FormData(formShr)

        fetch('/agregar-merma',{
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

                formShr.reset()
             }
             msgError.prepend(frag)

            //duracion de msg
            setTimeout(() => {
                msgError.removeChild(msgError.firstElementChild)  
            }, 8000);

        }).catch(err => console.log(err))
    })
}