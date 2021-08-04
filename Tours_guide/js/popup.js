
function exit() {
  document.querySelector('.exit-intent-popup').classList.remove('visible'); 
}

function popup(){
  document.querySelector('.exit-intent-popup').classList.add('visible'); 
}

function sentmail(username){
  const comment = document.getElementById("comment").value;
  Email.send({ 
    Host: "smtp.gmail.com",
    Username: "tourguid52@gmail.com",
    Password: "4CvnKwsaj9RTZMi",
    To: 'youremail@gmail.com',
    From: "tourguid52@gmail.com",
    Subject: "Review",
    Body: "<h1>username :"+username+"</h1><br><h2>comments:"+comment+"</h2>",
  })
    .then(function (message) {
      alert("mail sent successfully");
    });  
}