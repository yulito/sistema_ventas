const formCheck = document.getElementById('formDeliveryCheck')
const check = document.getElementById('idcheck')
const statusChange = document.getElementById('statusChange')

if( check !== null ){
    check.addEventListener('change', (e)=>{
        e.preventDefault

        if(check.value == "on"){ 
            check.disabled = true
            statusChange.style.color="green";
            statusChange.style.textShadow="1px 1px 2px #000";
            statusChange.textContent = "Despachado"
            
            changeStatusCheck()
         }
    })
} 

function changeStatusCheck(){

    const data = new FormData(formCheck)

    fetch("/editar-despacho",{
        method:'post',
        body:data
    }).then( response => response.json() )
    .then(msg => {
        const msgError = document.querySelector('.edit-box')
            let frag = document.createDocumentFragment()
            let h6 = document.createElement('h6')
            h6.setAttribute("class", "text-center");
            h6.textContent = ""
                        
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
             msgError.prepend(frag)

            //duracion de msg
            setTimeout(() => {
                msgError.removeChild(msgError.firstElementChild)  
            }, 8000);

    })
    .catch( err => console.log(err))
}