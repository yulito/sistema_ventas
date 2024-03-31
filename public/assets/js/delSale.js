const btn = document.querySelector('.btn-del-sale')
const form = document.querySelector('#formDelSale')
const url = "/eliminar-venta"

btn.addEventListener('click', (e)=>{
    e.preventDefault
    e.stopPropagation    

    const data = new FormData(form)

    fetch(url, {
        method:'post',
        body:data
    }).then(response => response.json())
    .then(msg =>{
        
        let frag = document.createDocumentFragment()
        let h6 = document.createElement('h6')
        h6.setAttribute("class", "text-center");
        
        if(msg.empty){ 
            h6.style.color="var(--color10)";
            h6.textContent += msg.empty
            frag.append(h6)
        }
        if(msg.fail){ 
            h6.style.color="var(--color10)";
            h6.textContent += msg.fail
            frag.append(h6)
        }
        if(msg.success){
            h6.style.color="var(--color11)";
            h6.textContent = msg.success
            frag.append(h6)
            form.reset()
        }

        form.prepend(frag)

        //duracion de msg
        setTimeout(() => {
            form.removeChild(form.firstElementChild)  
            }, 8000);
    })
    .catch(err => console.log(err));
})