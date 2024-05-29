function readCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}

function delete_cookie ( cookie_name ) {
    var cookie_date = new Date ( );  // current date & time
    cookie_date.setTime ( cookie_date.getTime() - 1 );
    document.cookie = cookie_name += "=; expires=" + cookie_date.toGMTString();
}
  
function verificaRegEx(x,myRegEx){
	if ( !(myRegEx.test(x)) ){
				return false;
	}
	return true;
}

function isVuoto(x){
	if ((x == "") || (x == "undefined")) {
		return true;
	}
	false;
}

function verificaMailPasswd(email, passwd){
    if(isVuoto(email) || isVuoto(passwd)) return false;
    myRegEx = /^[A-z0-9\.\+_-]+@[A-z0-9\._-]+\.[A-z]{2,6}$/;
    if(!verificaRegEx(email,myRegEx)) return false;
    return true;
}

function verificaNameSurname(name, surname){
    if(isVuoto(name) || isVuoto(surname)) return false;
    return true;
}

function createSpinner(){
    const loader = document.createElement('div');
    loader.id = 'loader';
    //loader.innerHTML = '<div class="spinner"></div><div class="loader-message">Caricamento in corso...</div>';
    loader.innerHTML = '<div class="spinner"></div>';
    document.body.appendChild(loader);
    $('body').addClass('disable-page-interaction');
    //$('.loader-message').hide();
}

function removeSpinner(){
    /*setTimeout(function() {
        $('.loader-message').fadeIn('slow');
    }, 2000);*/
    document.querySelector('#loader').remove();
    $('body').removeClass('disable-page-interaction');
}

function login(email, passwd){
    if(!verificaMailPasswd(email, passwd)){
        $("#error1").text("Formato email non valido o campi vuoti..");
        $("#error1").css('visibility', 'visible');
        return;
    }
    $("#error1").css('visibility', 'hidden');
    createSpinner();
    passwd = CryptoJS.SHA256(passwd);
    //alert(passwd);
    //Funzione accesso.
    $.ajax({
        type: "POST",
        url: "../php/login.php",
        data: "email=" + email + "&password=" + passwd,
        error: function(){
          alert("errore");
          removeSpinner();
        },  
        success: function(result){
            var user_id = readCookie("user_id");
            alert(user_id);
            if (user_id) { //Se l'utente si è loggato
                window.location.href= "../index.html";
            }
            else{
                $("#error1").text("Credenziali d'accesso errate.");
                $("#error1").css('visibility', 'visible');
            }
            removeSpinner();
        }
    });
}

function register(email, passwd,name,surname){
    if(!verificaMailPasswd(email, passwd)){
        $("#error1").text("Formato email non valido o campi vuoti..");
        $("#error1").css('visibility', 'visible');
        return;
    }
    if(!verificaNameSurname(name, surname)){
        $("#error1").text("campi vuoti..");
        $("#error1").css('visibility', 'visible');
        return;
    }
    $("#error1").css('visibility', 'hidden');
    createSpinner();
    passwd = CryptoJS.SHA256(passwd);
    //alert(passwd);
    $.ajax({
        type: "POST",
        url: "../php/register.php",
        data: "name=" + name+ "&surname=" + surname +"&email=" + email + "&password=" + passwd,
        error: function(){
          alert("errore");
          removeSpinner();
        },  
        success: function(result){
            //alert(result);
            var user_id = readCookie("user_id");
            //alert(user_id);
            if (user_id) { //Se l'utente si è registrato
                $.ajax({
                    type: "POST",
                    url: "../php/sendemail.php",
                    data: "opt=1"+ "&name=" + name+ "&surname=" + surname +"&email=" + email,
                    error: function(){
                      //alert("errore");
                      removeSpinner();
                      window.location.href= "../index.html";
                    },  
                    success: function(result){
                        //alert(result);
                        removeSpinner();
                        window.location.href= "../index.html";
                    }
                });
            }
            else{
                $("#error1").text("Utente già registrato");
                $("#error1").css('visibility', 'visible');
                removeSpinner();
            }
        }
    });

}

function sendmessage(mes){
    if(isVuoto(mes)){
        //alert("It's empty!");
        return;
    }
    createSpinner();
    $.ajax({
        type: "POST",
        url: "../php/sendemail.php",
        data: "opt=2"+ "&txt=" + mes,
        error: function(){
          //alert("errore");
          removeSpinner();
        },  
        success: function(result){
            //alert(result);
            removeSpinner();
            window.location.href= "../index.html";
        }
    });
}

