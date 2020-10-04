window.onload=(event)=>{

let dropdown = document.getElementsByClassName("dropdown-btn");

for (let i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
  this.classList.toggle("active");
  let dropdownContent = this.nextElementSibling;
  if (dropdownContent.style.display === "block") {
  dropdownContent.style.display = "none";
  } else {
  dropdownContent.style.display = "block";
  }
  });
}

let alertCls = document.getElementById('alertClass');


if(alertCls)
{
setTimeout(()=>{
  document.querySelector('#alertClass').remove();
}, 3000);
}

document.querySelectorAll('.conform').forEach(button=>{
  button.addEventListener('click',(e)=>{
    let answer = confirm("Are you sure with the operation");
    if(!answer)
    {
      e.preventDefault();
    }
  });
});


let selecAllBtn = document.getElementById('select-all');
let checkBox = document.querySelectorAll('.check-box');
if(selecAllBtn)
{
selecAllBtn.addEventListener('click',()=>{
    if(selecAllBtn.checked)
    {
      checkBox.forEach((check) =>{
        check.checked = true ;
      });
    }else{
      checkBox.forEach((check) =>{
        check.checked = false ;
      });
    }
});
}


};