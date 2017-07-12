<html>
<head><title></title>
<style type="text/css">
li {
	shadow-box: 10, 20px;
    color:blue;
}
.x {
	color:#000;
    font-family: roboto;
}
.x:hover {
	color:red;
    cursor: hand;
    border:2px;
    background: #356;
}
</style>
<script>
function addNew() {
	var item = document.getElementById('newItem').value;
	var count = document.getElementById('i').value;// get the increment value

    if(item === "") {
    	alert("You cannot add an empty item");
        return false;
    }
    else {

    	var ul = document.getElementById("list");
        var li = document.createElement("li");
        var span = document.createElement("span");
        li.appendChild(document.createTextNode(item));
        li.setAttribute("id", "item"+count);

        span.appendChild(document.createTextNode(" x"));
        span.setAttribute("class", "x");
        span.setAttribute("onclick", 'delItem("'+'item'+count+'")');

        li.appendChild(span);
  		ul.appendChild(li);
        count++;
        document.getElementById('i').value = count;
    }
}

function delItem(itemId) {
	var item = document.getElementById(itemId);
	item.setAttribute("style", "display:none;");
	
}

</script>
</head>
<body>
<h1> My TodoList </h1>
<div id="todoItems">
	<input type="text" id="newItem" ><button onclick="addNew()" id="add">Add</button><br>
    <ul id="list">
    	
    </ul>

    <input type="hidden" value="1" id="i">
</div>
</body>
</html>