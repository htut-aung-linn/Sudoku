function getAns(){
    let mydata = new Array();
    for(var i = 0; i<9; i++){
        var rowdata = new Array();
        for(var j=0; j < 9; j++){
            var data = document.getElementById(i.toString()+"-"+j.toString()).value;
            if(data==''){
                data = '0';
            }
            let int = parseInt(data);
            if(!(int>=0 && int<10)){
                console.log("invalid");
            }
            rowdata.push(data);
        }
        mydata.push(rowdata);
    }
    //mydata.push(rowdata);
        $.ajax({
        url: "sudokuView.php",
        type: "POST",
        data: { mydata: mydata },
        success: function(response) {
            var jsonData;
            try {
                jsonData = JSON.parse(response);
                console.log(jsonData);
              } catch (e) {
                if (e instanceof SyntaxError) {
                  // Handle the error here
                  console.log("Invalid JSON data");
                } else {
                  // Handle other errors
                  console.log("Unexpected error");
                }
            }
            if(jsonData!=null){
                for(var i = 0; i<9; i++){
                    for(var j=0; j < 9; j++){
                        var input = document.getElementById(i.toString()+"-"+j.toString());
                        if( jsonData[i][j]!="0" && input.value != jsonData[i][j]){
                            input.value = jsonData[i][j];
                            input.style.color = "red";
                        }
                        if(jsonData[i][j]=="0"){
                            document.getElementById("pos-btn").disabled = false;
                        }
                    }
                }
            }
        }
        });
    //console.log(mydata);
}
function getPos(){
    let mydata = new Array();
    for(var i = 0; i<9; i++){
        var rowdata = new Array();
        for(var j=0; j < 9; j++){
            var data = document.getElementById(i.toString()+"-"+j.toString()).value;
            if(data==''){
                data = '0';
            }
            let int = parseInt(data);
            rowdata.push(data);
        }
        mydata.push(rowdata);
    }
    $.ajax({
        url: "sudokuView.php",
        type: "POST",
        data: { getP: mydata },
        success: function(response) {
            var jsonData;
            try {
                jsonData = JSON.parse(response);
                //console.log(jsonData);
              } catch (e) {
                if (e instanceof SyntaxError) {
                  // Handle the error here
                  console.log("Invalid JSON data");
                } else {
                  // Handle other errors
                  console.log("Unexpected error");
                }
            }
            var guess = "These possibilities are due to not enough information!<br>construction = (x,y) : {possibilities} <br> (1,1) is at top row and first square in table. <br>";
            for(var i = 0; i<9; i++){
                for(var j=0; j < 9; j++){
                    var input = document.getElementById(i.toString()+"-"+j.toString());
                    if(input.value ==''){
                        //console.log(true);
                        guess += "("+(j+1).toString() + "," + (i+1).toString()+")" +" : " + jsonData[i][j].toString() +"<br>";
                    }
                    
                }
            }
            document.getElementById("guess-value").innerHTML = guess;
            console.log(jsonData);
        }
        });
}

for(var i = 0; i<9; i++){
    for(var j=0; j < 9; j++){
        var inp = document.getElementById(i.toString()+"-"+j.toString());
        inp.addEventListener("input", function() {
            var inte = parseInt(this.value)
            if(inte>0 && inte<10){
                document.getElementById("get-btn").disabled = false;
                document.getElementById("noti").innerHTML="";
            }else{
                document.getElementById("get-btn").disabled = true;
                document.getElementById("noti").innerHTML="<p style='color:red'>"+this.value +" is INVALID input!</p>";
            }
            if(this.value=="" ){
                document.getElementById("get-btn").disabled = false;
                document.getElementById("noti").innerHTML="";
            }
        });
    }
}

