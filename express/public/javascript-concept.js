
function average(a, b) {
    return (a + b) / 2;
  }
  
  console.log(average(2, 1));
/**
 * Promise code
 * 
 */
// function resolve(age){
//     return new Promise((resolve,reject)=>{
//         if(age >=18){
//             resolve(console.log("resolved"))
//         }else{
//             reject(console.log("rejected"));
//         }
//     })
// }

// resolve(17).then(()=>console.log("promise reolved")).catch(()=>console.log("not resolved"));

/**
 * Own Callback
 */
// function ownCallback(callback){
//     const constant = "callled";
//     callback(constant);
// }

// ownCallback(function(param){
//     console.log(param);
// });
/**
 * Closure
 */
 
//  function testClosure(param){
//      const constant = "called";
//      function innerClosure(){
//          const innerVar = "innerCalled";
//          console.log(innerVar + constant+param);
//      }
//      return innerClosure()
//  }
 
//  testClosure(123);

// setTimeout(function(){
//     console.log("1")
//     new Promise(function(res,rej){
//         res(console.log("promise"));
//         rej();
//     })
// },0);
// setTimeout(function(){
//     console.log("0")
// },1);


/**
 * Polyfill
 */
 
arr = [1,2,3,4,5];
//  let newarr = arr.map(function(item){
//      return item*item;
//  })
// console.log(newarr)

// function mymap(arr, cb){
//     const newarr = [];
//     for(let i=0; i<arr.length;i++){
//         newarr.push(cb(arr[i]))
//     }
//     return newarr;
// }

// const res = mymap(arr,function(item){
//     return item*item*item;
// })

// console.log(res);

/**
 * reduce
 */
// function myFilterArr(arr, cb){
//     const newarr = [];
//     for(let i=0;i<arr.length;i++){
//         if(cb(arr[i]))
//             newarr.push(arr[i])
//     }
//     return newarr;
// } 

// const res = myFilterArr(arr, function(item){
//     return item%2===0;
// })
// console.log(res);

/**
 * Reduce
 */
 
//  const res = arr.reduce((acc,item)=>{
//     return acc += item 
//  });
//  console.log(res)

// function polyfillMAP(arr, cb, v){
//     let sum = 0;

//     for(let i=0; i<arr.length; i++){
//         sum += cb(arr[i], v);
//     }
//     return sum;
// }

// function SUM(x, y) {
//   y+= x;
//   return y;
// }

// console.log(polyfillMAP(arr, funcrion(x,y){
//     y+= x;
//     return y;
// }, 0));

// Array.prototype.myreduce = function(cb,initialValue){
//     let accumulator = initialValue;
//     for(let i=0; i<this.length;i++){
//         accumulator = cb(accumulator, this[i], i, this)
//     }
//     return accumulator;
// }

// const res = arr.myreduce(function(acc,item){
//     return acc += item;
// },0);
// console.log(res)

/**
 * Map
 */
//  Array.prototype.mymap = function(cb){
//   let newarr = [];
//   for(let i=0;i < this.length; i++){
//       newarr.push(cb(this[i]));
//   }
//   return newarr;
//  };
//  const res = arr.mymap(function(item){
//      return item*item;
//  });
//  console.log(res);
/**
 * Filter
 */
 
//  Array.prototype.myfilter = function(cb){
//      let newarr = [];
//      for(let i=0; i< this.length;i++){
//          if(cb(this[i]))
//             newarr.push(this[i]);
//      }
//      return newarr;
//  }
//  const res = arr.myfilter(function(item){
//      return item%2 ===0;
//  });
//  console.log(res);

 
