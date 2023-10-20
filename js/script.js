const pass=document.getElementById('password');
const con_pass=document.getElementById('con-pass');
const match=document.getElementById('pass-match');
const toggle_btn=document.getElementById('tgl-pass');
const nam=document.getElementById('name');
const s_btn=document.getElementById('s-btn');
const namehelp=document.getElementById('namehelp');
const namField=document.getElementById('fname');
const gname=document.getElementById('gname');
const sec=document.getElementById('sec');




let nameError=true;
let passError=true;
if(nam!==null){nam.addEventListener('focusout',(e)=>{
    if(nam.value==' '){
        namehelp.removeAttribute('hidden','');
        nameError=true;
    }
    else{
        namehelp.setAttribute('hidden','');
        nameError=false;
    }
})};


// Checking confirm password and password are matching or not 

if(con_pass!==null){    con_pass.addEventListener('input',(e)=>{
    if(pass.value==con_pass.value){
        passError=false;
        match.innerHTML='';
        con_pass.classList.remove('bg-n');
        pass.classList.remove('bg-n');
        match.classList.remove('text-danger');
    }
    else{
        match.innerHTML='<i class="fa-solid fa-xmark"></i> Password doesn\'t match';
        match.classList.add('text-danger');
        passError=true;
    }
});
const myinterval=setInterval(()=>{
    if(passError==false && nameError==false){
        s_btn.removeAttribute('disabled','');
        clearInterval(myinterval);
    }
    console.log(nameError,passError);
},1000);
};
    

if(namField!==null){
    const nam=document.querySelectorAll(".name");
    nam.forEach((nam)=>{
        nam.addEventListener('keydown',()=>{
            nam.value=nam.value.toUpperCase();
        });
        nam.addEventListener('focusout',()=>{
            nam.value=nam.value.toUpperCase();
        })
    })
    gname.addEventListener('keydown',()=>{
        gname.value=gname.value.toUpperCase();
    });
    gname.addEventListener('focusout',()=>{
        gname.value=gname.value.toUpperCase();
    })
    sec.addEventListener('keydown',()=>{
        sec.value=sec.value.toUpperCase();
    });
    sec.addEventListener('focusout',()=>{
        sec.value=sec.value.toUpperCase();
    })

}















// const s_btn=document.querySelectorAll('button');
// s_btn.forEach((btn)=>{
//     btn.addEventListener('click',(e)=>{
//         e.preventDefault();
//     })
// })

// toggle_btn.addEventListener('click',()=>{
//     let type =pass.getAttribute('type');
//     type=type=='password'?'text':'password';
//     pass.setAttribute('type',type);
//     toggle_btn.classList.toggle('fa-eye')
// });
