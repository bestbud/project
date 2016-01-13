url = "ws://localhost:8080/echo";
ws = new WebSocket(url);

ws.onopen = function(){
log("open");
}
ws.onmessage = function(){
log(e.data);
ws.send("Hello World");
}
ws.onclose = function(){
log("closed");
}