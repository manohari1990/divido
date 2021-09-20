
/*
* call this method on button click
* it takes value as string
*  returns response string
*/
function getJSONString(inputStr){
  if(inputStr != ""){
    try {
      ResultString = JSON.stringify(index(mergedObject, inputStr));
      if(typeof(ResultString) === 'undefined'){
        document.getElementById('ResultString').innerHTML = '<p class="labels">Result: </p> No value existed for given input';
      }else{
        document.getElementById('ResultString').innerHTML = '<p class="labels">Result: </p>' + ResultString;
      }
  
      document.getElementById('ErrorFileString').innerHTML = '<p class="labels">Error File list: </p>' + errorFileLit;
    } catch (e) {
      console.log(e);
    }
  }else{
    alert("please provide your input!");
  }
  
}

function index(obj,is) {
  let value = is.split('.')
  return value.reduce((o,i)=>o[i], obj);
}