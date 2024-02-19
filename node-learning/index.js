// const EventEmitter = require("node:events");
// const event = new EventEmitter;

// event.on('testing',(a,b)=>{
//     console.log(`console logged ${a.a} and ${a.b}`)
// });
// event.emit('testing',{a:"a",b:"b"});
// console.log("testing");

const express = require("express");
const app = express()
const port = 3000
app.listen(port,()=>{
    console.log("server is runnig on port 3000!");
})
app.get("/",(req,res)=>{
    console.log("home page");
    res.send("Hello world!");
});