function setup(){
    var user_id = readCookie("user_id");
    if (user_id) { //Se l'utente si è loggato
        document.getElementById('log1').textContent = "Logout";
        document.getElementById('credits').style.visibility = "visible";
        //$('#credits').prop('disabled', false);
    }
    else{
        document.getElementById('credits').style.visibility = "hidden";
        //$('#credits').prop('disabled', true);
    }
}

function logout(){
    delete_cookie("user_id");
    window.location.href= "index.html";
}

function gotologin(){
    var user_id = readCookie("user_id");
    if(user_id){
        logout();
    }
    else{
        window.location.href= "html/login.html";
    }
}

function gotocredits(){
    window.location.href= "html/credits.html";
}

function create(name,src_image,description){
    var user_id = readCookie("user_id");
    if(!user_id) return;
    if(isVuoto(name) || isVuoto(src_image) || isVuoto(description)) return false;
    createSpinner();
    $.ajax({
        type: "POST",
        url: "../php/createprojects.php",
        data: "name=" + name + "&src_image=" + src_image + "&description=" +description,
        error: function(){
          alert("errore");
          removeSpinner();
        },  
        success: function(result){
            removeSpinner();
            window.location.href= "projects.html";
            //alert(result);
        }
    });

}

var idprojects = [];

function vote(vote, idproject){
    //alert(vote + " " + idproject);
    var idp = idproject.split('x');
    //alert(idp[1]);
    $.ajax({
        type: "POST",
        url: "../php/insertvote.php",
        data: "IdProgetto=" + idp[1] + "&vote=" + vote,
        error: function(){
          alert("errore");
        },  
        success: function(result){
            buttonshow(idprojects);
        }
    });
}

function setallvote(){
    $.ajax({
		url: "../php/getallvote.php",
		method: "GET",
		dataType: "json",
		success: function(response) {
            for(var i = 0; i<response.length; i++){
                var project = response[i];
                var span = "#span" + project.IdProgetto;
                $(span).text(project.votazione);
            }
		},
		error: function(xhr, status, error) {
			console.error("Error into AJAX request:", error);
		}
	});
}

function buttonshow(idprojects){
    var user_id = readCookie("user_id");
    if (user_id) { //Se l'utente si è loggato
        $.ajax({
            url: "../php/getvote.php",
            method: "GET",
            dataType: "json",
            success: function(response) {
                for(var i = 0; i<response.length; i++){
                    var project = response[i];
                    for(var y = 0; y < idprojects.length; y++){
                        if(project.IdProgetto === idprojects[y]){
                            btnUp = "#upx" + idprojects[y];
                            btnDown = "#downx" + idprojects[y];
                            span = "#span" + idprojects[y];
                            $(btnUp).attr('disabled', true);
                            $(btnDown).attr('disabled', true);
                            $(span).css('visibility', 'visible');
                            break;
                        }
                    }
                }
                setallvote();
            },
            error: function(xhr, status, error) {
                console.error("Error into AJAX request:", error);
            }
        });
    }
    else{
        for(var i = 0; i<idprojects.length; i++){
            var btnId = idprojects[i];
            btnUp = "#upx" + btnId;
            btnDown = "#downx" + btnId;
            $(btnUp).attr('disabled', true);
            $(btnDown).attr('disabled', true);
        }
        
    }
}

function getAllProjects() {
    $.ajax({
		url: "../php/getallprojects.php",
		method: "GET",
		dataType: "json",
		success: function(response) {
            for(var i = 0; i< response.length; i++){
                var project = response[i];
                idprojects.push(project.IdProgetto);
				$("#addprojects").append("<div id= 'project"+project.IdProgetto+"'>" +  
                                        "<h2>"+project.nome+"</h2>" +
                                        "<img src='" +project.src_image +"' alt='image"+project.IdProgetto+"' style='height: auto; width: 600px;' />" +
                                        "<h3>"+project.descrizione+"</h3>" + 
                                        "<h3>"+project.data+"</h3>" +
                                        "<button id='upx"+project.IdProgetto+"' class='btn btn-success m-2' onclick='vote(+1,this.id)'>UPVOTE</button>" +
                                        "<button id='downx"+project.IdProgetto+"' class='btn btn-danger' onclick='vote(-1,this.id)'>DOWNVOTE</button>" +
                                        "<span id='span"+project.IdProgetto+"' class='p-3' style='visibility: hidden'>13113</span>" +
                                        "<hr>" +
                                        "</div>");
            }
            buttonshow(idprojects);
		},
		error: function(xhr, status, error) {
			console.error("Error into AJAX request:", error);
		}
	});
}

function showResult(){ 
			
    var inputVal = $("#usrinput").val();
    
    if(inputVal.length){
    
        $.get("../php/livesearch.php", {usrinput: inputVal}).done(function(data){ 
            
            if(data != ""){
                window.location.href="#project" + data;
            }
            
        });
    } 
}
