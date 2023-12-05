if(document.querySelector('#btn-login') !== null){
    const btnLogin = document.querySelector('#btn-login')
    btnLogin.addEventListener('click',(e)=>{
        e.preventDefault
        const formLogin = document.querySelector('#formLogin')
        const data = new FormData(formLogin)

        fetch('/login',{
            method:'post',
            body:data
        }).then(response => response.json())
        .then(msg =>{
            console.log(msg)
            const body = document.querySelector('body')
            let frag = document.createDocumentFragment()
            let h4 = document.createElement('h4')
            h4.setAttribute("class", "text-center");
            h4.textContent = ""

            if(msg.field){ 
                h4.style.color="red";
                h4.textContent = msg.field
                frag.appendChild(h4)
            }
            if(msg.fail){ 
                h4.style.color="red";
                h4.textContent = msg.fail
                frag.appendChild(h4)
            }
            body.prepend(frag)    
            //duracion de msg
            setTimeout(() => {
                body.removeChild(body.firstElementChild)  
            }, 6000);

            if(msg.success){
                location.href = '/'
            }  
        })
        .catch( err => console.log(err))
    })
}