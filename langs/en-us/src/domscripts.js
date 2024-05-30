function cooldownRefresh(){
        document.querySelector("#refreshticketdata").style.display = "none";
        setTimeout(function(){
            document.querySelector("#refreshticketdata").style.display = "inline";
        }, 5000);
}

let a = document.querySelector("#refreshticketdata");
a.addEventListener(onclick,cooldownRefresh());

document.querySelector(".chatticket").scroll(0, document.querySelector(".chatticket").scrollHeight);