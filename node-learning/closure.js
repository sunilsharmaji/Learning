// const sumation = (a, b, c)=>{
//     return function(d){
//         return a+b+c+d;
//     }
// };
// console.log(sumation(1,2,3)(4));
// const fs = require("fs");

// const content = fs.readFileSync("./stream.txt","utf-8");
// console.log(content);
// // below code will go in event loop
/**
 * libuv handles asynchronous non-blocking operations in node.js and is a cross platform open source library written in C++ laungauge.
 * Thread pool and event loop
 */
// console.log("first");
// const readfile  = ()=>{
//     fs.readFile("./stream.txt","utf-8",(err, data)=>{
//         if(err){
//             console.log(err)
//         }else{
//             console.log("readfile called",data);
//         }
//     });
// }
// readfile();

// console.log("end");
// const sum = 35 * "hello";
// console.log(sum);

// const crypto = require('crypto');
// const start = Date.now();
// const MAX_CALL = 8;
// for(let i = 1; i <= MAX_CALL; i++){
//     const content = crypto.pbkdf2Sync('secret', 'salt', 100000, 64, 'sha512');
// }
// console.log("Time: ", Date.now()- start);
// const starts = Date.now();
// for(let i = 1; i <= MAX_CALL; i++){

// crypto.pbkdf2('secret', 'salt', 100000, 64, 'sha512', (err, derivedKey) => {
//     if (err) throw err;
//     // Printing the derived key
//     // console.log("Key Derived: ",derivedKey.toString('hex'));
//     console.log(" asyc Time: ", Date.now()- starts);
//  });
// }
// async function f() {

//     let promise = new Promise((resolve, reject) => {
//       setTimeout(() => resolve("done!"), 1000)
//     });
  
//     let result = await promise; // wait until the promise resolves (*)
  
//     console.log(result); // "done!"
//   }
  
// f();
/**
 * 
 */
 

// {
//     let i = 1;
//     {
//         let i = 0;
//         console.log(i);
//     }
//     console.log(i);
// }

// console.log(i);
// var i = 1;
// test1();
// function test1(){
//     console.log("namee..")
// }
// test();
// let test = function(){
//     console.log("name");
// }

// for (let i = 1; i <= 5; i++) {
//     (function(i){
//         setTimeout(function() { console.log(i) }, 100);
//     })(i)
// }
// [function() { console.log(i) },function() { console.log(i) },function() { console.log(i) },function() { console.log(i) },function() { console.log(i) }]
// setImmediate(function(){
//     console.log("setimmediate");
// });
// setTimeout(()=>{console.log("time 1")
//     setTimeout(()=>{console.log("time 1.1")},0);
// },0);
// setTimeout(()=>{console.log("time 2")},0);
// setTimeout(()=>{console.log("time 3")},0);

// setTimeout(()=>{console.log("time 1.1")},0);
// console.log("end");
// setTimeout(()=>{console.log("time 1.2")},1);
// end
// time 1.1
// time 1.2
// process.nextTick(function(){
//     console.log("1 nexttick");
//     process.nextTick(function(){
//         console.log("1.1 nexttick");
        
//     });
// });
// process.nextTick(function(){
//     console.log("2 nexttick");
// });
// process.nextTick(function(){
//     console.log("3 nexttick");
// });

/**
 * call stack[], queue = [1.1]
 */
//console.log("1 nexttick");
//console.log("2 nexttick");
//console.log("3 nexttick");
//console.log("1.1 nexttick");

// Define a function with a callback parameter
function myAsyncFunction(data, callback) {
    const new_var= 1;
    callback(null, new_var);
}
  
  // Example usage of the callback function
  myAsyncFunction('hello', (error, result) => {
    if (error) {
      console.error('Error:', error);
    } else {
      console.log('Result:', result);
    }
  });
