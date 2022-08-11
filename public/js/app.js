var uname = Cookies.get("username")
if(uname!=undefined)
    document.getElementById("username-text").innerHTML=uname
else
    Cookies.set("username","DEFAULT")
var to_dos = document.getElementsByName('to-do')

to_dos.forEach(element=>{
    console.log(element)
    if(element.title=="none")
    {
        //element.style.border="solid red"
    }
    else
    {
        //element.style.border="solid green"
    }
    if(element.title==uname)
    {
        var fragment = document.createDocumentFragment();
        fragment.appendChild(element);
        document.getElementById('my-list').appendChild(fragment);
    }
})

var delets = document.getElementsByName('delete')
var multyple = 0
var selected = []
delets.forEach(element => {
   element.onmousedown=(e)=>{
     if(e.button===1)
     {
        if(selected.includes(element.id)){
            var index = selected.indexOf(element.id);
            if (index !== -1) {
                selected.splice(index, 1);
            }
            multyple--
            element.style.background="white"
            element.innerHTML = ""
        }
        else{
            multyple++
            selected.push(element.id)
            element.style.background="cyan"
            element.innerHTML = "&#10004"
        }
     }
     else if(e.button===0)
     {
        if(confirm("Do you really want to delete this?"))
        {
            document.getElementById('delete:'+element.id).submit()
        }
     }
   }
});



document.onmousedown=(e)=>{
    if(multyple!=0)
    {
        if(e.button===2)
        {
            if(confirm("Do you really want to delete this?"))
            {
                let a = document.getElementsByName("to-do")
                document.getElementById('delete:list').action="http://127.0.0.1:8000/delete/"+selected+"/"+a[0].id
                document.getElementById('delete:list').submit()
            }
        }
    }
}

var to_dos = document.getElementsByName('to-do')
to_dos.forEach(element => {
    element.onmousedown=(e)=>{
      if(e.button===2 && multyple==0)
      {
        console.log("test")
        if(element.parentNode.id=="my-list")
        {
            if(confirm("Do you really want to remove this to your list?"))
            {
                let a = document.getElementsByName("to-do")
                document.getElementById('change:'+element.className).action="http://127.0.0.1:8000/taskTake/none/"+element.className+"/"+a[0].id
                document.getElementById('change:'+element.className).submit()
            }
        }
        else
        {
            if(confirm("Do you really want to add this to your list?"))
            {
                let a = document.getElementsByName("to-do")
                var name = Cookies.get("username")
                document.getElementById('change:'+element.className).action="http://127.0.0.1:8000/taskTake/"+name+"/"+element.className+"/"+a[0].id
                document.getElementById('change:'+element.className).submit()
            }
        }
      }
}})

var username = document.getElementById('username-text')
username.onmousedown=(e)=>{
    if(e.button===0)
    {
        var old = Cookies.get("username")
        let person = prompt("Please enter your name:", "");
        if(person==null || person==undefined || person=="")
            return
        Cookies.set('username', person)
        let a = document.getElementsByName("to-do")
        document.getElementById('username').action="http://127.0.0.1:8000/usernameChange/"+person+"/"+a[0].id +"/"+old
        document.getElementById('username').submit()
    }
}