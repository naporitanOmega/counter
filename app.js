window.onload = () =>{

    //get.phpと通信する
    fetch("get.php")
    //get.phpから返却された値をJavaScriptから操作出きるように加工する
    .then((res) =>{
        return(res.json());
    })
    //加工した値を使って処理
    .then((json) =>{
        if(json["status"]){
            const count = document.querySelector("#count");
            count.innerHTML = json['count'];
        }
        else{
            alert("APIでエラーが発生");
        }
    })
    //通信中にエラーが発生したらここが実行される
    .catch((error) =>{
        alert("通信中にエラーが発生");
    });
}

document.querySelector("#btn-reload").addEventListener("click", () => {
    location.reload();
});