const formLevel = document.getElementById('formLevel');
const btnSaveLevel = document.querySelector('.btn-save-level');

if(btnSaveLevel !== null){
    btnSaveLevel.addEventListener('click',(e)=>{
        e.preventDefault        
    
        const data = new FormData(formLevel);

        fetch('/nivelar',{
            method:'post',
            body:data
        }).then( response => response.json())
        .then( msg => {
            //console.log(msg)
            let frag = document.createDocumentFragment()
            let h6 = document.createElement('h6')
            h6.setAttribute("class", "text-center");

            if(msg.fail){ 
                h6.style.color="var(--color10)";
                h6.textContent += msg.fail
                frag.append(h6)
            }
            if(msg.empty){ 
                h6.style.color="var(--color10)";
                h6.textContent += msg.empty
                frag.append(h6)
            }
            if(msg.success){
                h6.style.color="var(--color11)";
                h6.textContent = msg.success
                frag.append(h6)
                formLevel.reset();
            }

            formLevel.prepend(frag)

            //duracion de msg
            setTimeout(() => {
                formLevel.removeChild(formLevel.firstElementChild)                  
                }, 8000);

        })
        .catch( err => console.error(err) )
    })
} 