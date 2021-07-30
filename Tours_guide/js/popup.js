
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
    Username: "deepgt065@gmail.com",
    Password: "TwisSVhab37snDA",
    To: 'dipeshkumargupta99@gmail.com',
    From: "deepgt065@gmail.com",
    Subject: "Sending Email using javascript",
    Body: "<h1>username :"+username+"</h1><br><h2>comments:"+comment+"</h2>",
  })
    .then(function (message) {
      alert("mail sent successfully")
    });  
}