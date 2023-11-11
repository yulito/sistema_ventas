const urlUser   = '/gestion-usuario';
const urlUsers   = '/usuarios';
const tbody = document.querySelector('.tbody-reg')

window.addEventListener('load',(e)=>{
    e.preventDefault

    fetch(urlUsers, {
        method:'get'
    }).then(response => response.json())
    .then(list =>{
        /* list.forEach(element => {
            console.log(element.nomtipo)  
        });   */ 
        
        const template = document.querySelector('#tmp-user').content
        const fragment = document.createDocumentFragment()

        list.forEach(data =>{
            template.querySelector('.td1').textContent = data.nomusuario;
            if(data.nomtipo == "DESHABILITADO"){ 
                template.querySelector('.td2').style.color="red" }
                else{ 
                    template.querySelector('.td2').style.color="black" }
            template.querySelector('.td2').textContent = data.nomtipo;
            template.querySelector('button').value = data.nomusuario;          
            const clone = template.cloneNode(true)        
            fragment.appendChild(clone)
        })
        tbody.appendChild(fragment)
    })
})

//------------------------------------------------------------
const formReg = document.querySelector('#formUser');
const btnNewUser = document.querySelector('#btn-new-user');
const msgFormReg = document.querySelector('.msg-form-reg')
//const btnEditUser = document.querySelector('#btn-edit-user')

btnNewUser.addEventListener('click',(e)=>{
    e.preventDefault
    e.stopPropagation

    const data = new FormData(formReg);

    fetch(urlUser, {
        method:'post',        
        body:data
    }).then(response=>response.json())      
    .then(msg=>{
        console.log(msg)
        let frag = document.createDocumentFragment()
        let h6 = document.createElement('h6')
        h6.setAttribute("class", "text-center");
        h6.textContent = ""

        if(msg.field){ 
            h6.style.color="var(--color10)";
            h6.textContent += msg.field
            frag.appendChild(h6)
         }
         if(msg.pass){ 
            h6.style.color="var(--color10)";
            h6.textContent += msg.pass
            frag.appendChild(h6)
         }
         if(msg.type){ 
            h6.style.color="var(--color10)";
            h6.textContent += msg.type
            frag.appendChild(h6)
         }
         if(msg.name){ 
            h6.style.color="var(--color10)";
            h6.textContent += msg.name
            frag.appendChild(h6)
         }
         if(msg.success){ 
            h6.style.color="var(--color11)";
            h6.textContent = msg.success
            frag.appendChild(h6)
            
            //limpiar campos
            formReg.reset()

            //agregar usuario nuevo a la lista
            let type;
            if(msg.user.type == "DESHABILITADO"){ type = "<span style=color:red;>"+msg.user.type+"</span>";}
            else{ type = msg.user.type}

            document.querySelector('.tbody-reg').innerHTML += `<tr>
                                                                <th scope="row"><strong> - </strong></th>
                                                                <td>${msg.user.name}</td>
                                                                <td>${type}</td>
                                                                <td>
                                                                    <button value="${msg.user.name}" 
                                                                    type="button" id="btn-edit-user" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editUser">                                                                        
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                                                            <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 
                                                                            2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 
                                                                            3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                                                        </svg>                                                                        
                                                                    </button>                                                                                                          
                                                                </td>                    
                                                            </tr> `
         }           
         //agregamos msg
         msgFormReg.appendChild(frag)
         
         //duracion de msg
         setTimeout(() => {
            msgFormReg.removeChild(msgFormReg.lastElementChild)            
          }, 8000);
    })
    .catch(err => console.log(err)); 
    
})

/* btnEditUser.addEventListener('click', (e)=>{
    e.preventDefault
    console.log('abriendo modal')
    
}) */