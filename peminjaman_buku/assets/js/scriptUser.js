var keyword = document.getElementById('inputCari');
var list = document.getElementById('list');

keyword.addEventListener('keyup',function(){

  var xhr = new XMLHttpRequest();

  xhr.onreadystatechange = function(){
    if( xhr.readyState == 4 && xhr.status == 200 ){
      list.innerHTML = xhr.responseText;
    }
  }

  xhr.open('GET','ajaxUser.php?keyword=' + keyword.value,true);
  xhr.send();
})