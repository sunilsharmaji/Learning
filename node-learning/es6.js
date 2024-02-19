/**
 * 1. Constants
 * 2. Scoping a) variable b) function scoping
 * 3. Arrow function
 * 4. Map
 * 5. spread operator
 * 6. Destructing
 * 7. Template Literals - String Interpolation
 * 8. Extended Parameter Handling
 * 9. Rest Parameter
 * 10. Value Export/Import
 * 11. Default
 * 12. Set Data-Structure
 * 13. Map data structure
 */
// 1. Immutable variables
// const PI = 3.141593
// console.log(PI > 3.0);

const { resolve } = require("path");

// 2. Block-Scoped variable
// for (let i = 0; i < a.length; i++) {
//     let x = a[i]
// }
// for (let i = 0; i < b.length; i++) {
//     let y = b[i]
// }

// let callbacks = []
// for (let i = 0; i <= 2; i++) {
//     callbacks[i] = function () { return i * 2 }
// }
// callbacks[0]() === 0
// callbacks[1]() === 2
// callbacks[2]() === 4

// {
//     function foo () { return 1 }
//     console.log(1,foo())
//     foo() === 1
//     {
//         function foo () { return 2 }
//         console.log(2,foo())
//         foo() === 2
//     }
//     console.log(3,foo())
//     foo() === 1
// }

// let m = new Map()
// // let s = Symbol()
// m.set("hello", 42)
// m.set("g", 34)
// m.get("g") === 34
// m.size === 2
// for (let [k,v] of m.entries())
//     console.log(k,v);
    // console.log(key + " = " + val)
/**
 * States of promise
 * 1. Pending
 * 2. Fullfiled
 * 3. Rejected
 */
function msgAfterTimeout (msg, who, timeout) {
    return new Promise((resolve, reject) => {
        setTimeout(() => resolve(`${msg} Hello ${who}!`), timeout)
    })
}
msgAfterTimeout("", "Foo", 100).then((msg) =>
    msgAfterTimeout(msg, "Bar", 200)
).then((msg) => {
    console.log(`done after 300ms:${msg}`)
}).catch((error)=>{
    console.log("error");
});

// new Promise((resolve,reject)=>{
//     setTimeout(()=>{
//         resolve(console.log("timeout"));
//     },0);
//     console.log("Promise run");
// });

/**
 * Que. How NodeJS handle concurrency?
 * Ans. 1. NodeJS is built around a event driven architecture with single threaded event loop.
 *      The event loop continuously checks for events and executes associated callbacks when event occurs.
 *      2. The event loop allows Node.js to handle many connections simultaneously without the need for thread.
 * Que. How Node.js handles many connections?
 * Ans: I/O queue
 */

// Application-level middleware
// Router-level middleware
// Error-handling middleware
// Built-in middleware
// Third-party middleware
//  Pug, Mustache, and EJS. The Express application generator uses Jade as